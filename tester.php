<?php
$q = $_REQUEST["q"];

$xml = simplexml_load_file("posts.dat");

foreach ($xml->post as $post) {
	
	if($post->title == $q) {
		
		echo "<p>Title: <input type=\"text\" name=\"title\" value=\"" . $post->title . "\"></p>";
		echo "<p>Author: <input type=\"text\" name=\"author\" value=\"". $post->author ."\"></p>";
		echo "<p>Date: <input type=\"text\" name=\"date\" value=\"". $post->date ."\"></p>";
		echo "<p>Text (You can write in html here): <textarea name=\"post\" cols=\"40\" rows=\"5\" style=\"width:100%;\">" . $post->text . "</textarea></p>";
		echo "<p>Image: <img style=\"width:100%;\" src=\"images/". $post->image ."\"><input type=\"file\" name=\"image\" accept=\"image/x-png,image/gif,image/jpeg\"></p>";
		
	}
	
}

?>