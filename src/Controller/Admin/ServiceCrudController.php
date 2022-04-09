<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use App\Repository\UserInfoRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
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
        yield TextField::new('title');
        yield TextEditorField::new('description')->setNumOfRows(5);
    }
}
