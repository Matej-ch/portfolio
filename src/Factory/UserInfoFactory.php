<?php

namespace App\Factory;

use App\Entity\UserInfo;
use Zenstruck\Foundry\ModelFactory;

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
            'data' => json_encode([
                'name' => self::faker()->name(),
                'location' => self::faker()->country,
                'education' => self::faker()->title(),
                'work' => self::faker()->company(),
                'description' => self::faker()->text()], JSON_THROW_ON_ERROR),
            'avatar' => self::faker()->filePath(),
            'services' => null
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