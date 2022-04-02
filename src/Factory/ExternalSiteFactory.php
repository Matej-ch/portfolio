<?php

namespace App\Factory;

use App\Entity\ExternalSite;
use App\Repository\ExternalSiteRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @method static ExternalSite|Proxy createOne(array $attributes = [])
 * @method static ExternalSite[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static ExternalSite|Proxy find($criteria)
 * @method static ExternalSite|Proxy findOrCreate(array $attributes)
 * @method static ExternalSite|Proxy first(string $sortedField = 'id')
 * @method static ExternalSite|Proxy last(string $sortedField = 'id')
 * @method static ExternalSite|Proxy random(array $attributes = [])
 * @method static ExternalSite|Proxy randomOrCreate(array $attributes = [])
 * @method static ExternalSite[]|Proxy[] all()
 * @method static ExternalSite[]|Proxy[] findBy(array $attributes)
 * @method static ExternalSite[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static ExternalSite[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static ExternalSiteRepository|RepositoryProxy repository()
 * @method ExternalSite|Proxy create($attributes = [])
 */
class ExternalSiteFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function initialize(): self
    {
        return $this;
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->slug(2),
            'url' => self::faker()->url(),
            'icon' => self::faker()->filePath(),
            'ordering' => self::faker()->numberBetween(0, 50),
            'hide' => self::faker()->numberBetween(0, 1),
            'isPersonal' => self::faker()->numberBetween(0, 1),
        ];
    }

    protected static function getClass(): string
    {
        return ExternalSite::class;
    }
}