<?php include_once "partials/header.php"; //Include Header 
?>
    <link rel="stylesheet" href="public/css/user.css">
    <link rel="stylesheet" href="public/css/view-status.css">
    <title>CHAT HOME PAGE</title>
</head>
<body>
    <main>
        <section class="users">
            <header>
                <div class="content">
                    <img src="public/<?php echo $userInfo["img"]; ?>" alt="">
                    <div class="details">
                        <span><?php echo $userInfo["fname"] . " " . $userInfo["lname"]; ?></span>
                        <p><?php echo $userInfo["status"]; ?></p>
                    </div>
                </div>
                <a href="/logout?userId=<?php echo $_SESSION["userId"] ?>" class="logout">Logout</a>
            </header>
            <div class="chat-section">
                <h2 class="current">Chat</h2>
                <h2><a href="/status">Status</a></h2>
            </div>
            <div class="search">
                <span class="text">Select a user to start chat with</span>
                <input type="text" name="search" placeholder="Enter name to search..." autocomplete="off">
                <button><i class="fas fa-search"></i></button>
            </div>

            <div class="users-list">
                <!-- <div class="chat">
                    <a href="">
                        <img src="public/images/mc0TT1(1).jpg" alt="" class="no-status">
                    </a>
                    <a href="/chat?userId=1252863837" class="chat-link">
                        <div class="content">
                            <div class="details">
                                <span>Emma Jesse</span>
                                <p>You:  New Test...</p>
                            </div>
                        </div>
                        <div class="status-dot ">
                            <i class="fas fa-circle"></i>
                        </div>
                    </a>
                </div>
                <div class="chat">
                    <a href="">
                        <div class="card">
                            <div class="percent">
                                <svg>
                                    <circle cx="30" cy="30" r="28"></circle>
                                    <circle cx="30" cy="30" r="28" style="--percent: 30"></circle>
                                </svg>
                                <div class="number">
                                    <img src="public/images/mc0TT1(1).jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="/chat?userId=1252863837" class="chat-link">
                        <div class="content">
                            <div class="details">
                                <span>Emma Jesse</span>
                                <p>You:  New Test...</p>
                            </div>
                        </div>
                        <div class="status-dot ">
                            <i class="fas fa-circle"></i>
                        </div>
                    </a>
                </div> -->
            </div>
        </section>
    </main>

    <script src="public/js/users.js"></script>
</body>
</html>