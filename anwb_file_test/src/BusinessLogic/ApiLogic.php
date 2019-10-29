<?php
namespace App\BusinessLogic;

use App\DataAccess\DataBase;
use App\DataCarriers\TrafficJamInformation;

class ApiLogic
{
    private $database;

    public function __construct($dataBase = null)
    {
        if ($dataBase == null) {
            $this->database = new DataBase();
        }
    }

    public function storeDataFromApi($data)
    {

        $roadEntries = $data['roadEntries'];

        $newFile = array();

        foreach ($roadEntries as $road) {
            if ($road['events']['trafficJams'] !== []) {
                $trafficJams = $road['events']['trafficJams'];
                $roadname = $road['road'];

                foreach ($trafficJams as $trafficJam) {
                    $fileInformatie = new TrafficJamInformation();
                    $fileInformatie->setRoad($roadname);
                    $fileInformatie->setTo($trafficJam['to']);
                    $fileInformatie->setFrom($trafficJam['from']);
                    $fileInformatie->setFromLoc($trafficJam['fromLoc']);
                    $fileInformatie->setToLoc($trafficJam['toLoc']);
                    if (isset($trafficJam['delay'])) {
                        $fileInformatie->setDelay($trafficJam['delay']);
                    }
                    if (isset($trafficJam['start'])) {
                        $fileInformatie->setStart($trafficJam['start']);
                    }
                    if (isset($trafficJam['distance'])) {
                        $fileInformatie->setDistance($trafficJam['distance']);
                    }

                    $newFile[] = $fileInformatie;
                }
            }
        }
        $this->database->storeFileInfo($newFile);
    }

    public function getFileInformation() {
        $time = $this->database->getTime();
        $fileInfo = $this->database->getFileInfo($time);

        $formattedFileInfo = array();
        foreach ($fileInfo as $file) {
            $fileArray = array("to" => $file->getTo(),
                "toLoc" =>$file->getToLoc(),
                "from" =>$file->getFrom(),
                "fromLoc" =>$file->getFromLoc(),
                "start" =>$file->getStart(),
                "delay" =>$file->getDelay(),
                "distance" =>$file->getDistance(),
                "road" =>$file->getRoad(),
                "dateTime" =>$file->getDateTime(),
            );

            $formattedFileInfo[] = $fileArray;
        }
        return $formattedFileInfo;
    }
}