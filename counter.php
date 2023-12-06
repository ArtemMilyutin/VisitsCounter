<?php

    require_once 'connect.php';
    require_once 'ip.php';

    $queryVisit = "SELECT id FROM visits_counter 
                    WHERE `ip_address`='".$ip."' AND `date_visit`='".date('Y-m-d')."'";
    $resVisit = mysqli_query($link2, $queryVisit) or die("Query failed1: ". mysqli_error($link2));

    if(mysqli_num_rows($resVisit)>0)
    {
        $queryUpdVisit = "UPDATE visits_counter AS v SET v.visits=(v.visits+1) WHERE v.ip_address='".$ip."' AND v.`date_visit`='".date('Y-m-d')."'";
        $resUpdVisit = mysqli_query($link2, $queryUpdVisit) or die("Query failed2: ". mysqli_error($link2));
    }
    else {
        $queryInsVisit = "INSERT INTO visits_counter(`date_visit`, `ip_address`, `visits`) 
                            VALUES ('".date('Y-m-d')."', '".$ip."', 1)";
        $resInsVisit = mysqli_query($link2, $queryInsVisit) or die("Query failed3: ". mysqli_error($link2));
    }    

?>