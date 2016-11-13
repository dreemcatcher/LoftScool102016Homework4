<?php
session_start();
error_reporting(-1);
mb_internal_encoding('utf-8');
require_once '..\cn\cn.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Регистрация</title>
    <style>
        <?php
        include '..\css\main.css';
        ?>
    </style>
</head>
<body>
<?php
//include "../menu.php";
?>
<table width=100%  cellspacing="0" cellpadding="0">
    <tr>
        <td width="15%"></td>
        <td width="69%" align="center">
            <?php
            try {
                $username = !empty($_POST['nickname']) ? trim($_POST['nickname']) : null;
                $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

                $username= htmlspecialchars($username);
                $passwordAttempt=htmlspecialchars($passwordAttempt);

                $sql = "SELECT id, usr, pas FROM users WHERE usr = :username and pas = :password";
                $stmt = $databaseConnection->prepare($sql);

                $stmt->bindValue(':username', $username);
                $stmt->bindValue(':password', $passwordAttempt);
                $stmt->execute();

                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user === false) {
                    if(isset($_POST['nickname'])){
                        echo "Неверно введён логин или пароль!";
                    }
                    else {

                    }
                } else {

                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['usr'];
                    $_SESSION['logged_in'] = time();

                    echo "<p>Вы успешно залогинились</p>";
                    echo "Юзер id ".$_SESSION['user_id']."<br>";
                    echo "Имя юзера ".$_SESSION['user_name']."<br>";
                    echo "Время логина ".$_SESSION['logged_in']."<br>";
                    ?>
                    <script language = 'javascript'>
                        var delay = 3000;
                        setTimeout("document.location.href='../index.php'", delay);
                    </script>
                    <p>Через 3 секунды Вы будете перенаправлены на него. Но на случай если ничего не происходит, вот ссылка. <a href='../index.php'>Главная</a>
                    </p>
                    <?php
                }
                $dbh = null;
            } catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }
            ?><br><br><br><br>
            <div id='login'>
                <form action="login.php" method="post" name="login"><br><br>
                    <h1>Вход</h1><br>
                    <p>
                        <label>Ник<br><input class="input" name="nickname" size="32" type="text" placeholder="my_user_nickname"/></label><br>
                    </p>
                    <p>
                        <label>Пароль<br><input class="input" name="password" size="32" type="password" placeholder="eg. X8df!90EO" /></label><br>
                    </p>
                    <input class="button" name= "register" type="submit" value="login">
                </form>
            </div>
        </td>
        <td width="15%"></td>
    </tr>
</table>
</body>
</html>