$(function() {
	// 右側廣告圖fixed
	var fixed_area_top = $('.fixed-area').offset().top;
	var scrollTop = $(window).scrollTop();
	
	$(window).scroll(function() {
		scrollTop = $(window).scrollTop();
		if(scrollTop >= (fixed_area_top - 80) ) {
			$('.fixed-area').css({
				'position': 'fixed',
				'top': '80px'
			});
		}else {
			$('.fixed-area').css({
				'position': 'relative',
				'top': '0'
			});
		}
	}).scroll();

	// 留言標籤位置調整
	var tag_message_W = $('.tag-message').width();
	var tag_W = $('.tag-message .tag').width();
	var message_W = $('.tag-message .message').width();
	$(window).resize(function() {
		tag_message_W = $('.tag-message').width();
		if(tag_message_W <= (tag_W + message_W)) {
			$('.tag-message').css(
				'margin-bottom', '5px'
			);
			$('.tag-message .message').css({
				'width': '100%',
				'text-align': 'center',
				'margin-top': '13px'
			});
		}else {
			$('.tag-message').css(
				'margin-bottom', '20px'
			);
			$('.tag-message .message').css({
				'width': 'auto',
				'text-align': 'left',
				'margin-top': '0'
			});
		}
	}).resize();

	// 留言板內容 toggle
	// $('.tag-message .message a').click(function() {
	// 	$('.fb-comments-area').slideToggle({
	// 		duration: 200
	// 	});
	// });
	
});