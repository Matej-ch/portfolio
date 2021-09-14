<?php

namespace App\DataFixtures;

use App\Entity\ExternalSite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class ExternalSiteFixtures extends Fixture implements FixtureGroupInterface
{

    public function load(ObjectManager $manager)
    {
        foreach ($this->getExternalSites() as $name => $data) {
            $externalSite = new ExternalSite();

            $externalSite->setName($name);
            $externalSite->setUrl($data['url']);
            $externalSite->setOrdering($data['ordering']);

            $manager->persist($externalSite);
            $manager->flush();
        }
    }

    public function getExternalSites(): array
    {
        return [
            'github' => [
                'url' => 'https://github.com/',
                'ordering' => 1
            ],
            'linkedin' => [
                'url' => 'https://linkedin.com/',
                'ordering' => 2
            ],
            'twitter' => [
                'url' => 'https://twitter.com',
                'ordering' => 3
            ],
        ];
    }

    public static function getGroups(): array
    {
        return ['live'];
    }
}