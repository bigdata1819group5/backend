<?php

namespace App\Models;

use App\Exceptions\WrongInputException;
use App\Services;

/**
 * Class LoginModel
 * @package App\Models
 */
class LoginModel
{
    /**
     * @param null|string $email
     * @param null|string $password
     */
    public function login(?string $email, ?string $password)
    {
        $cryptography = Services::cryptoService();

        $result = Services::cassandraService()->query(
            "SELECT * FROM users WHERE username = ? AND password = ? ALLOW FILTERING ",
            [
                $email,
                $cryptography->hash($password)
            ]
        );

        if (count($result) < 1) {
            throw new WrongInputException('Invalid username or password');
        }

        Services::sessionService()->getSession()->set('login', $result[0]['id']);
    }

    public function logout()
    {
        Services::sessionService()->getSession()->remove('login');
    }
}