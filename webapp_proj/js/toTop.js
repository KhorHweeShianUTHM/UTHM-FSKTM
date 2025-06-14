$(document).ready(function(){
	$(window).scroll(function(){
		if($(window).scrollTop() > 500){
			$('.totop').css({
				"opacity":"1", "pointer-events":"auto"
			});
        }else{
			$('.totop').css({
				"opacity":"0", "pointer-events":"none"
			});
        }
	});
	$('.totop').click(function(){
		$('html').animate({scrollTop:0}, 500);
	});
});