<?php
session_start();
error_reporting(-1);
mb_internal_encoding('utf-8');
header('Content-Type: text/html; charset=utf-8');
require_once 'cn\cn.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Работа с фотографиями</title>
    <style>
        <?php
        include 'css/main.css';
       // include 'css/style.css';
        ?>
    </style>
</head>
<body>
<?php
include "cn/menu.php";

if (isset($_GET['unl'])) {
    // Проверяем кто владелец файла
    $photoName = $_GET['unl'];
    try {
        $sql = "SELECT userid, phname  FROM photos WHERE phname = :photoname";
        $stmt = $databaseConnection->prepare($sql);

        $stmt->bindValue(':photoname', $photoName);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "<br>" . $row['userid'];
        echo "<br>" . $row['phname'];

    } catch (PDOException $e) {
        print "<br>Error!: " . $e->getMessage() . "<br>";
        die();
    }
    if ($_SESSION["user_id"] === $row["userid"]) {
        echo "<br>Можно удалять<br>";
        $filename = "photos/" . htmlspecialchars($_GET['unl']);
        if (file_exists($filename)) {
            unlink($filename);
        } else {
            echo "При удалении файла произошла ошибка";
        }
        $sql = "DELETE FROM `photos` WHERE phname= :photoname";

        $stmt = $databaseConnection->prepare($sql);
        $stmt->bindValue(':photoname', $photoName);
        $result = $stmt->execute();
        if ($result) {
            echo "<br>Файл был успешно удалён.<br>";
            // echo "<script language='JavaScript'>";
            //  echo "window.location.href = 'index.php'</script>";
        }
    } else {
        echo "<br>У вас нет прав на удаление данного файла.<br>";
    }
} else {
}
?>
<table width=100% cellspacing="0" cellpadding="0">
    <tr>
        <td width="15%"></td>
        <td width="69%" align="center">
            <br><br><br><br><br><br><br><br>
            <div class="shadow">
                <?php
                if (isset($_SESSION["user_id"])) {
                    ?>
                    <table width=100% cellspacing="0" cellpadding="0" border="0">
                        <tr>
                            <?php
                            $i=0;
                            $userid = $_SESSION["user_id"];
                            $dir = 'photos';
                            $f = scandir($dir);
                            foreach ($f as $file) {
                                $i++;
                                if ($i<=2){
                                    echo "";
                                }else
                                {
                                echo "<br><img src=photos/" . $file . " width='330'><br>";
                                echo $file . "<br/>";
                                echo "<br><a href='watchall.php?unl=" . $file . "'>DELETE THIS</a>";
                                }
                            }
                            ?>
                        </tr>
                    </table>
                    <?php
                } else {
                    ?>
                    <h1>Надо бы <a href='auth.php'>залогиниться </a>/ <a href='reg.php'> зарегистрироваться</a></h1>
                    <?php
                }
                ?>
            </div>
        </td>
        <td width="15%"></td>
    </tr>
</table>
</body>
</html>