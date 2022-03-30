<?php

namespace App\Factory;

use App\Entity\ProjectState;
use App\Repository\ProjectStateRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<ProjectState>
 *
 * @method static ProjectState|Proxy createOne(array $attributes = [])
 * @method static ProjectState[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static ProjectState|Proxy find(object|array|mixed $criteria)
 * @method static ProjectState|Proxy findOrCreate(array $attributes)
 * @method static ProjectState|Proxy first(string $sortedField = 'id')
 * @method static ProjectState|Proxy last(string $sortedField = 'id')
 * @method static ProjectState|Proxy random(array $attributes = [])
 * @method static ProjectState|Proxy randomOrCreate(array $attributes = [])
 * @method static ProjectState[]|Proxy[] all()
 * @method static ProjectState[]|Proxy[] findBy(array $attributes)
 * @method static ProjectState[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static ProjectState[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ProjectStateRepository|RepositoryProxy repository()
 * @method ProjectState|Proxy create(array|callable $attributes = [])
 */
final class ProjectStateFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->text(),
            'description' => self::faker()->text(),
        ];
    }

    protected function initialize(): self
    {
        return $this;
    }

    protected static function getClass(): string
    {
        return ProjectState::class;
    }
}
