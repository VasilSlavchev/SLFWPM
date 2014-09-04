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

            <h1>Simple Login form With PM messages: List messages.</h1>

            <div class="register">

                <?php
//We check if the user is logged
                if(isset($_SESSION['username']))
                {
//We list his messages in a table
//Two queries are executes, one for the unread messages and another for read messages
                    $req1 = @mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.username from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="no" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
                    $req2 = @mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as userid, users.username from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['userid'].'" and m1.user1read="yes" and users.id=m1.user2) or (m1.user2="'.$_SESSION['userid'].'" and m1.user2read="yes" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
                    ?>
                    This is the list of your messages:<br />
                    <a href="new_pm.php" class="link_new_pm">New PM</a><br />
                    <h3>Unread Messages(<?php echo intval(mysql_num_rows($req1)); ?>):</h3>
                    <table>
                        <tr>
                            <th class="title_cell">Title</th>
                            <th>Nb. Replies</th>
                            <th>Participant</th>
                            <th>Date of creation</th>
                        </tr>
                        <?php
//We display the list of unread messages
                        while($dn1 = mysql_fetch_array($req1))
                        {
                            ?>
                            <tr>
                                <td class="left"><a href="read_pm.php?id=<?php echo $dn1['id']; ?>"><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                                <td><?php echo $dn1['reps']-1; ?></td>
                                <td><a href="profile.php?id=<?php echo $dn1['userid']; ?>"><?php echo htmlentities($dn1['username'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                                <td><?php echo date('Y/m/d H:i:s' ,$dn1['timestamp']); ?></td>
                            </tr>
                            <?php
                        }
//If there is no unread message we notice it
                        if(intval(mysql_num_rows($req1))==0)
                        {
                            ?>
                            <tr>
                                <td colspan="4" class="center">You have no unread message.</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <br />
                    <h3>Read Messages(<?php echo intval(mysql_num_rows($req2)); ?>):</h3>
                    <table>
                        <tr>
                            <th class="title_cell">Title</th>
                            <th>Nb. Replies</th>
                            <th>Participant</th>
                            <th>Date or creation</th>
                        </tr>
                        <?php
//We display the list of read messages
                        while($dn2 = mysql_fetch_array($req2))
                        {
                            ?>
                            <tr>
                                <td class="left"><a href="read_pm.php?id=<?php echo $dn2['id']; ?>"><?php echo htmlentities($dn2['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                                <td><?php echo $dn2['reps']-1; ?></td>
                                <td><a href="profile.php?id=<?php echo $dn2['userid']; ?>"><?php echo htmlentities($dn2['username'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                                <td><?php echo date('Y/m/d H:i:s' ,$dn2['timestamp']); ?></td>
                            </tr>
                            <?php
                        }
//If there is no read message we notice it
                        if(intval(mysql_num_rows($req2))==0)
                        {
                            ?>
                            <tr>
                                <td colspan="4" class="center">You have no read message.</td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                    <?php
                }
                else
                {
                    echo 'You must be logged to access this page.';
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