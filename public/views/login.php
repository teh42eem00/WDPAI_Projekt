<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>LOGIN PAGE</title>
</head>

<body>
<div class="container">
    <div class="logo">
        <img src="public/img/logo.svg" alt="logo">
    </div>

    <div class="login-container">
        <form class="login" action="login" method="POST">
            <div class="messages">
                <?php
                if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }

                ?>
            </div>
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <button type="submit">LOGIN</button>
            <div class="input-text">
                Haven't account yet? <a href="/register">REGISTER HERE</a>
            </div>
        </form>

    </div>
</div>
</body>