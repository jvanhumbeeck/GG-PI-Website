<?php
session_start();
$mydata = simplexml_load_file("mydata.xml");

$login = "";
$password = "";
$loginname = "";

for($i = 0; $i < count($mydata); $i++){

    $login = $mydata->login_details[$i]->login;
    $password = $mydata->login_details[$i]->password;
    $loginname = $mydata->login_details[$i]->login_name;


    if(empty($_POST["admin_name"]) || empty($_POST["admin_password"]))
    {
        $_SESSION['error']='Please fill in both username and password';
        exit(header("Location:login.php"));
    }


    if(($_POST["admin_name"] == $login) && ($_POST["admin_password"] == $password)){
        //set logged in
        $_SESSION['logged_in'] = true;
        //unset password no need to include that
        unset($mydata->login_details[$i]->password);

        //json encode the user stuff from the xml
        $_SESSION['user_details'] = json_encode($mydata->login_details[$i]);

        //goto admin
        exit(header("Location: ./admin_panel.php"));
    }
}

//as we have exited for loop (and therefore not been directed) we have a invalid login
$_SESSION['error']='Invalid username or password';
exit(header("Location:login.php"));
?> 