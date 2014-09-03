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

    <h1>Documentacion Area :)</h1>
        <a href="<?php echo $site_url; ?>"><img class="logo" src="<?php echo $theme; ?>/images/Messages-icon.png" alt="Logo" /></a>
    <ul>
        <li><a href="index.php">Начало</a></li>
        <li><a href="login.php">Вход</a></li>
        <li><a href="logout.php">Изход</a></li>
        <li><a href="list_users.php">Потребители</a></li>
        <li><a href="register.php">Регистрация</a></li>
        <li><a href="messages.php">Съобщения</a></li>
        <li><a href="setup-config-database-firstrun.php">Конфигурация</a></li>
        <li><a href="read_me.html">Документация</a></li>
    </ul>
</div>

<div class="container wrapper rounds wrapper-background2">

    <div class="content">

        <h1>Simple Login form With PM messages: Register.</h1>

            <div class="register">

                <?php
                //We check if the form has been sent
                if(isset($_POST['username'], $_POST['password'], $_POST['passverif'], $_POST['email'], $_POST['avatar']) and $_POST['username']!='')
                {
                    //We remove slashes depending on the configuration
                    if(get_magic_quotes_gpc())
                    {
                        $_POST['username'] = stripslashes($_POST['username']);
                        $_POST['password'] = stripslashes($_POST['password']);
                        $_POST['passverif'] = stripslashes($_POST['passverif']);
                        $_POST['email'] = stripslashes($_POST['email']);
                        $_POST['avatar'] = stripslashes($_POST['avatar']);
                    }
                    //We check if the two passwords are identical
                    if($_POST['password']==$_POST['passverif'])
                    {
                        //We check if the password has 6 or more characters
                        if(strlen($_POST['password'])>=6)
                        {
                            //We check if the email form is valid
                            if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
                            {
                                //We protect the variables
                                $username = mysql_real_escape_string($_POST['username']);
                                $password = mysql_real_escape_string($_POST['password']);
                                $email = mysql_real_escape_string($_POST['email']);
                                $avatar = mysql_real_escape_string($_POST['avatar']);
                                //We check if there is no other user using the same username
                                $dn = mysql_num_rows(mysql_query('select id from users where username="'.$username.'"'));
                                if($dn==0)
                                {
                                    //We count the number of users to give an ID to this one
                                    $dn2 = mysql_num_rows(mysql_query('select id from users'));
                                    $id = $dn2+1;

                                var_dump($dn);
                                var_dump($dn2);

                                    //We save the informations to the databse
                                    if(mysql_query('insert into users(id, username, password, email, avatar, signup_date) values ('.$id.', "'.$username.'", "'.$password.'", "'.$email.'", "'.$avatar.'", "'.time().'")'))
                                    {
                                        //We dont display the form
                                        $form = false;
                ?>
                <div class="message">You have successfuly been signed up. You can log in.<br />
                <a href="login.php">Log in</a></div>
                <?php
                                    }
                                    else
                                    {
                                        //Otherwise, we say that an error occured
                                        $form = true;
                                        $message = 'An error occurred while signing up.';
                                    }
                                }
                                else
                                {
                                    //Otherwise, we say the username is not available
                                    $form = true;
                                    $message = 'The username you want to use is not available, please choose another one.';
                                }
                            }
                            else
                            {
                                //Otherwise, we say the email is not valid
                                $form = true;
                                $message = 'The email you entered is not valid.';
                            }
                        }
                        else
                        {
                            //Otherwise, we say the password is too short
                            $form = true;
                            $message = 'Your password must contain at least 6 characters.';
                        }
                    }
                    else
                    {
                        //Otherwise, we say the passwords are not identical
                        $form = true;
                        $message = 'The passwords you entered are not identical.';
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
                    <form action="register.php" method="post">
                        <div class="center">
                            <b>Please fill the following form to register:</b>
                        <fieldset>
                            <label for="username">Username</label>
                            <input type="text" name="username" value="<?php if(isset($_POST['username'])){echo htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
                        </fieldset>

                        <fieldset>
                            <label for="password">Password<span class="small">(6 characters min.)</span></label>
                            <input type="password" name="password" /><br />
                        </fieldset>

                        <fieldset>
                            <label for="passverif">Password<span class="small">(verification)</span></label>
                            <input type="password" name="passverif" /><br />
                        </fieldset>

                        <fieldset>
                            <label for="email">Email</label>
                            <input type="text" name="email" value="<?php if(isset($_POST['email'])){echo htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
                        </fieldset>

                        <fieldset>
                            <label for="avatar">Avatar<span class="small">(optional)</span></label>
                            <input type="text" name="avatar" value="<?php if(isset($_POST['avatar'])){echo htmlentities($_POST['avatar'], ENT_QUOTES, 'UTF-8');} ?>" /><br />
                        </fieldset>

                        <input class="button" type="submit" value="Register"/>
                    </div>
                </form>
            </div>

            <?php
            }
        ?>

        </div><!-- end of /register-->

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