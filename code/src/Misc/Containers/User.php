<?php
/**
 * Created by PhpStorm.
 * User: aryanpc
 * Date: 8/13/19
 * Time: 1:27 PM
 */

namespace App\Misc\Containers;


class User
{
    /**
     * @var int $id
     */
    private  $id;
    /**
     * @var string $ip
     */
    private $ip;

    /**
     * User constructor.
     * @param int $id
     * @param string $ip
     */
    public function __construct(int $id, string $ip)
    {
        $this->id = $id;
        $this->ip = $ip;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }




}