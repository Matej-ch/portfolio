<?php

namespace App\Factory;

use App\Entity\Admin;
use App\Repository\AdminRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;
use Zenstruck\Foundry\RepositoryProxy;

/**
 * @extends ModelFactory<Admin>
 *
 * @method static Admin|Proxy createOne(array $attributes = [])
 * @method static Admin[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Admin|Proxy find(object|array|mixed $criteria)
 * @method static Admin|Proxy findOrCreate(array $attributes)
 * @method static Admin|Proxy first(string $sortedField = 'id')
 * @method static Admin|Proxy last(string $sortedField = 'id')
 * @method static Admin|Proxy random(array $attributes = [])
 * @method static Admin|Proxy randomOrCreate(array $attributes = [])
 * @method static Admin[]|Proxy[] all()
 * @method static Admin[]|Proxy[] findBy(array $attributes)
 * @method static Admin[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Admin[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static AdminRepository|RepositoryProxy repository()
 * @method Admin|Proxy create(array|callable $attributes = [])
 */
class AdminFactory extends ModelFactory
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();

        $this->passwordHasher = $passwordHasher;
    }

    protected function getDefaults(): array
    {
        return [
            'email' => self::faker()->email(),
            'roles' => [],
            'username' => self::faker()->firstName(),
            'isVerified' => true,
            'plainPassword' => 'tada',
        ];
    }

    protected function initialize(): self
    {
        return $this->afterInstantiate(function (Admin $admin): void {
            if ($admin->getPlainPassword()) {
                $admin->setPassword($this->passwordHasher->hashPassword($admin, $admin->getPlainPassword()));
            }
        });
    }

    protected static function getClass(): string
    {
        return Admin::class;
    }
}