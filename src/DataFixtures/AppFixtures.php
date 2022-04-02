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

        ExternalSiteFactory::createOne(['url' => 'https://github.com/', 'name' => 'Github', 'icon' => 'fab fa-github']);
        ExternalSiteFactory::createOne(['url' => 'https://linkedin.com/', 'name' => 'Linkedin', 'icon' => 'fab fa-linkedin']);
        ExternalSiteFactory::createOne(['url' => 'https://twitter.com', 'name' => 'Twitter', 'icon' => 'fab fa-twitter']);
        ExternalSiteFactory::createOne(['url' => 'https://codepenio.com', 'name' => 'Codepen', 'icon' => 'fab fa-codepen']);

        $languages[] = LanguageFactory::createOne(['name' => 'HTML', 'versions' => json_encode(['5'], JSON_THROW_ON_ERROR), 'type' => 'Language']);
        $languages[] = LanguageFactory::createOne(['name' => 'CSS', 'versions' => json_encode(['3'], JSON_THROW_ON_ERROR), 'type' => 'Language']);
        $languages[] = LanguageFactory::createOne(['name' => 'PHP', 'versions' => json_encode(['7', '8'], JSON_THROW_ON_ERROR), 'type' => 'Language']);
        $languages[] = LanguageFactory::createOne(['name' => 'Scss', 'type' => 'Extension']);
        $languages[] = LanguageFactory::createOne(['name' => 'Javascript', 'type' => 'Language']);
        $languages[] = LanguageFactory::createOne(['name' => 'Typescript', 'type' => 'Language']);
        $languages[] = LanguageFactory::createOne(['name' => 'Jquery', 'type' => 'Library']);
        $languages[] = LanguageFactory::createOne(['name' => 'VUE', 'type' => 'Framework']);
        $languages[] = LanguageFactory::createOne(['name' => 'React', 'type' => 'Framework']);
        $languages[] = LanguageFactory::createOne(['name' => 'Yii2', 'versions' => json_encode(['2'], JSON_THROW_ON_ERROR), 'type' => 'Framework']);
        $languages[] = LanguageFactory::createOne(['name' => 'Symfony', 'versions' => json_encode(['5', '6'], JSON_THROW_ON_ERROR), 'type' => 'Framework']);
        $languages[] = LanguageFactory::createOne(['name' => 'Laravel', 'type' => 'Framework']);
        $languages[] = LanguageFactory::createOne(['name' => 'Mysql', 'versions' => json_encode(['5', '8'], JSON_THROW_ON_ERROR), 'type' => 'Database management system']);
        $languages[] = LanguageFactory::createOne(['name' => 'graphQL', 'type' => 'Data query and manipulation language']);
        $languages[] = LanguageFactory::createOne(['name' => 'Git', 'type' => 'Tool']);
        $languages[] = LanguageFactory::createOne(['name' => 'Webpack', 'type' => 'Tool']);
        $languages[] = LanguageFactory::createOne(['name' => 'NPM', 'type' => 'Tool']);
        $languages[] = LanguageFactory::createOne(['name' => 'Kotlin', 'type' => 'Language']);
        $languages[] = LanguageFactory::createOne(['name' => 'Svelte', 'type' => 'Framework']);
        $languages[] = LanguageFactory::createOne(['name' => 'Less.js', 'versions' => '', 'type' => 'Tool']);

        ProjectStateFactory::createOne(['name' => 'WIP', 'description' => 'Work in progress']);
        ProjectStateFactory::createOne(['name' => 'Finished', 'description' => 'Project finished']);
        ProjectStateFactory::createOne(['name' => 'Start', 'description' => 'Project started']);
        $projectState = ProjectStateFactory::createOne(['name' => 'Deprecated', 'description' => 'Project deprecated']);

        $tags[] = TagFactory::createOne(['name' => 'handler']);
        $tags[] = TagFactory::createOne(['name' => 'jquery']);
        $tags[] = TagFactory::createOne(['name' => 'project']);
        $tags[] = TagFactory::createOne(['name' => 'extension']);
        $tags[] = TagFactory::createOne(['name' => 'library']);
        $tags[] = TagFactory::createOne(['name' => 'api']);

        ProjectFactory::createMany(50, static function () use ($projectState, $tags, $languages) {
            return [
                'projectState' => $projectState,
                'tags' => $tags,
                'language' => array_slice($languages, 0, random_int(1, count($languages) - 1), true),
            ];
        });

        $services[] = ServiceFactory::createOne(['title' => 'Frontend']);
        $services[] = ServiceFactory::createOne(['title' => 'Backend']);
        $services[] = ServiceFactory::createOne(['title' => 'FullStack']);

        UserInfoFactory::createMany(1, static function () use ($services) {
            return [
                'services' => $services
            ];
        });

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['live'];
    }
}