<?php
session_start();
//logout
if(isset($_GET['logout'])){unset($_SESSION['logged']);session_destroy();}


//check login
if(isset($_SESSION['logged']) && $_SESSION['logged']==true){
    
	//show page
	if(isset($_SESSION["message"])) {
		echo $_SESSION["message"];
	}
	
	if(isset($_SESSION["error"])) {
		print_r($_SESSION["error"]);
	}
	
}else{
    exit(header("Location: ./blog.php"));
}
?> 
<!DOCTYPE html>
<html>

	<head>
		<title>Admin page</title>
		<style>
		
		#header {
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
		}
		
		#header a {
			position: relative;
			float: right;
			margin-right: 50px;
			margin-top: 5px;
			text-decoration: none;
			border: none;
			background-color: gray;
			color: #33cd3d;
			padding: 5px 10px;
			border: 2px solid #5d6166;
			font-size: 16px;
		}

		#header a:hover {
			background-color: #5d6166;
			border: 2px solid gray;
		}
		
		#footer input {
			position: relative;
			text-align: center;
			margin-right: 50px;
			margin-top: 5px;
			text-decoration: none;
			border: none;
			background-color: gray;
			color: #33cd3d;
			padding: 5px 10px;
			border: 2px solid #5d6166;
			font-size: 16px;
		}

		#footer input:hover {
			background-color: #5d6166;
			border: 2px solid gray;
		}
		
		#footer {
			text-align: center;
		}
		</style>
	</head>
	
	<body>
		
		<!-- header for logout button -->
		<div id="header">
		
			<a href="?logout">logout</a>
		
		</div>
		
		<h4 style="color:red;margin-top: 40px;">Do not press F5, it will do the same task twice. Reconnect instead.</h4>
		<h4 style="color:red;">Do not forget to logout, it does not log you out fully automatic.</h4>
			
			<h1>Create a post.</h1>
			
			<form method="post" action="" enctype="multipart/form-data">
				
				<p>Title: <input type="text" name="title"></p>
				<p>Author: <input type="text" name="author"></p>
				<p>Text (You can write in html here): <textarea name="post" cols="40" rows="5" style="width:100%;  resize: vertical;"></textarea></p>
				<p>Image: <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg"></p>
				
				<br>
				<input type="submit" name="addPost" value="add post">
				
			</form>
			
			<br>
			
			<h1>Delete a post.</h1>
			
			<form method="post" action="">
			
				<p>Choose post: </p>
				
				<select id="slc_post" name="slc_post">
				
					<option value=""> - Select - </option>
					
					<?php
					
						$posts = simplexml_load_file("posts.dat");
						
						foreach($posts as $post) {
							
							echo "<option value=\"" . $post->title . "\">" . $post->title . "</option>";
							
						}
					
					?>
				
				</select>
				
				<br><br>
				<input id="remove" type="submit" name="removePost" value="remove post">
			
			</form>
			
			<br>
			
			<h1>Edit a post.</h1>
			
			<br>
			
			<form action="" method="post" enctype="multipart/form-data">
		
				Select item:
				<select name="items" onchange="showItem(this.value)">
				
					<option value=""> - Select - </option>
						
					<?php
					
						$posts = simplexml_load_file("posts.dat");
						
						foreach($posts as $post) {
							
							echo "<option value=\"" . $post->title . "\">" . $post->title . "</option>";
							
						}
					
					?>
				
				</select>
				
				<br>
				
				<p><span id="txtHint"></span></p>
			
				<br>
				
				<input type="submit" name="editPost" value="Edit Post">
			
			</form>
			
			<br>
			<br>
			
			<!-- separater -->
			<hr style="margin-bottom: 5rem;border: 0;border-top: 1px solid rgba(0,0,0,.1);box-sizing: content-box;height: 0;overflow: visible;">
			
			<!-- footer -->
			<div id="footer">
				
				<form method="post" action="viewer.php">
				
					<!-- button to edit index.php -->
					<input type="submit" name="editIndex" value="Edit index.html">
					<!-- button to edit blog.php -->
					<input type="submit" name="editBlog" value="Edit blog.php">
					<!-- button to edit users.xml -->
					<input type="submit" name="editUsers" value="Edit users.xml">
					<!-- button to edit posts.dat -->
					<input type="submit" name="editPosts" value="Edit posts.dat">
					<!-- button to edit admin_panel.php -->
					<input type="submit" name="editPanel" value="Edit admin_panel.php">
				
				</form>
				
			</div>
			
			<br>
			
			<!-- php code -->
			<?php
				
				// Add a post
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
				
				// Remove a post
				if(isset($_POST["removePost"])) {
					
					$value = $_POST["slc_post"];
					if($value == "") {
						echo "Please select a post.";
					}else{
						
						
						$xml = simplexml_load_file("posts.dat");
						
						$sxe = new SimpleXMLElement($xml->asXML());
						
						foreach($sxe->post as $post) {
							
							if($post->title == $value) {
								
								// remove image from server
								$dir = "images/";
								if(unlink($dir . $post->image)) {
									
									// remove xml data
									$dom = dom_import_simplexml($post);
									$dom->parentNode->removeChild($dom);
									
									//print as an xml
									$dom = new DOMDocument('1.0');
									$dom->preserveWhiteSpace = false;
									$dom->formatOutput = true;
									$dom->loadXML($sxe->asXML());
									
									$dom->save('posts.dat');
									
									echo "removed";
									
									print_r(error_get_last());
									
									header("Refresh:0");
									
								}else {
									
									echo "Error with deleting image.";
								
									print_r(error_get_last());
									
								}
								
							}
							
						}
						
					}
					
				}
				
				// Edit post
				// button edit post
				if(isset($_POST["editPost"])) {
					
					//check if an item is selected
					if(isset($_POST["items"])) {
						
						//get all the information
						$item = $_POST["items"];
						$title = $_POST["title"];
						$author = $_POST["author"];
						$date = $_POST["date"];
						$text = $_POST["post"];
						
						$xml = simplexml_load_file("posts.dat");
						$sxe = new SimpleXMLElement($xml->asXML());
						
						if($_FILES["image"]["name"] == "") {
							
							//no file selected
							foreach ($sxe->post as $post) {
								
								if($post->title == $item) {
									
									$image = $post->image;
														
									// remove xml data
									$dom = dom_import_simplexml($post);
									$dom->parentNode->removeChild($dom);
									
									//Save new data
									$post = $sxe->addChild("post");
									
									$post->addChild("title", $title);
									$post->addChild("author", $author);
									$post->addChild("date", $date);
									$post->addChild("image", $image);
									$post->addChild("text", $text);
									
									//print as an xml
									$dom = new DOMDocument('1.0');
									$dom->preserveWhiteSpace = false;
									$dom->formatOutput = true;
									$dom->loadXML($sxe->asXML());
									
									$dom->save('posts.dat');
									
									print_r(error_get_last());
									
									echo "Post edited.";
									
								}
								
							}
							
						}else{
							
							//delete image first
							foreach ($sxe->post as $post) {
								
								if($post->title == $item) {
									
									// remove image from server
									$dir = "images/";
									if(unlink($dir . $post->image)) {
										
										//save new image
										//image
										$file_name = $_FILES["image"]["name"];
											//start copy
											move_uploaded_file($_FILES["image"]["tmp_name"], "images/" . $file_name);
											
											print_r(error_get_last());
												
											// remove xml data
											$dom = dom_import_simplexml($post);
											$dom->parentNode->removeChild($dom);
											
											//Save new data
											$post = $sxe->addChild("post");
											
											$post->addChild("title", $title);
											$post->addChild("author", $author);
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
											
											echo "Post edited.";
										
										
									}else {
										
										echo "Error with deleting image.";
									
										print_r(error_get_last());
										
									}
									
								}
								
							}
							
						}
						
					}else {
						
						echo "<br>Please select a post.";
						
					}
					
				}
				
				//Button click to open viewer
				if(isset($_POST["editIndex"])) {
					
					
					
				}
				
				function test_input($data) {
				  $data = trim($data);
				  $data = stripslashes($data);
				  $data = htmlspecialchars($data);
				  return $data;
				}
			
			?>
			
			<script src="js/anti-label.js"></script>
			<script src="js/posts.js"></script>
			<script src="js/panel_script.js"></script>
		
	</body>

</html>