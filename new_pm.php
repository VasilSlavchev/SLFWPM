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
        </ul>

    </div>

    <div class="container wrapper rounds wrapper-background2">

        <div class="content">

            <h1>Simple Login form With PM messages: New messages.</h1>

            <div class="register">

                <?php
                //We check if the user is logged
                if(isset($_SESSION['username']))
                {
                    $form = true;
                    $otitle = '';
                    $orecip = '';
                    $omessage = '';
                //We check if the form has been sent
                    if(isset($_POST['title'], $_POST['recip'], $_POST['message']))
                    {
                        $otitle = $_POST['title'];
                        $orecip = $_POST['recip'];
                        $omessage = $_POST['message'];
                    //We remove slashes depending on the configuration
                        if(get_magic_quotes_gpc())
                        {
                            $otitle = stripslashes($otitle);
                            $orecip = stripslashes($orecip);
                            $omessage = stripslashes($omessage);
                        }
                    //We check if all the fields are filled
                        if($_POST['title']!='' and $_POST['recip']!='' and $_POST['message']!='')
                        {
                        //We protect the variables
                            $title = mysql_real_escape_string($otitle);
                            $recip = mysql_real_escape_string($orecip);
                            $message = mysql_real_escape_string(nl2br(htmlentities($omessage, ENT_QUOTES, 'UTF-8')));
                        //We check if the recipient exists
                            $dn1 = mysql_fetch_array(mysql_query('select count(id) as recip, id as recipid, (select count(*) from pm) as npm from users where username="'.$recip.'"'));
                            if($dn1['recip']==1)
                            {
                            //We check if the recipient is not the actual user
                                if($dn1['recipid']!=$_SESSION['userid'])
                                {
                                    $id = $dn1['npm']+1;
                                //We send the message
                                    if(mysql_query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "1", "'.$title.'", "'.$_SESSION['userid'].'", "'.$dn1['recipid'].'", "'.$message.'", "'.time().'", "yes", "no")'))
                                    {
                                        ?>
                                        <div class="message">The message has successfully been sent.<br />
                                            <a href="list_pm.php">List of my personnal messages</a></div>
                                            <?php
                                            $form = false;
                                        }
                                        else
                                        {
                                    //Otherwise, we say that an error occured
                                            $error = 'An error occurred while sending the message';
                                        }
                                    }
                                    else
                                    {
                                //Otherwise, we say the user cannot send a message to himself
                                        $error = 'You cannot send a message to yourself.';
                                    }
                                }
                                else
                                {
                            //Otherwise, we say the recipient does not exists
                                    $error = 'The recipient does not exists.';
                                }
                            }
                            else
                            {
                        //Otherwise, we say a field is empty
                                $error = 'A field is empty. Please fill of the fields.';
                            }
                        }
                        elseif(isset($_GET['recip']))
                        {
                    //We get the username for the recipient if available
                            $orecip = $_GET['recip'];
                        }
                        if($form)
                        {
                //We display a message if necessary
                            if(isset($error))
                            {
                                echo '<div class="message">'.$error.'</div>';
                            }
                //We display the form
                            ?>
                            <div class="content">
                                <h1>New Personnal Message</h1>
                                <form action="new_pm.php" method="post">
                                    Please fill the following form to send a personnal message.<br />
                                    <label for="title">Title</label><input type="text" value="<?php echo htmlentities($otitle, ENT_QUOTES, 'UTF-8'); ?>" id="title" name="title" /><br />
                                    <label for="recip">Recipient<span class="small">(Username)</span></label><input type="text" value="<?php echo htmlentities($orecip, ENT_QUOTES, 'UTF-8'); ?>" id="recip" name="recip" /><br />
                                    <label for="message">Message</label><textarea cols="40" rows="5" id="message" name="message"><?php echo htmlentities($omessage, ENT_QUOTES, 'UTF-8'); ?></textarea><br />
                                    <input type="submit" value="Send" />
                                </form>
                            </div>
                            <?php
                        }
                    }
                    else
                    {
                        echo '<div class="message">You must be logged to access this page.</div>';
                    }
                    ?>

                </div>

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