<?php

namespace App\Controller\Admin;

use App\Entity\UserInfo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserInfoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return UserInfo::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield BooleanField::new('is_active');
        yield ImageField::new('avatar')->setUploadDir('public/uploads/users')->hideOnIndex();
        yield ImageField::new('avatar')->setBasePath('uploads/users')->hideOnForm();

        yield TextField::new('name');
        yield TextField::new('location');
        yield TextField::new('education');
        yield TextField::new('work');
        yield TextEditorField::new('description');
    }
}
