<?php
namespace App\DataAccess;

use App\DataCarriers\TrafficJamInformation;
use Symfony\Component\Config\Definition\Exception\Exception;

class DataBase
{
    private $conn;

    public function __construct($dbConnection = null)
    {
        if ($dbConnection == null) {
            $dbConnection = new DatabaseConnect();
        }

        $this->conn = $dbConnection->connectToDb();
    }

    public function storeFileInfo($fileInfo) {

        $sql = "";
        foreach ($fileInfo as $file) {
            $fromLoc = $file->getFromLoc();
            $toLoc = $file->getToLoc();
            $fromLat = $fromLoc['lat'];
            $fromLong = $fromLoc['lon'];
            $toLat = $toLoc['lat'];
            $toLong = $toLoc['lon'];
            $sql .= "INSERT INTO `afi_file_info` (`from`, `from_long`, `from_lat`, `to`, `to_long`, `to_lat`, `start`, `distance`, `delay`, `road`)
            VALUES ('".$file->getFrom()."',
                    '".$fromLong."',
                    '".$fromLat."',
                    '".$file->getTo()."',
                    '".$toLong."', 
                    '".$toLat."', 
                    '".$file->getStart()."', 
                    '".$file->getDistance()."', 
                    '".$file->getDelay()."', 
                    '".$file->getRoad()."');";
        }

        if ($this->conn->multi_query($sql) === TRUE) {
            echo "New records created successfully";
        } else {
            throw new Exception($this->conn->error);
        }

        while ($this->conn->more_results()) {
            $this->conn->next_result();
        }
    }

    public function getTime() {
        $sql = "SELECT MAX(`time_registered`) AS `time` FROM `afi_file_info`";
        $result = $this->conn->query($sql);
        $time = $result->fetch_assoc();
        return $time['time'];

    }

    public function getFileInfo($time) {
        $sql ="SELECT * FROM `afi_file_info` WHERE `time_registered` = '$time'";


        $result = $this->conn->query($sql);
        $fileInfo = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $fromLoc = array("lat" => $row['from_lat'], "lon" => $row['from_long']);
                $toLoc = array("lat" => $row['to_lat'], "lon" => $row['to_long']);;

                $fileInformatie = new TrafficJamInformation();
                $fileInformatie->setDateTime($row['time_registered']);
                $fileInformatie->setRoad($row['road']);
                $fileInformatie->setTo($row['to']);
                $fileInformatie->setFrom($row['from']);
                $fileInformatie->setFromLoc($fromLoc);
                $fileInformatie->setToLoc($toLoc);
                if (isset($row['delay'])) {
                    $fileInformatie->setDelay($row['delay']);
                }
                if (isset($row['start'])) {
                    $fileInformatie->setStart($row['start']);
                }
                if (isset($trafficJam['distance'])) {
                    $fileInformatie->setDistance($row['distance']);
                }
                $fileInfo[] = $fileInformatie;
            }
        }

        return $fileInfo;
    }
}