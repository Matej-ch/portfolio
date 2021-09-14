<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture implements FixtureGroupInterface
{

    public function load(ObjectManager $manager)
    {
        foreach ($this->getTags() as $name => $ordering) {
            $tag = new Tag();
            $tag->setName($name);
            $tag->setOrdering($ordering);

            $manager->persist($tag);

            $manager->flush();
        }
    }

    public function getTags(): array
    {
        return [
            'handler' => 0,
            'api' => 1,
            'project' => 2,
            'code' => 3,
            'coding' => 4,
            'jquery' => 5,
        ];
    }

    public static function getGroups(): array
    {
        return ['live'];
    }
}