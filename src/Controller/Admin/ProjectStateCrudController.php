<?php

namespace App\Controller\Admin;

use App\Entity\ProjectState;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProjectStateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProjectState::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Project state')
            ->setEntityLabelInPlural('Projects states')
            ->setSearchFields(['name', 'description']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('description');
    }
}