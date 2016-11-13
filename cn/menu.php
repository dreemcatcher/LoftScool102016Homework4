<div class="menu"><table width=100%  cellspacing="0" cellpadding="0">
        <tr>
            <td width="15%"></td>
            <td width="69%" align="center">
                <?php
                if (isset($_SESSION["user_id"])){
                    echo "Приветствую ".$_SESSION['user_name']."&nbsp&nbsp&nbsp";
                    echo "<a href='index.php'>На главную </a>&nbsp";
                    echo "&nbsp<a href='settings/about.php'>О себе </a>&nbsp";
                    echo "&nbsp<a href='watchall.php'>Посмотреть все фотографии </a>&nbsp";
                    echo "&nbsp<a href='settings/exit.php'>Выйти </a>&nbsp";
                }
                else{
                    echo "
<a href='index.php'>На главную </a>&nbsp
<a href='reg.php'>Зарегистрироваться </a>&nbsp
<a href='auth.php'>Авторизоваться </a>";
                }
                ?>
            </td>
            <td width="15%"></td>
        </tr>
    </table></div>
