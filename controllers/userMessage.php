<?php 
/* PARTIAL TO LOOP THROUGH ARRAY OF USERS AND APPEND THIER LAST CONVERSATION WITH CURRENT USER */
/* LOOP THROUGH RESULTS AND APPEND ALL USERS INFO IN OUTPUT */
$output = "";

foreach ($results as $key => $value) {
    /* GET THE LAST MESSAGE BETWEEN THIS USER AND CURRENT USER SO IT CAN BE DISPLAYED */
    $statement = $pdo->prepare("SELECT message, outgoing_id FROM messages WHERE ((incoming_id = :userId OR outgoing_id = :userId)
                                                        AND (incoming_id = :currentUserId OR outgoing_id = :currentUserId)) 
                                                        ORDER BY msg_id desc LIMIT 1");
    $statement->bindValue(":userId", $value["unique_id"]); //set userId to User's unique Id 
    $statement->bindValue(":currentUserId", $_SESSION["userId"]); //set currentUserId to userId in session
    $statement->execute();
    $lastMessage = $statement->fetch(PDO::FETCH_ASSOC); //Get The Last Message 
    /* CHECK LAST MESSAGE AND DETERMINE IF IT WAS SENT OR RECEIVED 
    First check if Last Message is Empty or not*/
    if(!empty($lastMessage)) {
        /* First Slice Last Message TO max of 20 characters and set value to lastMsg*/
        strlen($lastMessage["message"]) >= 20 
                ? $lastMsg = substr($lastMessage["message"], 0, 20)
                : $lastMsg =  $lastMessage["message"];
        /* check if last Message outgoing_id is equal to session userId
        if it is add YOU: to show the last Message was sent by You */
        $lastMessage["outgoing_id"] === $_SESSION["userId"] ? $lastMsg = "You: ". $lastMsg . "..." : $lastMsg = $lastMsg;
       
    }
    else $lastMsg = "No Message Available";
    /* NOW CHECK THE STATUS OF CURRENT USER 
    IF current User is active set status to "" else set status to offline */
    $value["status"] === "Active" ? $status = "" : $status = "offline";
    /* APPEND INFO TO LAST MESSAGE AND ALSO CHECK IF USER HAS A NEW STATUS UPDATE TO DISPLAY STATUS UPDATE EFFECT 
    USING UPDATESTATUS, CHECK IF THIS USER's Unique_id exist in UPDATE STATUS */
    $statusLink = ""; //Set StatusLink to hold latest status Link
    /* CHECK IF THE CURRENT USER IN THE LOOP HAS A NEW STATUS THAT HAS NOT YET BEEN VIEWED BY LOGGED IN USER */
    if(!empty($updateStatus[$value["unique_id"]])) {
        $statusLinkArray = end($updateStatus[$value["unique_id"]]); //GET THE UPDATE STATUS INFORMATION 
        $statusLink = "/view-status?userId=" . $statusLinkArray["unique_id"] . "&statusId=" . $statusLinkArray["status_id"]; //GET THE STATUS LINK FROM STATUSLINKARRAY INFO
    }
    /* DISPLAY DIFFERENT OUTPUT FOR USER"S WITH STATUS AND FOR USER WITH NO NEW STATUS (LOGGED IN USER HAS VIEWED ALL THEIR STATUS) */ 
    if(empty($statusLink)) {
        $output .= '
            <div class="chat">
                <a href="/chat?userId=' .$value["unique_id"] . '">
                    <img src="public/' . $value['img'] . '" alt="" class="no-status">
                </a>';
    } else {
        $output .= ' 
        <div class="chat">
            <a href="'. $statusLink .'">
                <div class="card">
                    <div class="percent">
                        <svg>
                            <circle cx="30" cy="30" r="28"></circle>
                            <circle cx="30" cy="30" r="28" style="--percent: 30"></circle>
                        </svg>
                        <div class="number">
                            <img src="public/' . $value['img'] . '" alt="">
                        </div>
                    </div>
                </div>
            </a>';
    }
    $output .=  
        '<a href="/chat?userId=' .$value["unique_id"] . '" class="chat-link">
            <div class="content">
                <div class="details">
                    <span>'. $value["fname"] . " " . $value["lname"] . '</span>
                    <p>'. $lastMsg . '</p>
                </div>
            </div>
            <div class="status-dot ' . $status . '">
                <i class="fas fa-circle"></i>
            </div>
        </a>
        </div>';
}

echo $output;
?>