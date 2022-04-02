<?php

namespace App\Factory;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Project|Proxy createOne(array $attributes = [])
 * @method static Project[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Project|Proxy find($criteria)
 * @method static Project|Proxy findOrCreate(array $attributes)
 * @method static Project|Proxy first(string $sortedField = 'id')
 * @method static Project|Proxy last(string $sortedField = 'id')
 * @method static Project|Proxy random(array $attributes = [])
 * @method static Project|Proxy randomOrCreate(array $attributes = [])
 * @method static Project[]|Proxy[] all()
 * @method static Project[]|Proxy[] findBy(array $attributes)
 * @method static Project[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Project[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProjectRepository|RepositoryProxy repository()
 * @method Project|Proxy create($attributes = [])
 */
final class ProjectFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->realText(50),
            'isActive' => 1,
            'description' => self::faker()->paragraph(self::faker()->numberBetween(1, 4), true),
            'createdAt' => self::faker()->dateTime(),
            'updatedAt' => self::faker()->dateTime(),
            'slug' => self::faker()->slug(),
            'sourceUrl' => self::faker()->url(),
            'projectUrl' => self::faker()->url(),
            'bgImg' => self::faker()->filePath(),
            'shortDescription' => self::faker()->realText(20)
        ];
    }

    protected function initialize(): self
    {
        return $this->afterInstantiate(function (Project $project) {
            if (!$project->getSlug()) {
                $slugger = new AsciiSlugger();
                $project->setSlug($slugger->slug($project->getName()));
            }
        });
    }

    protected static function getClass(): string
    {
        return Project::class;
    }

    public function deactivate(): self
    {
        return $this->addState(['isActive' => 0]);
    }
}
