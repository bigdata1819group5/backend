<?php
/**
 * Created by PhpStorm.
 * User: aryanpc
 * Date: 8/23/19
 * Time: 4:54 AM
 */

namespace App\Services;
use Predis;

class RedisService implements CacheService
{

    private $redis;
    /**
     * RedisService constructor.
     */
    public function __construct()
    {
//      Predis\Autoloader::register();
//
//        try {
//
//            // This connection is for a remote server
//
//            $this->redis = new Predis\Client();
//
//        } catch (Exception $e) {
//            die($e->getMessage());
//        }
    }

    function set(string $name, ?string $value, int $ttl)
    {
//        return $this->redis->set($name, $value, $ttl);
    }

    function get(string $name): ?string
    {
//        return $this->redis->get($name);
    }

    function delete(string $name): void
    {
//        $this->redis->dump($name);
    }
}