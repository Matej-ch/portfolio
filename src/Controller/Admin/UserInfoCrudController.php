<?php

namespace App\Controller\Admin;

use App\Entity\UserInfo;
use EasyCorp\Bundle\EasyAdminBundle\Config\Asset;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
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
        yield FormField::addTab('Personal');
        yield TextField::new('name');
        yield TextField::new('location');
        yield TextField::new('education')->setHelp('Highest achieved education');
        yield TextField::new('work');
        yield TextField::new('work_email');
        yield TextField::new('github_name');
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

        yield FormField::addTab('About me');
        yield TextField::new('aboutMeTitle');
        yield TextEditorField::new('description')->setLabel('Description shown on about me page');
        yield TextEditorField::new('whoAmI')->hideOnIndex()
            ->setLabel('Who am i')
            ->setHelp('Write something about yourself. Text in `Who am i` section on projects page');
        yield BooleanField::new('is_active')->renderAsSwitch(false)->setHelp('Whether this user info is used on portfolio page, only one user info can be active at once');

        yield FormField::addTab('Hire me');
        yield FormField::addPanel('Fiverr');
        yield BooleanField::new('fiverrEnable')->setLabel('Enable fiverr')->setHelp('Show fiverr widget on contact page')->onlyOnForms();
        yield TextareaField::new('fiverrHtml')->setLabel('Fiverr html')
            ->setHelp('This is html from your fiverr profile')
            ->addWebpackEncoreEntries('textareaField')
            ->setCssClass('js-textarea-container-with-overflow')
            ->onlyOnForms();
        yield TextField::new('fiverrId')->setLabel('Script id')->setHelp('ID on script tag from your fiverr profile')->onlyOnForms();
        yield TextField::new('fiverrSrc')->setLabel('Script src')->setHelp('Source (url) on script tag from your fiverr profile')->onlyOnForms();


        yield FormField::addPanel('Upwork');
        yield BooleanField::new('upworkEnable')->setLabel('Enable upwork')->setHelp('Show upwork widget on contact page')->onlyOnForms();
        yield TextField::new('upworkSrc')->setLabel('Profile url')->setHelp('Profile (url) from upwork settings')->onlyOnForms();
        yield ImageField::new('upworkLogo')->setLabel('Upwork logo')->setHelp('Upwork logo to show on widget')
            ->setBasePath('uploads/users')
            ->setUploadDir('public/uploads/users')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
            ->onlyOnForms();

        yield FormField::addTab('Services');
        yield AssociationField::new('service')->hideOnIndex();
    }
}
