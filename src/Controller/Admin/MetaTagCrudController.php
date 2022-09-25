<?php

namespace App\Controller\Admin;

use App\Entity\MetaTag;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MetaTagCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return MetaTag::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('pageName')->hideOnForm();

        yield ChoiceField::new('pageName')->setChoices([
            'About page' => 'app_about',
            'Contact page' => 'app_contact',
            'Projects page' => 'app_homepage',
            'Project detail page' => 'app_project_show',
            'Landing page' => 'app_landing',
            'Project collections' => 'app_collections',
            'Collection detail' => 'app_collection_show',
        ])->setHelp('Name of route in your controllers eg. `app_home`')->hideOnDetail()->hideOnIndex();
        yield TextField::new('name')->setHelp('Name attribute on meta tag, not all tags require this');
        yield TextField::new('content')->setHelp('Content of `Content` attribute, not always required');
        yield TextField::new('charset');
        yield TextField::new('httpEquiv');
        yield TextField::new('itemprop');
    }
}