/* initializer */
registerImages();

var t;
var y;

/* window onload event */
window.addEventListener("load", function(){
	
	/* check if url end with #mindmap if that show more posts */
	if(window.location.hash){
		var hash = window.location.hash.substring(1); //Puts hash in variable, and removes the # character
        
		var p = document.getElementsByClassName("post");
		
		for(var x = 0; x < p.length; x++){
			
			t = p[x].getElementsByTagName("p");
			
			for(y = 0; y < t.length; y++){
			
				if(t[y].id == hash){
					
					var q = (x+1) - shown_posts + 1;
					
					showPosts(q);
					
					setTimeout(function() {SmoothScrollUp(document.getElementById(hash))}, 500);
				}
			}
		}
	}
	
});

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
	
	SmoothScrollUp(section);
	
});

function SmoothScrollUp(section)
{
	// invisible scrolled pixels top == to top of page
	var scrollTop = (document.documentElement.scrollTop || document.body.scrollTop);
	
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
//shown posts
var shown_posts = 0 ;

//initializer
showPosts(5);

function showPosts(amount) {
	// all the posts, or the max possible shown posts
	var p = document.getElementsByClassName("post");
	var max = p.length;
	var min = 5;
	
	//amount is the amount to sow or hide;
	if(amount > 0){//show amount more posts
		//check if is possible to show amount of posts, and calculate the amount that is possible;
		var q = ((shown_posts + amount) > max) ? (max - shown_posts) : amount;
		//q is the amount to show more;
		
		//loop trought to all q's;
		for(var i = 0; i < q; i++){
			//show post;
			p[shown_posts + i].style.display = "block";
		}
		
		//update shown_posts;
		shown_posts += q;
		
	}else{//hide amount of posts
		//check if is possible to hide amount of posts(amount is negative), and calculate the amount that is possible;
		var q = ((shown_posts + amount) < min) ? (shown_posts - min) : (-amount);
		//q is amount to hide;
		
		//loop trought all q's;
		for(var i = 0; i < q; i++){
			//hide post, subtract one, to count in Javascript;
			p[(shown_posts - 1) - i].style.display = "none";
		}
		
		//update shown_posts;
		shown_posts -= q;
	}
	
	//see if it is possible to show more posts, if not, disable button;
	if(shown_posts == max) {
		document.getElementById("older").classList.add("disabled");
	}else{
		//else remove disabled
		document.getElementById("older").classList.remove("disabled");
	}
	//see if it is posssible to hide more posts(the minimum is five), if not, disable button;
	if(shown_posts == 5) {
		document.getElementById("newer").classList.add("disabled");
	}else{
		//else remove disabled
		document.getElementById("newer").classList.remove("disabled");
	}
}

document.getElementById("older").addEventListener("click", function() {
	
	//when press button, show 5 more posts;
	showPosts(5);
	
});

document.getElementById("newer").addEventListener("click", function() {
	
	//when press button, hide 5 posts;
	showPosts(-5);
	
});

//login button in footer
document.getElementById("login").addEventListener("click", function () {
	
	//show login div
	document.getElementById("login_panel").style.display = "block";
	
});

//close login
var clicked = true;
document.getElementById("login_form").addEventListener("click", function () {
	
	//close login panel
	clicked = false;
	
});
document.getElementById("login_panel").addEventListener("click", function () {
	
	//close login panel
	if(clicked === true) {
		document.getElementById("login_panel").style.display = "none";
	}
	clicked = true;
	
});

//futur plans div, keep at side 
window.addEventListener("scroll", function() {
	
	//check if width is greater then 600px
	if(window.innerWidth > 600){
		
		//it is 95 + 79.438 + 89 = 263.438;
		if(document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
			
			var sideBar = document.getElementsByClassName("sidebar")[0];
			sideBar.style.position = "fixed";
			sideBar.style.top = "87px";
			sideBar.style.right = "0";
			
		}else {
			
			var sideBar = document.getElementsByClassName("sidebar")[0];
			sideBar.style.position = "relative";
			sideBar.style.top = null;
			sideBar.style.right = null;
			
		}
		
	}
	
	
});