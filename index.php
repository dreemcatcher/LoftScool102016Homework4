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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <style>
        <?php
        include 'css/main.css';
        include 'css/style.css';
        ?>
    </style>
</head>
<body>
<?php
include "menu.php";
?>
<table width=100% cellspacing="0" cellpadding="0" border="0">
    <tr>
    </tr>
</table>
<?php
} else {
    ?>
    <h2><a href="index.php">Залогиниться</a> или <a href="index.php">Зарегистрироваться</a></h2>
    <?php
}
?>
</body>
</html>