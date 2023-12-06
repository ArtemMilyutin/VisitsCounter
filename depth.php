<?php
    session_start();

    require_once 'connect.php';
    require_once 'ip.php';

    $queryInsDepth = "INSERT INTO visits_depth (date_visit, ip_address, `depth`) VALUES('".date("Y-m-d")."', '".$ip."',".$_SESSION["depth"].")";
    $resInsDepth = mysqli_query($link2, $queryInsDepth) or die("Query failed: ". mysqli_error($link2));
?>