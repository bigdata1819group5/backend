<?php
/**
 * Created by PhpStorm.
 * User: aryanpc
 * Date: 8/24/19
 * Time: 9:20 AM
 */

namespace App\Views;


use App\Misc\Containers\CarLog;
use App\Services;

class CarLogView
{
    /**
     * @param int $company
     * @return CarLog[]|null
     */
    public function getLogs($req): array
    {

        $results = Services::cassandraService()->query("select * from vehicles_by_company where company_id = ?", [$req . ""]);
        $logs = [];
        foreach ($results as $result) {
            $logs[] = new CarLog($result['id'], $result['latitude'], $result['longitude']);
        }
        return $logs;

    }

}