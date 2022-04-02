<?php

namespace App\Factory;

use App\Entity\UserInfo;
use App\Repository\UserInfoRepository;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @method static UserInfo|Proxy createOne(array $attributes = [])
 * @method static UserInfo[]|Proxy[] createMany(int $number, $attributes = [])
 * @method static UserInfo|Proxy find($criteria)
 * @method static UserInfo|Proxy findOrCreate(array $attributes)
 * @method static UserInfo|Proxy first(string $sortedField = 'id')
 * @method static UserInfo|Proxy last(string $sortedField = 'id')
 * @method static UserInfo|Proxy random(array $attributes = [])
 * @method static UserInfo|Proxy randomOrCreate(array $attributes = [])
 * @method static UserInfo[]|Proxy[] all()
 * @method static UserInfo[]|Proxy[] findBy(array $attributes)
 * @method static UserInfo[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static UserInfo[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static UserInfoRepository|RepositoryProxy repository()
 * @method UserInfo|Proxy create($attributes = [])
 */
class UserInfoFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'isActive' => true,
            'decodedData' => [
                'name' => self::faker()->name(),
                'location' => self::faker()->country,
                'education' => self::faker()->title(),
                'work' => self::faker()->company(),
                'description' => self::faker()->text()],
            'avatar' => self::faker()->filePath(),
            'avatar_big' => self::faker()->filePath(),
            'who_am_i' => self::faker()->text(1024),
        ];
    }

    protected function initialize(): self
    {
        return $this;
    }

    protected static function getClass(): string
    {
        return UserInfo::class;
    }
}