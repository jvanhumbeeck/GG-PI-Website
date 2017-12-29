<?php
session_start();
//logout
if(isset($_GET['logout'])){unset($_SESSION['logged']);session_destroy();}


//check login
if(isset($_SESSION['logged']) && $_SESSION['logged']==true){
    
	//show page
	
}else{
    exit(header("Location: ./blog.php"));
}

if(isset($_POST["editIndex"])) {
	
	$GLOBALS["file"] = "index.html";
	
}else if(isset($_POST["editBlog"])) {
	
	$GLOBALS["file"] = "blog.php";
	
}else if(isset($_POST["editUsers"])) {
	
	$GLOBALS["file"] = "users.xml";
	
}else if(isset($_POST["editPosts"])) {
	
	$GLOBALS["file"] = "posts.dat";
	
}else if(isset($_POST["editPanel"])) {
	
	$GLOBALS["file"] = "admin_panel.php";
	
}else {
	
	exit(header("Location: ./admin_panel.php"));
	
}
	
// check if form has been submitted
if (isset($_POST['text']))
{
	// save the text contents
	file_put_contents($file, $_POST['text']);
	echo "File saved";
	print_r(error_get_last());
}
// read the textfile
$text = file_get_contents($file);

?>
<!DOCTYPE html>
<html>

	<head>
		<title><?php echo $file; ?></title>
	</head>

	<body>
		
		<h4 style="margin-top: 40px;">You can resize the textfield, to see more of the editable file.</h4>
		<h4 style="margin-top: 40px;">To go back just press the back button of the browser.</h4>

		<br>
		
		<!-- HTML form -->
		<form action="" method="post">
			<textarea name="text" cols="40" rows="<?php $xml = simplexml_load_file($file);echo ((count($xml) * 10) + 3); ?>" style="width: 100%; height: 75vh; resize: vertical;"><?php echo htmlspecialchars($text) ?></textarea>
			<input type="submit" value="save" />
			<input type="reset" value ="reset"/>
		</form>
	</body>
</html>