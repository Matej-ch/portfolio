<?php

namespace App\Factory;

use App\Entity\LanguageType;
use App\Repository\LanguageTypeRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static LanguageType|Proxy createOne(array $attributes = [])
 * @method static LanguageType[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static LanguageType|Proxy find($criteria)
 * @method static LanguageType|Proxy findOrCreate(array $attributes)
 * @method static LanguageType|Proxy first(string $sortedField = 'id')
 * @method static LanguageType|Proxy last(string $sortedField = 'id')
 * @method static LanguageType|Proxy random(array $attributes = [])
 * @method static LanguageType|Proxy randomOrCreate(array $attributes = [])
 * @method static LanguageType[]|Proxy[] all()
 * @method static LanguageType[]|Proxy[] findBy(array $attributes)
 * @method static LanguageType[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static LanguageType[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static LanguageTypeRepository|RepositoryProxy repository()
 * @method LanguageType|Proxy create($attributes = [])
 */
final class LanguageTypeFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://github.com/zenstruck/foundry#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://github.com/zenstruck/foundry#model-factories)
            'name' => self::faker()->text(),
        ];
    }

    protected function initialize(): self
    {
        // see https://github.com/zenstruck/foundry#initialization
        return $this
            // ->afterInstantiate(function(LanguageType $languageType) {})
        ;
    }

    protected static function getClass(): string
    {
        return LanguageType::class;
    }
}
