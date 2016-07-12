/*
            jQuery jclock - jquery.rotate.bala plugin - v 0.0.1

            // include


            // init
            $.view_motion_view_flip_index.motion_view_flip()._SetOpts({ focus : $( value ) , mmtype : mmtype });
            $.view_motion_view_flip_index.motion_view_flip().aaa();
            
            phoebe 1.2.1
            bala   1.2.2
*/
(function($) {
            $.view_create_app = $.view_create_app || { version:'1.2.1' };
            var view_create_app = function(dom,opts) { //[--plugin define
                    var me=$(dom);
                    // public methods
                    $.extend(this, {
                                init: function() {
                                        init();
                                },
                                destroy: function() {
                                        
                                },
                                init_builder: function() {
                                        init_builder();
                                },
                                
                                options: function() {
                                        return opts;
                                },
                                _SetOpts: function( options ) {
                                        $.extend(opts,options);
                                }
                    });
                    
                    function destroy()
                    {  
                    } 
                    
                    function init_builder()
                    {
                                $( "#Page_2" ).effect( "drop" );

                                $( "#main_start_setting" ).hide();
                                $( "#LeftSide" ).effect( "drop" );
                                $( "#rightSide" ).effect( "drop" );


                                //$( "body" ).children( ".navbar" ).fadeIn();
                                //$( "body" ).children( ".container-full" ).fadeIn();
                                $( "body" ).children( ".container-full" ).fadeIn();


                                $( "#Pager li" ).removeClass( "start" ).removeClass( "finish" );
                                $( "#Pager [tab=Page_1]" ).addClass( "finish" );
                                $( "#Pager [tab=Page_2]" ).addClass( "start" );


                                 $( "body" ).css( "margin-left" , "230px" );
                                 
                                 $( ".sidebar-nav" ).hide();
                                 $( ".sidebar-nav" ).eq(0).show();
                                 $( ".sidebar-nav[layer_id=1]" ).show();


                                 
                                 if( $( "body" ).attr( "hasloadyepnope" ) == undefined )
                                 {
                                            $( "body" ).attr( "hasloadyepnope" , "true" );
                                            yepnope([{
                                                        nope: "backend/js/tinymce/js/tinymce/tinymce.min.js",
                                                        complete: function() {
                                                            
                                                                    console.log("tinymce loading finish !!");

                                                                    tinymce.init({

                                                                                selector: "textarea#elm1",
                                                                                theme: "modern",
                                                                                /*width:  1195,*/
                                                                                width:  '100%',
                                                                                height: 300,
                                                                                plugins: [
                                                                                            "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                                                                                            "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                                                                                            "save table contextmenu directionality emoticons template paste textcolor"
                                                                                ],
                                                                                //content_css: "manual/css/custom_theme_content.css",
                                                                                content_css: "",
                                                                                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
                                                                                style_formats:
                                                                                [
                                                                                            {title: 'Bold text', inline: 'b'},
                                                                                            {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                                                                                            {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                                                                                            {title: 'Example 1', inline: 'span', classes: 'example1'},
                                                                                            {title: 'Example 2', inline: 'span', classes: 'example2'},
                                                                                            {title: 'Table styles'},
                                                                                            {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                                                                                ],
                                                                                //abin ++ 7.9 http://www.tinymce.com/wiki.php/configuration:valid_elements
                                                                                //http://stackoverflow.com/questions/6266487/tinymce-allow-all-html-tag
                                                                                valid_elements : '*[*]',
                                                                                //abin -- 7.9 
                                                                    }); 
                                                        }
                                            }]);
                                     
                                 }
                             

                                 $.View.view_sidebar()._SetOpts({ id : "1" });
                                 $.View.view_sidebar().init_sidebar_from_id();
                                 $.View.view_sidebar()._SetOpts({ id : "2" });
                                 $.View.view_sidebar().init_sidebar_from_id();
                                 $.View.view_sidebar()._SetOpts({ id : "3" });
                                 $.View.view_sidebar().init_sidebar_from_id();
                        
                    }
                    
                    function init() 
                    {
                        
                                    $( "#Pager [tab=Page_1]" ).unbind('mousedown').bind( 'mousedown' , function() {

                                               $( "#Page_2" ).effect( "drop" );
                                               $( "#Page_1" ).fadeIn();

                                               $( "#Pager li" ).removeClass( "start" ).removeClass( "finish" );
                                               $( "#Pager [tab=Page_1]" ).addClass( "start" );

                                   });
                                   
                                    $( "#Page_1 [value=Next] , #Pager [tab=Page_2]" ).unbind('mousedown').bind( 'mousedown' , function() {
                                        
                                                console.log( $(this) );
                                                
                                                var tmp = $( "#Page_1 ul .selected" ) ;

                                                if( tmp.hasClass( "project" ) == true )
                                                {
                                                            $( "#Page_2_nameyourapp" ).hide();
                                                            $( "#Page_2_yourproject" ).show();
                                                }
                                                else if( tmp.hasClass( "project_add" ) == true )
                                                {
                                                            $( "#Page_2_nameyourapp" ).show();
                                                            $( "#Page_2_yourproject" ).hide();
                                                            
                                                            // init banner
                                                            $( "#menu_project2dropme" ).show();
                                                            $( "#menu_builder, #menu_return_project" ).hide();
                                                            $( "#menu_home" ).show();
                                                            
                                                            $( "#DropMePager [tab=DropMe_Page_3]" ).hide();
                                                            $( "#DropMePager [tab=DropMe_Page_1]" ).trigger( "mousedown" );
                                                }

                                                $( "#Page_1" ).effect( "drop" );
                                                $( "#Page_2" ).fadeIn();

                                                $( "#Pager li" ).removeClass( "start" ).removeClass( "finish" );
                                                $( "#Pager [tab=Page_1]" ).addClass( "finish" );
                                                $( "#Pager [tab=Page_2]" ).addClass( "start" );

                                                $( "#Page_2_nameyourapp_input" ).val( '' );
                                                
                                                //abin edit 2015.3.26 ++
                                                $( "#Page_2 [value=Next]" ).removeAttr("disabled");
                                                //abin edit 2015.3.26 --
                                   });
                                   
                                   
                                   $( "body" ).css( "margin-left" , "0px" );
                                   
                                   $( "#Page_2 [value=Next]" ).unbind('mousedown').bind( 'mousedown' , function() {

                                                console.log( $(this) );
                                                
                                                var tmp = $( "#Page_1 ul .selected" );
                                                
                                                if( tmp.hasClass( "project" ) == true )
                                                {
                                                    
                                                            // insert project profile
                                                            $.focus_projectname = $( "#Page_1_project .divFloatContainer .project.selected" ).attr( "focus_pro" ) ;
                                                            document.title = "@AppBuilder - " + $.focus_projectname ;
                                                            //abin edit 2015.3.26 ++
                                                            $.ajax({
                                                                        type : "POST",
                                                                        url_mail : "ForTTShow/pageedit_open_project.php" ,
                                                                        async: true ,
                                                                        data : {
                                                                            project : encodeURI($.focus_projectname) ,
                                                                        },
                                                                        success : function(data) { 
                                                                                console.log( data );
                                                                                if( data != "false" ) {
                                                                                        $.View.view_shelldata()._SetOpts({ putdata : data });
                                                                                } else {
                                                                                        $.View.view_shelldata()._SetOpts({ putdata : "" });
                                                                                }
                                                                                $.View.view_shelldata().putFile();
                                                                        } ,
                                                                        error : function(data) { console.log(data); }
                                                            });
                                                            /*
                                                            $.ajax({  
                                                                        type    : "POST",  
                                                                        url     : "jsk/DownLoad.JSK?func=DownloadFile" ,  
                                                                        data    :
                                                                        {
                                                                                    uid             : $.uid ,
                                                                                    projectname     : 'builder' + '/' + $.focus_projectname  
                                                                        },
                                                                        success: function(data) {
                                                                                    console.log( data );

                                                                                    $.View.view_shelldata()._SetOpts({ putdata : data });
                                                                                    $.View.view_shelldata().putFile();
                                                                        }
                                                            });
                                                            */
                                                            //abin edit 2015.3.26 --
                                                            
                                                            $( "#menu_project2dropme" ).hide();
                                                            $( "#menu_builder, #menu_return_project" ).show();
                                                            $( "#menu_home" ).hide();
                                                            
                                                            $( "#menu_user_profile_project" ).hide();
                                                            
                                                            $( "#menu_close_tool" ).show();
                                                            
                                                            $( "#DropMePager [tab=DropMe_Page_3]" ).show();
                                                            
                                                } 
                                                else if( tmp.hasClass( "project_add" ) == true )
                                                {
                                                            console.log( "testtest" );
                                                            
                                                            if( $( "#Page_2_nameyourapp_input" ).val() == "" )
                                                            {
                                                                        alert( 'please input your app name .. ' );
                                                            }/*
                                                            else if( $( "#Page_2 [value=Next]" ).attr( "status" ) == "template"  )
                                                            {
                                                                        $( "#Page_2 [value=Next]" ).button('loading');
                                                                
                                                                        $( "#Page_2 [value=Next]" ).attr( "status" , "" );
                                                                        
                                                                        $.focus_projectname = $( "#Page_2_nameyourapp_input" ).val();
                                                                        document.title = "@AppBuilder - " + $.focus_projectname ;
                                                                        
                                                                        // ------------------------------
                                                                        
                                                                        $.Shell.CreateFolder( "shell@ypdrive" , "myapps" , "/builder -token " + $.loginmsg.uid ,
                                                                        function( msg ){
                                                                            
                                                                                    console.log( msg ) ;
                                                                                    console.log( 'PutMsg success' );
                                                                                    if( msg.ErrCode == "0" )
                                                                                    $.mm.GetMsg( "5000" , msg.MsgID , function( msg ) {
                                                                                                console.log( msg ) ;
                                                                                    });

                                                                        });
                                                                        
                                                                        
                                                                        $.Shell.CreateFolder( "shell@ypdrive" , "myapps" , "/builder/" + $.focus_projectname + " -token " + $.loginmsg.uid ,
                                                                        function( msg ){
                                                                            
                                                                                    console.log( msg ) ;
                                                                                    console.log( 'PutMsg success' );

                                                                                    if( msg.ErrCode == "0" )
                                                                                    $.mm.GetMsg( "5000" , msg.MsgID , function( msg ) {
                                                                                        
                                                                                                console.log( msg );
                                                                                                if( msg.ErrCode == "0" )
                                                                                                {
                                                                                                            $.focus_templatename = $( "#MyTemplate_Page_1_Project li.removed" ).attr( "focus_pro" ) ;

                                                                                                            loadjscssfile( 'http://' + $.publish_domain + '/' + $.uid + '/builder/@DesignerTemplate/' + $.focus_templatename + '/css/extent.css', 'css');


                                                                                                            removejscssfile( 'http://' + $.publish_domain + '/' + $.uid + '/builder/@DesignerTemplate/' + $.focus_templatename + '/js/app.js', 'js');
                                                                                                            loadjscssfile( 'http://' + $.publish_domain + '/' + $.uid + '/builder/@DesignerTemplate/' + $.focus_templatename + '/js/app.js', 'js');
                                                                                                            console.log( "MainHtmlTemplate" );


                                                                                                            $.ajaxq(    "MainHtmlTemplate" 
                                                                                                                        ,
                                                                                                                        {  
                                                                                                                        type    : "POST",  
                                                                                                                        url     : "jsk/ProjectManagement.JSK?func=GetMainHtmlTemplate" ,  
                                                                                                                        data    :
                                                                                                                        {
                                                                                                                                    templatename : $.focus_templatename
                                                                                                                        },
                                                                                                                        success: function(data) 
                                                                                                                        {
                                                                                                                                    init_builder();


                                                                                                                                    $.builder_container_destroy();
                                                                                                                                    $( "#main_container" ).html( "" );
                                                                                                                                    $( "#main_container" ).html( data );

                                                                                                                                    $.builder_container_init();
                                                                                                                        }
                                                                                                                        ,error: function(data) 
                                                                                                                        {
                                                                                                                        }
                                                                                                            });



                                                                                                            $( "#menu_project2dropme" ).hide();
                                                                                                            $( "#menu_builder, #menu_return_project" ).show();
                                                                                                            $( "#menu_home" ).hide();

                                                                                                            $( "#menu_user_profile_project" ).hide();

                                                                                                            $( "#menu_close_tool" ).show();


                                                                                                            $( "#DropMePager [tab=DropMe_Page_3]" ).show();
                                                                                                    
                                                                                                }

                                                                                                
                                                                                    }
                                                                                    , function( msg ) {
                                                                                                console.log( 'GetMsg error' );
                                                                                    });

                                                                        } ,  function( msg ){} );
                                                                        
                                                            }*/
                                                            else
                                                            {
                                                                        $( "#Page_2 [value=Next]" ).button('loading');
                                                                        $.focus_projectname = $( "#Page_2_nameyourapp_input" ).val();
                                                                        document.title = "@AppBuilder - " + $.focus_projectname ;
                                                                        
                                                                        // $.Shell.CreateFolder( "shell@ypdrive" , "uid" , "/path" );
                                                                        //abin edit 2015.3.26 ++
                                                                        //create folder    $.focus_projectname
                                                                        /*
                                                                        $.ajax({
                                                                                    type : "POST",
                                                                                    url : "mk_dir.php" ,
                                                                                    async: true ,
                                                                                    data : {

                                                                                    },
                                                                                    success : function(data) { 
                                                                                            console.log( data );
                                                                                    } ,
                                                                                    error : function(data) { console.log(data); }
                                                                        });
                                                                        */
                                                                       //get input value
                                                                        $.ajax({
                                                                                    type : "POST",
                                                                                    url : "ForTTShow/pageedit_create_project.php" ,
                                                                                    async: true ,
                                                                                    data : {
                                                                                        project : encodeURI($.focus_projectname) ,
                                                                                        html : "" ,
                                                                                        edit : ""
                                                                                    },
                                                                                    success : function(data) {
                                                                                            if( data == "true" )  {
                                                                                                    $( "#menu_project2dropme" ).hide();
                                                                                                    $( "#menu_builder, #menu_return_project" ).show();
                                                                                                    $( "#menu_home" ).hide();

                                                                                                    $( "#menu_user_profile_project" ).hide();

                                                                                                    $( "#menu_close_tool" ).show();

                                                                                                    $( "#DropMePager [tab=DropMe_Page_3]" ).show();

                                                                                                    // init builder
                                                                                                    //init_builder();
                                                                                                    $.View.view_create_app().init_builder();

                                                                                                    $.builder_container_destroy();
                                                                                                    $( "#main_container" ).html( "" );

                                                                                                    var tmp_html = 
                                                                                                    '<div style="display: block;" class="lyrow ui-draggable">' +
                                                                                                                '<a href="#close" class="remove label label-danger"><i class="glyphglyphicon glyphicon-remove glyphicon"></i> </a>' +
                                                                                                                '<span class="drag label label-default" style="margin-right: 30px;"><i class="glyphicon glyphglyphicon glyphicon-hand-right"></i> </span>' +
                                                                                                                '<span class="configuration"><button data-target="#myModalbackground" data-toggle="modal" class="btn btn-default btn-xs btn-xs">Background</button></span>' +
                                                                                                                '<div class="preview"><input value="12" class="form-control" type="text"></div>' +
                                                                                                                '<div class="view">' +
                                                                                                                            '<div class="row-fluid clearfix">' +
                                                                                                                                        '<div class="col-md-12 column ui-sortable"></div>' +
                                                                                                                            '</div>' +
                                                                                                                '</div>' +
                                                                                                    '</div>' ;

                                                                                                    $( "#main_container" ).html( tmp_html );
                                                                                                    $.builder_container_init();
                                                                                            }
                                                                                            else {
                                                                                                    $( "#Page_2 [value=Next]" ).html('Next');
                                                                                                    $( "#Page_2 [value=Next]" ).removeAttr('disabled');
                                                                                                    $( "#Page_2 [value=Next]" ).removeClass('disabled');
                                                                                                    alert("專案名稱重複");
                                                                                            }
                                                                                    } ,
                                                                                    error : function(data) { console.log(data); }
                                                                        });
                                                                        
                                                                        /*
                                                                        $.Shell.CreateFolder( "shell@ypdrive" , "myapps" , "/builder/" + $.focus_projectname + " -token " + $.loginmsg.uid ,
                                                                        function( msg ){

                                                                                    if( msg.Data.body.ErrCode == "0" )
                                                                                    {
                                                                                                // init banner
                                                                                                $( "#menu_project2dropme" ).hide();
                                                                                                $( "#menu_builder, #menu_return_project" ).show();
                                                                                                $( "#menu_home" ).hide();

                                                                                                $( "#menu_user_profile_project" ).hide();

                                                                                                $( "#menu_close_tool" ).show();

                                                                                                $( "#DropMePager [tab=DropMe_Page_3]" ).show();

                                                                                                // init builder
                                                                                                //init_builder();
                                                                                                $.View.view_create_app().init_builder();

                                                                                                $.builder_container_destroy();
                                                                                                $( "#main_container" ).html( "" );

                                                                                                var tmp_html = 
                                                                                                '<div style="display: block;" class="lyrow ui-draggable">' +
                                                                                                            '<a href="#close" class="remove label label-danger"><i class="glyphglyphicon glyphicon-remove glyphicon"></i> </a>' +
                                                                                                            '<span class="drag label label-default" style="margin-right: 30px;"><i class="glyphicon glyphglyphicon glyphicon-hand-right"></i> </span>' +
                                                                                                            '<span class="configuration"><button data-target="#myModalbackground" data-toggle="modal" class="btn btn-default btn-xs btn-xs">Background</button></span>' +
                                                                                                            '<div class="preview"><input value="12" class="form-control" type="text"></div>' +
                                                                                                            '<div class="view">' +
                                                                                                                        '<div class="row-fluid clearfix">' +
                                                                                                                                    '<div class="col-md-12 column ui-sortable"></div>' +
                                                                                                                        '</div>' +
                                                                                                            '</div>' +
                                                                                                '</div>' ;

                                                                                                $( "#main_container" ).html( tmp_html );
                                                                                                $.builder_container_init();
                                                                                    }
                                                                                    else 
                                                                                    {
                                                                                                $( "#Page_2 [value=Next]" ).button('reset');

                                                                                    }

                                                                        }, function(msg){}, function(msg){});
                                                                        */
                                                                       //abin edit 2015.3.26 --
                                                            }
                                                }
                                   });

                                   $( "#re_home" ).unbind('mousedown').bind( 'mousedown' , function() {

                                               //$( "body" ).children( ".navbar" ).effect( "drop" );
                                               $( "body" ).children( ".container-full" ).effect( "drop" );

                                               
                                               $( "#main_start_setting" ).show();
                                               
                                               $( "#LeftSide" ).fadeIn();
                                               $( "#rightSide" ).fadeIn();


                                               $( "#Page_1" ).fadeIn();


                                               $( "#Pager li" ).removeClass( "start" ).removeClass( "finish" );
                                               $( "#Pager [tab=Page_1]" ).addClass( "start" );

                                   });

                                   $( "#Page_1 ul.divFloatContainer" ).children( "li" ).unbind('mousedown').bind( 'mousedown' , function() {

                                               $( "#Page_1 ul.divFloatContainer" ).children( "li" ).removeClass( "selected" );
                                               $( this ).addClass( "selected" );

                                   });
                                   
                                   
                                   /**/
                                   // $( "#Page_2 [value=Next]" ).trigger('mousedown')
                                   // get theme
                                   
                                   
                                   
                    }
            };//--view_hbtest

            // jQuery plugin implementation
            $.fn.view_create_app = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("view_create_app");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                            alarm_data              : "",
                            alarm_state             : "",
                            create_:function(e,m,o){}
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new view_create_app(this, opts);
                            $(this).data("view_create_app", el);
                    });

                    return opts.api ? el: this;
            };
            
            
            
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);
