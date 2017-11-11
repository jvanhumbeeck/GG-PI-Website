/* initial */
var i = 0;
var t = true;
var id = setTimeout(carousel, 3000, 1);

floater();
registerNavbarEvents();

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

/* navbar button pressevent */
function registerNavbarEvents() {
	
	var buttons = document.getElementById("buttons").getElementsByTagName("a");
	
	for (var v = 0; v < buttons.length; v++) {
		
		if (!buttons[v].getAttribute("href")) {
			
			buttons[v].addEventListener("click", function () {
				
				var theID = this.id.substring(1);
				
				var section = document.getElementById(theID);
				
				SmoothScrollUp(section);
				
			});
		}
	}	
}

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
			titles[i].style.top = "65%";
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
	
	var a = document.getElementsByClassName("slide")[i].clientHeight;
	
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

const step = 75;
var h, t;
var y = 0;

document.getElementById("back").addEventListener("click", function() {
	
	var section = document.getElementById("home");
	
	SmoothScrollUp(section);
	
});

const offset = 1/4 * window.innerHeight;

function SmoothScrollUp(section)
{
	// invisible scrolled pixels top == to top of page
	var scrollTop = document.documentElement.scrollTop;
	
	//ofset from top
	var divFromTop = section.offsetTop;
	
	// if(divFromTop != 0){divFromTop = offset}
	
	//so the amout for scrolling is = scrollTop - offSet;
	var toScroll = (scrollTop - divFromTop);
	
	if(h == toScroll){/*stop*/clearTimeout(t); y = 0; return;}
	
    h = toScroll;
	
	//positief
	if(h > 0) { // naar boven
		y += step;
		if(h < step){window.scrollBy(0, -h);}
		else{window.scrollBy(0, -step);}
		if(h == 0){clearTimeout(t); y = 0; return;}
		t = setTimeout(function(){SmoothScrollUp(section)},20);
	}else{ // naar beneden
		//negatief
		y -= step;
		if(h > -step){window.scrollBy(0, -h);}
		else{window.scrollBy(0, step);}
		if(h == 0){clearTimeout(t); y = 0; return;}
		t = setTimeout(function(){SmoothScrollUp(section)},20);
	}
};

window.addEventListener("scroll", detectDiv);

/* navbar light up witch div look at */

function detectDiv() {
	
	var divs = document.getElementsByClassName("section");
	
	// invisible scrolled pixels top
	var scrollTop = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
	
	for (var k = 0;k < divs.length; k++) {
		
		//div position from top
		var div_pos = divs[k].offsetTop;
		
		//div height inc padding scrollbar and borders
		var div_Height = divs[k].offsetHeight;
		
		if ((scrollTop > (div_pos - offset)) && (scrollTop < (div_pos + (div_Height - offset)))) {
			//divs[k].classList.add("active");
			var btn = document.getElementById("b" + divs[k].id);
			btn.classList.add("active");
			
		}else{
			//divs[k].classList.remove("active");
			var btn = document.getElementById("b" + divs[k].id);
			btn.classList.remove("active");
			
		}
	}
	
}