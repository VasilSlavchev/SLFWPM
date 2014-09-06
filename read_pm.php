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

        <h1>Read messages. :)</h1>
        <?php
            //include('menu.php');
            include('menu_items.php');
            //include('check_if_login.php');
        ?>
    </div>

    <div class="container wrapper rounds wrapper-background2">

        <div class="content">

            <h1>Simple Login form With PM messages: List messages.</h1>

            <div class="register">

                <?php
//We check if the user is logged
                if(isset($_SESSION['username']))
                {
//We check if the ID of the discussion is defined
                    if(isset($_GET['id']))
                    {
                        $id = intval($_GET['id']);
//We get the title and the narators of the discussion
                        $req1 = mysql_query('select title, user1, user2 from pm where id="'.$id.'" and id2="1"');
                        $dn1 = mysql_fetch_array($req1);
//We check if the discussion exists
                        if(mysql_num_rows($req1)==1)
                        {
//We check if the user have the right to read this discussion
                            if($dn1['user1']==$_SESSION['userid'] or $dn1['user2']==$_SESSION['userid'])
                            {
//The discussion will be placed in read messages
                                if($dn1['user1']==$_SESSION['userid'])
                                {
                                    mysql_query('update pm set user1read="yes" where id="'.$id.'" and id2="1"');
                                    $user_partic = 2;
                                }
                                else
                                {
                                    mysql_query('update pm set user2read="yes" where id="'.$id.'" and id2="1"');
                                    $user_partic = 1;
                                }
//We get the list of the messages
                                $req2 = mysql_query('select pm.timestamp, pm.message, users.id as userid, users.username, users.avatar from pm, users where pm.id="'.$id.'" and users.id=pm.user1 order by pm.id2');
//We check if the form has been sent
                                if(isset($_POST['message']) and $_POST['message']!='')
                                {
                                    $message = $_POST['message'];
    //We remove slashes depending on the configuration
                                    if(get_magic_quotes_gpc())
                                    {
                                        $message = stripslashes($message);
                                    }
    //We protect the variables
                                    $message = mysql_real_escape_string(nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8')));
    //We send the message and we change the status of the discussion to unread for the recipient
                                    if(mysql_query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "'.(intval(mysql_num_rows($req2))+1).'", "", "'.$_SESSION['userid'].'", "", "'.$message.'", "'.time().'", "", "")') and mysql_query('update pm set user'.$user_partic.'read="yes" where id="'.$id.'" and id2="1"'))
                                    {
                                        ?>
                                        <div class="message">Your message has successfully been sent.<br />
                                            <a href="read_pm.php?id=<?php echo $id; ?>">Go to the discussion</a></div>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <div class="message">An error occurred while sending the message.<br />
                                                <a href="read_pm.php?id=<?php echo $id; ?>">Go to the discussion</a></div>
                                                <?php
                                            }
                                        }
                                        else
                                        {
//We display the messages
                                            ?>
                                            <div class="content">
                                                <h1><?php echo $dn1['title']; ?></h1>
                                                <table class="messages_table">
                                                    <tr>
                                                        <th class="author">User</th>
                                                        <th>Message</th>
                                                    </tr>
                                                    <?php
                                                    while($dn2 = mysql_fetch_array($req2))
                                                    {
                                                        ?>
                                                        <tr>
                                                            <td class="author center"><?php
                                                            if($dn2['avatar']!='')
                                                            {
                                                                echo '<img src="'.htmlentities($dn2['avatar']).'" alt="Image Perso" style="max-width:100px;max-height:100px;" />';
                                                            }
                                                            ?><br /><a href="profile.php?id=<?php echo $dn2['userid']; ?>"><?php echo $dn2['username']; ?></a></td>
                                                            <td class="left"><div class="date">Sent: <?php echo date('m/d/Y H:i:s' ,$dn2['timestamp']); ?></div>
                                                                <?php echo $dn2['message']; ?></td>
                                                            </tr>
                                                            <?php
                                                        }
//We display the reply form
                                                        ?>
                                                    </table><br />
                                                    <h2>Reply</h2>
                                                    <div class="center">
                                                        <form action="read_pm.php?id=<?php echo $id; ?>" method="post">
                                                            <label for="message" class="center">Message</label><br />
                                                            <textarea cols="40" rows="5" name="message" id="message"></textarea><br />
                                                            <input type="submit" value="Send" />
                                                        </form>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            echo '<div class="message">You dont have the rights to access this page.</div>';
                                        }
                                    }
                                    else
                                    {
                                        echo '<div class="message">This discussion does not exists.</div>';
                                    }
                                }
                                else
                                {
                                    echo '<div class="message">The discussion ID is not defined.</div>';
                                }
                            }
                            else
                            {
                                echo '<div class="message">You must be logged to access this page.</div>';
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