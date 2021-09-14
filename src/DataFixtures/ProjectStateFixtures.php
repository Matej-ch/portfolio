<?php

namespace App\DataFixtures;

use App\Entity\ProjectState;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectStateFixtures extends Fixture implements FixtureGroupInterface
{

    public function load(ObjectManager $manager)
    {
        //new ProjectState();
        foreach ($this->getStates() as $name => $description) {
            $st = new ProjectState();
            $st->setName($name);
            $st->setDescription($description);

            $manager->persist($st);

            $manager->flush();
        }
    }

    public function getStates(): array
    {
        return [
            'wip' => 'Work in progress',
            'finished' => 'Project finished',
            'start' => 'Project started',
            'deprecated' => 'Project deprecated'
        ];
    }

    public static function getGroups(): array
    {
        return ['live'];
    }
}