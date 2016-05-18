var update = false;
var fileage = '';
/*make vars that are used in multiple functions*/

$(document).ready(function(){
	var w = window.innerWidth;
	w = w +"px"
	var h = window.innerHeight;
	h = h*0.8 +"px"
	document.getElementById('chat_area').style.width= w;
	document.getElementById('chat_area').style.height= h;
	w = window.innerWidth*0.8 +"px";
	h = window.innerHeight*0.1 +"px";
	document.getElementById('textfield').style.width= w;
	document.getElementById('textfield').style.height= h;
	if(window.innerWidth < 700){
		document.getElementById("sumbitbutton").style.height = "40px"
		
	}
	
});
/*making stuff happen on index ready, there is not really requrment to but everything in different js file cause it just uses one document but it looks nice*/

$(function () {

        $('form').on('submit', function (e) {
			e.preventDefault();
			//alert($('form'));
		$.ajax({
			type: 'post',	
			url: 'write.php',
			data: $('form').serialize(),
			success: function () {
				$('#textfield').val("");
			}
		});
		});
});
/*catch submit button on index and sending it over with ajax*/

function updatefunction(user){
setInterval(function refreshFrame(){	
	
		$.ajax({
			type: "GET",
			url: "fileage.php",
		success: function(data){
			fileage  = data;
			var updated = fileage;		   
		if (update != updated){
			update = fileage;
			$.ajax({
				type: "GET",
				url: "tekstikentta.php",
			success: function(data){
				var elem = document.getElementById('chat_area');
				document.getElementById("chat_area").innerHTML = data;
				var scroll = elem.scrollHeight * 1000000;
				elem.scrollTop = scroll;
				
				$("."+user).css("background-color","#66FFFF", "!important");
				$("."+user).css("left","50%", "!important");
			}
			});
		} 
		}
		});
} , 1000);
}
/*make page check if file changed and if necessary update it to new*/

function deletedata(){

		$.ajax({
			type: "GET",
			url: "delete.php",
			success: function(){	
			}
		});
}
/*ajax to delete data, only function is to open php that deletes always same file.*/

function logout(){

		$.ajax({
			type: "GET",
			url: "logout.php",
			success: function(){	
			}
		});
}
/*same as deketadata only goes runs php on page*/

$(function () {
		$("#textfield").keypress(function (e) {
			if(e.which == 13 && !e.shiftKey) {        
				$(this).closest("form").submit();
				e.preventDefault();
			return false;
			}
		});
});
/*make enter send textfields texts, shift enter howerer just makes linebreak*/

 function view(img) {
		imgsrc = img.src;
		viewwin = window.open(imgsrc,'viewwin', 'width=1000,height=1000');    
}
/*when someone posts image link you can open it in new window*/

window.onresize = function(event) {
	document.getElementById("sumbitbutton").style.visibility = "visible";
    var w = window.innerWidth;
	w = w +"px";
	var h = window.innerHeight;
	h = h*0.8 +"px";
	document.getElementById('chat_area').style.width= w;
	document.getElementById('chat_area').style.height= h;
	w = window.innerWidth*0.8 +"px";
	h = window.innerHeight*0.1 +"px";
	document.getElementById('textfield').style.width= w;
	document.getElementById('textfield').style.height= h;
	document.getElementById("sumbitbutton").style.height = "100px";
	if(window.innerWidth < 700){
		document.getElementById("sumbitbutton").style.height = "40px";
		if(window.innerWidth < 361){
		document.getElementById("sumbitbutton").style.height = "20px";
		if(window.innerWidth < 261){
		document.getElementById("sumbitbutton").style.visibility = "hidden";
		
	}
	}
	}
};
/*making sure elements when window is resized */
