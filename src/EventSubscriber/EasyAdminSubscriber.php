<?php

namespace App\EventSubscriber;

use App\Entity\Project;
use App\Service\ImageOptimizer;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly ImageOptimizer $imageOptimizer)
    {
    }


    public static function getSubscribedEvents(): array
    {
        return [
            AfterEntityPersistedEvent::class => ['updateImageSize'],
            AfterEntityUpdatedEvent::class => ['updateImageSize'],
        ];
    }

    public function updateImageSize(AfterEntityPersistedEvent|AfterEntityUpdatedEvent $event): void
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Project)) {
            return;
        }

        if (!empty($entity->getBgImg())) {
            $this->imageOptimizer->resize('uploads/projects/' . $entity->getBgImg());
        }
    }
}