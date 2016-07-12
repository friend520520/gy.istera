/*
            jQuery shell - from shell.js - v 0.0.1
*/
(function($) {
            $.view_shelldata = $.view_shelldata || {version:'0.0.1'};
            var view_shelldata = function(dom,opts) { //[--plugin define
                    var me=$(dom);
                    // public methods
                    $.extend(this, {
                                init: function() {
                                            init();
                                },
                                putQuery: function() {
                                            putQuery();
                                },
                                putFile: function() {
                                            putFile();
                                },
                                
                                options: function() {
                                            return opts;
                                },
                                _SetOpts: function( options ) {
                                            $.extend(opts,options);
                                }
                    });
                    
                    
                    function init()
                    {
                                
                    }
                    
                    function putQuery()
                    {
                                console.log( '===========================' );
                                console.log( opts.putdata );
                                
                                // list project
                                if( opts.putdata.name.split( 'myapps' ).length > 1 )
                                {
                                            console.log( "abin ready edit" );
                                    
                                            //abin 2014.8.4 edit ++    add support
                                            /*
                                            if( tmp_data[0].status == "true") 
                                            {
                                                        //$( "#menu_support" ).show();
                                                        $("#menu_support").unbind('click').bind( 'click' , function() {
                                                                    $.View.process_support().init();
                                                        });
                                            }*/
                                            
                                            //abin 2014.8.4 edit --    add support
                                            
                                            $( "#menu_project_edit_open" ).show();
                                            $( "#menu_project_edit_close" ).hide();

                                            $( "#menu_user_profile_box" ).show();
                                            $( "#menu_user_profile_login" ).hide();
                                            $( "#menu_user_profile_logout" ).show();
                                            $( ".myclassforBusinessWebsite" ).hide();

                                            $( "#menu_user_profile_project" ).show();
                                            $( "#menu_user_project" ).show();


                                            $( "#Page_1_haslogin" ).show();
                                            $( "#Page_1_nologin" ).hide();
                                            
                                            $( "#Page_1_project .divFloatContainer .project" ).remove();
                                            var tmp_html = "" ;

                                            $.each( opts.putdata.children , function(index, value) {
                                                        value.name = decodeURI( value.name );
                                                        if( value.name != "@DesignerTemplate" && value.type == "folder" ) {
                                                                /*
                                                                tmp_html += '<li class="project drag_pro" segment="1" focus_pro="' + value.name + '" focus_background-image="' + opts.putdata.url +  value.name + '/appprofile/main.png">' +
                                                                                        '<div style="background-image:url(\'' + opts.putdata.url +  value.name + '/appprofile/main.png?' + Math.random().toString() + '\');">' +
                                                                                        '<p><a href="' + opts.putdata.url + value.name + '/index.html" target="_blank" >' + value.name + '</a></p>' +
                                                                            '</li>' ;
                                                                */
                                                                tmp_html += '<li class="project drag_pro" segment="1" focus_pro="' + value.name + '" focus_background-image="' + opts.putdata.url +  value.name + '/appprofile/main.png">' +
                                                                                        '<div>' +
                                                                                        '<p><a href="' + opts.putdata.url + value.name + '/index.html" target="_blank" >' + value.name + '</a></p>' +
                                                                            '</li>' ;
                                                        }
                                            });

                                            $( "#Page_1_project .divFloatContainer" ).append( tmp_html );
                                            $( "body" ).trigger('init');
                                            //$( "#Page_1_project .divFloatContainer" ).children( "li:eq(0)" ).trigger( "mousedown" );

                                            //$( "#Page_1_project .divFloatContainer" ).children( "li" ).children( ".remove" ).unbind('mousedown').bind( 'mousedown' , function() {
                                            $( "#menu_project_edit_modify" ).unbind('mousedown').bind( 'mousedown' , function() {
                                                        console.log(123123);
                                            });
                                            //$( "#Page_1_project .divFloatContainer" ).children( "li" ).children( ".remove" ).unbind('mousedown').bind( 'mousedown' , function() {
                                            /*
                                            $( "#menu_project_edit_delete" ).unbind('mousedown').bind( 'mousedown' , function() {

                                                        var tmp_focus = $( "#Page_1_project .divFloatContainer" ).children( "li.removed" ) ;
                                                        if( tmp_focus.length > 0 )
                                                        {
                                                                    var tmp = tmp_focus.attr( "focus_pro" );

                                                                    $.ajax({  
                                                                                type    : "POST",  
                                                                                url     : "jsk/ProjectManagement.JSK?func=DeleteProject" ,  
                                                                                data    : {
                                                                                            path: tmp
                                                                                },
                                                                                success: function(data) {

                                                                                            //console.log( data );
                                                                                            ypcloudInit();

                                                                                }
                                                                    });
                                                        }
                                            });
                                            */
                                            
                                }
                                // else if(  opts.putdata.path.split( 'y:\\YPDrive\\' + $.uid ).length > 1 )
                                else if( opts.putdata.name.split( "(uid)" ).length > 1 )
                                {
                                    console.log( "abin ready edit 2" );
                                            $.View.view_dropme()._SetOpts({ PutMediaData : opts.putdata });
                                            $.View.view_dropme().PutMedia();
                                }
                                else
                                {
                                    console.log( "abin ready edit 3" );
                                            console.log( opts.putdata );
                                }
                                
                                //alert( opts.putdata );
                    }
                    
                    function putFile()
                    {
                                console.log( '===========================' );
                                //console.log( opts.putdata );
                        
                                $( "#menu_user_project" ).hide();

                                $( "#Page_2 [value=Next]" ).button('reset');

                                $.View.view_create_app().init_builder();

                                $.builder_container_destroy();
                                
                                $( "#main_container" ).html( "" );
                                $( "#main_container" ).html( opts.putdata );

                                //$.View.init_project().init();

                                
                                // insert project profile
                                $.focus_templatename = $( "#main_container" ).children().attr( "focus_templatename" ) ;
                                /*
                                if( $.focus_templatename == undefined )
                                {
                                            $( "#main_container" ).attr( "class" , "" );
                                            $( "#main_container" ).attr( "class" , "demo ui-sortable" );
                                            
                                            removejscssfile( '' + 'http://myapps.ypcloud.com/' +  $.uid + '/' + $.focus_projectname + '/css/extent.css', 'css');
                                            loadjscssfile( '' + 'http://myapps.ypcloud.com/' +  $.uid + '/' + $.focus_projectname + '/css/extent.css', 'css');
                                            
                                            removejscssfile( '' + 'http://myapps.ypcloud.com/' +  $.uid + '/' + $.focus_projectname + '/js/app.js', 'js');
                                            loadjscssfile( '' + 'http://myapps.ypcloud.com/' +  $.uid + '/' + $.focus_projectname + '/js/app.js', 'js');
                                }
                                else
                                {
                                            loadjscssfile( '' + 'http://myapps.ypcloud.com/' + $.uid + '/@DesignerTemplate/' + $.focus_templatename + '/css/extent.css', 'css');
                                            
                                            loadjscssfile( '' + 'http://myapps.ypcloud.com/' + $.uid + '/' + $.focus_projectname + '/css/extent.css', 'css');
                                            
                                            removejscssfile( '' + 'http://myapps.ypcloud.com/' + $.uid + '/@DesignerTemplate/' + $.focus_templatename + '/js/app.js', 'js');
                                            loadjscssfile( '' + 'http://myapps.ypcloud.com/' + $.uid + '/@DesignerTemplate/' + $.focus_templatename + '/js/app.js', 'js');
                                            
                                            console.log( "MainHtmlTemplate" );
                                }
                                */
                                $.builder_container_init();
                                
                    }
                    
                    
            };//--view_shelldata


            // jQuery plugin implementation
            $.fn.view_shelldata = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("view_shelldata");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                            aaa                    : "aaa",
                            map_id                 : 0,
                            alarm_state             : "",
                            create_:function(e,m,o){}
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new view_shelldata(this, opts);
                            $(this).data("view_shelldata", el);
                    });

                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);
