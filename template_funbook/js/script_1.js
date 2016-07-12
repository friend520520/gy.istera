// JavaScript Document

//上方中間最新消息頁籤
$(function(){
		var _showTab = 0;
		$('.tab-block').each(function(){
			var $tab = $(this);

			$('ul.tabs li', $tab).eq(_showTab).addClass('active');
			$('.tab_content', $tab).hide().eq(_showTab).show();

			$('ul.tabs li', $tab).click(function() {
				var $this = $(this),
					_clickTab = $this.find('a').attr('href');
				$this.addClass('active').siblings('.active').removeClass('active');
				$(_clickTab).stop(false, true).fadeIn(0).siblings().hide();

				return false;
			}).find('a').focus(function(){
				this.blur();
			});
		});
});

$(document).ready(function() {
		
	//人氣熱推
	$("#article-turn").owlCarousel({
		items:5,
		itemsDesktop     :[1176,4],
   	 	itemsDesktopSmall:[768,3],
                itemsTablet      :[700,2],
                itemsMobile      :[510,1],
                        pagination:false,
                navigation:true
	});
		
	//人氣熱推 滑出文字
	var _titleHeight = 32;
        $('.gallery-block').each(function(){
                var $this = $(this), 
                _height = $this.height(), 
                $caption = $('.caption', $this),
                _captionHeight = $caption.outerHeight(true),
                _speed = 200;
			
                $this.hover(function(){
                        $caption.stop().animate({
                                top: _height - _captionHeight
                        }, _speed);
                }, function(){
                        $caption.stop().animate({
                                top: _height - _titleHeight
                        }, _speed);
                });
	});
});

//人氣作者頁籤效果
$(function(){
	$('#join-content div.item').eq(0).show();
	$('#join-content div.item').eq(1).hide();
	$('ul.hot-rank').eq(0).show();
	$('ul.hot-rank').eq(1).hide();
	
	$('#join-tab div.item').eq(0).click(function(e) {
		$(this).addClass('active');
		$('#join-tab div.item').eq(1).removeClass('active');
        $('#join-content div.item').eq(0).show();
		$('#join-content div.item').eq(1).hide();
    });
	$('#join-tab div.item').eq(1).click(function(e) {
		$(this).addClass('active');
		$('#join-tab div.item').eq(0).removeClass('active');
        $('#join-content div.item').eq(1).show();
		$('#join-content div.item').eq(0).hide();
    });
});

//廣告列表區 瀑布流
$(function(){
	var $container = $("#ad-area-container").masonry();  
		$container.imagesLoaded(function() {
		$container.masonry({
			itemSelector:".ad-area",
			columnWidth:".grid-sizer"
		});
	});
});