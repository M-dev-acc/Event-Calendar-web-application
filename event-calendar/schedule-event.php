<?php
include "config/Database.php";
include "models/Event.php";

date_default_timezone_set("Asia/Kolkata");

$message         = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (empty($_POST["title"])) {
        $message = "<p class='alert_sign'>&#9888;&#65039;</p> Title field should not be empty.";
    } elseif (empty($_POST["date"])) {
        $message = "<p class='alert_sign'>&#9888;&#65039;</p> Date field should not be empty.";
    } elseif (empty($_POST["time"])) {
        $message = "<p class='alert_sign'>&#9888;&#65039;</p> Time field should not be empty.";
    } else {
        $message = Event::scheduleEvent($_POST["title"], $_POST["date"], $_POST["time"]);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Schedule Event</title>
</head>
<body>
    <?php include "includes/navigation.html";?>
    <section class="container push-down">
    <fieldset class="form__container">
        <legend><h3 class="form__heading">Be Productive, Schedule Task</h3></legend>
        <form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
            <input type="text" name="title" id="" class="form__element" placeholder="Enter Event title.">
            <input type="date" name="date" value="<?=(isset($_GET["date"])) ? $_GET["date"] : date("Y-m-d");?>" id="" class="form__element">
            <input type="time" name="time" value="<?=date("H:i");?>" id="" class="form__element">
            <input type="submit" value="Schedule Event" class="form__submit-btn">
        </form>
    </fieldset>
    </section>

    <?php if ($message): ?>
    <article class="alert"><?=htmlspecialchars_decode($message);?>
        <button class="alert__btn" id="close-alert">&#10006;</button>
    </article>
    <?php endif;?>

</body>
</html>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
        let closeAlertBtn = document.querySelector("#close-alert");
        closeAlertBtn.addEventListener("click", () => {
            document.querySelector(".alert").style.display = "none";
        });
    });
</script>