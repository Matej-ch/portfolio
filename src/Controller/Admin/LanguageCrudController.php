<?php

namespace App\Controller\Admin;

use App\Entity\Language;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;

class LanguageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Language::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name');
        yield CollectionField::new('versionsArray')->hideOnIndex();
        yield TextField::new('versions')->hideOnForm();
        yield ImageField::new('icon')
            ->setBasePath('uploads/languages')
            ->setUploadDir('public/uploads/languages')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]');
        yield TextField::new('type');
        yield BooleanField::new('hide');
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('versions')
            ->add('type')
            ->add(BooleanFilter::new('hide'));
    }

}
