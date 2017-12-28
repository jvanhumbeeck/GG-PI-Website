<!DOCTYPE html>
<?php 
session_start();
//already logged in
if(isset($_SESSION["logged"]) && $_SESSION["logged"] == true) {
	exit(header("Location: ./test_panel.php"));
}
?>
<html>

	<head>
		<title>test</title>
	</head>
	
	<body>
	
		<h1>Settings page include login system</h1>
		
		<?php echo (isset($_SESSION['error'])?'<span style="color:red">'.$_SESSION['error'].'</span>':null);?>
		
		<form action="" method="post">
		
			<p>Username: <input type="text" name="user"></p>
			<p>Password: <input type="password" name="pass"></p>
			
			<input type="submit" value="Login" name="login">
		
		</form>
		
		<?php
		
			if(isset($_POST["login"])) {
				
				
				
			}
		
		?>
	
	</body>

</html>
<?php
//unset error as its only required once
unset($_SESSION['error']);
?>