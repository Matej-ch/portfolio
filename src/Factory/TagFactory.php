<?php

namespace App\Factory;

use App\Entity\Tag;
use Zenstruck\Foundry\ModelFactory;

class TagFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->realText(20),
            'ordering' => self::faker()->numberBetween(0, 50),
            'isActive' => self::faker()->numberBetween(0, 1),
            'projects' => null
        ];
    }

    protected function initialize(): self
    {
        return $this;
    }

    protected static function getClass(): string
    {
        return Tag::class;
    }
}