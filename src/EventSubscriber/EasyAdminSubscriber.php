<?php

namespace App\EventSubscriber;

use App\Entity\Project;
use App\Service\ImageOptimizer;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    #[ArrayShape([AfterEntityPersistedEvent::class => "string[]"])]
    public static function getSubscribedEvents(): array
    {
        return [
            AfterEntityPersistedEvent::class => ['updateImageSize'],
        ];
    }

    public function updateImageSize(AfterEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Project)) {
            return;
        }

        if(!empty($entity->getBgImg())) {
            $optimizer = new ImageOptimizer();
            $optimizer->resize('uploads/projects/'.$entity->getBgImg());
        }
    }
}