window.onload = function() {
	
	var divs = document.getElementsByTagName("div");
	
	for(var i = 0; i < divs.length; i++) {
		
		if(divs[i].style.zIndex == "9999999") {
			
			divs[i].style.visibility = "hidden";
			
		}
		//divs[i].style.z-index = "0";
		
	}
	
}