<!DOCTYPE html>
<html>

	<head>
		<title>Admin page</title>
	</head>
	
	<body>
		
		<!-- tempory without login -->
		
		<div id="AddPost">
		
		
		
			<form method="post" action="" enctype="multipart/form-data">
				
				<p>Title: <input type="text" name="title"></p>
				<p>Author: <input type="text" name="author"></p>
				<p>Text (You can write in html here): <textarea name="post" cols="40" rows="5"></textarea></p>
				<p>Image: <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg"></p>
				
				<br>
				<input type="submit" name="addPost" value="addPost">
				
			</form>
			
			<!-- php code -->
			<?php
				
				if(isset($_POST["addPost"])) {
					//TODO
					$title = test_input($_POST["title"]);
					$author = test_input($_POST["author"]);
					$text = $_POST["post"];
					
					//image
					$file_name = $_FILES["image"]["name"];
					//check if exists
					if(file_exists("images/" . $file_name)) {
						echo $file_name . " already exists.";
					}else{
						//start copy
						move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . $file_name);
						
						print_r(error_get_last());
						
						//start add it to database
						$xml = simplexml_load_file("posts.dat");
						
						$sxe = new SimpleXMLElement($xml->asXML());
						
						$post = $sxe->addChild("post");
						
						$post->addChild("title", $title);
						$post->addChild("author", $author);
						//Calculte current time
						$date = date('F j, Y', time());
						$post->addChild("date", $date);
						$post->addChild("image", $file_name);
						$post->addChild("text", $text);
						
						//print as an xml
						$dom = new DOMDocument('1.0');
						$dom->preserveWhiteSpace = false;
						$dom->formatOutput = true;
						$dom->loadXML($sxe->asXML());
						
						$dom->save('posts.dat');
						
						print_r(error_get_last());
						
						echo "Post added.";
						
					}
				}
				
				function test_input($data) {
				  $data = trim($data);
				  $data = stripslashes($data);
				  $data = htmlspecialchars($data);
				  return $data;
				}
			
			?>
			
			<script src="js/anti-label.js"></script>
		
		</div>
		
		
	</body>

</html>