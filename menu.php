r<?php
// thats menu file.
//header('menu.php');
?>
<a href="<?php echo $site_url; ?>"><img class="logo" src="<?php echo $theme; ?>/images/Messages-icon.png" alt="Logo" /></a>
<ul>
    <li>
        <?php

            if(!isset($_SESSION['username'])) {
                //We check if the form has been sent
                if(isset($_POST['username'], $_POST['password'], $_POST['passverif'], $_POST['email'], $_POST['avatar']))
                    {
                        ?>
                            <li><a href="edit_infos.php">.:Профил:.</a></li>
                            <li><a href="messages.php">Съобщения</a></li>
                            <li><a href="read_pm.php">Нови Съобщения</a></li>
                            <li><a href="edit_infos.php">Профил</a></li>
                        <?php
                    }
                else
                {
                    ?>
                        <li><a href="index.php">Начало</a></li>
                        <li><a href="login.php">Вход</a></li>
                        <li><a href="logout.php">Изход</a></li>
                        <li><a href="register.php">Регистрация</a></li>
                        <li><a href="sign_up.php">Регистрация 2</a></li>
                        <li><a href="list_users.php">Потребители</a></li>
                        <li><a href="read_me.html">Документация</a></li>
                        <li><a href="setup-config-database-firstrun.php">Конфигурация</a></li>
                    <?php
                }
            }
        ?>
    </li>

    <!--     <li><a href="index.php"><?php

        if (!empty($username)){
            echo "Добре дошъл: ".'<b><span style="color: green;">'.@$username_.'</b></span>'." ";
            echo "<span class='header'><a href='logout.php'>Изход</a></span>";
        }
        else
        {
            echo "Не сте логнат.";
        }
        ?>
        </a>
    </li> -->


</ul>