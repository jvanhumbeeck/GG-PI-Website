<?php session_start();
//already logged in
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
    exit(header("Location: ./admin_panel.php"));
}
?>
<html>
<head>
<title>Administrator Login Page</title>
</head>
<body>
<h1>Administrator Login Page</h1>

<?php echo (isset($_SESSION['error'])?'<span style="color:red">'.$_SESSION['error'].'</span>':null);?>
<div>
    <form action="admin_verify.php" method="post">
        <label for="admin_name">User Name:</label> <input type="text" name="admin_name" />
        </br>
        <label for="admin_password">Password:</label> <input type="password" name="admin_password" />
        </br>
        <input style="margin-left:30px" type="submit" value="Login"/>
        <input type="reset" value="Reset"/>
    </form>
</div>

</body>
</html>
<?php 
//unset error as its only required once
unset($_SESSION['error']);
?>