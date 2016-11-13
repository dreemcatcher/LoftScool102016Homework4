<?php
//session_start();
error_reporting(-1);
mb_internal_encoding('utf-8');

include '..\cn\cn.php';

if (isset($_POST['nickname']) and isset($_POST['email']) and isset($_POST['password'])) {
    $nick = htmlspecialchars($_POST['nickname']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    echo "<br>" . $nick . "<br>" . $email . "<br>" . $password;

    try {
        // $dbh = new PDO('mysql:host=localhost;dbname=dreamcatcher', _USER_NAME_, _DB_PASSWORD);
        // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $databaseConnection

        $sql = "SELECT COUNT(*) as num FROM users WHERE usr = :username";
        $stmt = $databaseConnection->prepare($sql);

        $stmt->bindValue(':username', $nick);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['num'] > 0) {
            echo "That username already exists!";
            // die();
        } else {
            echo "Такого юзера не существует";
            $sql = "INSERT INTO users (usr, pas, email) VALUES (:username, :password, :email)";

            //INSERT INTO `LoftScoolDZBD`.`users` (`id`, `name`, `email`, `photo`, `usr`, `pas`) VALUES (NULL, '', 'mail@ru.ru', '', 'art', '123');
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

//
//if(!empty($_POST['nickname']) and !empty($_POST['email']) and !empty($_POST['password'])) {
//    $nick = htmlspecialchars($_POST['nickname']);
//    $email = htmlspecialchars($_POST['email']);
//    $password = htmlspecialchars($_POST['password']);
//
//    echo $nick.$email.$password;
//
//
//    try {
//        // $dbh = new PDO('mysql:host=localhost;dbname=dreamcatcher', _USER_NAME_, _DB_PASSWORD);
//        // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        // $databaseConnection
//
//        $sql = "SELECT COUNT(*) as num FROM users WHERE usr = :username";
//        $stmt = $databaseConnection->prepare($sql);
//
//        $stmt->bindValue(':username', $nick);
//
//        $stmt->execute();
//
//        $row = $stmt->fetch(PDO::FETCH_ASSOC);
//
//        if ($row['num'] > 0) {
//            echo "That username already exists!";
//            // die();
//        } else {
//            echo "Такого юзера не существует";
//            $sql = "INSERT INTO users (usr, pas, email) VALUES (:username, :password, :email)";
//            $stmt = $databaseConnection->prepare($sql);
//
//            $stmt->bindValue(':username', $nick);
//            $stmt->bindValue(':password', $password);
//            $stmt->bindValue(':email', $email);
//
//            $result = $stmt->execute();
//
//            if ($result) {
//                echo 'Thank you for registering with our website.';
//                echo "<script language='JavaScript'>";
//                echo "window.location.href = 'index.php'</script>";
//            }
//        }
//        $databaseConnection = null;
//    } catch (PDOException $e) {
//        print "Error!: " . $e->getMessage() . "<br/>";
//        die();
//    }
//
//}

//header('Content-Type: text/html; charset=utf-8');

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