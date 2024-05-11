<?php 

$serverName = "localhost";
$userName = "root";
$password = "";
$databaseName = "conan_closet1";

try {
    $connection = new PDO ("mysql:host=$serverName;dbname=$databaseName", $userName, $password);
    $connection-> setAttribute(PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Connection failed: ".$e->getMessage();
}
?>