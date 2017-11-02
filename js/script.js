/* initial */
var i = 0;
var t = true;
var id = setTimeout(carousel, 3000, 1);

/* onload event */
window.addEventListener("load", function(){
	fixButton();
	fixImage();
	
	document.getElementById("lbutton").addEventListener("click", function() {
		clearTimeout(id);
		t = false;
		
		carousel(-1);
	});
	
	document.getElementById("rbutton").addEventListener("click", function() {
		clearTimeout(id);
		t = false;
		
		carousel(1);
	});
	
});

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
	
	/* carousel */
	fixImage();
	fixButton();
	
	if(window.innerWidth > 600) {
		var navbar = document.getElementById("navbar");
		navbar.style.height = "60px";
		navbar.setAttribute("state", "false");
	}
});

/* carousel */ /* for max height 100%; && titles */
function fixImage() {
	
	if(document.getElementById("carousel").clientHeight > window.innerHeight) {
		
		document.getElementById("carousel").style.height = window.innerHeight + "px";
		var titles = document.getElementsByClassName("holder");
		
		for (var i=0; i<titles.length; i++) {
			titles[i].style.top = "25%";
		}
	}else{
		
		document.getElementById("carousel").style.height = null;
		
		var titles = document.getElementsByClassName("holder");
		
		for (var i=0; i<titles.length; i++) {
			titles[i].style.top = null;
		}
	}
	
}

function fixButton() {
	
	var a = document.getElementsByClassName("slide")[i].getElementsByTagName("img")[0].clientHeight;
	
	document.getElementById("lbutton").style.height = a + "px";
	document.getElementById("rbutton").style.height = a + "px";
	
}

function carousel(x) {
	
	
	
		var a = document.getElementsByClassName("slide");
		
		if((i == 2) && (x > 0)){
			
			a[i].style.display = "none";
			
			i = 0;
			
			a[i].style.display = "inline-block";
			
		}else{
			
			a[i].style.display = "none";
			
			i += x;
			
			a[i].style.display = "inline-block";
			
		}
		
		if(t == true){
		
		    id = setTimeout(carousel, 3000, 1);
	    }
}