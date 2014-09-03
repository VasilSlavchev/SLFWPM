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

        <h1>Configuracion Area :)</h1>
        <a href="<?php echo $site_url; ?>"><img class="logo" src="<?php echo $theme; ?>/images/Messages-icon.png" alt="Logo" /></a>
        <ul>
            <li><a href="index.php">Начало</a></li>
            <li><a href="login.php">Вход</a></li>
            <li><a href="logout.php">Изход</a></li>
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

            <h1 id="logo">Инсталация и настройка на ДБ сървъра.</h1>

            <p>По-долу трябва да въведете данните за връзка с вашата база от данни. Ако не сте сигурни, моля свържете се с вашият хостинг администратор.</p>

            <form method="post" action="setup-config-database-firstrun.php?step=Success">
                <p><?php echo( "Below you should enter your database connection details. If you&#8217;re not sure about these, contact your host." ); ?></p>
                <table class="form-table">
                    <tr>
                        <th><label for="dbhostname"><?php echo( 'Хост / Database Host' ); ?></label></th>
                        <td><input name="dbhostname" id="dbhostname" type="text" size="25" value="localhost" /></td>
                        <td><?php echo( 'You should be able to get this info from your web host, if <code>localhost</code> does not work.' ); ?></td>
                    </tr>

                    <tr>
                        <th><label for="dbusername"><?php echo( 'Потребител / User Name' ); ?></label></th>
                        <td><input name="dbusername" id="dbusername" type="text" size="25" value="root" /></td>
                        <td><?php echo( 'Your MySQL username' ); ?></td>
                    </tr>
                    <tr>
                        <th><label for="dbpassword"><?php echo( 'Парола / Password' ); ?></label></th>
                        <td><input name="dbpassword" id="dbpassword" type="text" size="25" placeholder="default empty" value="" /></td>
                        <td><?php echo( '&hellip;and your MySQL password.' ); ?></td>
                    </tr>
                    <tr>
                        <th><label for="database"><?php echo( 'База данни / Database Name' ); ?></label></th>
                        <td><input name="database" id="database" type="text" size="25" value="slfwpm" /></td>
                        <td><?php echo( 'The name of the database you want to run WP in.' ); ?></td>
                    </tr>
                </table>
                <?php if ( isset( $_POST['noapi'] ) ) { ?>
                <input name="noapi" type="hidden" value="1" /><?php } ?>
                <p class="step"><input name="submit" type="submit" value="Запази" class="button" /></p>
            </form>

        </div><!-- end of /content-->

    </div><!-- end of /container-->

    <div class="footer wrapper rounds wrapper-background">
        <ul>
            <a href="index.php">SLFWPM</a> by
            <a href="vaseto.net">Vaseto.net</a>
            <strong>2014 CC BY-NC-SA.</strong>
        </ul>
    </div><!-- end of /footer-->

    <?php
    if ( array(
        isset($_POST['dbhostname']) ||
        isset($_POST['dbusername']) ||
        isset($_POST['dbpassword']) ||
        isset($_POST['database'])))
    {

        @$dbhostname = $_POST['dbhostname'];
        @$dbusername = $_POST['dbusername'];
        @$dbpassword = $_POST['dbpassword'];
        @$database = $_POST['database'];

        print("<center><b>\"Текущи настройки: ('$dbhostname'), ('$dbusername'), ('$dbpassword'), ('$database')\".<br>");
    }

    else {

        $dbhostname = 'localhost';
        $dbusername = 'root';
        $dbpassword = '';
        $database = 'slfwpm';
    }

        //here we login into database.
    if (!($db = mysql_connect( $dbhostname, $dbusername , $dbpassword ))){
        die("<i>Не можа да се свърже към базата данни(Грешка1).</i>");
    }

    else
    {
        if (!(mysql_select_db("$database",$db)))  {
            die("<i>Не можа да се свърже към базата данни(Грешка2).</i>");
        }
    }
    echo "<i>//Свързан към базата. / Connected to database.//</i>";

        //Generate automaticly db_config.php file.
    $hostname =
    "<?php \n".
    "/* This is automatic genereted config file from -> /setup-config-database-firstrun.php */\n".
    "/* NOTE: Please edit database info to match your setings if its nesessary.*/\n".
    '/*'." Do not delete. */\n".
    '$dbhostname = '."'$dbhostname';\n".
    '$dbusername = '."'$dbusername';\n".
    '$dbpassword = '."'$dbpassword';\n".
    '$database =   '."'$database';\n".
    "/* Do not delete. */\n ?>";
    $filename = 'db_config.php';
    $fh = fopen($filename, 'r') or die("can't open file");
    $options = array('ftp' => array('overwrite' => true));
    $stream = stream_context_create($options);
    $stringData = file_put_contents( $filename, $hostname, 4, $stream);
    fwrite($fh, $stringData);
    fclose($fh);

    ?>
    <p><?php echo( "All right, buddy!" ); ?></p>

</body>
</html>
