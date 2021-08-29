<?php

namespace App\Controller\Admin;

use App\Entity\LanguageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LanguageTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LanguageType::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
