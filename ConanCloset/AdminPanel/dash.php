<?php

function getCategoryTotalQuantity($connection)
{
    $sql = "SELECT Categry, SUM(Quantity) AS TotalQuantity FROM product GROUP BY Categry";
    $stm = $connection->prepare($sql);
    $stm->execute();

    if ($stm->rowCount() > 0) {
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $result = array();
    }
    return $result;
}

// Fetch data
$data = getCategoryTotalQuantity($connection);

// Prepare data for Chart.js
$categories = array();
$quantities = array();
foreach ($data as $row) {
    $categories[] = $row['Categry'];
    $quantities[] = $row['TotalQuantity'];
}

// Chart.js HTML
?>

