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

        <h1>List of users :)</h1>
        <?php
            //include('menu.php');
            include('menu_items.php');
            //include('check_if_login.php');
        ?>
    </div>

    <div class="container wrapper rounds wrapper-background2">

        <div class="content">

            <h1>Simple Login form With PM messages - List of users:</h1>

            <div class="users">

                <p>This is the list of members:</p>

                <table>
                    <tr>
                        <th width="50px">ID</th>
                        <th width="130px">Username</th>
                        <th width="150px">Email</th>
                        <th width="180px">Sign up date</th>
                    </tr>
                    <?php
                        //We get the IDs, usernames and emails of users
                        $req = mysql_query('select id, username, email, signup_date from users');

                        while($dnn = mysql_fetch_array($req))
                        //while($dnn = mysql_fetch_array($req) or die ($req.'<code>'.mysql_error().'</code>'))
                            // fixed by me!!!
                        {
                            ?>
                                <tr>
                                    <td style="float:center; padding-left:20px;"><?php echo $dnn['id']; ?></td>
                                    <td style="float:center; padding-left:50px;"><a href="profile.php?id=<?php echo $dnn['id']; ?>"><?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                                    <td style="float:center; padding: 0 30px 0 30px;"><?php echo htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td style="float:center; padding: 0 5px 0 20px;"><?php echo date($dnn['signup_date']); ?></td>
                                </tr>
                            <?php
                        }
                    ?>
                </table>

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