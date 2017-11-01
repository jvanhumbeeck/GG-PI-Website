/* navbar collapse script */
document.getElementById("collapsor").onclick = function() {
	
	var navbar = document.getElementById("navbar");
	var state = navbar.getAttribute("state");
	
	if(state == "true"){
		navbar.style.height = "60px";
		navbar.setAttribute("state", "false");
	}else {
		navbar.style.height = "365px";
		navbar.setAttribute("state", "true");
	}
	
};

/* resize event for navbar recollapse at pixels */
window.addEventListener("resize", function() {
	
	if(window.innerWidth > 600) {
		var navbar = document.getElementById("navbar");
		navbar.style.height = "60px";
		navbar.setAttribute("state", "false");
	}
});