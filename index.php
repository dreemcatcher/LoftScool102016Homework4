<?php
session_start();
error_reporting(-1);
mb_internal_encoding('utf-8');
header('Content-Type: text/html; charset=utf-8');
// тут всё просто отслеживаеи сессию
// Если она существует, проверяемнаша она или нет.
// Сессии нет - предлагаем залогиниться
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <style>
        <?php
        require_once 'css/main.css';
        ?>
    </style>
</head>
<body>
<?php
if (isset($_SESSION["user_id"])){
    require_once 'menu.php';
    ?>

<?php
}else {
    ?>
<div class="center">
    <div class="shadow">
    <h2><a href="auth/login.php">Залогиниться</a> или <a href="auth/reg.php">Зарегистрироваться</a></h2>
</div></div>
    <?php
}
?>
</body>
</html>