<?php

namespace App\Controller\Admin;

use App\Entity\ExternalSite;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ExternalSiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ExternalSite::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('External site')
            ->setEntityLabelInPlural('External sites')
            ->setSearchFields(['name', 'url'])
            ->setDefaultSort(['ordering' => 'ASC']);
    }
}