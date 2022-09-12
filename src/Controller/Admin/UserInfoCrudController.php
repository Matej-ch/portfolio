<?php

namespace App\Controller\Admin;

use App\Entity\UserInfo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
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
        yield TextField::new('name');
        yield TextField::new('location');
        yield TextField::new('education')->setHelp('Highest achieved education');
        yield TextField::new('work');
        yield TextField::new('work_email');
        yield TextField::new('aboutMeTitle');
        yield ImageField::new('avatar')
            ->setBasePath('uploads/users')
            ->setUploadDir('public/uploads/users')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
            ->setHelp('Picture of yourself for about me page and icon in menu');

        yield ImageField::new('avatarBig')
            ->setBasePath('uploads/users')
            ->setUploadDir('public/uploads/users')
            ->setUploadedFileNamePattern('[slug]-[timestamp]-big.[extension]')
            ->setLabel('Big picture of yourself')
            ->setHelp('Picture shown in `Who am i` section of projects page');

        yield TextEditorField::new('description')->setLabel('Description shown on about me page');
        yield TextEditorField::new('whoAmI')->hideOnIndex()
            ->setLabel('Who am i')
            ->setHelp('Write something about yourself. Text in `Who am i` section on projects page');
        yield BooleanField::new('is_active')->renderAsSwitch(false);

        yield AssociationField::new('services');
    }
}
