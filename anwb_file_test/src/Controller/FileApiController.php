<?php
namespace App\Controller;

use App\BusinessLogic\ApiLogic;
use Symfony\Component\HttpFoundation\Response;
use App\DataAccess\DataCurl;

class FileApiController
{
    public function storeFileInfo($datacurl = null, $apiLogic = null)
    {
        if ($datacurl == null) {
            $datacurl = new DataCurl();
        }

        if ($apiLogic == null) {
            $apiLogic = new ApiLogic();
        }
        set_time_limit(0); // make it run forever
        while (true) {
            $response = $datacurl->requestUrl("https://www.anwb.nl/feeds/gethf");

            $data = null;
            if ($response == true) {
                $data = json_decode($response, true);
            }

            $apiLogic->storeDataFromApi($data);
            sleep(300);
        }

        return new Response(
            'succes'
        );
    }
    public function sendFileInfo($apiLogic = null) {
        if ($apiLogic == null ) {
            $apiLogic = new ApiLogic();
        }

        $fileData = $apiLogic->getFileInformation();

        return new Response(
            json_encode($fileData)
        );

    }
}