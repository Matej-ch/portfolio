<?php

namespace App\DataFixtures;


use App\Factory\AdminFactory;
use App\Factory\ExternalSiteFactory;
use App\Factory\LanguageFactory;
use App\Factory\ProjectFactory;
use App\Factory\ProjectStateFactory;
use App\Factory\ServiceFactory;
use App\Factory\TagFactory;
use App\Factory\UserInfoFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager)
    {
        AdminFactory::createOne(['email' => 'admin@admin.com', 'username' => 'admin', 'roles' => ['ROLE_ADMIN']]);

        ExternalSiteFactory::createOne(['url' => 'https://github.com/', 'name' => 'Github']);
        ExternalSiteFactory::createOne(['url' => 'https://linkedin.com/', 'name' => 'Linkedin']);
        ExternalSiteFactory::createOne(['url' => 'https://twitter.com', 'name' => 'Twitter']);

        LanguageFactory::createOne(['name' => 'HTML', 'versions' => json_encode(['5'], JSON_THROW_ON_ERROR), 'type' => 'Language']);
        LanguageFactory::createOne(['name' => 'CSS', 'versions' => json_encode(['3'], JSON_THROW_ON_ERROR), 'type' => 'Language']);
        LanguageFactory::createOne(['name' => 'PHP', 'versions' => json_encode(['7', '8'], JSON_THROW_ON_ERROR), 'type' => 'Language']);
        LanguageFactory::createOne(['name' => 'Scss', 'type' => 'Extension']);
        LanguageFactory::createOne(['name' => 'Javascript', 'type' => 'Language']);
        LanguageFactory::createOne(['name' => 'Typescript', 'type' => 'Language']);
        LanguageFactory::createOne(['name' => 'Jquery', 'type' => 'Library']);
        LanguageFactory::createOne(['name' => 'VUE', 'type' => 'Framework']);
        LanguageFactory::createOne(['name' => 'React', 'type' => 'Framework']);
        LanguageFactory::createOne(['name' => 'Yii2', 'versions' => json_encode(['2'], JSON_THROW_ON_ERROR), 'type' => 'Framework']);
        LanguageFactory::createOne(['name' => 'Symfony', 'versions' => json_encode(['5', '6'], JSON_THROW_ON_ERROR), 'type' => 'Framework']);
        LanguageFactory::createOne(['name' => 'Laravel', 'type' => 'Framework']);
        LanguageFactory::createOne(['name' => 'Mysql', 'versions' => json_encode(['5', '8'], JSON_THROW_ON_ERROR), 'type' => 'Database management system']);
        LanguageFactory::createOne(['name' => 'graphQL', 'type' => 'Data query and manipulation language']);
        LanguageFactory::createOne(['name' => 'Git', 'type' => 'tool']);
        LanguageFactory::createOne(['name' => 'Webpack', 'type' => 'tool']);
        LanguageFactory::createOne(['name' => 'NPM', 'type' => 'tool']);
        LanguageFactory::createOne(['name' => 'Kotlin', 'type' => 'Language']);
        LanguageFactory::createOne(['name' => 'Svelte', 'type' => 'Framework']);
        LanguageFactory::createOne(['name' => '', 'versions' => '', 'type' => '']);

        TagFactory::createOne(['name' => 'handler']);
        TagFactory::createOne(['name' => 'jquery']);
        TagFactory::createOne(['name' => 'project']);
        TagFactory::createOne(['name' => 'extension']);
        TagFactory::createOne(['name' => 'library']);
        TagFactory::createOne(['name' => 'api']);

        ProjectStateFactory::createOne(['name' => 'WIP', 'description' => 'Work in progress']);
        ProjectStateFactory::createOne(['name' => 'Finished', 'description' => 'Project finished']);
        ProjectStateFactory::createOne(['name' => 'Start', 'description' => 'Project started']);
        ProjectStateFactory::createOne(['name' => 'Deprecated', 'description' => 'Project deprecated']);

        ServiceFactory::createOne([]);
        ServiceFactory::createOne([]);
        ServiceFactory::createOne([]);

        ProjectFactory::createMany(5);

        UserInfoFactory::createOne([]);

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['live'];
    }
}