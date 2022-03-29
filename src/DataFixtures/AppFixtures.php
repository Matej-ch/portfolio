<?php

namespace App\DataFixtures;

use App\Factory\AdminFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        AdminFactory::createOne(['email' => 'admin@example.com', 'username' => 'admin', 'roles' => ['ROLE_ADMIN']]);

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['live'];
    }
}