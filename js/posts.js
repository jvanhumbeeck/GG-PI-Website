function showItem(item) {
	
	if (item.length == 0) { 
        document.getElementById("txtHint").innerHTML = "Select an item.";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "printer.php?q="+item, true);
        xmlhttp.send();
    }
	
}