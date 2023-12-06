<?php

    require_once 'connect.php';
    require_once 'ip.php';
    $current_time = time();

    $queryTimeVisit = "SELECT * FROM visits_time 
                        WHERE `time_visit` IS NOT NULL AND `ip_address`='".$ip."' AND `date_visit`='".date('Y-m-d')."' AND `duration` IS NULL LIMIT 1";
    $resTimeVisit = mysqli_query($link2, $queryTimeVisit) or die("Query failed: ". mysqli_error($link2));
    $time_visit = 0;
    if(mysqli_num_rows($resTimeVisit)>0)
    {
        while($row = mysqli_fetch_array($resTimeVisit))
        {
            $time_visit = $current_time - $row['time_visit'];
            $queryInsVisit = "UPDATE visits_time SET `duration`= ".$time_visit." WHERE `id`=".$row["id"];
            $resInsVisit = mysqli_query($link2, $queryInsVisit) or die("Query failed: ". mysqli_error($link2));
        }
    }

?>