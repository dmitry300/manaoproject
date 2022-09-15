<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>
    <meta charset="UTF-8">

</head>
<body>
<?php include "app/views/main/header.php" ?>
<?php echo $content; ?>
<noscript>
    <h1 style="color: red">You must enable JS!</h1>
</noscript>
</body>
</html>