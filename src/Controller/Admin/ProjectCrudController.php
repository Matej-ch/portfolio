<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Form\LanguageType;
use App\Repository\LanguageRepository;
use App\Repository\ProjectStateRepository;
use App\Repository\TagRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

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
            ->setDefaultSort(['createdAt' => 'DESC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('name'));
    }

    public function configureFields(string $pageName): iterable
    {

        $name = TextField::new('name');
        $slug = SlugField::new('slug')->setTargetFieldName('name');
        $description = TextEditorField::new('description')->setNumOfRows(20);
        $isActive = BooleanField::new('is_active');

        $sourceUrl = TextField::new('source_url');
        $projectUrl = TextField::new('project_url');

        if (Crud::PAGE_NEW === $pageName || Crud::PAGE_EDIT === $pageName) {
            $choices = [];

            foreach ($this->states as $state) {
                $choices[$state->getName()] = $state->getId();
            }

            return [
                $name,
                $sourceUrl,
                $projectUrl,
                $slug,
                $description,
                $isActive,
                ChoiceField::new('state')->setChoices(fn () => $choices ),
                AssociationField::new('language'),
                AssociationField::new('tags')->autocomplete()
            ];
        }

        return [
            $name,
            $sourceUrl,
            $projectUrl,
            $slug,
            $description,
            $isActive,
            TextField::new('state')
        ];
    }
}
