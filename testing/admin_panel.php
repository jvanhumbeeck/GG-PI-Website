<?php
session_start();
//logout
if(isset($_GET['logout'])){unset($_SESSION['logged_in']);session_destroy();}


//check login
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
    //json decode user details from session into an array
    $user_details = json_decode($_SESSION['user_details'],true);

    //debug your values
    echo '<pre>'.print_r($user_details,true).'</pre>';
    /*
    Array
    (
        [unique_ref] => 1-61
        [login_name] => tomme
        [login] => me
        [file1] => Test
        [file2] => Array
            (
            )

        [file3] => Array
            (
            )

        [file4] => Array
            (
            )

    )
    */

    echo '<a href="?logout">logout</a>';
	echo "<br><br><p id=\"test\">hallo</p>";
	echo "<script src=\"js/script.js\"></script>";
}else{
    exit(header("Location: ./login.php"));
}
?> 