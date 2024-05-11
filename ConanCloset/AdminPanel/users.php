<?php

function getAllItems($connection)
{
    $sql = "SELECT * FROM user ORDER by ID ASC";
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