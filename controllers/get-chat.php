<?php 
//GET MESSAGES BETWEEN LOGGED IN USER AND THIS USER 
/* check request Type and if request type is not a post register, die */
if($_SERVER["REQUEST_METHOD"] != "POST") die("Not Authorized");

/* ESTABLISH CONNECTION TO DATABASE */
$pdo = require_once "database/database.php"; 

/* JUST A BIT OF SECURITY, MIGHT BE POINTLESS 
IF NO MSG IS RECEIVED OR incoming_id OR outgoing_id DO NOTHING */
if(empty($_POST["incoming_id"]) || empty($_POST["outgoing_id"])) exit;

/* GET THE LATEST MESSAGE BETWEEN THIS USER's FROM THE DATABASE */
$outgoing_id = $_POST["outgoing_id"]; //Logged In User's ID /also $_SESSION["userId"]
$incoming_id = $_POST["incoming_id"]; 
// LEFT JOIN users ON users.unique_id = messages.outgoing_id
/* GET THE MESSAGE INFO AND ALSO THE USER THAT SENT THE MESSAGE */
$statement = $pdo->prepare("SELECT * FROM messages 
                            LEFT JOIN users ON users.unique_id = messages.outgoing_id 
                            WHERE ((outgoing_id = :outgoing_id AND incoming_id = :incoming_id) OR 
                                    (outgoing_id = :incoming_id AND incoming_id = :outgoing_id)) ORDER BY msg_id asc ");
$statement->bindValue(":outgoing_id", $outgoing_id); //Bind the outgoing Id 
$statement->bindValue(":incoming_id", $incoming_id); //Bind the incoming Id 
$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);
/* IF NO MESSAGE DIE */
if(empty($results)) die("No New Messages");
$output = "";
/* LOOP THROUGH MESSAGES */
foreach ($results as $key => $value) {
    if($value['outgoing_id'] === intval($outgoing_id)) {
        //Meaning sent messages from this signed-in user 
        $output .= '
        <div class="chat outgoing">
            <div class="details">
                <p>'. $value["message"] .'</p>
            </div>
        </div>';
    } else {
        /* MESSAGES ARE RECEIVED SO DISPLAY SENDER's IMG*/
        $output .= '
        <div class="chat incoming">
            <img src="public/'.$value["img"] . '" alt="">
            <div class="details">
                <p>'. $value["message"] .'</p>
            </div>
        </div>';
    }
}
echo $output;
?>