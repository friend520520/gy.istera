
$("document").ready(function() {
        $.showresult = '#showresult'; //jquery.pagination.js Parent html id above checkbox checkall
        $.hiddenresult = '#hiddenresult'; //jquery.pagination.js table id
        
        cancel_checkall();
        init_batch();
});

function init_batch(){
    
        /*<table> <th> <input type=checkbox id="checkall">*/
        $( "#checkall" ).unbind("click").bind( "click" , function(){
                if( $( "#checkall" ).is( ":checked" ) ) {
                    $( $.showresult + " input[type=checkbox]:not(:checked)" ).click();
                } else {
                    $( $.showresult + " input[type=checkbox]:checked" ).click();
                }
        });
	
	/*批次處理 暫停會員權限*/
        $( "#btn_checkbox_block_pause_account" ).unbind("click").bind( "click" , function(){
                $.list = [];
                $.each( $( "#showresult input[type=checkbox]:checked" ) , function( index , value ){
                    $.list[$.list.length] = $( value ).parents('[a_id]').attr('a_id');
                });
                if ( $.list.length > 0 ){
                        $( ".myModalAddGroup_body span" ).html('此'+$.list.length+'位會員權限嗎');
                        $( "#dialogue_pause_account" ).modal("show");
                } else {
                        $( ".myModalAddGroup_body span" ).html('全部會員權限嗎');
                        $.each( $( "#hiddenresult input[type=checkbox]" ) , function( index , value ){
                                $.list[$.list.length] = $( value ).parents('[a_id]').attr('a_id');
                        });
                        $( "#dialogue_pause_account" ).modal("show");
                }
        });
        $( "#checkbox_account_block_pause_yes" ).unbind("click").bind( "click" , function(){
                fn_btn_checkbox_pause_account();
        });
	
        /*批次處理 恢復會員權限*/
        $( "#btn_checkbox_block_continue_account" ).unbind("click").bind( "click" , function(){
                $.list = [];
                $.each( $( "#showresult input[type=checkbox]:checked" ) , function( index , value ){
                    $.list[$.list.length] = $( value ).parents('[a_id]').attr('a_id');
                });
                if ( $.list.length > 0 ){
                        $( ".myModalAddGroup_body span" ).html('此'+$.list.length+'位會員權限嗎');
                        $( "#dialogue_continue_account" ).modal("show");
                } else {
                        $( ".myModalAddGroup_body span" ).html('全部會員權限嗎');
                        $.each( $( "#hiddenresult input[type=checkbox]" ) , function( index , value ){
                                $.list[$.list.length] = $( value ).parents('[a_id]').attr('a_id');
                        });
                        $( "#dialogue_continue_account" ).modal("show");
                }
        });
        $( "#checkbox_account_block_continue_yes" ).unbind("click").bind( "click" , function(){
                fn_btn_checkbox_continue_account();
        });
        
        /*批次處理 上架文章*/
        $( "#btn_checkbox_display_article" ).unbind("click").bind( "click" , function(){
                $.list = [];
                $.each( $( $.showresult+" input[type=checkbox]:checked" ) , function( index , value ){
                    $.list[$.list.length] = $( value ).parents('[page_id]').attr('page_id');
                });
                if ( $.list.length > 0 ){
                        $( "#dialogue_display_article .myModalAddGroup_body span" ).html('此'+$.list.length+'篇文章嗎');
                        $( "#dialogue_display_article" ).modal("show");
                } else {
                        $( ".myModalAddGroup_body span" ).html('全部文章嗎');
                        $.each( $( "#hiddenresult input[type=checkbox]" ) , function( index , value ){
                                $.list[$.list.length] = $( value ).parents('[page_id]').attr('page_id');
                        });
                        $( "#dialogue_display_article" ).modal("show");
                }
        });
        $( "#checkbox_dialogue_display_article_yes" ).unbind("click").bind( "click" , function(){
                fn_btn_checkbox_display_article();
        });
        
        
        /*批次處理 下架文章*/
        $( "#btn_checkbox_nonedisplay_article" ).unbind("click").bind( "click" , function(){
                $.list = [];
                $.each( $( $.showresult+" input[type=checkbox]:checked" ) , function( index , value ){
                    $.list[$.list.length] = $( value ).parents('[page_id]').attr('page_id');
                });
                if ( $.list.length > 0 ){
                        $( "#dialogue_nonedisplay_article .myModalAddGroup_body span" ).html('此'+$.list.length+'篇文章嗎');
                        $( "#dialogue_nonedisplay_article" ).modal("show");
                } else {
                        $( "#dialogue_nonedisplay_article .myModalAddGroup_body span" ).html('全部文章嗎');
                        $.each( $( "#hiddenresult input[type=checkbox]" ) , function( index , value ){
                                $.list[$.list.length] = $( value ).parents('[page_id]').attr('page_id');
                        });
                        $( "#dialogue_nonedisplay_article" ).modal("show");
                }
        });
        $( "#checkbox_dialogue_nonedisplay_article_yes" ).unbind("click").bind( "click" , function(){
                fn_btn_checkbox_nonedisplay_article();
        });
        
        
        /*批次處理 刪除文章*/
        $( "#btn_checkbox_delete_article" ).unbind("click").bind( "click" , function(){
                $.list = [];
                $.each( $( $.showresult+" input[type=checkbox]:checked" ) , function( index , value ){
                    $.list[$.list.length] = $( value ).parents('[page_id]').attr('page_id');
                });
                if ( $.list.length > 0 ){
                        $( "#dialogue_delete_article .myModalAddGroup_body span" ).html('此'+$.list.length+'篇文章嗎');
                        $( "#dialogue_delete_article" ).modal("show");
                } else {
                        $( "#dialogue_delete_article .myModalAddGroup_body span" ).html('全部文章嗎');
                        $.each( $( "#hiddenresult input[type=checkbox]" ) , function( index , value ){
                                $.list[$.list.length] = $( value ).parents('[page_id]').attr('page_id');
                        });
                        $( "#dialogue_delete_article" ).modal("show");
                }
        });
        $( "#checkbox_dialogue_delete_article_yes" ).unbind("click").bind( "click" , function(){
                fn_btn_checkbox_delete_article();
        });
    
        /*批次處理 刪除訊息*/
        $( "#btn_checkbox_delete_message" ).unbind("click").bind( "click" , function(){
                $.list = [];
                $.each( $( $.showresult+" input[type=checkbox]:checked" ) , function( index , value ){
                    $.list[$.list.length] = $( value ).parents('[m_id]').attr('m_id');
                });
                if ( $.list.length > 0 ){
                        $( "#dialogue_delete_message .myModalAddGroup_body span" ).html('此'+$.list.length+'篇訊息嗎');
                        $( "#dialogue_delete_message" ).modal("show");
                } else {
                        $( "#dialogue_delete_message .myModalAddGroup_body span" ).html('全部訊息嗎');
                        $.each( $( "#hiddenresult input[type=checkbox]" ) , function( index , value ){
                                $.list[$.list.length] = $( value ).parents('[m_id]').attr('m_id');
                        });
                        $( "#dialogue_delete_message" ).modal("show");
                }
        });
        $( "#checkbox_dialogue_delete_message_yes" ).unbind("click").bind( "click" , function(){
                fn_btn_checkbox_delete_message();
        });
}


/**
 * 批次處理 上架文章
 * @
 */
function fn_btn_checkbox_display_article()
{
        var list = $.list;
        var data = {
                token:      $.global_getcookie,
                list:       JSON.stringify(list)
        };
        var success_back = function( data ) {

                var tmp = "";
                data = JSON.parse( data );
                console.log(data);
                if (data.Success) {
                        $('#example').DataTable().ajax.reload();
                        show_remind("更改成功");
                        $( "#dialogue_display_article" ).modal("hide");

                        $.list = [];
                } else {
                        show_remind("更改失敗");
                }

        };
        var error_back = function( data ) {
                console.log(data);
        };
        $.Ajax( "POST" , "php/" + $.global_php + "?func=fn_btn_checkbox_display_article" , data , "" , success_back , error_back);
}


/**
 * 批次處理 下架文章
 * @
 */
function fn_btn_checkbox_nonedisplay_article()
{
        var list = $.list;
        var data = {
                token:      $.global_getcookie,
                list:       JSON.stringify(list)
        };
        var success_back = function( data ) {

                var tmp = "";
                data = JSON.parse( data );
                console.log(data);
                if (data.Success) {
                        $('#example').DataTable().ajax.reload();
                        show_remind("更改成功");
                        $( "#dialogue_nonedisplay_article" ).modal("hide");

                        $.list = [];
                } else {
                        show_remind("更改失敗");
                }

        };
        var error_back = function( data ) {
                console.log(data);
        };
        $.Ajax( "POST" , "php/" + $.global_php + "?func=fn_btn_checkbox_nonedisplay_article" , data , "" , success_back , error_back);
}


/**
 * 批次處理 刪除文章
 * @
 */
function fn_btn_checkbox_delete_article()
{
        var list = $.list;
        var data = {
                token:      $.global_getcookie,
                list:       JSON.stringify(list)
        };
        var success_back = function( data ) {

                var tmp = "";
                data = JSON.parse( data );
                console.log(data);
                if (data.Success) {

                        $.each(data.data, function(index, value) {
                                $("[page_id='" + value + "']").html( "" );
                        });
                        show_remind("刪除成功");
                        $( "#dialogue_delete_article" ).modal("hide");

                        $.list = [];
                } else {
                        show_remind("刪除失敗");
                }

        };
        var error_back = function( data ) {
                console.log(data);
        };
        $.Ajax( "POST" , "php/" + $.global_php + "?func=fn_btn_checkbox_delete_article" , data , "" , success_back , error_back);
}


/**
 * 批次處理 刪除公告
 * @
 */
function fn_btn_checkbox_delete_board()
{
        var list = $.list;
        var data = {
                token:      $.global_getcookie,
                list:       JSON.stringify(list)
        };
        var success_back = function( data ) {
                var tmp = "";
                data = JSON.parse( data );
                if (data.Success) {
                        $('#example').DataTable().ajax.reload();
                        show_remind("刪除成功");
                        $( "#dialogue_delete_board" ).modal("hide");
                        $.list = [];
                } else {
                        show_remind("刪除失敗");
                }
        };
        var error_back = function( data ) {
                console.log(data);
        };
        $.Ajax( "POST" , "php/" + $.global_php + "?func=fn_btn_checkbox_delete_board" , data , "" , success_back , error_back);
}


/**
 * 批次處理 刪除訊息
 * @
 */
function fn_btn_checkbox_delete_message()
{
        var list = $.list;
        var data = {
                token:      $.global_getcookie,
                list:       JSON.stringify(list)
        };
        var success_back = function( data ) {

                var tmp = "";
                data = JSON.parse( data );
                console.log(data);
                if (data.Success) {

                        $.each(data.data, function(index, value) {
                                $("[m_id='" + value + "']").html( "" );
                        });
                        show_remind("刪除成功");
                        $( "#dialogue_delete_message" ).modal("hide");
                        $.list = [];
                } else {
                        show_remind("刪除失敗");
                }

        };
        var error_back = function( data ) {
                console.log(data);
        };
        $.Ajax( "POST" , "php/" + $.global_php + "?func=fn_btn_checkbox_delete_message" , data , "" , success_back , error_back);
}


/**
 * 全選功能之checkbox
 * @cancel_checkall(): 網頁重新整理/換頁時，清除已勾選checkbox
 */
function cancel_checkall(){

        if( $( "#checkall" ).is( ":checked" ) ) {
            $( "#checkall" ).click();
        }

}

