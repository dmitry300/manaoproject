<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../public/css/form.css">
    <link rel="stylesheet" href="../public/css/index.css">
    <noscript><meta http-equiv="refresh" content="0; url=/manaoproject" /></noscript>
</head>
<body>
<div class="wrapper">
        <form action="registered" method="POST" id="registerForm" class="form" autocomplete="off">
            <h1 class="form_title">Регистрация</h1>
            <div class="form_item">
                <label for="name" class="form_label">Name</label>
                <input type="text" placeholder="Enter username" id="name" name="name"
                       class="form_input _name _req">
            </div>
            <div class="form_item">
                <label for="login" class="form_label">Login</label>
                <input type="text" placeholder="Enter login" id="login" name="login" class="form_input _login _req">
            </div>
            <div class="form_item">
                <label for="email" class="form_label">Email</label>
                <input type="email" placeholder="Enter Email" id="email" name="email" class="form_input _email _req">
            </div>
            <div class="form_item">
                <label for="password" class="form_label">Password</label>
                <input type="password" placeholder="Enter Password" id="password" name="password"
                       class="form_input _password _req">
            </div>
            <div class="form_item">
                <label for="confirm_password" class="form_label">Repeat Password</label>
                <input type="password" placeholder="Repeat Password" id="confirm_password" name="confirm_password"
                       class="form_input _confirmed_password _req">
            </div>
            <div class="form_item">
                <button type="submit" class="form_button">Sign up</button>
            </div>
        </form>
</div>
<script src="../public/js/registerform.js"></script>

