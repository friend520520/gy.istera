/*
 * a bin ++ 2014.5.4.1300
*/
(function($) {
            $.process_image = $.process_image || {version:'0.0.1'};
            var process_image = function(dom,opts) { //[--plugin define
                    var me=$(dom);
                    // public methods
                    $.extend(this, {
                                init: function() {
                                        $("#myModalaaa .modal-body").html(opts.Form);
                                        destroy();
                                        preinstall();
                                        init();
                                        GET_click();
                                        DataSkema_input_style();
                                },
                                destroy: function() {
                                        destroy();
                                },
                                MMS_callback : function() {
                                        MMS_callback();
                                },
                                static_web : function() {
                                        static_web();
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
                            opts.target = $("#workbench");
                            if( $.uid != undefined ) {
                                    opts.id = $.uid ;
                            }
                            source_value();
                            uri_value();
                            skema_value();
                            imagealign_value();
                            
                            $("#myModalaaa input[name='source']").bind( "click", function(e) {
                                    Default();
                                    source_value();
                                    uri_value();
                                    if($(e.target).attr("value") == "none") {
                                            none();
                                    }
                                    else {
                                            $("#myModalaaa input[data-skema=cue]").attr("disabled", false);
                                            $("#myModalaaa [data-target=data]").unbind( "click" ).bind( "click", function(e) {
                                                    if($.View.modal_router().options().data != undefined || opts.source == "none") {
                                                            DATA_click();
                                                    }
                                                    e.preventDefault();
                                            });
                                            $("#myModalaaa [data-target=view]").unbind( "click" ).bind( "click", function(e) {
                                                    if($.View.modal_router().options().data != undefined || opts.source == "none") {
                                                            VIEW_click();
                                                    }
                                                    Default_sight();
                                                    e.preventDefault();
                                            });
                                    }
                            }); 
                            
                            $("#myModalaaa input[data-input=uri]").focusout(function() {
                                    uri_value();
                            });
                            $("#myModalaaa input[data-input=to]").focusout(function() {
                                    uri_value();
                            });
                            $("#myModalaaa textarea[data-input=body]").focusout(function() {
                                    uri_value();
                            });
                           
                            $("#myModalaaa input[data-skema='cue']").focusout(function() {
                                    skema_value();
                                    VIEW_click();
                                    DataSkema_input_style();
                            });

                            $("#myModalaaa [data-target=demo]").unbind( "click" ).bind( "click", function(e) {
                                    opts.default = true;
                                    $("#myModalaaa input[data-skema=cue]").attr("disabled", false);
                                    DEMO_click();
                                    Default_sight();
                                    e.preventDefault();
                            });
                            $("#myModalaaa [data-target=get]").unbind( "click" ).bind( "click", function(e) {
                                    opts.default = true;
                                    $.View.modal_router().options().data = undefined;
                                    $("input[data-skema='cue']").val("");
                                    $("#myModalaaa input[data-skema=cue]").attr("disabled", false);
                                    GET_click();
                                    Default_sight();
                                    e.preventDefault();
                            });
                            $("#myModalaaa [data-target=submit]").unbind( "click" ).bind( "click", function(e) {
                                        opts.default = true;
                                        GET_click();
                                        e.preventDefault();
                            });
                            
                            $("#myModalaaa [data-target=media]").unbind( "click" ).bind( "click", function(e) {
                                    //alert("media");
                                    e.preventDefault();
                            });
                            $("#myModalaaa [data-target=data]").unbind( "click" ).bind( "click", function(e) {
                                    if($.View.modal_router().options().data != undefined && opts.source != "none") {
                                            DATA_click();
                                    }
                                    e.preventDefault();
                            });
                            $("#myModalaaa [data-target=view]").unbind( "click" ).bind( "click", function(e) {
                                    if($.View.modal_router().options().data != undefined && opts.source != "none") {
                                            VIEW_click();
                                    }
                                    Default_sight();
                                    e.preventDefault();
                            });
                            $("#myModalaaa [data-target=json]").unbind( "click" ).bind( "click", function(e) {
                                    //alert("json");
                                    e.preventDefault();
                            });
                            
                            $("#myModalaaa input[name='ImageAlign']").bind( "click", function(e) {
                                    imagealign_value();
                                    imagealign();
                            });
                            
                            $("#myModalaaa [data-target=save]").attr("onclick","");
                            $("#myModalaaa [data-target=save]").attr("data-dismiss","modal");
                            $("#myModalaaa [data-target=save]").unbind( "click" ).bind( "click", function(e) {
                                    if($.View.modal_router().options().data != undefined || opts.source == "none") {
                                            Save();
                                    }
                                    e.preventDefault();
                            });
                            $("#myModalaaa [data-target=back]").attr("onclick","");
                            $("#myModalaaa [data-target=back]").attr("data-dismiss","modal");
                            $("#myModalaaa [data-target=back]").unbind( "click" ).bind( "click", function(e) {
                                    e.preventDefault();
                            });
                    }
                    
                    function destroy() 
                    {
                            opts.Form = "";
                            opts.source = "";
                            opts.value = "";
                            opts.demo = 0;
                            //opts.mmtype = "";
                            opts.target = "";
                            opts.skema = {};
                            
                            $("#myModalaaa input[name='source']").unbind( "click" );
                            $("#myModalaaa input[name='source']").off('focusout');
                            $("#myModalaaa input[data-skema='cue']").off('focusout');
                            $("#myModalaaa [data-target=demo]").unbind( "click" );
                            $("#myModalaaa [data-target=get]").unbind( "click" );
                            $("#myModalaaa [data-target=submit]").unbind( "click" );
                            $("#myModalaaa [data-target=media]").unbind( "click" );
                            $("#myModalaaa [data-target=data]").unbind( "click" );
                            $("#myModalaaa [data-target=view]").unbind( "click" );
                            $("#myModalaaa [data-target=json]").unbind( "click" );

                            $("#myModalaaa [data-target=save]").unbind( "click" );
                            $("#myModalaaa [data-target=back]").unbind( "click" );
                    }
                    
                    function Default() 
                    {
                            $("#myModalaaa input[type=text]").val("");
                            $("#myModalaaa textarea[data-input='body']").val("");
                            $("#workbench").html("");
                            Default_sight();
                    }
                    
                    function Default_sight()
                    {
                            $( "input[type=text]" ).css( "box-shadow" , "");
                            $( "input[type=text]" ).css( "border-color" , "");
                    }
                    
                    function source_value()
                    {
                            opts.source = $('#myModalaaa input[name=source]:checked').val();
                    }
                    
                    function uri_value() 
                    {
                            if(opts.source == "http") {
                                    opts.value = $("#myModalaaa div[div-target='HTTP'] input[data-input='uri']").val();
                            }
                            else if(opts.source == "cds") {
                                    opts.value = $("#myModalaaa div[div-target='CDS'] input[data-input='uri']").val();
                            }
                            else if(opts.source == "mms") {
                                    opts.value = [ $("#myModalaaa div[div-target='MMS'] input[data-input='to']").val() , 
                                                   $("#myModalaaa div[div-target='MMS'] textarea[data-input='body']").val() ];
                            }
                            else if(opts.source == "none") {
                                    //opts.value = "";
                            }
                    }
                    
                    function skema_value()
                    {
                            opts.skema.image = $("input[data-skema='cue']").eq(0).val();
                    }
                    
                    function imagealign_value() 
                    {
                            opts.imagealign = $("#myModalaaa input[name='ImageAlign']:checked").val();
                    }
                    
                    function DEMO_click() 
                    {
                            if(opts.source == "http") {
                                        $("#myModalaaa div[div-target='HTTP'] input[data-input='uri']").val("http://api.flickr.com/services/feeds/photos_public.gne?lang=en-us&format=rss_200&format=json");
                            }
                            else if(opts.source == "cds") {
                                        $("#myModalaaa div[div-target='CDS'] input[data-input='uri']").val("(drive)/drive/media");
                            }
                            else if(opts.source == "mms") {
                                        $("#myModalaaa div[div-target='MMS'] input[data-input='to']").val("shell@ypdrive");
                                        //$("#myModalaaa div[div-target='MMS'] textarea[data-input='body']").val("\\clouddisk\\Builder\\JSON\\demo\\image.json");
                                        $("#myModalaaa div[div-target='MMS'] textarea[data-input='body']").val("/(mydrive)/drive/media");
                                        
                                        
                            }
                            uri_value();
                            GET_click();
                    }
                    
                    function GET_click()
                    {
                            console.log( "GET_click" );

                            if(opts.source == "none") 
                            {
                                        VIEW_click(); 
                            }
                            else if(opts.source == "http") {
                                        // get flicker
                                        if(opts.value.lastIndexOf("format=json") != -1 ) {
                                                flick();
                                        }
                                        else if(opts.value.lastIndexOf(".jpg") != -1 || opts.value.lastIndexOf(".png") != -1 ||
                                                opts.value.lastIndexOf(".tif") != -1 || opts.value.lastIndexOf(".bmp") != -1 ||
                                                opts.value.lastIndexOf(".gif") != -1 ) {

                                                http_file();
                                        }
                                        else if( opts.value.substr( opts.value.length-5 , opts.value.length ) == ".json" && 
                                                 opts.value.substr(0,7) == "http://" ) {
                                                http_json();
                                        }
                            }
                            else if(opts.source == "cds") {
                                        if( opts.value.substr( opts.value.length-5 , opts.value.length ) != ".json") {
                                                cds_folder();
                                        }
                                        else if( opts.value.substr( opts.value.length-5 , opts.value.length ) == ".json" && 
                                                 opts.value.indexOf("\\") == 0 ) {
                                                if( opts.value.substr( 0 , 5) == "\\ppd\\" ) {
                                                        remote_json();
                                                }
                                        }
                                        else if( opts.value.substr( opts.value.length-5 , opts.value.length ) == ".json" && opts.value.indexOf("\\") != 0) {
                                                //opts.id  == $.uid;
                                                if( opts.id != undefined ) {
                                                        local_json();
                                                } 
                                        }
                            }
                            
                            else if(opts.source == "mms") {
                                        MMS();
                            }
                    }
                    
                    function none() 
                    {
                            opts.source = "none";
                            opts.value = "";
                            $("#myModalaaa [data-target=data]").unbind( "click" );
                            $("#myModalaaa [data-target=view]").unbind( "click" ); 
                            VIEW_click();         
                    }
                    
                    function none_sight()
                    {
                            $("input[data-skema='cue']").eq(0).val(opts.skema.image);
                    }
                    
                    function DataSkema_input_style() 
                    {
                            if(opts.data == undefined || opts.data == "") {
                                    $("input[data-skema='cue']").eq(0).css("border" , "1px solid #FF0000");
                            }
                            else {
                                    $("input[data-skema='cue']").eq(0).css("border" , "");
                            }
                    }
                    
                    function error() 
                    {
                                console.log("abin error !!");
                                if(opts.target.attr("id") == "workbench") {
                                            $("#myModalaaa input[name=source][value=none]").attr("checked",true);

                                            $("#myModalaaa div[div-target='HTTP'] input[data-input='uri']").val("");
                                            $("#myModalaaa div[div-target='CDS'] input[data-input='uri']").val("");
                                            $("#myModalaaa div[div-target='MMS'] input[data-input='to']").val("");
                                            $("#myModalaaa div[div-target='MMS'] textarea[data-input='body']").val("");

                                            $("#myModalaaa input[data-skema='cue']").eq(0).val("");
                                            opts.default = true;
                                            $("#myModalaaa input[name=source][value=none]").click();
                                }
                                else {
                                            none();
                                }
                    }
                    
                    function cds_folder()
                    {
                                console.log( opts.target );
                                console.log( opts.value );

                                $.View.path()._SetOpts({ input_mpath : opts.value });
                                $.View.path().process_mpath();
                                var tmp = $.View.path().options().output_marray;
                                
                                var tmp = {} ;
                                tmp.Path = $.View.path().options().output_marray ;
                                tmp.temp_page_size  = "500" ;
                                tmp.temp_page_no    = "1" ;
                                
                                mpath( tmp , function( data ){
                                    
                                            if( opts.default ) {
                                                        opts.skema.image = "Name";
                                                        $( "input[data-skema='cue']" ).eq(0).val( opts.skema.image );
                                            }
                                            //opts.target   = this.data2.target;
                                            Re_Set_mmobj_value();
                                            $.View.modal_router().options().data = data;
                                            opts.data     = data;
                                            VIEW_click();
                                });
                                
                                // $shell@ypdrive/Builder/Media/Cat
                                
                                /*
                                var today = new Date();
                                var data = { func : "jPWS_DIR", FileType : "any" , PageNo : 1 , PageSize : 500 , Timer : today.getTime() };       
                                    data.Path = opts.value;
                                var data2 = { target : opts.target };
                                var callback = function(data) {
                                            try {
                                                        data = eval('['+data+']')[0];
                                                        if(data.ErrMsg == "OK" && data.Record != undefined && data.Record != null ) {
                                                                    if( opts.default ) {
                                                                                opts.skema.image = "Name";
                                                                                $("input[data-skema='cue']").eq(0).val(opts.skema.image);
                                                                    }
                                                                    opts.target   = this.data2.target;
                                                                    Re_Set_mmobj_value();
                                                                    $.View.modal_router().options().data = data;
                                                                    opts.data     = data;
                                                                    VIEW_click();
                                                        }
                                                        else
                                                        {
                                                                    error();
                                                        }
                                            }
                                            catch( e ) {
                                                        error();
                                            }
                                }
                                var callback_error = function(xhr, ajaxOptions, thrownError) {
                                            console.log( "error" , xhr , ajaxOptions, window.location.href );
                                            console.log( "error!!");
                                            console.log("url= " + this.url + "  data:"  + this.data  + "  back: " + this.back);
                                            error();
                                }
                                $.CGI_proxy( "GET" , "jsk/CDS.Agent.1.0.PPK" , data , data2 , callback , callback_error);*/
                    }

                    function mpath( tmp_path , callback )
                    {
                                var tmp_shellTo     = '' ;
                                var tmp_shellpath   = '' ;
                                $.each( tmp_path.Path , function(index, value) {
                                            if( index == 0 )
                                            {
                                                        if( value == "home" )
                                                        tmp_shellTo = $.HomeShell ;
                                                        else
                                                        tmp_shellTo = value ;
                                            }
                                            else
                                            tmp_shellpath +=    '/' +  value  ;
                                });
                                
                                tmp_shellpath = tmp_shellpath + " -n "  + 
                                                        "-pagesize "    +  tmp_path.temp_page_size + " " +
                                                        "-pageno "      +  tmp_path.temp_page_no + " -orderby name -order asc -token " + $.loginmsg.uid ;

                                var data = { "body" : $.dropmeshellcmdlist.ls + " " + tmp_shellpath };

                                $.mm.PutMsg( tmp_shellTo , data , function( msg ){

                                            console.log( msg ) ;
                                            console.log( 'PutMsg success' );
                                            $.mm.GetMsg( "5000" , msg.MsgID , function( msg ) {
                                                
                                                        console.log( '----------- children -----------' );
                                                        //console.log( msg.Data.body.fs.children );
                                                        if( msg.Data.body.ErrCode == 0 )
                                                        {
                                                                    console.log( msg.Data.body.fs.children );
                                                                    callback( msg.Data.body.fs )
                                                                    /*
                                                                    if( msg.Data.body.fs.children )
                                                                    {
                                                                                $.View.CloudDrive()._SetOpts({obj:msg.Data.body.fs,page_total:msg.Data.body.fs.totalpage,page_no:msg.Data.body.fs.pageno});
                                                                                $.View.CloudDrive().BuildSmallMedia();
                                                                    }else{
                                                                                $.View.view_dropme().PutHint( 'This folder is empty' );
                                                                    }*/
                                                        }
                                                        else
                                                        {
                                                                    $.View.view_dropme().PutHint( 'This folder is empty' );
                                                        }
                                                        $("#set_mode [value=Select]").trigger("click");
                                                        
                                            }
                                            , function( msg ) {
                                                        console.log( 'GetMsg error' );
                                            });
                                } ,  function( msg ){} );
                    }
                    

                    function local_json()
                    {
                            var path = opts.id + "\\json\\" +opts.value;
                            var data = { path : path };       
                            var data2 = { target : opts.target };
                            var callback = function(data) {
                                    try {
                                            data = eval('['+data+']')[0];
                                            if( opts.default ) {
                                                    opts.skema.image = "picture_url";
                                                    $("input[data-skema='cue']").eq(0).val(opts.skema.image);
                                            }
                                            opts.target   = this.data2.target;
                                            Re_Set_mmobj_value();
                                            $.View.modal_router().options().data = data;
                                            opts.data     = data;
                                            VIEW_click();
                                    }
                                    catch( e ) {
                                            error();
                                    }
                            }
                            var callback_error = function(xhr, ajaxOptions, thrownError) {
                                    console.log( "error" , xhr , ajaxOptions, window.location.href );
                                    console.log( "error!!");
                                    console.log("url= " + this.url + "  data:"  + this.data  + "  back: " + this.back);
                                    error();
                            }
                            $.CGI_proxy( "POST" , "jsk/GetCDSFile.PPK?func=GetJSON" , data , data2 , callback , callback_error);
                    }  
                    
                    function remote_json()
                    {
                            if( opts.value.substr( 0 , 5) == "\\ppd\\" ) {
                                    var path = opts.value.replace("\\ppd\\" , "");
                            }
                            var data = { path : path };       
                            var data2 = { target : opts.target };
                            var callback = function(data) {
                                    try {
                                            data = eval('['+data+']')[0];
                                            if( opts.default ) {
                                                    opts.skema.image = "picture_url";
                                                    $("input[data-skema='cue']").eq(0).val(opts.skema.image);
                                            }
                                            opts.target   = this.data2.target;
                                            Re_Set_mmobj_value();
                                            $.View.modal_router().options().data = data;
                                            opts.data     = data;
                                            VIEW_click();
                                    }
                                    catch( e ) {
                                            error();
                                    }
                            }
                            var callback_error = function(xhr, ajaxOptions, thrownError) {
                                    console.log( "error" , xhr , ajaxOptions, window.location.href );
                                    console.log( "error!!");
                                    console.log("url= " + this.url + "  data:"  + this.data  + "  back: " + this.back);
                                    error();
                            }
                            $.CGI_proxy( "POST" , "jsk/GetCDSFile.PPK?func=GetJSON" , data , data2 , callback , callback_error);
                    }
                    
                    function http_file()
                    {
                            $("#myModalaaa input[data-skema=cue]").attr("disabled","true");
                            $("#myModalaaa [data-target=data]").unbind( "click" );
                            $("#myModalaaa [data-target=view]").unbind( "click" ); 
                            VIEW_click();
                    }
                    
                    function flick() 
                    {
                            var data2 = { target : opts.target };
                            callback = function(){
                                    try {
                                            opts.data = $.http_cds_json_file_data;
                                            $.View.modal_router().options().data = opts.data;
                                            $.http_cds_json_file_data = "";

                                            if( opts.default ) {
                                                    var data = $.View.modal_router().options().data;
                                                    opts.data = {};
                                                    opts.data.list = [];
                                                    opts.data.list[0] = {};
                                                    opts.skema.image = "media";
                                                    opts.data.list[0].picture_url = data.items[0]["media"].m;
                                                    $("input[data-skema='cue']").eq(0).val(opts.skema.image);
                                            }
                                            
                                            opts.target   = this.data2.target;
                                            Re_Set_mmobj_value();
                                            VIEW_click();
                                    }
                                    catch( e ) {
                                            error();
                                    }
                            };
                            callback_error = function(data) {
                                    console.log("error" + data);
                                    error();
                            }
                            $.get_json_file( opts.value , data2 , callback , callback_error);
                    }

                    function http_json()
                    {
                            var data2 = { target : opts.target };
                            callback = function(){
                                    try {
                                            opts.data = $.http_cds_json_file_data;
                                            $.View.modal_router().options().data = opts.data;
                                            $.http_cds_json_file_data = "";

                                            opts.target   = this.data2.target;
                                            if( opts.default ) {
                                                    opts.skema.image = "picture_url";   
                                                    $("input[data-skema='cue']").eq(0).val(opts.skema.image);
                                            }
                                            Re_Set_mmobj_value();
                                            VIEW_click();
                                    }
                                    catch( e ) {
                                            error();
                                    }
                            };
                            callback_error = function(data) {
                                    console.log("error" + data);
                                    error();
                            }
                            $.get_json_file( opts.value , data2 , callback , callback_error);
                    }

                    function MMS() 
                    {
                                
                                var input_mpath = '$' + $("#myModalaaa div[div-target='MMS'] input[data-input='to']").val() + $("#myModalaaa div[div-target='MMS'] textarea[data-input='body']").val() ;
                                        
                                $.View.path()._SetOpts({ input_mpath : input_mpath }) ;
                                //$.View.path()._SetOpts({ input_mpath : "$shell@ypdrive/(mydrive)/drive/media" }) ;
                                $.View.path().process_mpath() ;
                                $.View.path().options().output_marray ;
                                
                                opts.ListMediaPathArr = $.View.path().options().output_marray ;
                        
                                opts.temp_page_no = 1 ;

                                var tmp_path = '' ;
                                $.each( opts.ListMediaPathArr  , function(index, value) {
                                            if( index != 0 )
                                            tmp_path +=  '/' +  value ;
                                });
                                tmp_path = tmp_path + " -n -pagesize 100 -pageno " + opts.temp_page_no + " -orderby name -order asc -token " + $.loginmsg.uid ;

                                opts.data = { "body" : $.dropmeshellcmdlist.ls + " " + tmp_path };

                                console.log( "PutMM" );
                                $.mm.PutMsg( $.CurrentShell , opts.data , function( msg ){
                                            console.log( msg ) ;
                                            console.log( 'PutMsg success' );
                                            $.mm.GetMsg( "5000" , msg.MsgID , function( msg ) {
                                                        console.log( 'GetMsg success' );
                                                        alert( JSON.stringify( msg.Data.body.fs.children ) );
                                            }
                                            , function( msg ) {
                                                        console.log( 'GetMsg error' );
                                            });

                                } ,  function( msg ){} );
                                
                                /*
                                $.View.path()._SetOpts({ input_mpath : "$shell@ypdrive/(mydrive)/drive/media" }) ;
                                $.View.path().process_mpath() ;
                                $.View.path().options().output_marray ;
                                
                                opts.ListMediaPathArr = $.View.path().options().output_marray ;
                                PutMediaList();*/

                    }

                    function MMS_callback() 
                    {
                            opts.target = $("#" + opts.data.Data.body.usd.component_id);
                            Re_Set_mmobj_value();
                            
                            if( opts.value[0] == "json@cds" ) {
                                    if( opts.data.Data.body.JSON == undefined ) {
                                            error();
                                    }
                                    else
                                    {
                                            opts.data = opts.data.Data.body.JSON;
                                            if( opts.default ) {
                                                    opts.skema.image = "picture_url";
                                                    $("input[data-skema='cue']").eq(0).val(opts.skema.image);
                                            }
                                            Re_Set_mmobj_value();
                                            $.View.modal_router().options().data = opts.data;
                                            VIEW_click();
                                    }
                            }
                    }

                    function Save() 
                    {
                            // for  mms 
                            if( opts.target.attr("id") == "workbench" && opts.source == "mms" && $.View.process_mms().options().listen ) {
                                    return;
                            }
                            // for  mms 
                            
                            opts.target = $.View.modal_router().options().target;
                            VIEW_click();
                            edit_mmobj();
                    }
                    
                    function VIEW_click()
                    {
                            console.log(opts.target);
                            $.View.view_image()._SetOpts({ target : opts.target });
                            $.View.view_image().destory();
                            console.log(opts.data);
                            // cheack_column();
                            // $.View.view_image()._SetOpts({ mmobj : opts.data });
                            if( opts.data )
                            {
                                
                                    $.View.view_image()._SetOpts({ mmobj : opts.data.url + opts.data.children[0].name });
                                    $.View.view_image().designer_init_image();
                                    imagealign();
                                
                            }
                    }
                    
                    function cheack_column() 
                    {
                            var data = $.View.modal_router().options().data;
                            var i=0;    
                            opts.data = {};
                            opts.data.list = [];
                            if( opts.source == "none" ) {
                                    if( opts.value != "" && opts.default == false ) {
                                            opts.data = opts.value;
                                    }
                                    else {
                                            opts.data = "http://cdn.ypcall.com/Builder/PD/image/image01.jpg";
                                    }
                            }
                            else if(opts.source == "http") {
                                    if( opts.value.lastIndexOf("format=json") != -1 ) {
                                            if(opts.skema.image == "media") {
                                                    opts.data = data.items[0][opts.skema.image]["m"];
                                            }
                                            else {
                                                    opts.data = data.items[0][opts.skema.image];
                                            }
                                    }
                                    else if(opts.value.lastIndexOf(".jpg") != -1 || opts.value.lastIndexOf(".png") != -1 ||
                                            opts.value.lastIndexOf(".tif") != -1 || opts.value.lastIndexOf(".bmp") != -1 ||
                                            opts.value.lastIndexOf(".gif") != -1 ) {
                                        
                                            opts.data = opts.value;
                                            $.View.modal_router().options().data = opts.data;
                                    }
                                    else if( opts.value.substr( opts.value.length-5 , opts.value.length ) == ".json" && 
                                             opts.value.substr(0,7) == "http://" ) {

                                             opts.data = data.list[0][opts.skema.image];
                                    }
                            }
                            else if(opts.source == "cds") {
                                    // remote json
                                    if( opts.value.substr( opts.value.length-5 , opts.value.length ) == ".json" && 
                                             opts.value.indexOf("\\") == 0 ) {
                                                    opts.data = data.list[0][opts.skema.image];
                                                    if(data.list[0][opts.skema.image] == undefined) {
                                                            opts.data.list[0].picture_url = undefined;
                                                    }
                                    }
                                    //local json
                                    else if( opts.value.substr( opts.value.length-5 , opts.value.length ) == ".json" && opts.value.indexOf("\\") != 0 ) {
                                            console.log(data);
                                            opts.data = data.list[0][opts.skema.image];
                                            if(data.list[0][opts.skema.image] == undefined) {
                                                    opts.data.list[0].picture_url = undefined;
                                            }
                                    }
                                    else if( opts.value.substr( opts.value.length-5 , opts.value.length ) != ".json" ) {
                                            if( data.ReferenceUrl.lastIndexOf(".") != -1 ) {
                                                    data.ReferenceUrl = data.ReferenceUrl.substring( 0 , data.ReferenceUrl.lastIndexOf("/")+1 );
                                            }
                                            for(i=0;i<data.Record.length;i++) {
                                                    opts.data = data.AccessUrl + data.ReferenceUrl +  data.Record[i][opts.skema.image];
                                                    if(data.Record[0][opts.skema.image] == undefined) {
                                                            opts.data.list[0].picture_url = undefined;
                                                    }
                                            }
                                    }
                            }
                            else if(opts.source == "mms") {
                                    if( opts.value[0] == "json@cds" ) {
                                            opts.data = data.list[0][opts.skema.image];
                                    }
                            }
                    }
                    
                    function DATA_click()
                    {       
                            opts.target.carousel('pause');
                            opts.target.html("");
                            var html="<br>",i=0;
                            var data = $.View.modal_router().options().data;

                            if(opts.source == "http") {
                                    if( opts.value.lastIndexOf("format=json") != -1 ) {
                                            $.each( data.items[0] , function(index, value) {
                                                    if(index.length > 20) {
                                                            index = index.substring(0,20) + "...";
                                                    }
                                                    if(value.length > 20) {
                                                            value = value.substring(0,20) + "...";
                                                    }
                                                    if(index == "media") {
                                                            value = data.items[i].media.m;
                                                            if(value.length > 20) {
                                                                    value = value.substring(0,20) + "...";
                                                            }
                                                            i++;
                                                    }
                                                    if(index != "description" && index != "tags") {
                                                            //index = index.substring(0,1).toUpperCase() + index.substring(1);
                                                            html = html +   '<div style="font-size:12pt;" class="row">\n\
                                                                                    <div style="font-size:16pt;color:#5bc0de;" text="' + index + '" data-skema="column" style="cursor:-moz-grab;" class="col-lg-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
                                                                                            &nbsp;&nbsp;' + index + ':</div>\n\
                                                                                    <div class="col-lg-6">' + value + '</div>\n\
                                                                                    <div class="col-lg-1"></div>\n\
                                                                                    <div class="col-lg-1"></div>\n\
                                                                            </div>';    
                                                    }
                                            });
                                    }
                                    else if( opts.value.substr( opts.value.length-5 , opts.value.length ) == ".json" && 
                                             opts.value.substr(0,7) == "http://" ) {

                                            $.each( data.list[0] , function(index, value) {
                                                    if(index.length > 20) {
                                                            index = index.substring(0,20) + " ...";
                                                    }
                                                    if(value.length > 20) {
                                                            value = value.substring(0,20) + " ...";
                                                    }
                                                    //index = index.substring(0,1).toUpperCase() + index.substring(1);
                                                    html = html +   '<div style="font-size:12pt;" class="row">\n\
                                                                            <div style="font-size:16pt;color:#5bc0de;" text="' + index + '" data-skema="column" style="cursor:-moz-grab;" class="col-lg-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
                                                                                    &nbsp;&nbsp;' + index + ':</div>\n\
                                                                            <div class="col-lg-6">' + value + '</div>\n\
                                                                            <div class="col-lg-1"></div>\n\
                                                                            <div class="col-lg-1"></div>\n\
                                                                    </div>';
                                            });
                                    }
                            }
                            else if(opts.source == "cds") {
                                    if( opts.value.substr( opts.value.length-5 , opts.value.length ) != ".json") {
                                        
                                            $.each( data.children[0] , function(index, value) {
                                                    var first = index ;
                                                    var second = value ;
                                                
                                                    if( first.length > 20 ) {
                                                            var index = first.substring(0,20) + " ...";
                                                    }else{
                                                            var index = first ;
                                                    }
                                                    if( second > 20) {
                                                            var value = second.substring(0,20) + " ...";
                                                    }else{
                                                            var value = second ;
                                                    }
                                                    index = index.substring(0,1).toUpperCase() + index.substring(1);

                                                    html = html +   '<div style="font-size:12pt;" class="row">\n\
                                                                            <div style="font-size:16pt;color:#5bc0de;" text="' + index + '" data-skema="column" style="cursor:-moz-grab;" class="col-lg-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
                                                                                    &nbsp;&nbsp;' + index + ':</div>\n\
                                                                            <div class="col-lg-6">' + value + '</div>\n\
                                                                            <div class="col-lg-1"></div>\n\
                                                                            <div class="col-lg-1"></div>\n\
                                                                    </div>';
                                            });
                                            
                                            /*
                                            $.each( data.Record[0] , function(index, value) {
                                                    if(index.length > 20) {
                                                            index = index.substring(0,20) + " ...";
                                                    }
                                                    if(value.length > 20) {
                                                            value = value.substring(0,20) + " ...";
                                                    }
                                                    index = index.substring(0,1).toUpperCase() + index.substring(1);

                                                    html = html +   '<div style="font-size:12pt;" class="row">\n\
                                                                            <div style="font-size:16pt;color:#5bc0de;" text="' + index + '" data-skema="column" style="cursor:-moz-grab;" class="col-lg-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
                                                                                    &nbsp;&nbsp;' + index + ':</div>\n\
                                                                            <div class="col-lg-6">' + value + '</div>\n\
                                                                            <div class="col-lg-1"></div>\n\
                                                                            <div class="col-lg-1"></div>\n\
                                                                    </div>';
                                            });*/
                                    }
                                    else if( opts.value.substr( opts.value.length-5 , opts.value.length ) == ".json" ) {
                                            $.each( data.list[0] , function(index, value) {
                                                    if(index.length > 20) {
                                                            index = index.substring(0,20) + " ...";
                                                    }
                                                    if(value.length > 20) {
                                                            value = value.substring(0,20) + " ...";
                                                    }
                                                    //index = index.substring(0,1).toUpperCase() + index.substring(1);
                                                    html = html +   '<div style="font-size:12pt;" class="row">\n\
                                                                            <div style="font-size:16pt;color:#5bc0de;" text="' + index + '" data-skema="column" style="cursor:-moz-grab;" class="col-lg-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
                                                                                    &nbsp;&nbsp;' + index + ':</div>\n\
                                                                            <div class="col-lg-6">' + value + '</div>\n\
                                                                            <div class="col-lg-1"></div>\n\
                                                                            <div class="col-lg-1"></div>\n\
                                                                    </div>';
                                            });
                                            console.log( data );
                                    }  
                            }
                            else if(opts.source == "mms") {
                                    $.each( data.list[0] , function(index, value) {
                                            if(index.length > 20) {
                                                    index = index.substring(0,20) + " ...";
                                            }
                                            if(value.length > 20) {
                                                    value = value.substring(0,20) + " ...";
                                            }
                                            //index = index.substring(0,1).toUpperCase() + index.substring(1);
                                            html = html +   '<div style="font-size:12pt;" class="row">\n\
                                                                    <div style="font-size:16pt;color:#5bc0de;" text="' + index + '" data-skema="column" style="cursor:-moz-grab;" class="col-lg-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;\n\
                                                                            &nbsp;&nbsp;' + index + ':</div>\n\
                                                                    <div class="col-lg-6">' + value + '</div>\n\
                                                                    <div class="col-lg-1"></div>\n\
                                                                    <div class="col-lg-1"></div>\n\
                                                            </div>';
                                    });
                            }
                            opts.target.append(html);

                            // add event
                            $( "input[data-skema='cue']" ).css( "box-shadow" , "0 1px 1px rgba(0, 0, 0, 0.075) inset, 0 0 8px rgba(102, 175, 233, 0.6)");
                            $( "input[data-skema='cue']" ).css( "border-color" , "#66AFE9");
                            $( "div[data-skema='column']" ).draggable({
                                            helper: "clone",
                                            start : function(e,ui) {
                                                    $(ui.helper).css("cursor","-moz-grabbing").css("font-size","20pt").css("color","blue");
                                                    $("div[data-skema='cue']").css("font-size","20pt").css("color","blue").css("opacity","0.6");
                                            },
                                            stop : function() {
                                                    $("div[data-skema='cue']").css("font-size","").css("color","").css("opacity","");
                                            }
                            });
                            $( "input[data-skema='cue']" ).droppable({
                                            over : function(e,ui) {
                                                    $( this ).html(ui.draggable.attr("text"));
                                                    $(ui.helper).css("cursor","-moz-grab");
                                            },
                                            out : function(e,ui) {
                                                    $( this ).html($( this ).attr("text"));
                                                    $(ui.helper).css("cursor","-moz-grabbing");
                                            },
                                            drop: function( event, ui ) {
                                                    var i=0;
                                                    $( this ).val(ui.draggable.attr("text"));
                                                    $( this ).attr("text",ui.draggable.attr("text"));
                                                    skema_value();
                                            }
                            });
                    }
                    
                    function Re_Set_mmobj_value()
                    {
                            if(opts.target.attr("id") == "workbench") {
                                    opts.source        = $('#myModalaaa input[name=source]:checked').val();
                                    if( opts.source == "http" ) {
                                            opts.value = $("#myModalaaa div[div-target=HTTP] input[data-input='uri']").val();
                                    }
                                    else if( opts.source == "cds" ) {
                                            opts.value = $("#myModalaaa div[div-target=CDS] input[data-input=uri]").val();
                                    }
                                    else if( opts.source == "mms") {
                                            opts.value = [ $("#myModalaaa div[div-target='MMS'] input[data-input='to']").val() , 
                                                           $("#myModalaaa div[div-target='MMS'] textarea[data-input='body']").val() ];
                                    }
                                    else if( opts.source == "none" ) {
                                            opts.value = "";
                                    }
                                    
                                    if( opts.source != "none" ) {
                                            opts.skema.image    = $("#myModalaaa input[data-skema='cue']").eq(0).val();
                                    }
                                    
                                    opts.imagealign    = $("#myModalaaa input[name=ImageAlign]:checked").val();
                                    console.log( $.View.process_thumbnails().options() );
                            }
                            else 
                            {
                                    opts.mmobj         = eval('[' + opts.target.attr("mmobj") + ']')[0];
                                    opts.source        = opts.mmobj.source;
                                    opts.value         = opts.mmobj.value;
                                    opts.skema         = opts.mmobj.skema;
                                    opts.imagealign    = opts.mmobj.imagealign ;
                                    console.log(opts.mmobj);
                            }
                    }
                    
                    function edit_mmobj() 
                    {
                            opts.target.attr("json", "");

                            var mmobj = { source     : opts.source ,
                                           value      : opts.value  ,
                                           skema      : opts.skema  ,
                                           imagealign : opts.imagealign};   
                            if( opts.source == "cds" &&  opts.value.substr( opts.value.length-5 , opts.value.length ) == ".json" ) {
                                     var json = { id : $.uid };
                                     json = JSON.stringify( json );
                                     opts.target.attr("json", json);
                                     value = opts.value.replace(/\\/g,'\\\\');
                            }
                            else if( opts.source == "mms" ) {
                                    mmobj.value[0] = mmobj.value[0].replace(/\\/g,'\\');
                                    mmobj.value[1] = mmobj.value[1].replace(/\\/g,'\\');
                            }
                            else {
                                     mmobj.value = opts.value.replace(/\\/g,'\\');
                            }
                            mmobj = JSON.stringify(mmobj);
                            opts.target.attr("mmobj",mmobj);  
                            if( opts.source != "none" ) {
                                    opts.target.attr("changeimage", "0");
                            }
                    }
                    
                    function static_web()
                    {   
                            opts.mmobj = eval('[' + opts.mmobj + ']')[0];
                            opts.source = opts.mmobj.source;
                            opts.value = opts.mmobj.value;
                            opts.skema = opts.mmobj.skema;
                            opts.imagealign = opts.mmobj.imagealign ;
                            opts.default = false;

                            try {
                                    opts.id = eval('[' + opts.target.attr("json") + ']')[0]["id"];
                                    console.log("local.json");
                            }
                            catch( e ) {
                                    console.log("json attr error!!");
                            }
                            
                            GET_click();
                    }
                    
                    function imagealign() 
                    {
                            if(opts.imagealign == "left") {
                                    opts.target.find("center").css("float","left");
                            }
                            else if(opts.imagealign == "center") {
                                    opts.target.find("center").css("float","");
                            }
                            else if(opts.imagealign == "right") {
                                    opts.target.find("center").css("float","right");
                            }
                    }
                    
                    function preinstall()
                    {
                            var data = eval("[" + opts.mmobj + "]")[0];
                            console.log(data);
                            $("#myModalaaa input[name=source][value='" + data.source + "']").attr("checked",true);
                            
                            if(data.source != "none") {
                                    $("#myModalaaa input[name=source][value='" + data.source + "']").click();
                                    $("#myModalaaa input[data-skema='cue']").eq(0).val(data.skema["image"]);
                            }
                            
                            if(data.source == "none") {
                                    opts.value = data.value;
                            }
                            else if(data.source == "http") {
                                    $("#myModalaaa div[div-target='HTTP'] input[data-input='uri']").val(data.value);
                            }
                            else if(data.source == "cds") {
                                    $("#myModalaaa div[div-target='CDS'] input[data-input='uri']").val(data.value);
                            }
                            else if(data.source == "mms") {
                                    $("#myModalaaa div[div-target='MMS'] input[data-input='to']").val(data.value[0]);
                                    $("#myModalaaa div[div-target='MMS'] textarea[data-input='body']").val(data.value[1]);
                            }
                            
                            $("#myModalaaa input[name=ImageAlign][value='" + data.imagealign + "']").click();

                            opts.default = false;
                    }
            };

            // jQuery plugin implementation
            $.fn.process_image = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("process_image");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                            Form : "" ,
                            source : "" ,
                            value : "" ,
                            demo : 0 ,
                            mmtype : "" ,
                            imagealign : "",
                            default : true ,
                            
                            target : "" ,
                            skema : {} ,
                            create_:function(e,m,o){} ,
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new process_image(this, opts);
                            $(this).data("process_image", el);
                    });
                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);
