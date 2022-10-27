<?php 
/* GET THE lATEST STATUS UPLOADS */
require_once "update-status.php";

/* CREATE TWO VARIABLES 
Output to hold html unique arrangement of status 
and userOutput to hold the same but for the logged in user (if logged in user has a status) */
$output = "";
$userOutput = '
        <div class="add-status">
            <form action="#">
                <label for="status">
                    <div class="profile-picture">
                        <img src="public/'. $userInfo["img"] . '" alt="">
                        <span class="material-icons-outlined">
                            add_circle
                        </span>
                    </div>
                    <div class="my-status-details">
                        <h2>My Status</h2>
                        <p class="detail-content">Tap to add status update</p>
                    </div>
                </label>
                <input type="file" name="status" id="status" hidden accept="image/png, image/jpg, image/jpeg">
            </form>';

/* IF THERE ARE STATUS UPDATE */
if(!empty($updateStatus)) {
    //check if user uploaded a status 
    if(array_key_exists($_SESSION["userId"], $updateStatus) && count($updateStatus) > 1) {
        /* Meaning, There's user status and other people's status 
        LOOP THROUGH UPDATE STATUS, check if key is equal to Logged In User Id or not */
        $output .= '<h3 class="recent-update">Recent updates</h3>'; //to identify recent status by other people 
        foreach ($updateStatus as $key => $value) {
            if($key == $_SESSION["userId"]) {
                //Means current status in loop is the Logged In user status 
                $lastStatus = $updateStatus[$_SESSION["userId"]][0]["file"];  //Get The Last Status File 
                $lastStatusTimeString = $updateStatus[$_SESSION["userId"]][0]["created_at"]; //Get The Last Status Created_at time 
                $dateDiffString = calculateTime($lastStatusTimeString); //Calculate time difference from current time to created_at time 
                $pointer = end($updateStatus[$_SESSION["userId"]]); //Pointer is used to focus on the last status (that is the earlier status that hasn't been viewed)
                /* add this informations to $userOutput */
                $userOutput .= '
                <a href="/view-status?userId='. $pointer["unique_id"] .'&statusId='. $pointer["status_id"] .'" class="status-link">
                    <div class="status-list viewed">
                        <div class="card">
                            <div class="percent">
                                <svg>
                                    <circle cx="30" cy="30" r="28"></circle>
                                    <circle cx="30" cy="30" r="28" style="--percent: 30"></circle>
                                </svg>
                                <div class="number">
                                    <img src="public/'. $lastStatus .'" alt="">
                                </div> 
                            </div>
                        </div>
                        <div class="my-status-details">
                            <h2>You</h2>
                            <p class="detail-content">'. $dateDiffString .'</p>
                        </div>
                    </div>
                </a>
                </div>';
            } else {
                /* THIS PARTICULAR STATUS IN LOOP WAS POSTED BY ANOTHED USER */
                $lastStatus = $updateStatus[$key][0]["file"]; //Get the last status file 
                $lastStatusTimeString = $updateStatus[$key][0]["created_at"]; //get the last status created_at time 
                $dateDiffString = calculateTime($lastStatusTimeString); //Calculate time diff to current time 
                $pointer = end($updateStatus[$key]);
                /* APPEND these informations to output */
                $output .= '
                <a href="/view-status?userId='. $pointer["unique_id"] .'&statusId='. $pointer["status_id"] .'" class="status-link">
                    <div class="status-list">
                        <div class="card">
                            <div class="percent">
                                <svg>
                                    <circle cx="30" cy="30" r="28"></circle>
                                    <circle cx="30" cy="30" r="28" style="--percent: 30"></circle>
                                </svg>
                                <div class="number">
                                    <img src="public/'. $lastStatus .'" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="my-status-details">
                            <h2>' . $updateStatus[$key][0]["fname"] . " " . $updateStatus[$key][0]["lname"] . '</h2>
                            <p class="detail-content">'. $dateDiffString .'</p>
                        </div>
                    </div>
                </a>';
            }
        }
    } else if (array_key_exists($_SESSION["userId"], $updateStatus) && count($updateStatus) == 1) {
        //Means it is just the user's status available
        $lastStatus = $updateStatus[$_SESSION["userId"]][0]["file"]; //Get The last status file 
        $lastStatusTimeString = $updateStatus[$_SESSION["userId"]][0]["created_at"]; //get the created_at time for lastStatus 
        $dateDiffString = calculateTime($lastStatusTimeString); //calculate time difference 
        $pointer = end($updateStatus[$_SESSION["userId"]]);
        /* APPEND THIS INFORMATIONS TO USEROUTPUT*/
        $userOutput .= '
        <a href="/view-status?userId='. $pointer["unique_id"] .'&statusId='. $pointer["status_id"] .'" class="status-link">
            <div class="status-list viewed">
                <div class="card">
                    <div class="percent">
                        <svg>
                            <circle cx="30" cy="30" r="28"></circle>
                            <circle cx="30" cy="30" r="28" style="--percent: 30"></circle>
                        </svg>
                        <div class="number">
                            <img src="public/'. $lastStatus .'" alt="">
                        </div> 
                    </div>
                </div>
                <div class="my-status-details">
                    <h2>You</h2>
                    <p class="detail-content">'. $dateDiffString .'</p>
                </div>
            </div>
        </a>
        </div>';
    } else {
        /* THERE ARE NEW STATUS AND NONE WAS POSTED BY THE LOGGED IN USER */
        /* Unique userOutput to signify no new update by logged in User*/
        $userOutput .= '</div>';
        $output .= '<h3 class="recent-update">Recent updates</h3>'; //meaning there are recent status 
        //No users Status, Just other contact status 
        foreach ($updateStatus as $key => $value) {
            $lastStatus = $updateStatus[$key][0]["file"]; //Get The last file
            $lastStatusTimeString = $updateStatus[$key][0]["created_at"]; //created_at time
            $dateDiffString = calculateTime($lastStatusTimeString); //current time diff
            $pointer = end($updateStatus[$key]);
            $output .= '
            <a href="/view-status?userId='. $pointer["unique_id"] .'&statusId='. $pointer["status_id"] .'" class="status-link">
                <div class="status-list">
                    <div class="card">
                        <div class="percent">
                            <svg>
                                <circle cx="30" cy="30" r="28"></circle>
                                <circle cx="30" cy="30" r="28" style="--percent: 30"></circle>
                            </svg>
                            <div class="number">
                                <img src="public/'. $lastStatus .'" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="my-status-details">
                        <h2>' . $updateStatus[$key][0]["fname"] . " " . $updateStatus[$key][0]["lname"] . '</h2>
                        <p class="detail-content">'. $dateDiffString .'</p>
                    </div>
                </div>
            </a>';
        }
    }
}

/* HANDLE VIEWED STATUS */
$viewedOutput = "";
if(!empty($viewedStatus)) {
    $viewedOutput .= '<h3 class="recent-update">Viewed updates</h3>';
    foreach ($viewedStatus as $key => $value) {
        $lastStatus = $viewedStatus[$key][0]["file"]; 
        $lastStatusTimeString = $viewedStatus[$key][0]["created_at"];
        $dateDiffString = calculateTime($lastStatusTimeString);
        $pointer = end($viewedStatus[$key]);
        $viewedOutput .= '
        <a href="/view-status?userId='. $pointer["unique_id"] .'&statusId='. $pointer["status_id"] .'" class="status-link">
            <div class="status-list viewed">
                <div class="card">
                    <div class="percent">
                        <svg>
                            <circle cx="30" cy="30" r="28"></circle>
                            <circle cx="30" cy="30" r="28" style="--percent: 30"></circle>
                        </svg>
                        <div class="number">
                            <img src="public/'. $lastStatus .' " alt="">
                        </div>
                    </div>
                </div>
                <div class="my-status-details">
                    <h2>' . $viewedStatus[$key][0]["fname"] . " " . $viewedStatus[$key][0]["lname"] . '</h2>
                    <p class="detail-content">'. $dateDiffString .'</p>
                </div>
            </div>
        </a>';
    }
}

// var_dump($allStatus);
// var_dump($viewedStatus);
// var_dump($updateStatus);
// exit;
$totalOutput = $userOutput . $output . $viewedOutput;
echo $totalOutput;
?>