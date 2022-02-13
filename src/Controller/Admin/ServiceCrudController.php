<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use App\Repository\UserInfoRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Service::class;
    }

    public array $states;

    public function __construct(UserInfoRepository $repository)
    {
        $this->states = $repository->findAll();
    }

    public function configureFields(string $pageName): iterable
    {
        if (Crud::PAGE_NEW === $pageName || Crud::PAGE_EDIT === $pageName) {
            $choices = [];

            foreach ($this->states as $state) {
                $choices[$state->getName()] = $state->getId();
            }

            yield ChoiceField::new('relation')->setChoices(fn() => $choices);
        }

        yield TextField::new('title');
        yield TextField::new('description');
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

}
