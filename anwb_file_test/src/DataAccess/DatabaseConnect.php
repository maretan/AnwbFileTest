<?php

namespace App\DataAccess;

use Symfony\Component\Config\Definition\Exception\Exception;
use mysqli;

class DatabaseConnect
{
 public function connectToDb() {

     $servername = "localhost";
     $username = "root";
     $password = "";
     $db = "anwb_file_info";

// Create connection
     $conn = new mysqli($servername, $username, $password, $db);

     if ($conn->connect_error) {
         throw new Exception("connection failed");
     }

     return $conn;
 }
}