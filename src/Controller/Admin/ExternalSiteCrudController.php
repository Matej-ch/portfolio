<?php

namespace App\Controller\Admin;

use App\Entity\ExternalSite;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

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

    public function configureFields(string $pageName): iterable
    {
        return [
            'name',
            UrlField::new('url'),
            ImageField::new('icon')->setUploadDir('public/uploads/sites')->hideOnIndex(),
            ImageField::new('icon')->setBasePath('uploads/sites')->hideOnForm(),
            'ordering'
        ];
    }
}