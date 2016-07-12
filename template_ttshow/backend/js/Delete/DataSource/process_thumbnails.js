/*
 * a bin ++ 2014.5.4.1300
*/
(function($) {
            $.process_thumbnails = $.process_thumbnails || {version:'0.0.1'};
            var process_thumbnails = function(dom,opts) { //[--plugin define
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
                            display_value();
                            titlealign_value();
                            subtitlealign_value();
                            
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
                            
                            $("#myModalaaa input[name='display']").bind( "click", function(e) {
                                    display_value();
                                    display();
                            });
                            $("#myModalaaa input[name='TitleAlign']").bind( "click", function(e) {
                                    titlealign_value();
                                    titlealign();
                            });
                            $("#myModalaaa input[name='SubtitleAlign']").bind( "click", function(e) {
                                    subtitlealign_value();
                                    subtitlealign();
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
                            
                            $("#myModalaaa [data-target=Sum_Add]").unbind( "click" ).bind( "click", function(e) {
                                    add_thumbnails();
                                    e.preventDefault();
                            });
                            $("#myModalaaa [data-target=Sum_Less]").unbind( "click" ).bind( "click", function(e) {
                                    delete_thumbnails();
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
                            opts.display = [];
                            
                            $("#myModalaaa input[name='source']").unbind( "click" );
                            $("#myModalaaa input[data-skema='cue'] input[name='source']").off('focusout');
                            $("#myModalaaa [data-target=demo]").unbind( "click" );
                            $("#myModalaaa [data-target=get]").unbind( "click" );
                            $("#myModalaaa [data-target=submit]").unbind( "click" );
                            $("#myModalaaa [data-target=media]").unbind( "click" );
                            $("#myModalaaa [data-target=data]").unbind( "click" );
                            $("#myModalaaa [data-target=view]").unbind( "click" );
                            $("#myModalaaa [data-target=json]").unbind( "click" );
                            $("#myModalaaa input[name='display']").unbind( "click" );
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
                    
                    function DataSkema_input_style() 
                    {
                            if(opts.source != "none") {
                                    if(opts.data.list[0].picture_url == undefined) {
                                            $("input[data-skema='cue']").eq(0).css("border" , "1px solid #FF0000");
                                    }
                                    else {
                                            $("input[data-skema='cue']").eq(0).css("border" , "");
                                    }
                                    if(opts.data.list[0].title == undefined) {
                                            $("input[data-skema='cue']").eq(1).css("border" , "1px solid #FF0000");
                                    }
                                    else {
                                            $("input[data-skema='cue']").eq(1).css("border" , "");
                                    }
                                    if(opts.data.list[0].subtitle == undefined) {
                                            $("input[data-skema='cue']").eq(2).css("border" , "1px solid #FF0000");
                                    }
                                    else {
                                            $("input[data-skema='cue']").eq(2).css("border" , "");
                                    }
                            }
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
                                    opts.value = "";
                            }
                    }
                    
                    function skema_value()
                    {
                            opts.skema.image = $("input[data-skema='cue']").eq(0).val();
                            opts.skema.title = $("input[data-skema='cue']").eq(1).val();
                            opts.skema.subtitle = $("input[data-skema='cue']").eq(2).val();
                    }
                    
                    function display_value()
                    {
                            var i=0;
                            var cheackbox = $("input[name=display]");
                            for(i=0;i<cheackbox.length;i++) {
                                    if(cheackbox.eq(i).is(':checked')) {
                                            opts.display[i] = true;
                                    }
                                    else {
                                            opts.display[i] = false;
                                    }
                            }
                    }
                    
                    function titlealign_value() 
                    {
                            opts.titlealign = $("#myModalaaa input[name='TitleAlign']:checked").val();
                    }
                    
                    function subtitlealign_value() 
                    {
                            opts.subtitlealign = $("#myModalaaa input[name='SubtitleAlign']:checked").val();
                    }

                    function DEMO_click() 
                    {
                            console.log(opts.source);
                            if(opts.source == "http") {
                                    $("#myModalaaa div[div-target='HTTP'] input[data-input='uri']").val("http://api.flickr.com/services/feeds/photos_public.gne?lang=en-us&format=rss_200&format=json");
                            }
                            else if(opts.source == "cds") {
                                    $("#myModalaaa div[div-target='CDS'] input[data-input='uri']").val("(drive)/drive/media");
                            }
                            else if(opts.source == "mms") {
                                    $("#myModalaaa div[div-target='MMS'] input[data-input='to']").val("shell@ypdrive");
                                    $("#myModalaaa div[div-target='MMS'] textarea[data-input='body']").val("\\clouddisk\\Builder\\JSON\\demo\\thumbnails.json");
                            }
                            uri_value();
                            GET_click();
                    }
                    
                    function GET_click()
                    {
                            if(opts.source == "none") {
                                    if(opts.target.attr("id") == "workbench") {
                                            opts.target.append( $.View.modal_router().options().target.clone() );
                                            opts.target.find(".caption").removeAttr("contenteditable");
                                    }
                                    /*
                                    else {
                                            VIEW_click();
                                            if( $("#main_container")[0] != undefined && opts.target.attr("id") != "workbench") {
                                                    opts.target.find(".caption").attr("contenteditable",true);
                                            }
                                    }
                                    */
                                    $("#myModalaaa [data-target=data]").unbind( "click" );
                                    $("#myModalaaa [data-target=view]").unbind( "click" ); 
                            }
                            else if(opts.source == "http") {
                                    if(opts.value.lastIndexOf("format=json") != -1 ) {
                                            flick();
                                    }
                                    else if(opts.value.lastIndexOf(".jpg") != -1 || opts.value.lastIndexOf(".png") != -1 ||
                                            opts.value.lastIndexOf(".tif") != -1 || opts.value.lastIndexOf(".bmp") != -1 ||
                                            opts.value.lastIndexOf(".gif") != -1 ) {
                                        
                                            if( opts.default ) {
                                                    http_file();
                                            }
                                            else if( opts.target.attr("id") == "workbench" ) {
                                                    $("#myModalaaa input[data-skema=cue]").attr("disabled","true");
                                                    $("#myModalaaa [data-target=data]").unbind( "click" );
                                                    $("#myModalaaa [data-target=view]").unbind( "click" );
                                                    opts.data = { list : [ { picture_url : "" , title : "" , subtitle : ""} ] };
                                                    opts.target.append( $.View.modal_router().options().target.clone() );
                                                    opts.target.find(".caption").removeAttr("contenteditable");
                                            }
                                    }
                                    else if( opts.value.substr( opts.value.length-5 , opts.value.length ) == ".json" && 
                                             opts.value.substr(0,7) == "http://" ) {
                                            http_json();
                                    }
                                    else {
                                        
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
                                            //  opts.id  == $.uid
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
                            opts.Form = "";
                            opts.source = "none";
                            opts.value = "";
                            opts.skema = {};
                            opts.skema.image = "picture_url";
                            opts.skema.title = "title";
                            opts.skema.subtitle = "subtitle";
                            opts.display = [ true , true , true ];
                            
                            $("#myModalaaa [data-target=data]").unbind( "click" );
                            $("#myModalaaa [data-target=view]").unbind( "click" ); 
                            
                            none_sight();
                            VIEW_click();          
                    }
                    
                    function none_sight()
                    {
                            $("input[data-skema='cue']").eq(0).val(opts.skema.image);
                            $("input[data-skema='cue']").eq(1).val(opts.skema.title);
                            $("input[data-skema='cue']").eq(2).val(opts.skema.subtitle);
                            $("select[data-select='interval']").val(opts.interval);
                            var i=0;
                            var cheackbox = $("input[name=display]");
                            for(i=0;i<cheackbox.length;i++) {
                                    $("input[name=display]")[i].checked = opts.display[i];
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
                                    $("#myModalaaa input[data-skema='cue']").eq(1).val("");
                                    $("#myModalaaa input[data-skema='cue']").eq(2).val("");
                                    $("#myModalaaa input[name=display]")[0].checked = true;
                                    $("#myModalaaa input[name=display]")[1].checked = true;
                                    $("#myModalaaa input[name=display]")[2].checked = true;
                                    $("#myModalaaa input[name=TitleAlign][value=center]").click();
                                    $("#myModalaaa input[name=SubtitleAlign][value=right]").click();
                                    opts.default = true;
                                    $("#myModalaaa input[name=source][value=none]").click();
                            }
                            else {
                                    none();
                            }
                    }
                    
                    function cds_folder() 
                    {       
                            if( opts.default ) {
                                    opts.skema.image = "Name";
                                    opts.skema.title = "Time";
                                    opts.skema.subtitle = "Name";
                            }
                            var today = new Date();
                            var data = { func : "jPWS_DIR", FileType : "any" , PageNo : 1 , PageSize : 500 , Timer : today.getTime() };       
                                data.Path = opts.value;
                            var data2 = { target : opts.target };
                            var callback = function(data) {
                                    try {
                                            data = eval('['+data+']')[0];
                                            if(data.ErrMsg == "OK" && data.Record != undefined) {
                                                    $("input[data-skema='cue']").eq(0).val(opts.skema.image);
                                                    $("input[data-skema='cue']").eq(1).val(opts.skema.title);
                                                    $("input[data-skema='cue']").eq(2).val(opts.skema.subtitle);
                                                    opts.target   = this.data2.target;
                                                    Re_Set_mmobj_value();
                                                    $.View.modal_router().options().data = data;
                                                    opts.data     = data;
                                                    VIEW_click();
                                            }
                                            else {
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
                            $.CGI_proxy( "GET" , "jsk/CDS.Agent.1.0.PPK" , data , data2 , callback , callback_error);
                    }
                    
                    function local_json()
                    {
                            if( opts.default ) {
                                    opts.skema.image = "picture_url";
                                    opts.skema.title = "title";
                                    opts.skema.subtitle = "describe";
                            }
                            var path = opts.id + "\\json\\" +opts.value;
                            var data = { path : path };       
                            var data2 = { target : opts.target };
                            var callback = function(data) {
                                    try {
                                            data = eval('['+data+']')[0];
                                            $("input[data-skema='cue']").eq(0).val(opts.skema.image);
                                            $("input[data-skema='cue']").eq(1).val(opts.skema.title);
                                            $("input[data-skema='cue']").eq(2).val(opts.skema.subtitle);
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
                            if( opts.default ) {
                                    opts.skema.image = "picture_url";
                                    opts.skema.title = "title";
                                    opts.skema.subtitle = "describe";
                            }
                            var data = { path : path };
                            var data2 = { target : opts.target };
                            var callback = function(data) {
                                    try {
                                            data = eval('['+data+']')[0];
                                            $("input[data-skema='cue']").eq(0).val(opts.skema.image);
                                            $("input[data-skema='cue']").eq(1).val(opts.skema.title);
                                            $("input[data-skema='cue']").eq(2).val(opts.skema.subtitle);
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
                            if( $("#main_container")[0] != undefined && opts.target.attr("id") != "workbench") {
                                    opts.target.find("h3").attr("contenteditable",true);
                                    opts.target.find("p").attr("contenteditable",true);
                            }
                    }
                   
                    function flick() 
                    {
                            var data2 = { target : opts.target };
                            callback = function(){
                                    try {
                                            opts.data = $.http_cds_json_file_data;
                                            $.View.modal_router().options().data = opts.data;
                                            $.http_cds_json_file_data = "";
                                            if( opts.default == true ) {
                                                    var data = $.View.modal_router().options().data;
                                                    opts.data = {};
                                                    opts.data.list = [];
                                                    opts.skema.image    = "media";
                                                    opts.skema.title    = "title";
                                                    opts.skema.subtitle = "date_taken";
                                                    for(var i=0;i<data.items.length;i++) {
                                                            opts.data.list[i] = {};
                                                            opts.data.list[i].title = data.items[i]["title"];
                                                            opts.data.list[i].subtitle = data.items[i]["date_taken"];
                                                            opts.data.list[i].picture_url = data.items[i]["media"].m;
                                                    }
                                                    $("input[data-skema='cue']").eq(0).val(opts.skema.image);
                                                    $("input[data-skema='cue']").eq(1).val(opts.skema.title);
                                                    $("input[data-skema='cue']").eq(2).val(opts.skema.subtitle);
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
                                    error();
                                    console.log("error" + data);
                            }
                            $.get_json_file( opts.value , data2 , callback , callback_error);
                    }

                    function http_json()
                    {
                            if( opts.default ) {
                                    opts.skema.image = "picture_url";
                                    opts.skema.title = "title";
                                    opts.skema.subtitle = "describe";
                            }
                            var data2 = { target : opts.target };
                            callback = function(){
                                    try {
                                            opts.data = $.http_cds_json_file_data;
                                            $.View.modal_router().options().data = opts.data;
                                            $.http_cds_json_file_data = "";
                                            if( opts.default ) {
                                                    $("input[data-skema='cue']").eq(0).val(opts.skema.image);
                                                    $("input[data-skema='cue']").eq(1).val(opts.skema.title);
                                                    $("input[data-skema='cue']").eq(2).val(opts.skema.subtitle);
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
                            }
                            $.get_json_file( opts.value , data2 , callback , callback_error);
                    }

                    function MMS() 
                    {
                            var data = {
                                body : {
                                    request     : "get" ,
                                    file        : opts.value[1] ,
                                    usd         : { component_id : opts.target.attr("id") , component_type : opts.mmtype }
                                }
                            }
                            /*
                            $.View.process_mms()._SetOpts({ to : opts.value[0] , data : data , id : opts.target.attr("id") });
                            $.View.process_mms().PutMessage();*/
                            
                            console.log( "PutMM" );
                            $.mm.PutMsg( opts.value[0] , data , function( msg ){
                                        console.log( msg ) ;
                                        console.log( 'PutMsg success' );
                                        $.mm.GetMsg( "5000" , msg.MsgID , function( msg ) {
                                                    console.log( 'GetMsg success' );
                                        }
                                        , function( msg ) {
                                                    console.log( 'GetMsg error' );
                                        });

                            } ,  function( msg ){} );
                    }

                    function MMS_callback() 
                    {
                            opts.target = $("#" + opts.data.Data.body.usd.component_id);
                            Re_Set_mmobj_value();
                            
                            if( opts.value[0] == "json@cds" ) {
                                    if( opts.data.Data.body.JSON == undefined ) {
                                            error();
                                    }
                                    else {
                                            opts.data = opts.data.Data.body.JSON;
                                            if( opts.default ) {
                                                    opts.skema.image = "picture_url";
                                                    opts.skema.title = "title";
                                                    opts.skema.subtitle = "describe";
                                                    $("input[data-skema='cue']").eq(0).val(opts.skema.image);
                                                    $("input[data-skema='cue']").eq(1).val(opts.skema.title);
                                                    $("input[data-skema='cue']").eq(2).val(opts.skema.subtitle);
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
                            if( opts.source == "none" ) {
                                    $.View.view_thumbnails()._SetOpts({ target : opts.target });
                                    $.View.view_thumbnails().destory();
                                    if( $("#workbench").find("div[mmid]")[0] != undefined) {
                                            opts.target.append( $("#workbench div").clone().html() );
                                    }
                                    else {
                                            opts.target.append( $("#workbench").clone().html() );
                                    }
                                    opts.target.find(".caption").attr("contenteditable",true);
                                    /*
                                    if(  $("#workbench").find("[mmid]")[0] != undefined ) {
                                            opts.target.html("");
                                            opts.target.append($("#workbench").find("[mmid]").html());
                                    }
                                    else {
                                            opts.target.attr("changeimage",1);
                                            VIEW_click();
                                    }
                                    opts.target.find("h3").attr("contenteditable",true);
                                    opts.target.find("p").attr("contenteditable",true);
                                    */
                            }
                            else {
                                    VIEW_click();
                                    if( opts.source == "http" ) {
                                            if( opts.value.lastIndexOf(".jpg") != -1 || opts.value.lastIndexOf(".png") != -1 ||
                                                opts.value.lastIndexOf(".tif") != -1 || opts.value.lastIndexOf(".bmp") != -1 ||
                                                opts.value.lastIndexOf(".gif") != -1 ) {
                                                    if( opts.default == false ) {
                                                            $.View.view_thumbnails()._SetOpts({ target : opts.target });
                                                            $.View.view_thumbnails().destory();
                                                            opts.target.append( $("#workbench div").clone().html() );
                                                    }
                                                    opts.target.find(".caption").attr("contenteditable",true);
                                            }
                                    }
                                    /*
                                    opts.target.removeAttr("changeimage");
                                    if(opts.source == "http" && opts.value.lastIndexOf("format=json") == -1) {
                                            opts.target.find("h3").attr("contenteditable",true);
                                            opts.target.find("p").attr("contenteditable",true);
                                    }
                                    */
                            }
                            edit_mmobj();
                    }
                    
                    function VIEW_click() 
                    {
                            $.View.view_thumbnails()._SetOpts({ target : opts.target });
                            $.View.view_thumbnails().destory();
                            console.log(opts.data);
                            cheack_column();                            
                            console.log(opts.data);
                            $.View.view_thumbnails()._SetOpts({ mmobj : opts.data });
                            $.View.view_thumbnails().designer_init_thumbnails();
                            display();
                            titlealign();
                            subtitlealign();
                    }
                    
                    function cheack_column() 
                    {
                            var data = $.View.modal_router().options().data;
                            var i=0;    
                            opts.data = {};
                            opts.data.list = [];
                            /*
                            if( opts.source == "none" ) {
                                    opts.data = { list : [ { title : "Thumbnails01" , subtitle : "2014.5.30" , picture_url : "http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails01.jpg" } ,
                                                      { title : "Thumbnails02" , subtitle : "2014.5.30" , picture_url : "http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails02.jpg" } ,
                                                      { title : "Thumbnails03" , subtitle : "2014.5.30" , picture_url : "http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails03.jpg" }] };
                                    data = { list : [ { title : "Thumbnails01" , subtitle : "2014.5.30" , picture_url : "http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails01.jpg" } ,
                                                      { title : "Thumbnails02" , subtitle : "2014.5.30" , picture_url : "http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails02.jpg" } ,
                                                      { title : "Thumbnails03" , subtitle : "2014.5.30" , picture_url : "http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails03.jpg" }] };
                                    for(i=0;i<data.list.length;i++) {
                                            opts.data.list[i] = {};
                                            opts.data.list[i].picture_url = data.list[i]["picture_url"];
                                            opts.data.list[i].title = data.list[i]["title"];
                                            opts.data.list[i].subtitle = data.list[i]["subtitle"];  
                                    }
                            }
                            */
                            if( opts.source == "none" ) {
                                    if( opts.value != "" && opts.default == false ) {
                                    }
                                    else {
                                            data = { list : [ { title : "Thumbnails01" , subtitle : "2014.5.30" , picture_url : "http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails01.jpg" } ,
                                                              { title : "Thumbnails02" , subtitle : "2014.5.30" , picture_url : "http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails02.jpg" } ,
                                                              { title : "Thumbnails03" , subtitle : "2014.5.30" , picture_url : "http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails03.jpg" }] };
                                            for(i=0;i<data.list.length;i++) {
                                                    opts.data.list[i] = {};
                                                    opts.data.list[i].picture_url = data.list[i]["picture_url"];
                                                    opts.data.list[i].title = data.list[i]["title"];
                                                    opts.data.list[i].subtitle = data.list[i]["subtitle"];  
                                            }
                                    }
                            }
                            else if(opts.source == "http") {
                                    if( opts.value.lastIndexOf("format=json") != -1 ) {
                                            for(i=0;i<data.items.length;i++) {
                                                    opts.data.list[i] = {};
                                                    opts.data.list[i].title = data.items[i][opts.skema.title];
                                                    opts.data.list[i].subtitle = data.items[i][opts.skema.subtitle];
                                                    opts.data.list[i].picture_url = data.items[i][opts.skema.image];  
                                                    if(opts.skema.image == "media") {
                                                            opts.data.list[i].picture_url = data.items[i][opts.skema.image]["m"];
                                                    }
                                                    if(opts.skema.title == "media") {
                                                            opts.data.list[i].title = data.items[i][opts.skema.title]["m"];
                                                    }
                                                    if(opts.skema.subtitle == "media") {
                                                            opts.data.list[i].subtitle = data.items[i][opts.skema.subtitle]["m"];
                                                    }
                                            }
                                    }
                                    else if(opts.value.lastIndexOf(".jpg") != -1 || opts.value.lastIndexOf(".png") != -1 ||
                                            opts.value.lastIndexOf(".tif") != -1 || opts.value.lastIndexOf(".bmp") != -1 ||
                                            opts.value.lastIndexOf(".gif") != -1 ) {

                                            opts.data.list[0] = {};
                                            opts.data.list[0].title = "text";
                                            opts.data.list[0].subtitle = "2014.10.2";
                                            opts.data.list[0].picture_url = opts.value;  
                                            $.View.modal_router().options().data = opts.data;
                                    }
                                    else if( opts.value.substr( opts.value.length-5 , opts.value.length ) == ".json" && 
                                             opts.value.substr(0,7) == "http://" ) {
                                            for(i=0;i<data.list.length;i++) {
                                                    opts.data.list[i] = {};
                                                    opts.data.list[i].title = data.list[i][opts.skema.title];
                                                    opts.data.list[i].subtitle = data.list[i][opts.skema.subtitle];
                                                    opts.data.list[i].picture_url = data.list[i][opts.skema.image];  
                                            }
                                    }
                            }
                            else if(opts.source == "cds") {
                                    // remote json
                                    if( opts.value.substr( opts.value.length-5 , opts.value.length ) == ".json" && 
                                             opts.value.indexOf("\\") == 0 ) {
                                            for(i=0;i<data.list.length;i++) {
                                                    opts.data.list[i] = {};
                                                    opts.data.list[i].picture_url = data.list[i][opts.skema.image];
                                                    opts.data.list[i].title = data.list[i][opts.skema.title];
                                                    opts.data.list[i].subtitle = data.list[i][opts.skema.subtitle];
                                                    if(data.list[i][opts.skema.image] == undefined) {
                                                            opts.data.list[i].picture_url = undefined;
                                                    }
                                            }
                                    }
                                    //local json
                                    else if( opts.value.substr( opts.value.length-5 , opts.value.length ) == ".json" && opts.value.indexOf("\\") != 0 ) {
                                            for(i=0;i<data.list.length;i++) {
                                                    opts.data.list[i] = {};
                                                    opts.data.list[i].picture_url = data.list[i][opts.skema.image];
                                                    opts.data.list[i].title = data.list[i][opts.skema.title];
                                                    opts.data.list[i].subtitle = data.list[i][opts.skema.subtitle];
                                                    if(data.list[i][opts.skema.image] == undefined) {
                                                            opts.data.list[i].picture_url = undefined;
                                                    }
                                            }
                                    }
                                    else if( opts.value.substr( opts.value.length-5 , opts.value.length ) != ".json" ) {
                                            if( data.ReferenceUrl.lastIndexOf(".") != -1 ) {
                                                    data.ReferenceUrl = data.ReferenceUrl.substring( 0 , data.ReferenceUrl.lastIndexOf("/")+1 );
                                            }
                                            for(i=0;i<data.Record.length;i++) {
                                                    opts.data.list[i] = {};
                                                    opts.data.list[i].picture_url = data.AccessUrl + data.ReferenceUrl +  data.Record[i][opts.skema.image];
                                                    opts.data.list[i].title = data.Record[i][opts.skema.title];
                                                    opts.data.list[i].subtitle = data.Record[i][opts.skema.subtitle];
                                                    if(data.Record[i][opts.skema.image] == undefined) {
                                                            opts.data.list[i].picture_url = undefined;
                                                    }
                                            }
                                    }
                            }
                            else if(opts.source == "mms") {
                                    if( opts.value[0] == "json@cds" ) {
                                            for(i=0;i<data.list.length;i++) {
                                                    opts.data.list[i] = {};
                                                    opts.data.list[i].picture_url = data.list[i][opts.skema.image];
                                                    opts.data.list[i].title = data.list[i][opts.skema.title];
                                                    opts.data.list[i].subtitle = data.list[i][opts.skema.subtitle];
                                                    if(data.list[i][opts.skema.image] == undefined) {
                                                            opts.data.list[i].picture_url = undefined;
                                                    }
                                            }
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
                                            });
                                    }
                                    else if( opts.value.substr( opts.value.length-5 , opts.value.length ) == ".json" ) {
                                            $.each( data.list[0] , function(index, value) {
                                                    if(index.length > 20) {
                                                            index = index.substring(0,20) + " ...";
                                                    }
                                                    if(value.length > 20) {
                                                            value = value.substring(0,20) + " ...";
                                                    }
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
                                            opts.skema.title    = $("#myModalaaa input[data-skema='cue']").eq(1).val();
                                            opts.skema.subtitle = $("#myModalaaa input[data-skema='cue']").eq(2).val();
                                    }
                                    opts.display       = [ $("#myModalaaa input[name=display]")[0].checked ,
                                                           $("#myModalaaa input[name=display]")[1].checked ,
                                                           $("#myModalaaa input[name=display]")[2].checked ];
                                    opts.titlealign    = $("#myModalaaa input[name=TitleAlign]:checked").val();
                                    opts.subtitlealign = $("#myModalaaa input[name=SubtitleAlign]:checked").val();
                                    console.log( $.View.process_thumbnails().options() );
                            }
                            else {
                                    opts.mmobj         = eval('[' + opts.target.attr("mmobj") + ']')[0];
                                    opts.source        = opts.mmobj.source;
                                    opts.value         = opts.mmobj.value;
                                    opts.skema         = opts.mmobj.skema;
                                    opts.display       = opts.mmobj.display;
                                    opts.titlealign    = opts.mmobj.titlealign;
                                    opts.subtitlealign = opts.mmobj.subtitlealign;
                                    console.log(opts.mmobj);
                            }
                    }
                    
                    function edit_mmobj() 
                    {
                            var mmobj = { source : opts.source ,
                                           value  : opts.value ,
                                           skema  : opts.skema ,
                                           display : opts.display ,
                                           titlealign : opts.titlealign ,
                                           subtitlealign : opts.subtitlealign };  
                            if( opts.source == "none" ) {
                                     mmobj.dropme = true;
                            }       
                            else if( opts.source == "cds" &&  opts.value.substr( opts.value.length-5 , opts.value.length ) == ".json" ) {
                                     var json = { id : $.uid };
                                     json = JSON.stringify( json );
                                     opts.target.attr("json", json);
                                     value = opts.value.replace(/\\/g,'\\\\');
                            }
                            else if( opts.source == "mms" ) {
                                    mmobj.value[0] = mmobj.value[0].replace(/\\/g,'\\');
                                    mmobj.value[1] = mmobj.value[1].replace(/\\/g,'\\');
                            }
                            else if( opts.value.lastIndexOf(".jpg") != -1 || opts.value.lastIndexOf(".png") != -1 ||
                                     opts.value.lastIndexOf(".tif") != -1 || opts.value.lastIndexOf(".bmp") != -1 ||
                                     opts.value.lastIndexOf(".gif") != -1 ) {
                                    mmobj.dropme = true;
                                    mmobj.value = opts.value.replace(/\\/g,'\\');
                            }
                            else {
                                     mmobj.value = opts.value.replace(/\\/g,'\\');
                            }
                            mmobj = JSON.stringify(mmobj);
                            opts.target.attr("mmobj",mmobj);  
                    }
                    
                    function static_web()
                    {   
                            opts.mmobj = eval('[' + opts.mmobj + ']')[0];
                            opts.source = opts.mmobj.source;
                            opts.value = opts.mmobj.value;
                            opts.skema = opts.mmobj.skema;
                            opts.display = opts.mmobj.display;
                            opts.titlealign = opts.mmobj.titlealign;
                            opts.subtitlealign = opts.mmobj.subtitlealign;
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
                    
                    function display() 
                    {
                            var thumbnails = opts.target.find(".row");
                            if( thumbnails.children().length != 0 ) {
                                    if( opts.display[0] ) {  thumbnails.find(".photo").css("display","block");  }
                                    else                  {  thumbnails.find(".photo").css("display","none");   }
                                    if( opts.display[1] ) {  thumbnails.find("h3").css("display","block");   }
                                    else                  {  thumbnails.find("h3").css("display","none");    }
                                    if( opts.display[2] ) {  thumbnails.find("[data-text=subtitle]").css("display","block");     }
                                    else                  {  thumbnails.find("[data-text=subtitle]").css("display","none");      }
                            }
                    }
                    
                    function titlealign() 
                    {
                            if(opts.titlealign == "left") {
                                    opts.target.find("h3").css("text-align","left");
                            }
                            else if(opts.titlealign == "center") {
                                    opts.target.find("h3").css("text-align","center");
                            }
                            else if(opts.titlealign == "right") {
                                    opts.target.find("h3").css("text-align","right");
                            }
                    }
                    
                    function subtitlealign() 
                    {
                            if(opts.subtitlealign == "left") {
                                    opts.target.find("p").css("text-align","left");
                            }
                            else if(opts.subtitlealign == "center") {
                                    opts.target.find("p").css("text-align","center");
                            }
                            else if(opts.subtitlealign == "right") {
                                    opts.target.find("p").css("text-align","right");
                            }
                    }
                    
                    function add_thumbnails()
                    {
                            var number = opts.target.find(".img-thumbnail").length  %  3 + 1;
                            var number2 = opts.target.find(".img-thumbnail").length + 1;

                            opts.target.find(".row").append('<div class="col-sm-6 col-md-3" hassortable="false">\n\
                                                        <div class="img-thumbnail">\n\
                                                                <div class="photo img-responsive" index_num="247" index_pic="http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails0' + number + '.jpg" \n\
                                                                        style="background-image: url(http://cdn.ypcall.com/Builder/PD/Thumbnails/Thumbnails0' + number + '.jpg"></div>' +
                                                                "<div class='caption'>" +
                                                                        "<h3 style='text-align:center;' >Thumbnails" + number2 + "</h3>" +
                                                                        "<p data-text='subtitle' style='text-align:right;' >2014.5.30</p>" +
                                                                "</div>" +
                                                        '</div>\n\
                                                        <br>\n\
                                                </div>' );
                    }
                   
                    function delete_thumbnails()
                    {
                            var children = opts.target.find(".img-thumbnail").length;
                            if(children > 0) {
                                    opts.target.find(".row").children()[children-1].remove();
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
                                    $("#myModalaaa input[data-skema='cue']").eq(1).val(data.skema["title"]);
                                    $("#myModalaaa input[data-skema='cue']").eq(2).val(data.skema["subtitle"]);
                            }
                            
                            if(data.source == "http") {
                                    $("#myModalaaa div[div-target='HTTP'] input[data-input='uri']").val(data.value);
                            }
                            else if(data.source == "cds") {
                                    $("#myModalaaa div[div-target='CDS'] input[data-input='uri']").val(data.value);
                            }
                            else if(data.source == "mms") {
                                    $("#myModalaaa div[div-target='MMS'] input[data-input='to']").val(data.value[0]);
                                    $("#myModalaaa div[div-target='MMS'] textarea[data-input='body']").val(data.value[1]);
                            }
                            $("#myModalaaa input[name=display]")[0].checked = data.display[0];
                            $("#myModalaaa input[name=display]")[1].checked = data.display[1];
                            $("#myModalaaa input[name=display]")[2].checked = data.display[2];

                            $("#myModalaaa input[name=TitleAlign][value='" + data.titlealign + "']").click();
                            $("#myModalaaa input[name=SubtitleAlign][value='" + data.subtitlealign + "']").click();
                            
                            opts.default = false;
                    }
            };
            // jQuery plugin implementation
            $.fn.process_thumbnails = function(conf) {

                    // return existing instance
                    var el = this.eq(typeof conf == 'number' ? conf : 0).data("process_thumbnails");
                    if (el) {return el;}

                    // setup options
                    var opts = {
                            Form : "" ,
                            source : "" ,
                            value : "" ,
                            demo : 0 ,
                            mmtype : "" ,
                            default : true ,
                            
                            target : "" ,
                            skema : {} ,
                            display : [] ,
                            create_:function(e,m,o){} ,
                    };

                    $.extend(opts, conf);

                    // install the plugin for each items in jQuery
                    this.each(function() {
                            el = new process_thumbnails(this, opts);
                            $(this).data("process_thumbnails", el);
                    });

                    return opts.api ? el: this;
            };
////////////////////////////////////////////////////////////////////////////////////////////////
})(jQuery);
