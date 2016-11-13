<?php
error_reporting(-1);
mb_internal_encoding('utf-8');

require_once '..\cn\cn.php';

if (isset($_POST['nickname']) and isset($_POST['email']) and isset($_POST['password'])) {
    $nick = htmlspecialchars($_POST['nickname']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    try {

        $sql = "SELECT COUNT(*) as num FROM users WHERE usr = :username";
        $stmt = $databaseConnection->prepare($sql);

        $stmt->bindValue(':username', $nick);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['num'] > 0) {
            echo "That username already exists!";
        } else {
            echo "Такого юзера не существует";
            $sql = "INSERT INTO users (usr, pas, email) VALUES (:username, :password, :email)";

            $stmt = $databaseConnection->prepare($sql);

            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':username', $nick);
            $stmt->bindValue(':password', $password);


            $result = $stmt->execute();

            if ($result) {
                echo 'Thank you for registering with our website.';
                echo "<script language='JavaScript'>";
                echo "window.location.href = '../index.php'</script>";
            }
        }
        $databaseConnection = null;

    } catch (PDOException $e) {
        print "<br>Error!: " . $e->getMessage() . "<br>";
        die();
    }
} else {
    echo "Данные не переданы";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Регистрация</title>
    <style>
        <?php
        include '../css/main.css';
        ?>
    </style>
</head>
<body>
<?php
//include "menu.php";
?>
<table width=100% cellspacing="0" cellpadding="0">
    <tr>
        <td width="15%"></td>
        <td width="69%" align="center">
            <br><br><br><br>
            <div id='login'>
                <form action="reg.php" method="post" name="login"><br><br>
                    <h1>Регистрация</h1><br>
                    <p>
                        <label>Ник<br><input class="input" name="nickname" size="32" type="text"
                                             placeholder="my_user_nickname"/></label><br>
                    </p>
                    <p>
                        <label>Мэйл<br><input class="input" name="email" size="32" type="text"
                                              placeholder="123@mail.ru"/></label><br>
                    </p>
                    <p>
                        <label>Пароль<br><input class="input" name="password" size="32" type="password"
                                                placeholder="eg. X8df!90EO"/></label><br>
                    </p>
                    <input class="button" name="register" type="submit" value="login">
                </form>
            </div>
        </td>
        <td width="15%"></td>
    </tr>
</table>
</body>
</html>