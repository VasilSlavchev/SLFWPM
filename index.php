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

    <h1>Index Area :)</h1>
        <?php
            //include('menu.php');
            include('menu_items.php');
            //include('check_if_login.php');
        ?>
</div>

<div class="container wrapper rounds wrapper-background2">

    <div class="content">

        <h1>Simple Login form With PM messages: Members area.</h1>

        <div class="register">

            <p> Welcome to Simple Login Form With PM Messages. </p>

            <?php if(isset($_SESSION['username'])){
                echo 'Влезнал като: '.htmlentities($_SESSION['username'], ENT_QUOTES, 'UTF-8');
                } ?><br/>
            <p>Тук може да видиш <a href="list_users.php">списък с потребителите</a>.

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
                    <ul>
                    <li><a href="edit_infos.php">Промени профилната информация.</a></li>
                    <li><a href="list_pm.php">Моите лични съобщения: (<?php echo $nb_new_pm; ?> непрочетено)</a></li>
                    <li><a href="login.php">Излез</a></li>
                    </ul>
                    <?php
                }
                else
                {
                    //Otherwise, we display a link to log in and to Sign up
                    ?>
                    <ul>
                    <li><a href="register.php">Регистрирай се тук</a></li>
                    <li><a href="login.php">Или влез от тук</a></li>
                    </ul>
                    <?php
                }
            ?>

        </div><!-- end of /login-->

    </div><!-- end of /content-->

</div><!-- end of /container-->

<div class="footer wrapper rounds wrapper-background">
    <?php
    include('footer.php');
    ?>
</div>

</body>
</html>