/* initializer */
var posts = 0 ;

registerImages();
showPosts(5);

/* navbar collapse script */
document.getElementById("collapsor").addEventListener("click", function() {
	
	var navbar = document.getElementById("navbar");
	var state = navbar.getAttribute("state");
	
	if(state == "true"){
		navbar.style.height = "60px";
		navbar.setAttribute("state", "false");
	}else {
		navbar.style.height = "190px";
		navbar.setAttribute("state", "true");
	}
	
});

/* resize event for navbar recollapse at pixels */
window.addEventListener("resize", function() {
	
	if(window.innerWidth > 600) {
		var navbar = document.getElementById("navbar");
		navbar.style.height = "60px";
		navbar.setAttribute("state", "false");
	}
});

/* back to top button with animation */

const step = 75;
var h, t;
var y = 0;

document.getElementById("back").addEventListener("click", function() {
	
	var section = document.getElementById("home");
	
	SmoothScrollUp(0);
	
});

function SmoothScrollUp(section)
{
	// invisible scrolled pixels top == to top of page
	var scrollTop = document.documentElement.scrollTop;
	
	//ofset from top
	var divFromTop = section	;
	
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

/* image click, image close, and open in full screen */
function registerImages() {
	
	var imgs = document.getElementsByClassName("posts")[0].getElementsByTagName("img");
	
	for(var k = 0; k < imgs.length; k++) {
		
		imgs[k].addEventListener("click", function() {
	
			showImg(this);
	
		});	
	}
	
	document.getElementById("close").addEventListener("click", function() {
	
		document.getElementById("holder").style.display = "none";
	
	});	
}

function showImg(img) {
	
	var holder = document.getElementById("holder");
	var vimg = holder.getElementsByTagName("img")[0];
	
	vimg.src = img.src;
	
	holder.style.display = "block";
	
}

/* blog post show a few, not all */
function showPosts(amount) {
	var p = document.getElementsByClassName("post");
	
	if(amount > 0){
		var q = ((amount + posts) > p.length) ? (p.length + posts) : (amount + posts); 
		for(var i = posts;i < q; i++) {
			posts++;
			p[i].style.display = "block";
		}
	}else{
		var q = ((amount + posts) < 5) ? (posts - (amount + posts)) : (amount + posts);
		for(var i = (posts-1);i > (q - 1); i--) {
			posts--;
			p[i].style.display = "none";
		}
	}
	
	if(posts == p.length){
		//at bottom of posts
		document.getElementById("older").classList.add("disabled");
	}else {
		document.getElementById("older").classList.remove("disabled");
	}
	
	if(posts > 5) {
		//at top of posts
		document.getElementById("newer").classList.remove("disabled");
	}else {
		document.getElementById("newer").classList.add("disabled");
	}
}

document.getElementById("older").addEventListener("click", function() {
	
	showPosts(5);
	
});

document.getElementById("newer").addEventListener("click", function() {
	
	showPosts(-5);
	
});