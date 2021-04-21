<?php
date_default_timezone_set("Asia/Kolkata");
class Calendar
{
    public function getMonthlyCalendar(String $dateString): array
    {
        date_default_timezone_set("Asia/Kolkata");

        $stringToTimestamp = strtotime($dateString, "-01");
        $month             = date("m", $stringToTimestamp);
        $daysOfMonth       = date("t", $stringToTimestamp);
        $getYear           = date("Y", $stringToTimestamp);
        $todaysDate        = date("Y-m-j");
        $getWeeksOfMonth   = date("w", mktime(0, 0, 0, $month, 1, $getYear));
        $weeks             = array();
        $week              = "";
        $week .= str_repeat('<td>&nbsp;</td>', $getWeeksOfMonth);

        for ($day = 1; $day <= $daysOfMonth; $day++, $getWeeksOfMonth++) {
            $currentDateTime = new DateTime(date("Y-m-d"));
            $date            = $getYear . "-" . $month . "-" . str_pad($day, 2, "0", STR_PAD_LEFT);
            $dateObj         = new DateTime($date);

            if (Event::isEventScheduled($date)) {
                if ($dateObj < $currentDateTime) {
                    Database::executeQuery("UPDATE tbl_event SET status=0 WHERE time LIKE :time", array(":time" => $date . "%"));
                    $week .= "<td class='passed'><a href='event.php?date=$date'>" . $day . "</a></td>";
                } else {
                    $week .= "<td class='scheduled'><a href='event.php?date=$date'>" . $day . "</a></td>";
                }
            } elseif ($todaysDate === $date) {
                $week .= "<td class='today'><a href='schedule-event.php?date=$date'>" . $day . "</a></td>";
            } elseif ($dateObj < $currentDateTime) {
                $week .= "<td>" . $day . "</td>";
            } else {
                $week .= "<td><a href='schedule-event.php?date=$date'>" . $day . "</a></td>";
            }

            if ($getWeeksOfMonth % 7 === 6 || strval($day) == $daysOfMonth) {
                if ($day === $daysOfMonth) {
                    $week .= str_repeat('<td>&nbsp;</td>', 6 - ($str % 7));
                }
                array_push($weeks, htmlspecialchars_decode("<tr>" . $week . "</tr>"));
                $week = "";
            }

        }
        return $weeks;
    }
}
