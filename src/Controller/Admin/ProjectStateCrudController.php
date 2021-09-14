<?php

namespace App\Controller\Admin;

use App\Entity\ProjectState;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProjectStateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProjectState::class;
    }
}