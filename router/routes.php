<?php 
/* RETURN ALL ROUTES IN APP WITH THEIR RESPECTIVE METHOD */
return [
    "GET" => [
        "" => "controllers/index.php",
        "login" => "controllers/login.php",
        "names" => "controllers/names.php",
        "users" => "controllers/users.php",
        "chat" => "controllers/chat.php",
        "getUsers" => "controllers/getUsers.php",
        "logout" => "controllers/logout.php",
        "status" => "controllers/status.php",
        "get-status" => "controllers/get-status.php",
        "view-status" => "controllers/view-status.php",
    ],
    "POST" => [
        "signup" => "controllers/register.php",
        "login" => "controllers/login-user.php",
        "searchUser" => "controllers/search.php",
        "getChat" => "controllers/get-chat.php",
        "send-user-messages" => "controllers/send-user-messages.php",
        "upload-status" => "controllers/upload-status.php"
    ]
];
?>