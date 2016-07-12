$("document").ready(function() {

        $.View = $( "body" );
        $.View.view_getOptionsFromForm();
        init();
        get_sidebar_this_week_hot();
        
});


function init() {
        
        $( "#direction-menu" ).show();
        
        var c = getParameterByName("c");
        $.category = c ? c : "All";
        var mod = getParameterByName("mod");
        $.mod = mod ? mod : "New";
        var ori = getParameterByName("ori");
        $.ori = ori ? ori : "All";
        var reset =  $.category === "All" ? "mod=" + $.mod : "c=" + c;
        $.cur_page = 1;
        $.page_num = 24;
        get_cate_info();
        get_cate_page();
        
        $( "#path .focus" ).attr( "href" , "v_article_list.php?" + reset );
        $( "#direction-map > .dir-5 > dd > a" ).attr( "href" , "v_article_list.php?" + reset );
};

function get_cate_info() {
        
        
        if( $.category === "All" ){
                
                var mod_name;
                switch( $.mod ){
                    case "New":
                        mod_name = "最新";
                        break;
                    case "Hot":
                        mod_name = "熱門";
                        break;
                }
                    
                $( "#cate_name" ).html( mod_name );
                var tmp = '<a class="active" cate="All">' + mod_name + '</a>';
                var tmp2 = '<a class="focus">' + mod_name + '</a>';

                $( "#direction-map > .dir-1 > dd" ).html( tmp );
                $( "#sub-path" ).html( tmp2 );
                
                selector_event();
        }
        else{
                
                var data = {
                            c: $.category ,
                            ori: $.ori
                };
                var success_back = function( data ) {

                        data = JSON.parse( data );
                        console.log(data);
                        loading_ajax_hide();
                        if( data.Success ) {
                            var category_result = data.data;
                            var tmp = "",tmp2 = "";
                            if( category_result['cate_name'] )
                                $( "#cate_name" ).html( category_result['cate_name'] );
                            
                            if( category_result["focus"] ){
                                tmp += '<a class="active" cate="'+category_result['id']+'">全部</a>';
                                tmp2 += '<a href="v_article_list.php?c='+category_result['id']+'&ori='+$.ori+'&mod='+$.mod+'" class="focus">全部</a>';
                            }
                            else{
                                tmp += '<a cate="'+category_result['id']+'">全部</a>';
                                tmp2 += '<a href="v_article_list.php?c='+category_result['id']+'&ori='+$.ori+'&mod='+$.mod+'" >全部</a>';
                            }                  
                            if( category_result["children"] ) {
                                $.each( category_result["children"] , function( index , value ){
                                        if( value["cate_display"] === "block" ) {
                                            if( value["focus"] ){
                                                    tmp += '<a cate="'+value['id']+'" class="active">'+value['cate_name']+'</a>';
                                                    tmp2 += '<a href="v_article_list.php?c='+value['id']+'&ori='+$.ori+'&mod='+$.mod+'" class="focus">'+value['cate_name']+'('+value['page_num']+')</a>';
                                            }
                                            else{
                                                    tmp += '<a cate="'+value['id']+'">'+value['cate_name']+'</a>';
                                                    tmp2 += '<a href="v_article_list.php?c='+value['id']+'&ori='+$.ori+'&mod='+$.mod+'">'+value['cate_name']+'('+value['page_num']+')</a>';
                                            }

                                        }
                                });
                            }
                            $( "#direction-map > .dir-1 > dd" ).html( tmp );
                            $( "#sub-path" ).html( tmp2 );
                            selector_event();

                        }
                        else {
                            show_remind( data.ErrMsg , "error" );
                        }

                }
                var error_back = function( data ) {
                        console.log(data);
                }
                $.Ajax( "POST" , "php/category.php?func=search_category" , data , "" , success_back , error_back);
                
        }
        
        

};

function get_cate_page() {
        
        var data = {
                    ch: "All" ,
                    category: $.category ,
                    mod: $.mod ,
                    ori: $.ori ,
                    cur_page: $.cur_page ,
                    page_num: $.page_num
        };
        var success_back = function( data ) {

                data = JSON.parse( data );
                console.log(data);
                loading_ajax_hide();
                if( data.Success ) {
                    var tmp = "";
                    $.each( data.data , function( index , value ){
                            tmp += create_page( value );
                    });
                    $( "#hiddenresult" ).html( tmp );
                    //$( "#item-list" ).html( tmp );
                    
                    $.View.view_getOptionsFromForm().destroy();
                    $.View.view_getOptionsFromForm()._SetOpts({ page_num : "16" , focus : $( "#left" ) , focus_2 : $( "#item-list" ) , focus_3 : $("#page-switch") });
                    $.View.view_getOptionsFromForm().init();
                    show_entire_time_event();
                    
                }
                else {
                    show_remind( data.ErrMsg , "error" );
                }

        }
        var error_back = function( data ) {
                console.log(data);
        }
        $.Ajax( "POST" , "php/page.php?func=get_page" , data , "" , success_back , error_back);

};

function get_sidebar_this_week_hot(){
        
        var data = {
                    page_num : 10
        };
        var success_back = function( data ) {

                data = JSON.parse( data );
                console.log(data);
                loading_ajax_hide();
                if( data.Success ) {
                        
                        var tmp = "";
                        $.each( data.data , function( index , value ){
                                tmp += '<li>' +
                                        '    <a href="v_article_info.php?p=' + value.page_id + '">' +
                                                '<div class="res_div3">\n\
                                                        <div style="background-image:url(\'' + website_page_url+value.page_id+"/ThumbnailM/"+value.p_icon + '\')"></div>\n\
                                                </div>' +
                                        '        <p>' + value.p_title + '</p>' +
                                        '    </a>' +
                                        '</li>';
                        });
                        $( "#right ul" ).html( tmp );
                        
                        
                }
                else {
                        show_remind( data.ErrMsg , "error" );
                }

        }
        var error_back = function( data ) {
                console.log(data);
        }
        $.Ajax( "POST" , "php/page.php?func=get_this_week_hot_page" , data , "" , success_back , error_back);
    
}
function selector_event(){
    
    $( "#direction-map .dir-2 a[ori="+$.ori+"]" ).addClass( "active" );
    $( "#direction-map .dir-3 a[mod="+$.mod+"]" ).addClass( "active" );
    
    $( "#direction-map a" ).bind( "click" , function(){
            var pos = $(this);
            if( !$(this).hasClass( "active" ) ){
                    pos.parent().children().removeClass( "active" );
                    pos.addClass( "active" );
            }
    });
    $( "#direction-search" ).bind( "click" , function(){
            $.category = $( "#direction-map .dir-1 a.active" ).attr( "cate" );
            $.ori = $( "#direction-map .dir-2 a.active" ).attr( "ori" );
            $.mod = $( "#direction-map .dir-3 a.active" ).attr( "mod" );
            location.href = location.href.split("?")[0] + "?c=" + $.category + "&mod=" + $.mod + "&ori=" + $.ori;
    });
}
        