<?php

namespace App\EntityListener;

use App\Entity\ProjectCollection;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProjectCollectionEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(ProjectCollection $project, LifecycleEventArgs $event)
    {
        $project->computeSlug($this->slugger);
    }

    public function preUpdate(ProjectCollection $project, LifecycleEventArgs $event)
    {
        $project->computeSlug($this->slugger);
    }
}