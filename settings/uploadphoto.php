<?php
session_start();
error_reporting(-1);
mb_internal_encoding('utf-8');
header('Content-Type: text/html; charset=utf-8');
require_once '..\cn\cn.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Загрузка фотографии</title>
    <style>
        <?php
        require_once '../css/main.css';
       // include 'css/style.css';
        ?>
    </style>
</head>
<body>
<div id='login'>
    <table width=100% cellspacing="0" cellpadding="0">
        <tr>
            <td width="15%">
                <div class="center">
                    <div class="shadow">
                        <?php
                        $user_id = $_SESSION['user_id'];
                        $usernameS = $_SESSION['user_name'];

                        if (!isset($_SESSION["user_id"])) {
                            echo "Приветствую " . $_SESSION['user_name'] . "&nbsp";
                            echo "&nbsp<a href='exit.php'>Выйти</a>&nbsp";
                        } else {
                            ///////////////////////
                            // Уголок безопасности начало
                            ///////////////////////
                            $size = 2048000;  // 1 метра 1024*2*1024
                            $types = array('image/gif', 'image/png', 'image/jpeg', 'image/jpg');
                            // Проверяем тип файла лп Mimetype
                            if (!in_array($_FILES['userfile']['type'], $types)) {
                                die("Запрещённый тип файла. <a href='about.php'>Попробовать другой файл?</a>");
                            }
                            // Проверяем размер файла
                            if ($_FILES["userfile"]["size"] > $size) {
                                die('Слишком большой размер файла. <a href="?">Попробовать другой файл?</a>');
                            }

                            ///////////////////////
                            // Уголок безопасности конец
                            ///////////////////////

                            $uploaddir = '../photos/';

                            $uploadname = $_SESSION['user_name'] . mt_rand(10000, 99999) . time() . '.jpg';

                            $uploadfile = $uploaddir . $uploadname;
                            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                                // echo "File is valid, and was successfully uploaded.\n";
                            } else {
                                echo "File uploading failed.\n";
                            }
                            echo "<a href='about.php'>Назад</a><br>";
                            echo "Файл " . $uploadname . " был загружен<br>";
                            echo "<div align='center'><img src=../photos/" . $uploadname . " width=200></div><br>";

                            echo "Приветствую " . $_SESSION['user_name'] . "&nbsp";
                            echo "&nbsp<a href='../index.php'>На главную</a>&nbsp";
                            echo "&nbsp<a href='exit.php'>Выйти</a>&nbsp";
                            echo "&nbsp<a href='about.php'>Загрузить ещё</a>&nbsp<br>";

                            $sql = "INSERT INTO Photos (userid, phname) VALUES (:userid, :phname)";
                            $stmt = $databaseConnection->prepare($sql);

                            $stmt->bindValue(':userid', $user_id);
                            $stmt->bindValue(':phname', $uploadname);

                            $result = $stmt->execute();

                            if ($result) {
                                echo "Файл загржен успешно.";
                                //   echo "<script language='JavaScript'>";
                                //    echo "window.location.href = 'index.php'</script>";
                            }

                            if (!empty($_POST['username']) && !empty($_POST['age']) && !empty($_POST['tarea'])) {
                                $user_name = htmlspecialchars($_POST['username']);
                                $age = htmlspecialchars($_POST['age']);
                                $tarea = htmlspecialchars($_POST['tarea']);

                                $nick = $_SESSION['user_id'];
                                try {
                                    $databaseConnection = new PDO('mysql:host=localhost;dbname=dreamcatcher', _USER_NAME_, _DB_PASSWORD);
                                    $databaseConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                                    $sql = "UPDATE users SET user_name = :username, about = :about, age = :age WHERE id = :user_id";
                                    $stmt = $databaseConnection->prepare($sql);

                                    $stmt->bindValue(':username', $user_name);
                                    $stmt->bindValue(':about', $tarea);
                                    $stmt->bindValue(':age', $age);

                                    $stmt->bindValue(':user_id', $user_id);

                                    $result = $stmt->execute();

                                    $databaseConnection = null;

                                    echo "<script language='JavaScript'>";
                                    echo "window.location.href = 'settings.php'</script>";
                                } catch (PDOException $e) {
                                    print "Error!: " . $e->getMessage() . "<br/>";
                                    die();
                                }
                            } else {
                                // echo "<br>Одно из полей незаполнено";
                            }
                        }
                        ?></div>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>