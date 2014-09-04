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
</head>
<body>

    <div class="header wrapper rounds wrapper-background">

        <h1>Login Area :)</h1>
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
        </ul>

    </div>

    <div class="container wrapper rounds wrapper-background2">

        <div class="content">

            <h1>Simple Login form With PM messages: Login Area.</h1>

            <div class="login">

                <?php
                //If the user is logged, we log him out
                if(isset($_SESSION['username']))
                {
                    //We log him out by deleting the username and userid sessions
                        unset($_SESSION['username'], $_SESSION['userid']);
                    ?>
                    <div class="message">You have successfuly been loged out.<br />
                        <a href="<?php echo $site_url; ?>">Home</a></div>
                        <?php
                    }
                    else
                    {
                        $ousername = '';
                    //We check if the form has been sent
                        if(isset($_POST['username'], $_POST['password']))
                        {
                        //We remove slashes depending on the configuration
                            if(get_magic_quotes_gpc())
                            {
                                $ousername = stripslashes($_POST['username']);
                                $username = mysql_real_escape_string(stripslashes($_POST['username']));
                                $password = stripslashes($_POST['password']);
                            }
                            else
                            {
                                $username = mysql_real_escape_string($_POST['username']);
                                $password = $_POST['password'];
                            }
                        //We get the password of the user
                            $req = mysql_query('select password,id from users where username="'.$username.'"');
                            $dn = mysql_fetch_array($req);
                        //We compare the submited password and the real one, and we check if the user exists
                            if($dn['password']==$password and mysql_num_rows($req)>0)
                            {
                            //If the password is good, we dont show the form
                                $form = false;
                            //We save the user name in the session username and the user Id in the session userid
                                $_SESSION['username'] = $_POST['username'];
                                $_SESSION['userid'] = $dn['id'];
                                ?>
                                <div class="message">You have successfuly been logged. You can access to your member area.<br />
                                    <a href="<?php echo $site_url; ?>">Home</a></div>
                                    <?php
                                }
                                else
                                {
                            //Otherwise, we say the password is incorrect.
                                    $form = true;
                                    $message = 'The username or password is incorrect.';
                                }
                            }
                            else
                            {
                                $form = true;
                            }
                            if($form)
                            {
                            //We display a message if necessary
                                if(isset($message))
                                {
                                    echo '<div class="message">'.$message.'</div>';
                                }
                            //We display the form
                                ?>
                                <div class="content">
                                    <form action="login.php" method="post">
                                        Please type your IDs to log in:<br />
                                        <div class="center">
                                            <label for="username">Username</label><input type="text" name="username" id="username" value="<?php echo htmlentities($ousername, ENT_QUOTES, 'UTF-8'); ?>" /><br />
                                            <label for="password">Password</label><input type="password" name="password" id="password" /><br />
                                            <input type="submit" value="Log in" />
                                        </div>
                                    </form>
                                </div>
                                <?php
                            }
                        }
                        ?>

                    </div><!-- end of /login-->

                </div><!-- end of /content-->

            </div><!-- end of /container-->

            <div class="footer wrapper rounds wrapper-background">
                <ul>
                    <a href="index.php">SLFWPM</a> by
                    <a href="vaseto.net">Vaseto.net</a>
                    <strong>2014 CC BY-NC-SA.</strong>
                </ul>
            </div>

        </body>
        </html>