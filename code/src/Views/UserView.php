<?php
/**
 * Created by PhpStorm.
 * User: aryanpc
 * Date: 8/13/19
 * Time: 1:31 PM
 */

namespace App\Views;


use App\Misc\Containers\User;
use App\Services;

class UserView
{
    /**
     * @param array $ids
     * @return User[]|null
     */
    public function getUsers(array $ids): ?array
    {
        if (empty($ids)) {
            return [];
        }
        $result = Services::cassandraService()->select('users', $ids);
        if (empty($result)) {
            return [];
        }

        $containers = [];

        foreach ($result as $id => $fields) {
            $user = new User($fields['id'], $fields['ip']);
            $containers[$fields['id']] = $user;
        }

        return $containers;
    }

    public function getAll()
    {
        $list = array_column(Services::cassandraService()->selectAll('users'), 'id');
        return $this->getUsers($list);
    }


    public function getUser(int $id): User
    {
        return $this->getUsers([$id])[$id];
    }


}