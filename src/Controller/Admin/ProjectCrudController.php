<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Repository\ProjectStateRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public array $states;

    public function __construct(ProjectStateRepository $repository)
    {
        $this->states = $repository->findAll();
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Project')
            ->setEntityLabelInPlural('Projects')
            ->setSearchFields(['name', 'description'])
            ->setDefaultSort(['id' => 'DESC'])
            ->setPageTitle(Crud::PAGE_DETAIL, static function (Project $project) {
                return sprintf('Project: %s', $project->getName());
            });
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(TextFilter::new('name'))
            ->add(BooleanFilter::new('isActive'))
            ->add('projectState')
            ->add('language')
            ->add('tags');
    }

    public function configureActions(Actions $actions): Actions
    {
        $viewAction = Action::new('view');
        $viewAction->linkToUrl(function (Project $project) {
            return $this->generateUrl('app_project_show', ['slug' => $project->getSlug()]);
        })->setIcon('fa fa-eye')
            ->setLabel('View on site')
            ->addCssClass('btn btn-success');

        return parent::configureActions($actions)
            ->add(Crud::PAGE_DETAIL, $viewAction)
            ->add(Crud::PAGE_INDEX, $viewAction);
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name');
        yield TextField::new('source_url');
        yield TextField::new('project_url');
        yield ImageField::new('bg_img')
            ->setBasePath('uploads/projects')
            ->setUploadDir('public/uploads/projects')
            ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')->hideOnIndex();
        yield AssociationField::new('language')->autocomplete()->hideOnIndex();
        yield AssociationField::new('tags')->autocomplete()->hideOnIndex();
        yield TextField::new('short_description')->onlyOnForms();
        yield TextEditorField::new('description')->setNumOfRows(20)->hideOnIndex();
        yield SlugField::new('slug')
            ->setTargetFieldName('name')
            ->setFormTypeOption('disabled', $pageName !== Crud::PAGE_NEW)
            ->hideOnIndex();
        yield BooleanField::new('is_active')->renderAsSwitch(false);
        yield BooleanField::new('readme_is_enabled')->renderAsSwitch(false);
        yield AssociationField::new('projectState');
    }
}
