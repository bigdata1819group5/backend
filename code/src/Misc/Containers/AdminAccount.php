<?php
/**
 * Created by PhpStorm.
 * User: aryanpc
 * Date: 5/21/19
 * Time: 3:11 AM
 */

namespace App\Misc\Containers;


use App\Roles;

class AdminAccount implements Account
{

    private $id;
    private $email;
    private $password;
    private $roles;

    /**
     * AdminAccount constructor.
     * @param $id
     * @param $email
     * @param $password
     */
    public function __construct($id, $email, $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->roles = [Roles::ADMIN_ROLE];
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = md5($password);
    }

    /**
     * @return mixed
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }
}