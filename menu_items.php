<?php

    //If the user is logged, we display links to edit his infos, to see his pms and to log out
    if(isset($_SESSION['username']))
    {
        $nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
        $nb_new_pm = $nb_new_pm['nb_new_pm'];


        //display links
        ?>
        <a href="<?php echo $site_url; ?>"><img class="logo" src="<?php echo $theme; ?>/images/Messages-icon-2.png" title="Online, logged in" alt="Logo" /></a>
            <ul>
                <li><a href="index.php">.:Начало:.</a></li>
                <li><a href="logout.php">.:Изход:.</a></li>
                <li><a href="edit_infos.php">.:Профил:.</a></li>
                <li><a href="messages.php">.:Съобщения:.</a></li>
                <li><a href="read_pm.php">.:Нови Съобщения:.</a></li>
                <li><a href="list_users.php">Потребители</a></li>
                <li><a href="read_me.html">Документация</a></li>
            </ul>
        <?php
    }
    else
    {
        //Otherwise, we display a link to log in and to Sign up
        ?>
        <a href="<?php echo $site_url; ?>"><img class="logo" src="<?php echo $theme; ?>/images/Messages-icon.png" title="Offline, not logged in" alt="Logo" /></a>
            <ul>
                <li><a href="index.php">Начало</a></li>
                <li><a href="login.php">Вход</a></li>
                <li><a href="logout.php">Изход</a></li>
                <li><a href="register.php">Регистрация</a></li>
                <li><a href="sign_up.php">Регистрация 2</a></li>
                <li><a href="list_users.php">Потребители</a></li>
                <li><a href="read_me.html">Документация</a></li>
                <li><a href="setup-config-database-firstrun.php">Конфигурация</a></li>
        <?php
            echo '<center><i>Не сте си влезнали в регистрацията</i></center>';
    }
?>
</ul>

<!-- thats second menu
<a href="<?php echo $site_url; ?>">
<img class="logo" src="<?php echo $theme; ?>/images/Messages-icon.png" alt="Logo"/></a>
<ul>
    <li>
        <?php
            if(!isset($_SESSION['username'])) {
                //We check if the form has been sent
                if(isset($_POST['username'], $_POST['password'], $_POST['passverif'], $_POST['email'], $_POST['avatar']))
                    {
                    ?>
                    <ul>
                        <li><a href="edit_infos.php">.:Профил:.</a></li>
                        <li><a href="messages.php">Съобщения</a></li>
                        <li><a href="read_pm.php">Нови Съобщения</a></li>
                        <li><a href="edit_infos.php">Профил</a></li>
                    </ul>
                    <?php
                    }
                else
                {
                ?>
                <ul>
                    <li><a href="index.php">Начало</a></li>
                    <li><a href="login.php">Вход</a></li>
                    <li><a href="logout.php">Изход</a></li>
                    <li><a href="register.php">Регистрация</a></li>
                    <li><a href="sign_up.php">Регистрация 2</a></li>
                    <li><a href="list_users.php">Потребители</a></li>
                    <li><a href="read_me.html">Документация</a></li>
                    <li><a href="setup-config-database-firstrun.php">Конфигурация</a></li>
                </ul>
                <?php
                }
            }
        ?>
    </li>
</ul>
 -->
