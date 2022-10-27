<?php include_once "partials/header.php"; //Include Header 
?>
    <link rel="stylesheet" href="public/css/user.css">
    <title>STATUS</title>
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
                <h2><a href="/users">Chat</a></h2>
                <h2 class="current">Status</h2>
            </div>
            <div class="search">
                <span class="text">Select a user to start chat with</span>
                <input type="text" name="search" placeholder="Enter name to search..." autocomplete="off">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="error-message">Hello Wolrd</div>
            <div class="status-update-update">
                <div class="add-status">
                    <form action="#">
                        <label for="status">
                            <div class="profile-picture">
                                <img src="public/<?php echo $userInfo["img"]; ?>" alt="">
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
                    </form>
                    <!-- <div class="status-list">
                        <div class="card">
                            <div class="percent">
                                <svg>
                                    <circle cx="30" cy="30" r="28"></circle>
                                    <circle cx="30" cy="30" r="28" style="--percent: 30"></circle>
                                </svg>
                                <div class="number">
                                    <img src="public/<?php echo $userInfo["img"]; ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="my-status-details">
                            <h2>Jesse Ehigie</h2>
                            <p class="detail-content">23 minutes ago</p>
                        </div>
                    </div> -->
                </div>
                <!-- <h3 class="recent-update">Recent updates</h3>
                <a href="" class="status-link">
                    <div class="status-list">
                        <div class="card">
                            <div class="percent">
                                <svg>
                                    <circle cx="30" cy="30" r="28"></circle>
                                    <circle cx="30" cy="30" r="28" style="--percent: 30"></circle>
                                </svg>
                                <div class="number">
                                    <img src="public/<?php echo $userInfo["img"]; ?>" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="my-status-details">
                            <h2>Jesse Ehigie</h2>
                            <p class="detail-content">23 minutes ago</p>
                        </div>
                    </div>
                </a>
                <h3 class="recent-update">Viewed updates</h3>
                <div class="status-list viewed">
                    <div class="card">
                        <div class="percent">
                            <svg>
                                <circle cx="30" cy="30" r="28"></circle>
                                <circle cx="30" cy="30" r="28" style="--percent: 30"></circle>
                            </svg>
                            <div class="number">
                                <img src="public/<?php echo $userInfo["img"]; ?>" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="my-status-details">
                        <h2>Jesse Ehigie</h2>
                        <p class="detail-content">23 minutes ago</p>
                    </div>
                </div>
                <div class="status-list viewed">
                    <div class="card">
                        <div class="percent">
                            <svg>
                                <circle cx="30" cy="30" r="28"></circle>
                                <circle cx="30" cy="30" r="28" style="--percent: 30"></circle>
                            </svg>
                            <div class="number">
                                <img src="public/<?php echo $userInfo["img"]; ?>" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="my-status-details">
                        <h2>Jesse Ehigie</h2>
                        <p class="detail-content">23 minutes ago</p>
                    </div>
                </div>
                <div class="status-list viewed">
                    <div class="card">
                        <div class="percent">
                            <svg>
                                <circle cx="30" cy="30" r="28"></circle>
                                <circle cx="30" cy="30" r="28" style="--percent: 30"></circle>
                            </svg>
                            <div class="number">
                                <img src="public/<?php echo $userInfo["img"]; ?>" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="my-status-details">
                        <h2>Jesse Ehigie</h2>
                        <p class="detail-content">23 minutes ago</p>
                    </div>
                </div>
                <div class="status-list viewed">
                    <div class="card">
                        <div class="percent">
                            <svg>
                                <circle cx="30" cy="30" r="28"></circle>
                                <circle cx="30" cy="30" r="28" style="--percent: 30"></circle>
                            </svg>
                            <div class="number">
                                <img src="public/<?php echo $userInfo["img"]; ?>" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="my-status-details">
                        <h2>Jesse Ehigie</h2>
                        <p class="detail-content">23 minutes ago</p>
                    </div>
                </div> -->
            </div>
        </section>
    </main>

    <script src="public/js/status.js"></script>
</body>
</html>