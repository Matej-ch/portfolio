<?php

namespace App\EntityListener;

use App\Entity\Project;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProjectEntityListener
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function prePersist(Project $project, LifecycleEventArgs $event)
    {
        $project->computeSlug($this->slugger);
    }

    public function preUpdate(Project $project, LifecycleEventArgs $event)
    {
        $project->computeSlug($this->slugger);
    }
}