<?php

namespace App\EventSubscriber;

use App\Entity\Project;
use App\Service\ImageOptimizer;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            AfterEntityPersistedEvent::class => ['updateImageSize'],
        ];
    }

    public function updateImageSize(AfterEntityPersistedEvent $event)
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