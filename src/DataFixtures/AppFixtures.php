<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class AppFixtures extends Fixture implements FixtureGroupInterface
{
    private $encoderFactory;

    public function __construct(PasswordHasherFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new Admin();
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setUsername('admin');
        $admin->setEmail('admin@example.com');
        $admin->setPassword($this->encoderFactory->getPasswordHasher(Admin::class)->hash('admin12345'));
        $manager->persist($admin);

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['live'];
    }
}
