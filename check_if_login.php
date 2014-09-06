<?php
    //We check if the user is logged
    if(!isset($_SESSION['username']))
    {
        //We check if the form has been sent
        if(isset($_POST['username'], $_POST['password'], $_POST['passverif'], $_POST['email'], $_POST['avatar']))
        {
            echo 'already logged in.';
        }
        else
        {
            ?>
            <ul>
                <li>
                    <a href="login.php">Log in</a>
                </li>
            </ul>
            <?php
        }
    }

?>


