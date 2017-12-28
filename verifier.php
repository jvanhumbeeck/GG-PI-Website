<?php

session_start();
$data = simplexml_load_file("users.xml");

if(empty($_POST["user"]) || empty($_POST["pass"]))
{
    $_SESSION['error']='Please fill in both username and password';
    exit(header("Location:blog.php"));
}

$login = "";
$password = "";

for($i = 0; $i < count($data); $i++){

    $login = $data->user[$i]->username;
    $password = $data->user[$i]->password;


    if(empty($_POST["user"]) || empty($_POST["pass"]))
    {
        $_SESSION['error']='Please fill in both username and password';
        exit(header("Location:blog.php"));
    }


    if(($_POST["user"] == $login) && ($_POST["pass"] == $password)){
        //set logged in
        $_SESSION['logged'] = true;
        //unset password no need to include that
        unset($data->user[$i]->password);

        //json encode the user stuff from the xml
        $_SESSION['user_details'] = json_encode($data->user[$i]);

        //goto admin
        exit(header("Location: ./admin_panel.php"));
    }
}

//as we have exited for loop (and therefore not been directed) we have a invalid login
$_SESSION['error']='Invalid username or password';
exit(header("Location:blog.php"));


?>