$(document).ready(function(){

	$('.header__langs-current').click(function(event){
		if($(this).parent().hasClass('active')){
			$(this).parent().removeClass('active');
		}
		else{
			$(this).parent().addClass('active');
		}
	});
	
	$(document).mouseup(function (e){
		if (!$('.header__langs').is(e.target) && $('.header__langs').has(e.target).length === 0){
			$(".header__langs").removeClass('active');
		}
	});

});


