<?php

namespace App\Controller\Admin;

use App\Entity\Language;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LanguageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Language::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name');
        yield TextField::new('versions');
        yield ImageField::new('icon')->setUploadDir('public/uploads/languages')->hideOnIndex();
        yield ImageField::new('icon')->setBasePath('uploads/languages')->hideOnForm();
        yield TextField::new('type');
    }

}
