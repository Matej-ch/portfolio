<?php

namespace App\DataFixtures;

use App\Factory\ProjectFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        ProjectFactory::new()->createMany(20);

        ProjectFactory::new()->deactivate()->createMany(5);
    }
}
