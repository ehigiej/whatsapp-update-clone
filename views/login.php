<?php include_once "partials/header.php"; //Include Header ?>
    <title>LOGIN | PHP WHATSAPP CHAT</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <main>
        <section class="form login">
            <header>PHP WHATSAPP CHAT</header>
            <form action="#">
                <div class="error-message"></div>
                <div class="email ff input">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter Your Email Address" required>
                </div>
                <div class="password ff input">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter Your Password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <input type="submit" value="Continue to chat app">
            </form>
            <div class="signing">
                not a user? 
                <a href="/">Signup now</a>
            </div>
        </section>
    </main>
    <script src="public/js/login.js"></script>
</body>
</html>