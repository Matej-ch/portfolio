<?php

namespace App\Controller\Admin;

use App\Entity\ExternalSite;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;

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
        yield TextField::new('name');
        yield UrlField::new('url');
        yield TextField::new('icon')->setLabel('Icon classes for font-awesome brand icons')->onlyOnForms();
        yield TextField::new('fullIcon')->renderAsHtml()->onlyOnIndex();
        yield IntegerField::new('ordering');
        yield BooleanField::new('hide');
        yield BooleanField::new('isPersonal');
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('url')
            ->add(BooleanFilter::new('hide'));
    }
}