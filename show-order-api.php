<?php
    require_once('inc/db.php');
    // number of orders displayed
    $orderNumber = isset($_GET['orderNumber']) && !empty($_GET['orderNumber']) ? $_GET['orderNumber'] : '';
    // sql query
    if (!empty($orderNumber)) {
        $query = "SELECT orderDate, requiredDate, shippedDate, status, comments, customerNumber FROM orders WHERE orderNumber = '$orderNumber'";
        // sql obj result
        $result = mysqli_query($connection, $query);
        $records = mysqli_fetch_assoc($result);
        echo json_encode($records);
    }
