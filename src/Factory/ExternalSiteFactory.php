<?php

namespace App\Factory;

use App\Entity\ExternalSite;
use Zenstruck\Foundry\ModelFactory;

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
            'name' => self::faker()->realText(2),
            'url' => self::faker()->url(),
            'icon' => self::faker()->file(),
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