<?php include('config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <title>.:SLFWPM by Vaseto.net:.</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, , initial-scale=1, user-scalable=no">
    <script type="text/javascript" src="js/images.js"></script>
    <link rel="stylesheet" href="css/styles.css">

    <link href="<?php echo $theme; ?>/css/style.css" rel="stylesheet" title="Style" />
</head>
<body>

    <div class="header wrapper rounds wrapper-background">

        <h1>Members Area :)</h1>
        <a href="<?php echo $site_url; ?>"><img class="logo" src="<?php echo $theme; ?>/images/Messages-icon.png" alt="Logo" /></a>
        <ul>
            <li><a href="index.php">Начало</a></li>
            <li><a href="login.php">Вход</a></li>
            <li><a href="logout.php">Изход</a></li>
            <li><a href="read_pm.php">Нови Съобщения</a></li>
            <li><a href="edit_infos.php.php">Профил</a></li>
            <li><a href="list_users.php">Потребители</a></li>
            <li><a href="sign_up.php">Регистрация 2</a></li>
            <li><a href="register.php">Регистрация</a></li>
            <li><a href="messages.php">Съобщения</a></li>
            <li><a href="setup-config-database-firstrun.php">Конфигурация</a></li>
            <li><a href="read_me.html">Документация</a></li>

            <li><a href="index.php"><?php

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
    </li>
</ul>
</div>

<div class="container wrapper rounds wrapper-background2">

    <div class="content">

        <h1>Simple Login form With PM messages: Members area.</h1>

        <div class="register">

            <p> Welcome to Simple Login Form With PM Messages. </p>

            <?php if(isset($_SESSION['username'])){echo ' '.htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8');} ?><br/>
            You can <a href="list_users.php">see the list of users</a>.<br/>
            <?php
                        //If the user is logged, we display links to edit his infos, to see his pms and to log out
            if(isset($_SESSION['username']))
            {
                        //We count the number of new messages the user has
                $nb_new_pm = mysql_fetch_array(mysql_query('select count(*) as nb_new_pm from pm where ((user1="'.$_SESSION['userid'].'" and user1read="no") or (user2="'.$_SESSION['userid'].'" and user2read="no")) and id2="1"'));
                        //The number of new messages is in the variable $nb_new_pm
                $nb_new_pm = $nb_new_pm['nb_new_pm'];
                        //We display the links
                ?>
                <a href="edit_infos.php">Edit my personnal informations</a><br />
                <a href="list_pm.php">My personnal messages(<?php echo $nb_new_pm; ?> unread)</a><br />
                <a href="login.php">Logout</a>
                <?php
            }
            else
            {
                //Otherwise, we display a link to log in and to Sign up
                ?>
                <a href="register.php">Register here</a><br/>
                <a href="login.php">Log in here</a>
                <?php
            }
            ?>

        </div><!-- end of /login-->

    </div><!-- end of /content-->

</div><!-- end of /container-->

<div class="footer wrapper rounds wrapper-background">
    <ul>
        <a href="index.php">SLFWPM</a> by
        <a href="http://vaseto.net">Vaseto.net</a>
        <strong>2014 CC BY-NC-SA.</strong>
    </ul>
</div>

</body>
</html>