<?php
/**
 * Created by PhpStorm.
 * User: aryanpc
 * Date: 8/24/19
 * Time: 8:33 AM
 */

namespace App\Controllers;


use App\Misc\Response\TemplateResponse;
use App\Services;
use App\Views\CarLogView;
use Symfony\Component\HttpFoundation\Request;

class StreamingController
{
    public function index()
    {
        Services::accountService()->checkAdminUser();

        return TemplateResponse::make(
            "stream.twig",
            []
        );
    }

    public function stream(Request $request)
    {

        Services::accountService()->checkAdminUser();
        $ids = Services::cassandraService()->query("SELECT DISTINCT company_id from vehicles_by_company", []);
        $results = '';
        if ($request->get("companyId") != null) {
            $results = (new CarLogView())->getLogs($request->get("companyId"));
        }
        return TemplateResponse::make(
            "stream.twig",
            [
                'ids' => $ids,
                'logs' => $results
            ]
        );
    }

}