<?php
include "config/Database.php";
include "models/Event.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title><?=(Event::isEventScheduled($_GET["date"])) ? "Events of " . $_GET["date"] : "Invalid date";?></title>
</head>
<body>
    <?php include "includes/navigation.html";?>
    <section class="card__container">
        <?php if (isset($_GET["date"])): ?>
            <?=Event::displayEvents($_GET["date"])?>
        <?php else: ?>
            <h4>You don have plans on this day.</h4>
        <?php endif;?>
    </section>
</body>
</html>