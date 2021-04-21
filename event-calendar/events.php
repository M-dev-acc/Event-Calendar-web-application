<?php
date_default_timezone_get();
include "config/Database.php";
include "models/Calendar.php";
include "models/Event.php";
$year   = "2021";
$months = array("January", "February", "March", "April",
    "May", "June", "July", "August",
    "September", "October", "November", "December");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Events</title>
</head>
<body>
    <?php include "includes/navigation.html";?>

    <header class="heading">
        <h1><?=$year;?></h1>
    </header>
    <section class="calendar__container">
    <?php foreach ($months as $monthIndex => $month): ?>
    <?php $monthYearDateString = $year . "-" . ($monthIndex + 1);?>
        <table class="calendar">
        <caption class="calendar__month"><?=$month?></caption>
            <thead class="calendar__week">
                    <th>S</th>
                    <th>M</th>
                    <th>T</th>
                    <th>W</th>
                    <th>T</th>
                    <th>F</th>
                    <th>S</th>
            </thead>
            <tbody>
            <?php foreach (Calendar::getMonthlyCalendar($monthYearDateString) as $dates): ?>
                <?=$dates?>
            <?php endforeach;?>
            </tbody>
        </table>
    <?php endforeach;?>
    </section>
</body>
</html>