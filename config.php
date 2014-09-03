<?php

/*
 * SLFWPM - Simple Login Form With PM Messages.
 *
 * This is config file for Simple PM Message by Vaseto^^ 2014.
 *
 * More at: (VasilSLavchev.net or vasilslavchev@gmail.com).
 *
 * https://bitbucket.org/VasilSlavchev/simpleloginformwithpm
 *
 * This project is under creative commons license: CC BY-NC-SA.
 *
 * https://creativecommons.org/licenses/by-nc-sa/2.5/bg/
 *
 * https://creativecommons.org/licenses/by-nc-sa/2.5/bg/deed.en
 *
*/

    //Session starts here.
    session_start();

    //Please edit database info to match your setings.
    $dbhostname = 'localhost';
    $dbusername = 'root';
    $dbpassword = '';
    $database = 'slfwpm';

    //here we login into database.
        if (!($db = mysql_connect($dbhostname, $dbusername , $dbpassword))){
        die("<center><i>Не можа да се свърже към базата данни(Грешка1).</i></center>");
    }

    else
        {
            if (!(mysql_select_db("$database",$db)))  {
                die("<center><i>Не можа да се свърже към базата данни(Грешка2).</i></center>");
        }
    }
    echo "<center><i>connected to database.</center></i>";

    //Webmaster email.
    $mail_webmaster = 'mail@example.bg';

    //Site url domain.
    $site_url = 'http://example.bg/';

    //Home page file.
    $home_dir = 'index.php';

    //Theme directory.
    $theme = 'default';

 ?>