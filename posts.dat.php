<!DOCTYPE html>
<html>

	<head>
	
		<title>posts.dat edit</title>
	
	</head>
	
	<body>
		
		<?php

			// configuration
			$file = 'posts.dat';

			// check if form has been submitted
			if (isset($_POST['text']))
			{
				// save the text contents
				file_put_contents($file, $_POST['text']);

				// redirect to form again
				echo "File saved";
				print_r(error_get_last());
			}

			// read the textfile
			$text = file_get_contents($file);

		?>
		<!-- HTML form -->
		<form action="" method="post">
			<textarea name="text" cols="40" rows="<?php $xml = simplexml_load_file($file);echo ((count($xml) * 10) + 3); ?>" style="width: 100%;"><?php echo htmlspecialchars($text) ?></textarea>
			<input type="submit" value="save" />
			<input type="reset" value ="reset"/>
		</form>
	
	</body>

</html>