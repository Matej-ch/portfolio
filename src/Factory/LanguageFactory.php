<?php

namespace App\Factory;

use App\Entity\Language;
use App\Repository\LanguageRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Language|Proxy createOne(array $attributes = [])
 * @method static Language[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static Language|Proxy find($criteria)
 * @method static Language|Proxy findOrCreate(array $attributes)
 * @method static Language|Proxy first(string $sortedField = 'id')
 * @method static Language|Proxy last(string $sortedField = 'id')
 * @method static Language|Proxy random(array $attributes = [])
 * @method static Language|Proxy randomOrCreate(array $attributes = [])
 * @method static Language[]|Proxy[] all()
 * @method static Language[]|Proxy[] findBy(array $attributes)
 * @method static Language[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Language[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static LanguageRepository|RepositoryProxy repository()
 * @method Language|Proxy create($attributes = [])
 */
final class LanguageFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->text(),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(Language $language) {})
        ;
    }

    protected static function getClass(): string
    {
        return Language::class;
    }
}
