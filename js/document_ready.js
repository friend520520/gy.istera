

/* a bin ++ 2014.7.24 edit*/
var jsonFlickrFeed = function(data) {
            $.http_cds_json_file_data = data;
}
$(document).ready(function() {
            
            $.View = $("body");
            $.View.view_shelldata();
            $.View.view_sidebar();
            $.view_motion_view_flip_index = $( "body" ) ;
           
            $('#ChromeModalaaa')
            .on('show.bs.modal', function (e) {
                        console.log(123);
            })
            .on('hidden.bs.modal', function (e) {
                        console.log(456);
            });
            //bohan++ 20140416
            
            $('#myModalforTemplate')
            .on('show.bs.modal', function (e) {
                        
                        $.ajax({
                                    type    : "POST",  
                                    url     : "jsk/ProjectManagement.JSK?func=ListTemplate" ,  
                                    data    : {
                                    },
                                    success: function(data) {
                                                //console.log( data );
                                                console.log( eval( '[' + data + ']' ) );
                                                var tmp_data = eval( '[' + data + ']' ) ;
                                                
                                                if( tmp_data[0].status == "false" )
                                                {
                                                                
                                                }
                                                else if( tmp_data[0].status == "true" )
                                                {
                                                            var tmp_html = "" ;
                                                            
                                                            $.each( eval( tmp_data[0].list ) , function(index, value) {
                                                                        if( value != "@DesignerTemplate" )
                                                                        tmp_html += '<li class="project drag_pro" segment="1" focus_pro="' + value + '" focus_background-image="http://' + $.publish_domain + '/' + $.user_profile_uid + '/@DesignerTemplate/' + value + '/@TemPublish/v/detail/web.jpg">' +
                                                                                                '<div style="background-image:url(\'http://' + $.publish_domain + '/' + $.user_profile_uid + '/@DesignerTemplate/' + value + '/@TemPublish/v/detail/web.jpg\');">' +
                                                                                                '<p><a href="http://' + $.publish_domain + '/' + $.user_profile_uid + '/@DesignerTemplate/' + value + '/index.html" target="_blank" >' + value + '</a></p>' +
                                                                                    '</li>' ;
                                                            });
                                                            $( "#MyTemplate_Page_1_Project" ).html( tmp_html );
                                                            

                                                            $( "#MyTemplate_Page_1_Project" ).children( "li" ).children( "div" )
                                                            .unbind('mousedown').bind( 'mousedown' , function() {

                                                                        console.log( $(this) );
                                                                        var tmp_focus = $(this).parent();

                                                                        tmp_focus.parent().children( "li" ).removeClass( "selected" ).removeClass( "removed" );
                                                                        tmp_focus.addClass( "removed" );

                                                            })
                                                            .unbind('dblclick').bind( 'dblclick' , function() {

                                                                        console.log( $(this) );
                                                                        var tmp_focus = $(this).parent();

                                                                        $( "#Page_1_project ul li" ).removeClass( "selected" ).removeClass( "removed" );
                                                                        $( "#Page_1_project ul li.project_add" ).addClass( "selected" );

                                                                        $( "#menu_project_edit_open" ).hide();
                                                                        $( "#menu_user_project" ).hide();
                                                                        
                                                                        $( "#Page_2 [value=Next]" ).attr( "status" , "template" );
                                                                        $( "#Page_1 [value=Next]" ).eq(0).trigger('mousedown');

                                                                        $( "#myModalforTemplate" ).modal( "hide" );

                                                            });
                                                            
                                                            // $( "#Page_1_project .divFloatContainer" )

                                                }
                                    }
                        });
            
                
            })
            .on('hidden.bs.modal', function (e) {
                        console.log(456);
            });
            
            
            //bohan-- 20140416
            /* a bin ++ 2014.0408.1500  */
            $('#myModalaaa')
            .on('show.bs.modal', function (e) {
                        console.log(123);
            })
            .on('hidden.bs.modal', function (e) {
                        eval($.View.modal_router().options().destroy);
                        $.View.modal_router().destroy();
                        console.log(456);
            });
            
            $( ".preview" ).unbind('mouseover').bind( 'mouseover' , function() {
                        
            });

            $( "#menu_project_edit_close_delete" ).unbind('mousedown').bind( 'mousedown' , function() {
                
                        $( "#myModalforAlarmBoxTitle" ).html( "Are You Sure Delete This App ?" );
                        
                        $("#myModalforAlarmBox").modal( "show" );
                        $( "#myModalforAlarmBoxYes" ).unbind('mousedown').bind( 'mousedown' , function() {

                                    var tmp_focus = $( "#Page_1_project .divFloatContainer" ).children( "li.removed" ) ;
                                    if( tmp_focus.length > 0 )
                                    {
                                                var tmp = tmp_focus.attr( "focus_pro" );
                                                //abin edit 2015.3.30 ++
                                                //delete dir
                                                $.ajax({
                                                            type : "POST",
                                                            url : "ForTTShow/pageedit_delete_project.php" ,
                                                            async: true ,
                                                            data : {
                                                                project : encodeURI(tmp) ,
                                                            },
                                                            success : function(data) { 
                                                                    if( data == "true" ) {
                                                                            $.ajax({
                                                                                        type : "POST",
                                                                                        url : "ForTTShow/pageedit_list_project.php" ,
                                                                                        async: true ,
                                                                                        data : { },
                                                                                        success : function(data) { 
                                                                                                if( data != "false" ) {
                                                                                                        var msg = JSON.parse( data );
                                                                                                        msg = msg.Msg[0].Data.body.fs
                                                                                                        console.log( msg );
                                                                                                        $.View.view_shelldata()._SetOpts({ putdata : msg });
                                                                                                        $.View.view_shelldata().putQuery();
                                                                                                        $( "#menu_project_edit_close_start" ).trigger( "mousedown" );
                                                                                                }
                                                                                        } ,
                                                                                        error : function(data) { console.log(data); }
                                                                            });
                                                                    }
                                                            } ,
                                                            error : function(data) { console.log(data); }
                                                });
                                                //abin edit 2015.3.30 --
                                    }

                        });
                        
                        $( "#myModalforAlarmBoxNo" ).unbind('mousedown').bind( 'mousedown' , function() {
                                    $("#myModalforAlarmBox").modal( "hide" );
                        });
                        
                
                                        
            });
            
            $( "#menu_project_edit_close_start" ).unbind('mousedown').bind( 'mousedown' , function() {
                    
                        $( "#menu_project_edit_open" ).show();
                        $( "#menu_project_edit_close" ).hide();
                                        
                        $( "#menu_project_edit_open_start" ).attr( "edit" , "false" );
                        $( ".navbar-inner" ).css( "background-image" , "linear-gradient(to bottom, #222222, #111111)" );

                        $( "#menu_project_edit_modify" ).hide();
                        $( "#menu_project_edit_delete" ).hide();
                        $( "#Page_1_project .divFloatContainer" ).children( "li.project_add" ).show();


                        $( "#Page_1_project .divFloatContainer" ).children( "li.removed" ).removeClass( "removed" ).addClass( "selected" );

                        if( $( "#Page_1_project .divFloatContainer" ).children( "li.selected" ).length > 1 )
                        {
                                    $( "#Page_1_project .divFloatContainer" ).children( "li.project_add" ).removeClass( "selected" );
                        }
                        else if( $( "#Page_1_project .divFloatContainer" ).children( "li.selected" ).length == 0 )
                        {
                                    $( "#Page_1_project .divFloatContainer" ).children( "li.project_add" ).addClass( "selected" );
                        }
                                        
            });
                    
            $( "#menu_project_edit_open_start" ).unbind('mousedown').bind( 'mousedown' , function() {
                
                        $( "#menu_project_edit_open" ).hide();
                        $( "#menu_project_edit_close" ).show();

                        $( "#menu_project_edit_open_start" ).attr( "edit" , "true" );
                        $( ".navbar-inner" ).css( "background-image" , "linear-gradient(to bottom, #222222, #666666)" );

                        $( "#menu_project_edit_modify" ).show();
                        $( "#menu_project_edit_delete" ).show();
                        $( "#Page_1_project .divFloatContainer" ).children( "li.project_add" ).hide();

                        $( "#Page_1_project .divFloatContainer" ).children( "li.selected" ).removeClass( "selected" ).addClass( "removed" );

                        if( 
                                    $( "#Page_1_project .divFloatContainer" ).children( "li.project_add" ).hasClass( "removed" ) 
                                    ||
                                    $( "#Page_1_project .divFloatContainer" ).children( "li.project.removed" ).length == 0
                        )
                        {
                                    $( "#Page_1_project .divFloatContainer" ).children( "li.project" ).eq(0).addClass( "removed" );
                        }
                        
            });

            $( "#menu_appbuilder" ).unbind('mousedown').bind( 'mousedown' , function() {
                        $( "#menu_user_profile_project" ).show();
                        
                        $("#DropMeLeftSide0").hide();
                        $("#LeftSide").show();
                        
                        $( "body" ).trigger('init');
                        ypcloudInit();
                        //$( "body" ).trigger('get_user_profile');
                        
            });      
                    
            //abin edit 2015.4.2 ++
            $( "body" ).unbind('init').bind( 'init' , function() {
                        
                        $( "#Page_1_project .divFloatContainer" ).children( "li" ).children( "div" ).unbind('click').bind( 'click' , function() {
                                    console.log( $(this) );
                                    
                                    var tmp_focus = $(this).parent();

                                    if( $( "#menu_project_edit_open_start" ).attr( "edit" ) != "true" )
                                    {
                                                tmp_focus.parent().children( "li" ).removeClass( "selected" ).removeClass( "removed" );
                                                tmp_focus.addClass( "selected" );

                                                $( "#menu_project_edit_open" ).hide();

                                                var tmp = $( "#Page_1 ul .selected" ) ;
                                                if( tmp.hasClass( "project" ) == true )
                                                {
                                                            $( "#Page_2 [value=Next]" ).eq(0).trigger('mousedown');
                                                }
                                                else if( tmp.hasClass( "project_add" ) == true )
                                                {
                                                            $( "#Page_1 [value=Next]" ).eq(0).trigger('mousedown');
                                                }
                                    }else{
                                                tmp_focus.parent().children( "li" ).removeClass( "selected" ).removeClass( "removed" );
                                                tmp_focus.addClass( "removed" );
                                    }
                                    
                                    $("#menu_return_project").css("display","block");
                                    $( "#Page_2 [value=Next]" ).removeClass( "disabled" );
                                    $( "#Page_2 [value=Next]" ).html("Next");
                        });
            });
            //abin edit 2015.4.2 --
            $( "body" ).trigger('init');
            
            
            $( ".divFloatContainer[page_1_type=new] , .divFloatContainer[page_1_type=project],\n\
                .divFloatContainer[page_1_type=theme] , .divFloatContainer[page_1_type=mylove]" ).css( "min-height" , "151px" );
            

            $("#menu_close_tool").click(function() {
                        if( $(this).attr( "hasopen" ) == undefined || $(this).attr( "hasopen" ) == "0"  )
                        {
                                    $(this).attr( "hasopen" , "1" );
                                    
                                    $( "body" ).css( "margin-left" , "1px" );
                                    $( ".tool" ).hide();
                                    
                                    $(this).find( ".glyphicon" ).removeClass( "glyphicon-circle-arrow-left" ).addClass( "glyphicon-circle-arrow-right" );
                                    
                        }else{
                                    $(this).attr( "hasopen" , "0" );
                                    
                                    $( "body" ).css( "margin-left" , "230px" );
                                    $( ".tool" ).show();

                                    $(this).find( ".glyphicon" ).removeClass( "glyphicon-circle-arrow-right" ).addClass( "glyphicon-circle-arrow-left" );
                                    
                        }
            });
            
            
            $("[id=menu_return_project]").click(function() {
                        
                        $( "#myModalforAlarmBoxTitle" ).html( "Do You Want to Save This App ?" );
                
                        if( $.all_data_inEdit.UserName != undefined )
                        {  
                                    $( "#myModalforAlarmBox" ).modal( "show" );
                                    $( "#myModalforAlarmBoxYes" ).unbind('mousedown').bind( 'mousedown' , function() {
                                                
                                                $( "#menu_user_project" ).show();
                                                
                                                $("#myModalforAlarmBox").modal( "hide" );
                                                /*
                                                $( "#menu_return_save" ).trigger( "click" );
                                                */
                                                $( "#myModalforAlarmBoxNo" ).trigger('mousedown');

                                    });
                                    $( "#myModalforAlarmBoxNo" ).unbind('mousedown').bind( 'mousedown' , function() {
                                                
                                                /*if( $( "#main_container" ).hasClass( "myclassfor" + $.focus_projectname.split(" ").join("") ) )
                                                        $( "#main_container" ).removeClass( "myclassfor" + $.focus_projectname.split(" ").join("") );*/
                                                    
                                                if( $.focus_projectname != undefined )
                                                removejscssfile( 'http://' + $.publish_domain + '/' + $.uid + '/builder/' + $.focus_projectname + '/css/extent.css', 'css');
                                                
                                                if( $.focus_templatename != undefined )
                                                removejscssfile( 'http://' + $.publish_domain + '/' + $.uid + '/builder/@DesignerTemplate/' + $.focus_templatename + '/css/extent.css', 'css');
                                                
                                                $.focus_projectname     = undefined ;
                                                $.focus_templatename    = undefined ;
                                                $.focus_cssname         = undefined ;
                                                document.title = "@AppBuilder";
                                                
                                                $( "#menu_user_project" ).show();
                                                
                                                $("#myModalforAlarmBox").modal( "hide" );
                                                
                                                
                                                $( "#menu_project2dropme" ).hide();

                                                $( "#menu_close_tool" ).hide();
                                                

                                                $( "body" ).children( ".container-full" ).effect( "drop" );

                                                $( "#main_start_setting" ).fadeIn();
                                                $( "#LeftSide" ).fadeIn();
                                                $( "#rightSide" ).fadeIn();

                                                $( "#Pager li" ).removeClass( "start" ).removeClass( "finish" );
                                                $( "#Pager [tab=Page_1]" ).addClass( "start" );


                                                $( "#Page_2" ).effect( "drop" );
                                                $( "#Page_1" ).fadeIn();

                                                $( "body" ).css( "margin-left" , "0px" );

                                                //ypcloudInit();
                                                $.ajax({
                                                            type : "POST",
                                                            url : "ForTTShow/pageedit_list_project.php" ,
                                                            async: true ,
                                                            data : { },
                                                            success : function(data) { 
                                                                    if( data != "false" ) {
                                                                            var msg = JSON.parse( data );
                                                                            msg = msg.Msg[0].Data.body.fs
                                                                            console.log( msg );
                                                                            $.View.view_shelldata()._SetOpts({ putdata : msg });
                                                                            $.View.view_shelldata().putQuery();
                                                                    }
                                                            } ,
                                                            error : function(data) { console.log(data); }
                                                });

                                                $( "#menu_project2dropme" ).hide();
                                                $( "#menu_builder, #menu_return_project" ).hide();
                                                $( "#menu_home" ).show();
                                                
                                                $( "menu_user_profile_project" ).show();

                                                $( "#DropMePager [tab=DropMe_Page_3]" ).hide();
                                                $( "#DropMePager [tab=DropMe_Page_1]" ).trigger( "mousedown" );

                                    });
                        }
                        else
                        {
                                    removejscssfile( 'http://' + $.publish_domain + '/' + $.uid + '/builder/' + $.focus_projectname + '/css/extent.css', 'css');

                                    $( "#menu_project2dropme" ).hide();

                                    $( "#menu_close_tool" ).hide();

                                    $( "body" ).children( ".container-full" ).effect( "drop" );

                                    $( "#main_start_setting" ).fadeIn();
                                    $( "#LeftSide" ).fadeIn();
                                    $( "#rightSide" ).fadeIn();

                                    $( "#Pager li" ).removeClass( "start" ).removeClass( "finish" );
                                    $( "#Pager [tab=Page_1]" ).addClass( "start" );


                                    $( "#Page_2" ).effect( "drop" );
                                    $( "#Page_1" ).fadeIn();

                                    $( "body" ).css( "margin-left" , "0px" );

                                    //ypcloudInit();

                                    $( "#menu_project2dropme" ).hide();
                                    $( "#menu_builder, #menu_return_project" ).hide();
                                    $( "#menu_home" ).show();

                                    $( "#DropMePager [tab=DropMe_Page_3]" ).hide();
                                    $( "#DropMePager [tab=DropMe_Page_1]" ).trigger( "mousedown" );
                        }
            });
            
});