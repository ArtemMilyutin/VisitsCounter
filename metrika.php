<?php
session_start();

    require_once 'connect.php';
    ////////////Посещения общие и уникальные////////////
    $queryVisits= "SELECT id FROM visits_counter 
                        WHERE `date_visit`='".date('Y-m-d')."'";
    $resVisits = mysqli_query($link2, $queryVisits) or die("Query failed: ". mysqli_error($link2));

    $uniq_visits = mysqli_num_rows($resVisits);

    $queryAllVisits= "SELECT SUM(visits) as all_visit FROM visits_counter 
                    WHERE `date_visit`='".date('Y-m-d')."'";
    $resAllVisits = mysqli_query($link2, $queryAllVisits) or die("Query failed: ". mysqli_error($link2));

    $all_visits = 0;
    while($row = mysqli_fetch_array($resAllVisits))
        $all_visits = $row['all_visit'];

    ////////////Среднее время посещения сайта////////////
    $queryTime = "SELECT AVG(duration) AS all_time FROM visits_time 
                    WHERE time_visit IS NOT NULL AND `date_visit`='".date('Y-m-d')."' AND `duration` IS NOT NULL";
    $resTime = mysqli_query($link2, $queryTime) or die("Query failed: ". mysqli_error($link2));

    $all_time = 0;
    while($row = mysqli_fetch_array($resTime))
        $all_time = intval($row['all_time']);

    $min = intval($all_time/60);
    $sec = $all_time-($min*60);

    ////////////Среднее время посещения сайта////////////
    $queryDepth = "SELECT AVG(`depth`) AS depth FROM visits_depth 
                    WHERE `date_visit`='".date('Y-m-d')."' ";
    $resDepth = mysqli_query($link2, $queryDepth) or die("Query failed: ". mysqli_error($link2));

    $d = 0;
    while($row = mysqli_fetch_array($resDepth))
        $d = round($row['depth'], 2);

    ////////////Вывод////////////
    $resHTML = '<div class="card" style="width: 18rem;">                  
                    <div class="card-body">
                      <h5 class="card-title">Статистика</h5>
                      <p class="card-text">Просмотры: <b>'.$all_visits.'</b></p>
                      <p class="card-text">Визиты: <b>'.$uniq_visits.'</b></p>
                      <p class="card-text">Время на сайте: <b>'.$min.":".(($sec<10) ? '0'.$sec : $sec).'</b></p>
                      <p class="card-text">Глубина: <b>'.$d.'</b></p>                    
                    </div>
                </div>';

    echo $resHTML;

?>