<?php
/**
 * Created by PhpStorm.
 * User: aryanpc
 * Date: 8/13/19
 * Time: 3:56 PM
 */

namespace App\Models;


use App\Services;

class UserModel
{
    public function insert(array $values)
    {
        $ids = Services::cassandraService()->insert(
            'users',
            ['ip', 'create_time'],
            [
                [
                    $values['ip'],
                    date('Y-m-d H:i:s'),
                ]
            ]
        );
        $id = $ids[0];
        return $id;
    }


}