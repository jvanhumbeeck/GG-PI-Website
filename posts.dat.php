<!DOCTYPE html>
<html>

	<head>
	
		<title>posts.dat edit</title>
	
	</head>
	
	<body>
		
		<form action="" method="post">
			
			<textarea name="post" cols="40" rows="<?php $xml = simplexml_load_file("posts.dat");echo ((count($xml) * 10) + 3); ?>" style="width:100%;"><?php

				echo $xml->asXML();
				
				print_r(error_get_last());
			
			?></textarea>
		
			<input type="submit" name="save" value="save">
		
		</form>
		
		<?php
		
			if(isset($_POST["save"])) {
				
				echo "koek";
				
				$text = $_POST["post"];
				
				//echo $text;
				
				$xml=simplexml_load_string($text);
				
				if ($xml === false) {
					echo "Failed loading XML\n";
					foreach(libxml_get_errors() as $error) {
						echo "\t", $error->message;
					}
				}
				
				
				print_r(error_get_last());
				
				echo "File saved.";
			
			}
		
		?>
	
	</body>

</html>