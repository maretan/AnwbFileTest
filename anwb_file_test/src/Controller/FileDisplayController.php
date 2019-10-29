<?php
namespace App\Controller;

use App\DataAccess\DataCurl;
use Symfony\Component\HttpFoundation\Response;

class FileDisplayController
{
    public function showFiles($dataCurl= null) {
        if ($dataCurl == null) {
            $dataCurl = new DataCurl();
        }
        $url = "127.0.0.1:8000/get";
        $response = $dataCurl->requestUrl($url);

        $data = null;
        if ($response == true) {
            $data = json_decode($response, true);
        }
        $table = "<table>";
        $table .= "<tr><th>Road</th><th>Time</th><th>From</th><th>From Coordinates</th><th>To</th><th>To Coordinates</th><th>Start of Traffic Jam</th><th>Delay</th><th>Lenght</th></tr>";
        foreach ($data as $file ){
            $table .= "<tr><td>".$file['road']."</td>
                        <td>".$file['dateTime']."</td>
                        <td>".$file['from']."</td>
                        <td>lat.:".$file['from_loc']['lat'].", long.:".$file['from_loc']['long']."</td>
                        <td>".$file['to']."</td>
                        <td>lat.:".$file['to_loc']['lat'].", long.:".$file['to_loc']['long']."</td>
                        <td>".$file['start']."</td>
                        <td>".$file['delay']."</td>
                        <td>".$file['length']."</td></tr>" ;
        }

        $table .= "</table>";
        return new Response(
            $table
        );
    }
}