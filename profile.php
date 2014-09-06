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

        <h1>Profile Area :)</h1>
        <?php
            //include('menu.php');
            include('menu_items.php');
            //include('check_if_login.php');
        ?>
    </div>

    <div class="container wrapper rounds wrapper-background2">

        <div class="content">

            <h1>Simple Login form With PM messages: Profile.</h1>

            <div class="login">

                <?php
                    //We check if the users ID is defined
                if(isset($_GET['id']))
                {
                    $id = intval($_GET['id']);
                        //We check if the user exists
                    $dn = mysql_query('select username, email, avatar, signup_date from users where id="'.$id.'"');
                    if(mysql_num_rows($dn)>0)
                    {
                        $dnn = mysql_fetch_array($dn);
                            //We display the user datas
                        ?>
                        This is the profile of "<?php echo htmlentities($dnn['username']); ?>" :
                        <table style="width:500px;">
                            <tr>
                                <td><?php
                                if($dnn['avatar']!='')
                                {
                                    echo '<img src="'.htmlentities($dnn['avatar'], ENT_QUOTES, 'UTF-8').'" alt="Avatar" style="max-width:100px;max-height:100px;" />';
                                }
                                else
                                {
                                    echo 'This user dont have an avatar.';
                                }
                                ?></td>
                                <td class="left"><h1><?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?></h1>
                                    Email: <?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?><br />
                                    This user joined the website on <?php echo date('Y/m/d',$dnn['signup_date']); ?></td>
                                </tr>
                            </table>
                            <?php
                    //We add a link to send a pm to the user
                            if(isset($_SESSION['username']))
                            {
                                ?>
                                <br /><a href="new_pm.php?recip=<?php echo urlencode($dnn['username']); ?>" class="big">Send a PM to "<?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?>"</a>
                                <?php
                            }
                        }
                        else
                        {
                            echo 'This user dont exists.';
                        }
                    }
                    else
                    {
                        echo 'The user ID is not defined.';
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