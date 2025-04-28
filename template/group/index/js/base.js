(function(){

})();

$(function(){
	
	$(document.body).css("min-height",$(window).height());
	$(window).resize(function(){
		document.getElementsByTagName('html')[0].style.fontSize = Math.min(window.innerWidth*12/320,200)+"px";		
		$(document.body).css("min-height",$(window).height());
	});

});	