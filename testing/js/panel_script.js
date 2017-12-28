window.onbeforeunload = function() {
	
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("GET", "logout.php", true);
    xmlhttp.send();
	
}