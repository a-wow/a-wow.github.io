$(document).ready(function(){

    $('.features__play').click(function(event){
		event.preventDefault();
		let video_player = '<iframe width="100%" height="100%" src="' + $(this).attr('data-video-id') + '?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
		$(".video-wnd__box").append(video_player);
		$('.video-wnd').addClass("active");
		
	});
	
	$('.video-wnd__cancel').click(function(event){
		if($('.video-wnd').hasClass('active')){
			$('.video-wnd').removeClass("active");
		
			setTimeout(function(){
				$(".video-wnd__box").html("");
			}, 300);
		}
	});

});


