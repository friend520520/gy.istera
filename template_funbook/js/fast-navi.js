$(function(){
	//set item
	$('#cover , #direction-map').hide();
	
	//direction menu
	$('#direction-menu, #btn-menu').click(function(e) {
                $('body').css('overflow-y','hidden');
                console.log( 'hidden' );
		$('#cover , #direction-map').fadeIn();
	});
	
	$('#cover').click(function(e) {
                $(this).hide();
		$('#direction-map').hide();
		$('body').css('overflow-y','auto');
	});
	
	// gotop
	$("#gotop").click(function(){
		$("html,body").animate({scrollTop:0},900);
	});
	
	//fb按讚
	$(function(){
		$("#item-list dl").hover(function(){
			$(this).find(".fb").stop().fadeIn(600).end();
		},function(){
			$(this).find(".fb").stop().fadeOut().end();
		});
	});
	//顯示完整時間
	/*$(function(){
		$("#item-list li dl dd p span").hide();
		$("#item-list li dl dd p").hover(function(){
			$(this).find("span").stop().fadeIn(200).end();
			$(this).find("b").stop().fadeOut(200).end();
		},function(){
			$(this).find("b").stop().fadeIn(200).end();
			$(this).find("span").stop().fadeOut(200).end();
		});
	});*/
});

function show_entire_time_event(){

        $( "#item-list li dl dd p" ).unbind( "mouseenter" ).bind( "mouseenter", function() {
                $(this).find("span").stop().fadeIn(200).end();
                $(this).find("b").stop().fadeOut(200).end();
        });
        $( "#item-list li dl dd p" ).unbind( "mouseleave" ).bind( "mouseleave", function() {
                console.log( $(this) );
                $(this).find("b").stop().fadeIn(200).end();
                $(this).find("span").stop().fadeOut(200).end();
        });
        
}