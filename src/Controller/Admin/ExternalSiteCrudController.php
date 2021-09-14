<?php

namespace App\Controller\Admin;

use App\Entity\ExternalSite;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ExternalSiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ExternalSite::class;
    }
}