<?php

function getAllCart($connection)
{
    $sql = "SELECT c.*, p.Image
    FROM cart c
    INNER JOIN product p ON c.Number= p.Number;";

    
    $stm = $connection->prepare($sql);
    $stm->execute();

    if ($stm->rowCount() > 0) {
        $items= $stm ->fetchAll();
    } else {
        $items = 0;
    }
    return $items;
}
?>