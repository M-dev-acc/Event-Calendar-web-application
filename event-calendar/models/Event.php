<?php

class Event
{
    public static function scheduleEvent(String $eventTitle, String $dateString, String $time): String
    {
        $todaysDate   = new DateTime(date("Y-m-d H:i"));
        $selectedDate = new DateTime($dateString . $time);

        if ($todaysDate <= $selectedDate) {
            Database::executeQuery("INSERT INTO tbl_event(name, time, status) VALUES(:title, :date, 1)", array(":title" => $eventTitle, ":date" => $dateString . " " . $time));
            $message = "<p class='alert_sign'>&#9989;</p> Your event has been Schedule.";
        } else {
            $message = "<p class='alert_sign'>&#9888;&#65039;</p> Sorry! Selcted time has already pass.";
        }

        return $message;
    }
    public static function isEventScheduled(String $dateString)
    {
        $isEventExist = Database::executeQuery("SELECT time FROM tbl_event WHERE time LIKE :time ORDER BY id DESC LIMIT 1", array(":time" => $dateString . "%"));

        if ($isEventExist) {
            $eventDate = Database::executeQuery("SELECT time FROM tbl_event WHERE time LIKE :time ORDER BY id DESC LIMIT 1", array(":time" => $dateString . "%"))[0]["time"];
            return $eventDate;
        }
    }
    public static function displayEvents(String $dateString): String
    {
        $eventCard = "";
        if (self::isEventScheduled($dateString)) {
            $events = Database::executeQuery("SELECT name, time, status FROM tbl_event WHERE time LIKE :time", array(":time" => $dateString . "%"));

            $eventCard = "";
            $eventCard .= "<article class='card'>";
            $eventCard .= "<h3 class='card__heading'>" . $_GET["date"] . "</h3>";
            foreach ($events as $event) {

                $eventCard .= "<div class='card__detail'>";
                $eventCard .= "<strong class='card__lable'>" . date("h:ia", strtotime($event["time"])) . "</strong>";
                $eventCard .= "<p class='card__text'>" . $event["name"] . "</p>";
                $eventCard .= "</div>";

            }
            $eventCard .= "</article>";
            return $eventCard;
        }
        return "You don't have plans on this day.";
    }

}
