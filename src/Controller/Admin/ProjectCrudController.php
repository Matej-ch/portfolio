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
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
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
        yield FormField::addTab('Main');
        yield TextField::new('name');
        yield ImageField::new('bg_img')
            ->setBasePath('uploads/projects')
            ->setUploadDir('public/uploads/projects')
            ->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')->hideOnIndex();
        yield BooleanField::new('isActive')->setHelp('Only active project will show on project page')->setSortable(true);
        yield BooleanField::new('isLanding')->setHelp('Show project on landing page')->setSortable(true);
        yield IntegerField::new('ordering');
        yield SlugField::new('slug')
            ->setHelp('Is generated automatically')
            ->setTargetFieldName('name')
            ->setFormTypeOption('disabled', $pageName !== Crud::PAGE_NEW)
            ->hideOnIndex();

        yield FormField::addTab('Links');
        yield TextField::new('source_url');
        yield TextField::new('project_url');

        yield FormField::addTab('Description');
        yield TextField::new('short_description')->onlyOnForms();
        yield TextEditorField::new('description')->setNumOfRows(20)->hideOnIndex();

        yield FormField::addTab('Images');
        yield CollectionField::new('projectImages');

        yield FormField::addTab('Tags / State');
        yield AssociationField::new('language')->autocomplete()->hideOnIndex();
        yield AssociationField::new('tags')->autocomplete()->hideOnIndex();
        yield AssociationField::new('projectState');

        yield FormField::addTab('Github');
        yield BooleanField::new('readmeIsEnabled')->setHelp('Whether to load readme from github')->setSortable(true);
        yield FormField::addTab('Collections');
        yield AssociationField::new('collections')->hideOnIndex()->setFormTypeOption('by_reference', false);

    }
}
