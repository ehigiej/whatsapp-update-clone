<?php include_once "partials/header.php"; //Include Header ?>
    <title>SIGNUP | PHP WHATSAPP CHAT</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <main>
        <section class="form signup">
            <header>PHP WHATSAPP CHAT</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-message"></div>
                <div class="names">
                    <div class="firstname ff input">
                        <label>First Name</label>
                        <input type="text" name="fname" placeholder="First Name" required>
                    </div>
                    <div class="lastname ff input">
                        <label>Last Name</label>
                        <input type="text" name="lname" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="email ff input">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter Your Email Address" required>
                </div>
                <div class="password ff input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter New Password">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="profileImage ff">
                    <label>Image</label>
                    <input type="file" name="profile" accept="image">
                </div>
                <input type="submit" value="Continue to chat app">
            </form>
            <div class="signing">
                Already Signed Up 
                <a href="/login">login now</a>
            </div>
        </section>
    </main>

    <script src="public/js/signup.js"></script>
</body>
</html>