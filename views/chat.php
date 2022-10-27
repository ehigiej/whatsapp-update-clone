<?php include_once "partials/header.php"; //Include Header ?>
    <title>ChatApp</title>
    <link rel="stylesheet" href="public/css/user.css">
    <link rel="stylesheet" href="public/css/chat.css">
</head>
<body>
    <main>
        <section class="chat-area">
            <header>
                <a href="/users" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="public/<?php echo $userInfo["img"]; ?>" alt="">
                <div class="details">
                    <span><?php echo $userInfo["fname"] . " " . $userInfo["lname"]; ?></span>
                    <p><?php echo $userInfo["status"]; ?></p>
                </div>
            </header>
            <div class="chat-box">
                <!-- <div class="chat outgoing">
                    <div class="details">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam recusandae distinctio repellendus libero tenetur vitae.</p>
                    </div>
                </div>
                <div class="chat incoming">
                    <img src="img.jpg" alt="">
                    <div class="details">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam recusandae distinctio repellendus libero tenetur vitae.</p>
                    </div>
                </div> -->
            </div>
            <form action="#" class="typing-area">
                <input type="text" name="incoming_id" value="<?php echo $userId; ?>" hidden>
                <input type="text" name="outgoing_id" value="<?php echo $_SESSION["userId"]; ?>" hidden>
                <input type="text" name="message" class="text-input" placeholder="Type your message here...">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </main>

    <script src="public/js/chat.js"></script>
</body>
</html>