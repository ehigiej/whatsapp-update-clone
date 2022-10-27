<?php include_once "partials/header.php"; //Include Header 
?>
    <link rel="stylesheet" href="public/css/view-status.css">
    <title>Status</title>
</head>
<body>
    <main>
        <section class="status-div">
            <div class="user-info">
                <div class="info1">
                    <img src="public/<?php echo $currentStatus["img"]; ?>" alt="">
                    <div class="user-info-div">
                        <p class="username"><?php echo $currentStatus["fname"] . " " . $currentStatus["lname"] ?></p>
                        <p class="time"><?php echo $dateDiffString ?></p>
                    </div>
                </div>
                <a href="/status">
                    <span class="material-icons-outlined">
                        close
                    </span>
                </a>
            </div>
            <div class="img-div">
                <img src="public/<?php echo $currentStatus["file"] ?>" alt="">
            </div>
            <?php if(!empty($previousStatus)): ?>
                <a href="<?php echo "/view-status?userId=" . $previousStatus["postedBy"] . "&statusId=" . $previousStatus["status_id"]  ?>" class="controllers left">
                    <div>
                        <span class="material-icons-outlined">
                            navigate_before
                        </span>
                    </div>
                </a>
            <?php endif ?>
            <?php if(!empty($nextStatus)): ?>
                <a href="<?php echo "/view-status?userId=" . $nextStatus["postedBy"] . "&statusId=" . $nextStatus["status_id"]  ?>" class="controllers right">
                    <div>
                        <span class="material-icons-outlined">
                            navigate_next
                        </span>
                    </div>
                </a>
            <?php endif ?>
        </section>
    </main>

    <script src="public/js/view-status.js"></script>
</body>
</html>