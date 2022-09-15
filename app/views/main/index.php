<head>
    <link rel="stylesheet" href="./public/css/index.css">
</head>
<?php if (isset($_SESSION['userName'])): ?>
    <h1>Hello, <?php echo $_SESSION['userName']; ?></h1>
<?php else: ?>
    <h1>Hello, unauthorized user</h1>
<?php endif; ?>