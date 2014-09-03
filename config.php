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

    //echo "<center><i>connected to database.</center></i>";
    //echo '<center>"'.$database.'"</center>';

if (isset($_POST['username']) and isset($_POST['password'])){
    $username_ = $_POST['username'];
    $password_ = $_POST['password'];
    $query = "SELECT * FROM `users` WHERE username='$username' and password='$password'";

    $result = mysql_query($query) or die(mysql_error());
    $count = mysql_num_rows($result);


    if ($count == 1){
        $_SESSION['username'] = $username;
        echo $username;
    }else{

        echo "<center>Невалидно Потребителско име или Парола!</center>";
    }
}

if (!empty($username)){
    echo $username;
}
else {
    echo "wrong!";
}

    //Webmaster email.
$mail_webmaster = 'mail@dev.slfwpm';

    //Site url domain.
$site_url = 'http://dev.slfwpm/';

    //Home page file.
$home_dir = 'index.php';

    //Theme directory.
$theme = 'classic';

?>