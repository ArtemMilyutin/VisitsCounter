<?php 

    require_once 'connect.php';
    require_once 'ip.php';
    $current_time = time();

    $queryTimeVisit = "SELECT * FROM visits_time 
                        WHERE `time_visit` IS NOT NULL AND `ip_address`='".$ip."' AND `date_visit`='".date('Y-m-d')."' AND `duration` IS NULL";
    $resTimeVisit = mysqli_query($link2, $queryTimeVisit) or die("Query failed5: ". mysqli_error($link2));

    if(mysqli_num_rows($resTimeVisit)<1)
    {
        $queryInsVisit = "INSERT INTO visits_time(`date_visit`,`time_visit`, `ip_address`) 
            VALUES ( '".date('Y-m-d')."', ".$current_time.", '".$ip."')";
        $resInsVisit = mysqli_query($link2, $queryInsVisit) or die("Query failed4: ". mysqli_error($link2));
    }
?>