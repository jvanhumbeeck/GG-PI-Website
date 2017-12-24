<!DOCTYPE html>

<html lang="en">

  <head>
    
	<!-- title -->
    <title>GG-PI Blog</title>
	
	<!-- logo -->
	<link rel="icon" type="image/png" href="assets/favicon.png">
	
	<!-- search engine info -->
	<meta charset="UTF-8">
	<meta name="description" content="GG-PI Blog">
	<meta name="author" content="Jens Van Humbeeck &#38; Joris Van Duyse">
	<meta name="keywords" content="GG-PI, Drone, Raspberry, Raspberry PI, PI, Quadcopter, Blog">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<!-- stylesheets -->
	<link rel="stylesheet" type="text/css" href="css/blog_style.css" >
	
  </head>
  
  <body>
    
	<!-- navbar -->
	<div id="navbar" state="false">
	  
	  <!-- logo -->
	  <a href="http://www.gg-pi.tk">
	    <img id="logo" src="assets/logo.png">
	  </a>
	  
	  <!-- buttons -->
	  <div id="buttons">
	    <ul class="list">
		  <li><a id="bhome" href="http://www.gg-pi.tk">Home</a></li>
		  <li><a href="http://www.blog.gg-pi.tk" class="active">Blog</a></li>
		</ul>
	  </div>
	  
	  <!-- collapse -->
	  <div id="collapse">
	    <button id="collapsor">&#9776;</button>
	  </div>
	  
	  
	</div>
	
	<!-- header -->
	<div id="home" class="header">
	  <h1>GG-PI blog</h1>
	  <p>See the progression we have made.</p>
	</div>
	
	<!-- separater -->
	<hr class="separator">
	
	<!-- right side panel -->
	<div class="sidebar">
	  <h4>Futur Plans</h4>
	  <p>Creating a Raspberry PI controlled quadcopter will be our main goal. Other plans are:</p>
	  <ul>
        <li>Cactus skeleton frame</li>
        <li>Flight pilot</li>
        <li>Led ligths</li>
		<li>Retractable landing gear</li>
		<li>Mounted camera</li>
		<li>An Airsoft gun mount</li>
		<li>Remote controller</li>
		<li>Airsoft gun trigger</li>
		<li>More later</li>
      </ul>
	</div>
	
	<!-- blog posts -->
	<div class="posts">
	  
	  <!-- separater (for splitting the post section from the sidebar with a screen smaller then 600px) -->
	  <hr class="separator resp">
	  
	  <!-- blog post example -->
	  <div class="post">
	    
		<!-- separater (upper post dont need this) -->
		<!-- <hr class="separator"> -->
		
	    <h2>Title</h2>
		<p class="meta">Date, 2017 by <a href="http://www.gg-pi.tk#who">Name</a>.</p>
		<p>Paragraph</p>
		<img src="" alt="image"></img>
		
	  </div>
	  
	  <?php
	  
		$posts = simplexml_load_file("posts.dat");
		
		foreach($posts as $post) {
			
			echo "<hr class=\"separator\">";
			echo "<div class=\"post\">";
			echo "	<h2>" . $post->title . "</h2>";
			echo "	<p class=\"meta\">" . $post->date . " by <a href=\"http://www.gg-pi.tk#who\">" . $post->author . "</a>.</p>";
			echo "	<p>" . $post->text . "</p>";
			echo "	<img src=\"images/" . $post->image . "\" alt=\"" . $post->image . "\"></img>";
			echo "</div>";
			echo "";
			
		}
	  
	  ?>
	  
	  <!-- button to show more posts -->
	  <div class="pagination">
	    
		<button id="older" class="pagbtn" href="">Older</button>
		<button id="newer" class="pagbtn disabled" href="">Newer</button>
		
	  </div>
	  
	</div>
	
	<!-- footer -->
	<div class="footer">
	  <!-- copyright -->
	  <p>Copytight gg-pi.tk</p>
	  
	  <!-- button to top -->
	  <button id="back">&#94;</button>
	  
	</div>
	
	<!-- img viewer -->
	<div id="holder">
	  
	  <!-- close button -->
	  <button id="close">&#10006;</button>
	  
	  <!-- image holder -->
	  <img src="">
	  
	</div>
	
	<!-- javascripts -->
	<script src="js/blog_script.js"></script>
	<!-- remove 000webhosting label -->
	<script src="js/anti-label.js"></script>
	
  </body>

</html>
