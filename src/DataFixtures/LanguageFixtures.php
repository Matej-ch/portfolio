<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class LanguageFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getLanguages() as $name => $data) {
            $language = new Language();

            $language->setName($name);

            $language->setVersions($data['versions']);
            $language->setType($data['type']);

            $manager->persist($language);
            $manager->flush();
        }
    }

    public function getLanguages(): array
    {
        return [
            'php' => [
                'versions' => '5.x,7.x,8.x',
                'type' => 'language'
            ],
            'html' => [
                'versions' => '5',
                'type' => ''
            ],
            'css' => [
                'versions' => '3',
                'type' => 'language'
            ],
            'sass' => [
                'versions' => '',
                'type' => 'library'
            ],
            'javascript' => [
                'versions' => '',
                'type' => 'language'
            ],
            'typescript' => [
                'versions' => '',
                'type' => 'language'
            ],
            'jquery' => [
                'versions' => '',
                'type' => 'library'
            ],
            'vuejs' => [
                'versions' => '2.0,3.0',
                'type' => 'framework'
            ],
            'react' => [
                'versions' => '16.x,17.x',
                'type' => 'framework'
            ],
            'yii2' => [
                'versions' => '2.x',
                'type' => 'framework'
            ],
            'laravel' => [
                'versions' => '7.x,8.x',
                'type' => 'framework'
            ],
            'symfony' => [
                'versions' => '5.x',
                'type' => 'framework'
            ],
            'mysql' => [
                'versions' => '5.7,8.0',
                'type' => 'language'
            ],
            'graphQL' => [
                'versions' => '',
                'type' => 'language'
            ],
            'git' => [
                'versions' => '',
                'type' => 'tool'
            ],
            'kotlin' => [
                'versions' => '',
                'type' => 'language'
            ]
        ];
    }

    public static function getGroups(): array
    {
        return ['live'];
    }
}
