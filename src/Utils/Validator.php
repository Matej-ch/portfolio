<?php

namespace App\Utils;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use function Symfony\Component\String\u;

class Validator
{
    public function validateName(?string $name): string
    {
        if (empty($name)) {
            throw new InvalidArgumentException('The name can not be empty.');
        }

        if (1 !== preg_match('/^[a-zA-Z_]+$/', $name)) {
            throw new InvalidArgumentException('The name must contain only lowercase, uppercase latin characters and underscores.');
        }

        return $name;
    }

    public function validateEmail(?string $email): string
    {
        if (empty($email)) {
            throw new InvalidArgumentException('The email can not be empty.');
        }

        if (null === u($email)->indexOf('@')) {
            throw new InvalidArgumentException('The email should look like a real email.');
        }

        return $email;
    }


    public function validatePassword(?string $plainPassword): string
    {
        if (empty($plainPassword)) {
            throw new InvalidArgumentException('The password can not be empty.');
        }

        if (u($plainPassword)->trim()->length() < 6) {
            throw new InvalidArgumentException('The password must be at least 6 characters long.');
        }

        return $plainPassword;
    }
}