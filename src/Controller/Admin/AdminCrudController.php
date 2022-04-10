<?php

namespace App\Controller\Admin;

use App\Entity\Admin;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdminCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Admin::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('username');
        yield EmailField::new('email');
        yield BooleanField::new('isVerified')->renderAsSwitch(false);
    }

    public function configureActions(Actions $actions): Actions
    {
        $authAction = Action::new('auth');
        $authAction->linkToUrl(function () {
            return $this->generateUrl('app_2fa_enable');
        })->setIcon('fa fa-exclamation')
            ->setLabel('Enable 2fa')
            ->addCssClass('btn btn-warning');

        return parent::configureActions($actions)
            ->add(Crud::PAGE_DETAIL, $authAction);
    }
}
