<?php 
//A Function to calculate the last status time difference to current time
function calculateTime($statusTime) {
    //First create a date object for lastStatusTime 
    $lastTime = date_create($statusTime);
    //create a date for current time;
    $currentTime = date_create(date("Y-m-d H:i"));
    //Get The Differences between both date 
    $dateDiff = date_diff($currentTime, $lastTime);
    $hoursDiff = $dateDiff->h;
    $minDiff = $dateDiff->i;
    $timeInfo = '';
    if($hoursDiff == 0) {
        /* STATUS WaS UPLOADED MINUTES AGO 
        NOw check the minutes diff */
        if($minDiff == 0) {
            //Status was barely uploaded less than a minute ago
            $timeInfo = "Just now";
        } else if ($minDiff == 1) {
            $timeInfo = $minDiff . " minute ago";
        } else {
            $timeInfo = $minDiff . " minutes ago";
        }
    } else {
        /* Get the time format status was uploaded ("10:55 pm") 
        First create a new DateTime with status time */
        $statusDt = new DateTime($statusTime); 
        //Get The Time Format 
        $timeInfo = $statusDt->format("h:i A");
        /* Get The Status Date and get today's date 
        check if today's date is greater than status date, so timeInfo can have an effect of "Yesterday, 10:30pm "*/
        $statusDateNumber = $statusDt->format('d');
        $currentDate = date("d");
        if($currentDate > $statusDateNumber) {
            //Meaning Post Was Made Yesterday 
            $timeInfo = "Yesterday, " . $timeInfo;
        } else {
            $timeInfo = "Today, " .  $timeInfo;
        }
    }
    return $timeInfo;
}
?>