<?php
session_start();

if($_GET["count"] == 0){
    require_once 'depth.php';
    require_once 'time_duration.php';
    session_unset();
    exit();
}
?>