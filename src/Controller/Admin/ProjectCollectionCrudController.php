<?php

namespace App\Controller\Admin;

use App\Entity\ProjectCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;

class ProjectCollectionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProjectCollection::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Collection')
            ->setEntityLabelInPlural('Collections')
            ->setSearchFields(['name', 'description'])
            ->setDefaultSort(['id' => 'DESC'])
            ->setPageTitle(Crud::PAGE_EDIT, static function (ProjectCollection $project) {
                return sprintf('Edit %s', $project->getName());
            })
            ->setPageTitle(Crud::PAGE_DETAIL, static function (ProjectCollection $project) {
                return sprintf('Collection: %s', $project->getName());
            });
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(TextFilter::new('name'))
            ->add(TextFilter::new('description'))
            ->add(BooleanFilter::new('is_landing'));
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name');
        yield TextEditorField::new('description')->setNumOfRows(20)->hideOnIndex();
        yield SlugField::new('slug')
            ->setHelp('Is generated automatically')
            ->setTargetFieldName('name')
            ->setFormTypeOption('disabled', $pageName !== Crud::PAGE_NEW)
            ->hideOnIndex();
        yield BooleanField::new('isLanding')->setHelp('Show project on landing page')->setSortable(true);
        yield AssociationField::new('project')->hideOnIndex();

    }

}