/* initial */
var i = 0;
var t = true;
var id = setTimeout(carousel, 3000, 1);

floater();

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
document.getElementById("collapsor").addEventListener("click", function() {
	
	var navbar = document.getElementById("navbar");
	var state = navbar.getAttribute("state");
	
	if(state == "true"){
		navbar.style.height = "60px";
		navbar.setAttribute("state", "false");
	}else {
		navbar.style.height = "365px";
		navbar.setAttribute("state", "true");
	}
	
});

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

/* who floater event */
const dest_e = 0;
const dest_l = -95;
const interval = 2.5;
var hover = 0;

function floater(){
	var imgs = document.getElementsByClassName("floater");
	
	for(var j = 0; j < imgs.length; j++){
		
		imgs[j].addEventListener("mouseenter", function(){
			
			var bio = this.getElementsByClassName("bio")[0];
			if(!bio.style.right){
				bioFloat(bio, 0, dest_e, parseFloat(bio.style.left));
			}else{
				bioFloat(bio, 1, dest_e, parseFloat(bio.style.right));
			}
			
		});
		
		imgs[j].addEventListener("mouseleave", function(){
			
			var bio = this.getElementsByClassName("bio")[0];
			if(!bio.style.right){
				bioFloat(bio, 0, dest_l, parseFloat(bio.style.left));
			}else{
				bioFloat(bio, 1, dest_l, parseFloat(bio.style.right));
			}
			
		});
	}
}

function bioFloat(img, direction , end, x){
	
	
	
	if((x == end)) {
		// stop
	}else{
		
		if(direction == "1"){
			if(x != parseFloat(img.style.right)){
				return;
			}
		}else{
			if(x != parseFloat(img.style.left)){
				return;
			}
		}
		
		if(end < 0){
			x -= interval;
	    }else{
			x += interval;
		}
		
		if(direction == "1"){
			img.style.right = x + "%";
		}else{
			img.style.left = x + "%";
		}
		
		hover = setTimeout(bioFloat, 22, img, direction, end, x);
		
	}
	
}

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

/* back to top button with animation */

document.getElementById("back").addEventListener("click", SmoothScrollUp);

var step = 75;
 var h,t;
 var y = 0;
function SmoothScrollUp()
{
    h = document.documentElement.scrollHeight;
    y += step;
    window.scrollBy(0, -step);
    if(y >= h )
      {clearTimeout(t); y = 0; return;}
    t = setTimeout(function(){SmoothScrollUp()},20);
};

/* navbar light up witch div look at */
