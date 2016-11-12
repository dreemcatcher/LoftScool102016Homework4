<?php
session_start();
error_reporting(-1);
mb_internal_encoding('utf-8');
header('Content-Type: text/html; charset=utf-8');

// тут всё просто отслеживаеи сессию
// Если она существует, проверяемнаша она или нет.
// Сессии нет - предлагаем залогиниться

if (isset($_SESSION["user_id"])){
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
        include 'css/main.css';
        include 'css/style.css';
        ?>
    </style>
</head>
<body>
Залогинился такой. Молодца.
</body>
</html>
<?php
}else {
    ?>
    <h2><a href="index.php">Залогиниться</a> или <a href="auth/reg.php">Зарегистрироваться</a></h2>
    <?php
}
?>
</body>
</html>