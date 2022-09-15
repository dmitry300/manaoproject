<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../public/css/form.css">
    <link rel="stylesheet" href="../public/css/index.css">
    <noscript><meta http-equiv="refresh" content="0; url=/manaoproject" /></noscript>
</head>
<div class="wrapper">
    <form action="logined" method="POST" id="loginForm" class="form" autocomplete="off">
        <h1 class="form_title">Вход</h1>
        <div class="form_item">
            <label for="login" class="form_label">Login</label>
            <input type="text" placeholder="Enter login" id="login" name="login" class="form_input _login _req">
        </div>
        <div class="form_item">
            <label for="password" class="form_label">Password</label>
            <input type="password" placeholder="Enter Password" id="password" name="password"
                   class="form_input _password _req">
        </div>
        <div class="form_item">
            <button type="submit" class="form_button">Sign in</button>
        </div>
    </form>
</div>
<script src="../public/js/loginform.js"></script>
