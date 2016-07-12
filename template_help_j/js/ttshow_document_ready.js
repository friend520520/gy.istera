$(document).ready(function() {
        $(window).scrollTop( 0 );
            $('#change_img_select_modal')
            .on('show.bs.modal', function (e) {
                    if( $('#change_img_select_modal').attr("load") == "false" ) {
                            $('#change_img_select_modal').attr("load","true");
                            ttshow_get_user_img();
                    }
            })
            .on('hidden.bs.modal', function (e) {
                        $.View.view_sidebar().options().click_img = "";
            });
            $("#change_img_select_modal_yes").unbind('click').bind( 'click' , function() {
                    //var src = $("#ttshow_img_list_space div[target]").css("background-image");
                    //src = src.replace("url(\"","").replace("\")","").replace("\"","").replace("\"","");
                    var src = $("#ttshow_img_list_space div[target]").attr("src");
                    if( $.insert_type === "content" ){
                        if( src != undefined ) {
                                tinyMCE.execCommand('mceInsertContent', false, '<img style="max-width:100%;" data-pos="member" src="' + src + '" />');
                                //$.View.view_sidebar().options().click_img.attr("src" , src );
                                $("#change_img_select_modal").modal("hide");
                        }
                    }
                    else if( $.insert_type === "cover" ){
                        if( src != undefined ) {
                                $("#upload_now").css("background-image","url('" + src + "?" + Math.random() + "')");
                                $("#upload_now").attr("img", src );
                                $.page_cover = src;
                                $("#upload_now").parent().css("background","white");
                                $("#change_img_select_modal").modal("hide");
                        }
                    }
            });
            $("#delete_img").unbind('click').bind( 'click' , function() {
                    
                    var pos = $("#ttshow_img_list_space div[target]");
                    var src = pos.css("background-image");
                    src = src.replace("url(","").replace(")","").replace("\"","").replace("\"","");
                    var img = src.split( "/" )[src.split( "/" ).length-1];
                    var img_array = [ img ];
                    var data = {
                            token : getCookie( "help_cookie" ),
                            img    : img_array
                    };
                    var success_back = function( data ) {

                            data = JSON.parse( data );
                            console.log(data);
                            loading_ajax_hide();
                            if( data.success ) {
                                pos.remove();
                                $( "#delete_img" ).hide();
                            }
                            else {
                                show_remind( data.msg , "error" );
                            }

                    }
                    var error_back = function( data ) {
                            console.log(data);
                    }
                    $.Ajax( "POST" , "php/user_upload_image.php?func=del_cloud_disk" , data , "" , success_back , error_back);
                    
            });
            
            var delete_transient_file = function( filename ) {
                    $.ajax({
                                type: "POST",
                                url: "php/user_upload_image.php?func=del_transient",
                                data : {
                                    transient_file : filename
                                },
                                success: function( data ) { return null; } ,
                                error: function( data ) { console.log( data ); }
                    });
            }
            $(window).on('beforeunload', function(){
                    $.each( $.upload_file.beforeunload , function(index, value) {
                            delete_transient_file( value );
                    });
            });
            $(window).unload( function(){
                    $.each( $.upload_file.beforeunload , function(index, value) {
                            delete_transient_file( value );
                    });
            });
            $("#insert_img_for_content").unbind('click').bind( 'click' , function() {
                    $.insert_type = "content";
                    $( "#change_img_select_modal" ).modal( "show" );
            });
            $("#insert_attach").unbind('click').bind( 'click' , function() {
                    $("#transient_file").click();
            });
            $('body.edit .demo').on("click","[data-target=#myModalforFBmovie]",function(e) {
                    $("#myModalforFBmovie").data("target", $(this).parent().parent().find(".view") );
            });
            $("#myModalforFB_movieYes").unbind('click').bind( 'click' , function() {
                    var fb_link = $("#FB_movie_input").val();
                    if( fb_link.search("fb-video") !== -1 )
                    {
                          fb_link = fb_link.split("/script>")[1];
                    }
                    $("#myModalforFBmovie").data("target").html( fb_link );
                    window.fbAsyncInit();
            });

            $("#remove_cover_img").unbind('click').bind( 'click' , function() {
                    $("#upload_now").css("background-image","");
                    $("#upload_now").parent().css("background","none");
                    $.page_cover = "";
            });
            
            $("#upload_cloud_disk").unbind('click').bind( 'click' , function() {
                    $("#my_cloud_disk").click();
            });

            $("#upload_cover_img").unbind('click').bind( 'click' , function() {
                    //$("#transient_file").click();
                    $.insert_type = "cover";
                    $( "#change_img_select_modal" ).modal( "show" );
            });
            
            $( "#attach_space tbody" ).delegate( ".delete" , "click" , function(){
                    var pos = $( this ).parent().parent( "tr" );
                    if( pos.attr("pos")==="member" ){
                            $.each( $.upload_file["insert_attach"] , function( index , value ){
                                    if( value.filename === pos.attr("file") ){
                                            $.upload_file["insert_attach"].splice(index, 1);
                                            pos.remove();
                                            return false;
                                    }
                            });
                    }
                    else if( pos.attr("pos")==="page" ){
                            $.del_page_file = pos.attr( "file" );
                            $( "#file_delete_modal" ).modal( "show" );
                    }
            });
            
            $("#file_delete_modal_yes").bind( 'click' , function() {
                    var data = {
                                token:      getCookie("help_cookie") ,
                                pf_id : $.del_page_file
                    };
                    var success_back = function( data ) {

                            data = JSON.parse( data );
                            console.log(data);
                            loading_ajax_hide();
                            if( data.success ) {
                                    $( "#attach_space tbody tr[file=" + data.data + "]" ).remove();
                                    $( "#file_delete_modal" ).modal( "hide" );
                            }
                            else {
                                    show_remind( data.msg , "error" );
                            }

                    }
                    var error_back = function( data ) {
                            console.log(data);
                    }
                    $.Ajax( "POST" , "php/page.php?func=delete_pagefile" , data , "" , success_back , error_back);
            });
            //page add tag ++
            $( "#ttshow_tag_name" ).bind( "keypress" , function(e){
                    if( e.which === 13 ){
                        $("#ttshow_tag_add").trigger('click');
                    }
            });
            $("#ttshow_tag_add").unbind('click').bind( 'click' , function() {
                    var tag = $("#ttshow_example_tag_model").clone();
                    tag.css("display","block");
                    tag.removeAttr("id");
                    tag.find("[id=text]").html( $("#ttshow_tag_name").val() );
                    tag.find("[id=delete]").unbind('click').bind( "click" , function(e) {
                            $(e.target).parent().remove();
                    });
                    $("#ttshow_tag_space").append( tag );
                    $("#ttshow_tag_space").append( $("#ttshow_tag_space .clearfix") );
            });
            //page add tag --
            
            //page publish ++
            $("#ttshow_publish_page").unbind('click').bind( 'click' , function() {
                    
                    var msg = "";
                    var bool = true;
                    if( $( "#ttshow_page_name" ).val() === "" ) {
                            bool = false;
                            $( "#ttshow_page_name" ).parent().addClass( "has-error" );
                            msg += msg === "" ? "請" : "、";
                            msg += "輸入文章標題";
                    }
                    else {
                            $( "#ttshow_page_name" ).parent().removeClass( "has-error" );
                    }
                    if( !$( "#ttshow_channel_select" ).val() ) {
                            bool = false;
                            msg += msg === "" ? "請" : "、";
                            msg += "選擇頻道";
                    }
                    if( !$( "#ttshow_category_select" ).val() ) {
                            bool = false;
                            msg += msg === "" ? "請" : "、";
                            msg += "選擇分類";
                    }
                    if( $( "#upload_now" ).css("background-image") === "none" ) {
                            bool = false;
                            msg += msg === "" ? "請" : "、";
                            msg += "上傳封面圖片";
                    }
                    if( $( "#ttshow_page_pre_html" ).val() === "" ) {
                            bool = false;
                            $( "#ttshow_page_pre_html" ).parent().addClass( "has-error" );
                            msg += msg === "" ? "請" : "、";
                            msg += "輸入文章未登入預覽文字";
                    }
                    else {
                            $( "#ttshow_page_pre_html" ).parent().removeClass( "has-error" );
                    }
                    if( !tinymce.activeEditor.getContent() ){
                            bool = false;
                            msg += msg === "" ? "請" : "、";
                            msg += "輸入文章內容";
                    }
                    
                    if( bool ) {
                        loading_ajax_show();
                        var state;
                        state = getParameterByName( "page" ) ? "modify" : "edit" ;
                        funbook19_publish( state );
                    }
                    else {
                        alert( msg );
                    }
                    
            });
            //page publish --
});

var ttshow_init_model = function( FilePath ) {
        
        $.all_data_inEdit = {};
        $.all_data_inEdit.img = [];
        $.all_data_inEdit.movie = []; 
        $("#channel_publish").parent().css("display","block");
}

var ttshow_login_event = function( data ) {
        $.member = data;
        var state;
        if( getParameterByName( "page" ) ){
                $.init_page = "modify"
        }
        else {
                $.init_page = "edit"
        }
        check_user_identity();
}

var check_user_identity = function() {
        var callback = function(){};
        var data = {};
        if( $.init_page == "modify" ) {
                data.func = "init";
                data.cmd = "init_modify";
                data.token = getCookie( "help_cookie" );
                data.page = getParameterByName( "page" );
                callback = ttshow_page;
        } else if( $.init_page == "edit" ) {
                data.func = "init";
                data.cmd = "init_edit";
                data.token = getCookie( "help_cookie" );
                callback = ttshow_page;
        }
        
        errorback = function( data ){
            console.log(data);
        };
        $.Ajax( "POST" , "php/editor.php" , data , "" , callback , errorback );    
}

var ttshow_page = function( data ) {
        try {
                var data = JSON.parse( data );
                console.log( data );
                if( data.success ) {
                        
                        ttshow_init_model();
                        $("#ttshow_channel_select").html("");
                        $("#ttshow_category_select").html("");
                        $("#ttshow_tag_space").html("");
                        $("#ttshow_tag_space").append('<div class="clearfix"></div>');
                        for(i=0;i<data.data.channel.length;i++) {
                                var opt = document.createElement('option');
                                opt.value = data.data.channel[i].ch_id;
                                opt.innerHTML = data.data.channel[i].ch_name;
                                //opt.style.color = data.data.channel[i].display === "none" ? "red" : "";
                                $("#ttshow_channel_select").append( opt );
                        }
                        for(i=0;i<data.data.category.length;i++) {
                                var opt = document.createElement('option');
                                opt.value = data.data.category[i].cate_id;
                                opt.innerHTML = data.data.category[i].cate_name;
                                if( data.data.category[i].cate_display === "none" )
                                    opt.style.color = "#d5d5d5";
                                $("#ttshow_category_select").append( opt );
                        }
                        
                        if( $.init_page === "edit" ){
                                $("#ttshow_publish_page").html("發布文章");
                                $("#ttshow_channel_select").val( $("#ttshow_channel_select option").eq(0).val() );
                                $("#ttshow_category_select").val( $("#ttshow_category_select option").eq(0).val() );
                                $("#ttshow_page_publish_time").html( new Date().toLocaleString() );
                                $("#ttshow_page_name").val( "" );
                                $("#ttshow_tag_name").val( "" );
                                $("#ttshow_page_pre_html").val( "" );
                                if( $( "[name=originality]" ).is( ":checked" ) ){ $( "[name=originality]" ).click() };
                                
                        }
                        else if( $.init_page === "modify" ){
                                $("#ttshow_publish_page").html("儲存文章");
                                $("#ttshow_page_publish_time").html( data.data.page.p_date );
                                $("#ttshow_page_name").val( data.data.page.p_title );
                                $("#upload_now").css("background-image","url(" + data.data.page.p_icon + ")");
                                var p_originality = data.data.page.p_originality === "1" ? true : false;
                                if( $( "[name=originality]" ).is( ":checked" ) !== p_originality ){ $( "[name=originality]" ).click() };
                                $("#ttshow_channel_select").val( data.data.page.p_channel_id );
                                $("#ttshow_category_select").val( data.data.page.p_category_id );
                                $( "#ttshow_page_pre_html" ).val( data.data.page.p_pre_html );
                                var tag_data = eval( data.data.page.p_tag );
                                for(i=0;i<tag_data.length;i++) {
                                        var tag = $("#ttshow_example_tag_model").clone();
                                        tag.css("display","block");
                                        tag.removeAttr("id");
                                        tag.find("[id=text]").html( tag_data[i] );
                                        tag.find("[id=delete]").unbind('click').bind( "click" , function(e) {
                                                $(e.target).parent().remove();
                                        });
                                        $("#ttshow_tag_space").append( tag );
                                        $("#ttshow_tag_space").append( $("#ttshow_tag_space .clearfix") );
                                }
                                //attach++
                                $.each( data.data.page.page_file , function( index , value ){
                                        buildAttach( value.pf_id , value.pf_original_name , value.pf_des , value.pf_download_num , "page" );
                                });
                                $( "#attach_space tbody [pos=page]" ).delegate( "input" , "change" , function(){
                                        var pos = $( this ).parent().parent( "tr" );
                                        pos.attr( "change" , "" );
                                });
                                //attach--
                                
                                $( "#editor_place_hide" ).html( data.data.page.p_edit_html );
                                $.each( $( "#editor_place_hide" ).find( "img[data-pos=page]" ) , function( index , value ) {
                                        //$( value ).attr( "data-pos" , "page" );
                                        $( value ).attr( "data-index" , $( value ).attr( "img_index" ) );
                                        if( $( value ).attr( "src" ).search( "http" ) === -1 ){
                                            $( value ).attr( "data-img" , $( value ).attr( "src" ) );
                                            $( value ).attr( "src" , "http://www.ggyyggy.com/funbook19/data/page/" + data.data.page.page_id + "/" + $( value ).attr( "src" ) );
                                        }
                                            
                                });
                                $.View.view_shelldata()._SetOpts({ putdata : $( "#editor_place_hide" ).html() });
                                $.View.view_shelldata().putFile();
                                //////////////
                                
                                loading_ajax_hide();
                        }
                        
                        loading_ajax_hide();
                } else {
                        if( data.msg === "Dont have channel" ){
                            show_remind( "沒有頻道，三秒後轉到申請頻道頁面。" , "error" );
                            setTimeout( function(){ location.href = "mgc_members_channel_setting.php" }, 3000);
                        }
                        else{
                            show_remind( data.msg , "error" );
                        }
                }
        }catch(e) {
                console.log(e);
        }
}

var funbook19_publish = function( state ) {
        loading_ajax_show();
        var data = process_publish_data( state );
        if( $.init_page === "modify" ){
                data.page_id = getParameterByName( "page" );
                //old attach update++
                var update_attach_des = [];
                $.each( $( "#attach_space tbody tr[change]" ) , function( index , value ){
                        update_attach_des[update_attach_des.length] = { pf_id : $(value).attr("file") , pf_des : $(value).find("input").val() };
                });
                data.update_attach_des = update_attach_des;
        }
        var callback = function(data) {
            console.log(data); 
            loading_ajax_hide();
            data = JSON.parse( data );
            if( data.success ){
                
                if( $.init_page === "modify" ){
                        show_remind( "修改成功" );
                }
                else if( $.init_page === "edit" ){
                        show_remind( "成功，開啟分頁設定FB分享照片，把文章網址複製上去即可，並三秒後轉跳到文章頁面。" );
                        window.open( "https://developers.facebook.com/tools/debug/" );
                        setTimeout( function(){
                            location.href = "v_article_info.php?p=" + data.data;
                        }, 3000);
                }
            }
            else{
                show_remind( data.msg , "error" );
            } 
        };
        errorback = function( data ){
            console.log(data);
        };
        $.Ajax( "POST" , "php/editor.php?func=publish" , data , "" , callback , errorback ); 
}

var process_publish_data = function( state ) {
        
        save_process();
        var tag_space = $("#ttshow_tag_space").children(":not(.clearfix)");
        var tag = [];
        for(var i=0; i< tag_space.length ; i ++ ) {
            var name = tag_space.eq(i).find("[id=text]").html();
            if( name != null && name != "" && name != undefined ) {
                tag[i] = name;
            }
        }
        tag = JSON.stringify( tag );
        //attach
        $.each( $.upload_file.insert_attach , function( index , value){
                $.upload_file.insert_attach[ index ][ "des" ] = $( "[file='" + value.filename + "'] input" ).val();
        });
        //
        var p_icon = $( "#upload_now" ).attr( "img" );
        p_icon = p_icon.split("/")[p_icon.split("/").length-1];
        
        var data = {
                p_channel_id : $("#ttshow_channel_select").val() ,
                p_category_id : $("#ttshow_category_select").val()[0] ,
                p_icon : p_icon ,
                p_title : $("#ttshow_page_name").val() ,
                p_pre_html : $("#ttshow_page_pre_html").val() ,
                p_html : $( "#editor_place_hide" ).html() ,
                p_edit_html : $.edit_html ,
                p_data : JSON.stringify( $.all_data_inEdit ) ,
                p_tag : tag ,
                p_annex : JSON.stringify( $.upload_file.insert_attach ) ,
                p_originality : $( "[name=originality]" ).is( ":checked" ) ,
                token : getCookie( "help_cookie" ) ,
                cmd : state
        };
        return data;
}



var init_subTab_url = function() {
        var href = "";
        if( $.getData.url == "true" ) {
            href = "?" + window.location.toString().split("?")[1];
        } else {
            if( $.getData.ch != null && $.getData.ch != undefined ) {
                href = "?ch=" + $.getData.ch;
            } else {
                href = "";
            }
        }
        $("#channel_homepage").attr( "href" , $("#channel_homepage").attr("href") + href );
        $("#channel_publish_page").attr( "href" , $("#channel_publish_page").attr("href") + href );
        $("#channel_list_page").attr( "href" , $("#channel_list_page").attr("href") + href );
        $("#channel_setting").attr( "href" , $("#channel_setting").attr("href") + href );
}

var display_loading_page = function() {
        $(window).scrollTop( 0 );
        $("#loadingpage").css("display","block");
        $("body").css("overflow","hidden");
}

var disable_loading_page = function() {
        $("#loadingpage").css("display","none");
        $("body").css("overflow","auto");
}


var ttshow_get_user_img = function() {
        var data = {
            token : getCookie( "help_cookie" )
        };
        callback = function( data ){
                try {
                        var data = JSON.parse( data );
                        if( data.success ) {
                                
                                var url = data.data.url;
                                delete data.data.url;
                                $.each( data.data , function(index, value) {
                                        var clone = $("#ttshow_img_list_example_model_2").clone();
                                        var clone_div = $("#ttshow_img_list_example_model").clone();
                                        clone.removeAttr("id");
                                        clone_div.removeAttr("id");
                                        //clone.attr("src", url + value );
                                        clone.attr("img", url + value);
                                        clone_div.attr("img", url + value);
                                        $("#ttshow_img_list_space").prepend( clone_div );
                                        $("#ttshow_img_list_space").prepend( clone );
                                });
                                console.log( data.data );
                                var div = $("#ttshow_img_list_space img[img]").eq(0);
                                div.attr("src", div.attr("img") );
                                div.removeAttr("img");

                                $.ttshow_change_img_event = function(e) {
                                        $("#ttshow_img_list_space div").css("border" , "1px solid black" );
                                        $("#ttshow_img_list_space div").removeAttr("target");
                                        $( e.target ).css("border" , "5px solid gray" );
                                        $( e.target ).attr("target","");
                                        $( "#delete_img" ).show();
                                }
                                var change = function() {
                                        //if( $("#ttshow_img_list_space img[img]").length != 0 ) {
                                                console.log( $("#ttshow_img_list_space img[img]").length );
                                                var div2 = $("#ttshow_img_list_space div[img]").eq(0);
                                                div2.css("background-image","url(\'" + div2.attr("img") + "\')");
                                                div2.css("display","block");
                                                div2.attr("src",div2.attr("img"));
                                                div2.removeAttr("img");
                                                div2.unbind('click').bind( 'click' , $.ttshow_change_img_event );

                                                if( $("#ttshow_img_list_space img[img]").length != 0 ) {
                                                    var div = $("#ttshow_img_list_space img[img]").eq(0);
                                                    div.attr("src", div.attr("img") );
                                                    div.removeAttr("img");
                                                    div.load( change );
                                                    div.error( change );
                                                }
                                        //}
                                };
                                div.load( change );
                                
                        } else {
                                show_remind( data.msg , "error" );
                        }
                        
                }catch(e) {
                        console.log(e);
                }
                console.log(data);
        };
        errorback = function( data ){
            console.log(data);
        };
        $.Ajax( "POST" , "php/editor.php?func=manage_img" , data , "" , callback , errorback );
}



function connected_callback( member ) {
    
            $.member = member;
            
            tinymce.init({"theme":"modern",
                    "height" : "480px" ,
                    "skin":"lightgray",
                    "language":"en",
                    "formats":{"alignleft":[{"selector":"p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li","styles":{"textAlign":"left"},"deep":false,"remove":"none"},{"selector":"img,table,dl.wp-caption","classes":["alignleft"],"deep":false,"remove":"none"}],"aligncenter":[{"selector":"p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li","styles":{"textAlign":"center"},"deep":false,"remove":"none"},{"selector":"img,table,dl.wp-caption","classes":["aligncenter"],"deep":false,"remove":"none"}],"alignright":[{"selector":"p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li","styles":{"textAlign":"right"},"deep":false,"remove":"none"},{"selector":"img,table,dl.wp-caption","classes":["alignright"],"deep":false,"remove":"none"}],"strikethrough":{"inline":"del","deep":true,"split":true}},
                    "fontsize_formats": "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
                    "relative_urls":false,
                    "remove_script_host":false,
                    "convert_urls":false,
                    "browser_spellcheck":true,
                    "fix_list_elements":true,
                    "entities":"38,amp,60,lt,62,gt",
                    "entity_encoding":"raw",
                    "extended_valid_elements" : "iframe[src|title|width|height|allowfullscreen|frameborder]",
                    "keep_styles":false,
                    "cache_suffix":"wp-mce-4109-20150505",
                    "preview_styles":"font-family font-size font-weight font-style text-decoration text-transform",
                    "end_container_on_empty_block":true,
                    "wpeditimage_disable_captions":false,
                    "wpeditimage_html5_captions":true,
                    "plugins":"charmap,colorpicker,code,hr,link,autolink,lists,media,paste,tabfocus,textcolor,fullscreen,wpautoresize,wpemoji,wpgallery,wpdialogs,wpview,youtube",
                    //"content_css":"http://www.ooxxoox.com/arod/wordpress/wp-includes/css/dashicons.min.css?ver=4.2.2,http://www.ooxxoox.com/arod/wordpress/wp-includes/js/tinymce/skins/wordpress/wp-content.css?ver=4.2.2,//fonts.googleapis.com/css?family=Noto+Sans%3A400italic%2C700italic%2C400%2C700%7CNoto+Serif%3A400italic%2C700italic%2C400%2C700%7CInconsolata%3A400%2C700&subset=latin%2Clatin-ext,http://www.ooxxoox.com/arod/wordpress/wp-content/themes/twentyfifteen/css/editor-style.css,http://www.ooxxoox.com/arod/wordpress/wp-content/themes/twentyfifteen/genericons/genericons.css",
                    //"content_css":"http://" + location.host + "/template/assets/css/ace.css",
                    "content_css":"http://www.ggyyggy.com/funbook19/template/css/style.css",
                    "selector":"#editor_place",
                    "resize":false,
                    "menubar":false,
                    "wpautop":true,
                    "indent":false,
                    "toolbar1":"bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,wplink",
                    "toolbar2":"formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,youtube",
                    "toolbar3":"fontsizeselect,code,wp_more,spellchecker,dfw,wp_adv,advlink,link,unlink",
                    "tabfocus_elements":"content-html,save-post",
                    "body_class":"content post-type-post post-status-auto-draft post-format-standard locale-zh-tw",
                    "wp_autoresize_on":true,
                    "add_unload_trigger":false,
                    "init_instance_callback":editor_init});
            
}

function unconnected_callback( data ) {
        loading_ajax_hide();
        show_remind( "未登入，三秒後轉跳到首頁。" , "error"  );
        // setTimeout( function(){ location.href = "v_index.php" }, 3000);
}

function editor_init(inst) {
        $(document).ready(function() {
                ttshow_login_event( $.member );
        });
}

function save_process() {
            
            var html = tinymce.activeEditor.getContent();
            $( "#editor_place_hide" ).html( html );
            html = $( "#editor_place_hide" );
            
            $.all_data_inEdit.img = {};
            $.all_data_inEdit.movie = {};
            var img_index = 0;
            var ifame_index = 0;
            var exist_index = [];
            $.each( html.find( "img[data-pos=page]" ) , function( index , value ) {
                    exist_index[ exist_index.length ] = parseInt( $( value ).attr( "data-index" ) );
                    $( value ).attr( "src" , $( value ).attr( "data-img" ) );
            });
            $.each( html.find( "img[data-pos=member]" ) , function( index , value ) {

                    while(1) {
                        if( $.inArray( img_index , exist_index ) === -1 ) {
                            break;
                        }
                        else {
                            img_index++;
                        }
                    }
                    
                    var tag = $( value );
                    var src = tag.attr("src");
                    src = src.substr(src.lastIndexOf("/")+1,src.length);
                    var src_type = src.split(".")[src.split(".").length-1];///bohan++
                    tag.attr("img_index", img_index );
                    
                    var tag_count = 0;
                    var tag_src = "";
                    var tag_http = "";
                    var get_ = function( src , count ) {
                        if( src.indexOf("../") != -1 ) {
                            src = src.replace("../","");
                            count++;
                            get_( src , count );
                        } else {
                            tag_src = src;
                            tag_count = count;
                            return 0;
                        }
                    };
                    var release_get_ = function( src , count ) {
                        if( count != -1 ) {
                            src = src.substr( 0 , src.lastIndexOf("/") );
                            count--;
                            release_get_( src , count );
                        } else {
                            tag_http = src + "/";
                            return 0;
                        }
                    }
                    if( tag.attr("src").indexOf("../") != -1 ) {
                        var img_src = get_( tag.attr("src") , 0 );
                        var http = release_get_( window.location.href  , tag_count );
                        tag_src = tag_http + tag_src;
                        console.log( tag_src );
                    } else {
                        tag_src = tag.attr("src");
                    }

                    $.all_data_inEdit.img[img_index] = tag_src;
                    //tag.attr("src" , "image_" + img_index );
                    tag.attr("src" , "image_" + img_index + "." + src_type );//bohan++
                    tag.attr( "data-pos" , "page" );//bohan++
                    tag.css("max-width","100%");
                    //tag.attr( "data-pos" , "page" );
                    img_index++;
            });
            $.edit_html = $( "#editor_place_hide" ).html();
            
            $.each( html.find( "img[data-video=youtube]" ) , function( index , value ) {
                        var tag = $( value );
                        
                        var iframe_html = '<div class="youtobe_video" style="">' +
                                            '<div style="max-width: 100%; width:' + tag.attr( "width" ) + 'px; position: relative; float: none" name="u2_player">' +/*text-align: center; margin-right: auto; margin-left: auto; */
                                                    '<iframe src="//www.youtube.com/embed/' + tag.attr( "data-id" ) + '" mmtype="[\'youtube\']" key="video" mmid="1" style="border: none; margin-left: auto; margin-right: auto; height: 100%; width:100%;"></iframe>' +
                                            '</div>' +
                                        '</div>';
                        
                        /*var iframe_html = '<div class="youtobe_video">' +
                                                '<iframe style="max-width:100%;" width="' + tag.attr( "width" ) + '" height="' + tag.attr( "height" ) + '" src="https://www.youtube.com/embed/' + tag.attr( "data-id" ) + '" frameborder="0" allowfullscreen></iframe>' +
                                            '</div>';*/
                        $.all_data_inEdit.movie[ifame_index] = 'https://www.youtube.com/embed/' + tag.attr( "data-id" );
                        tag.after( iframe_html );
                        ifame_index++;
            });
            html.find( "img[data-video=youtube]" ).remove();
            
            console.log( $.all_data_inEdit );
            
}

function buildAttach( FileName , OriName , Descri , DownloadNum , Pos ){
        //新上傳FileName是日期檔名，編輯的FileName是資料庫File ID
        var tmp = '<tr file="' + FileName + '" pos="' + Pos + '" role="row" class="odd child-middle" style="">' +
                        '<td>' + OriName + '</td>' +
                        '<td><input type="text" size="6" value="' + Descri + '" class="px"></td>' +
                        '<td>' + DownloadNum + '</td>' +
                        '<td><a class="delete">x</a></td>' +
                    '</tr>';
        $( "#attach_space tbody" ).append( tmp );
        
}