<?php 

/* DELETE STATUS THAT HAS BEEN POSTED FOR MORE 24Hrs */
// DELETE a.*, b.*
// FROM status a 
// LEFT JOIN views b 
// ON b.status_id = a.status_id 
// WHERE TIMESTAMPDIFF(DAY, a.created_at, NOW()) >= 1
$statement = $pdo->prepare("DELETE a.*, b.*
                            FROM status a 
                            LEFT JOIN views b 
                            ON b.status_id = a.status_id 
                            WHERE TIMESTAMPDIFF(DAY, a.created_at, NOW()) >= 1");
$statement->execute();
?>