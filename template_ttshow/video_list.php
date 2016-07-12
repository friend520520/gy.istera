<!DOCTYPE html>
<html lang="en">
	<head>
                
                <script src="js/google_analytics.js"></script>
                
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>ttshow-我的影片</title>

        <meta name="description" content="讓台灣的好作品、好人才被全世界看見" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="template/assets/css/bootstrap.css" />
                <link rel="stylesheet" href="template/assets/css/font-awesome.css" />
                <!--link rel="stylesheet" href="template/assets/css/jquery-ui.css" />
                <link rel="stylesheet" href="template/assets/css/ace-fonts.css" /-->

        <!-- ace styles 4/9 AL 更換CSS路徑-->
        <link rel="stylesheet" href="template/assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

        <script src="template/assets/js/jquery.js"></script>
        <script src="js/device.js"></script>
        <script src="js/create.js"></script>
        <script src="template/assets/js/ace-extra.js"></script>

        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

        <!--[if lte IE 8]>
		<script src="template/assets/js/html5shiv.js"></script>
		<script src="template/assets/js/respond.js"></script>
		<![endif]-->
		<link href="js/TouchSwipe-Jquery-Plugin-master/demos/css/main.css" type="text/css" rel="stylesheet" />
                <style>
                        .youtobe_video > [name=u2_player] {
                            position: relative;
                        }
                        .youtobe_video > [name=u2_player]:before {
                            content: "";
                            display: block;
                            padding-top: 62%;
                        }
                        .youtobe_video > [name=u2_player] > iframe {
                            bottom: 0;
                            left: 0;
                            position: absolute;
                            right: 0;
                            top: 0;
                        }
                        #video_place div.active {
                            background-color: lightblue;
                        }
                        
                </style>
                
                <!-- design by al -->
                    <style>
                        .panel-body1{
                           padding-left: 10px; 
                           padding-right: 10px;
                        }
                        .panel1{
                           float: left;
                           width: 100%; 
                           margin-bottom: 15px;
                        }
                        .panel1-btn{
                           float: right;
                           padding: 0px 13px; 
                           border-radius: 3px; 
                           background-color: rgb(19, 74, 121) !important;
                           border-color: rgb(19, 74, 121) !important;
                        }
                        .panel1-id{
                           margin-left: 9px; 
                           font-size: 11pt;
                        }
                        .panel1-identity{
                           margin-left: 8px;
                        }
                        .panel1-time{
                           position: absolute; 
                           margin-top: 10px; 
                           left: 70px;
                        }
                        .panel1-time-icon{
                           color: gray; 
                           padding-right: 5px;
                        }
                        .panel1-time span{
                           color: gray;
                        }
                        .panel1-title{
                           font-size: 14pt;
                           letter-spacing: 1px; 
                           margin-top: 5px; 
                           margin-bottom: 0px;
                        }
                        .panel1-time-description{
                           letter-spacing: 1px; 
                           color: gray; 
                           margin-top: 5px; 
                           margin-bottom: 10px;
                        }
                        .panel1-like{
                           float: left;
                            margin-right: 5px
                        }
                        .panel1-view{
                           float: left; 
                           color: gray;
                        }
                        .panel1-icontext{
                           margin-right: 3px;
                        }
                        .panel1-replay{
                           float: left; 
                           margin-left: 5px;
                           color: gray;
                        }
                        .panel1-tag{
                           background-color: gray;
                           color: white;
                           float: right;
                           font-size: 9pt;
                           margin-right: 5px;
                           padding: 1px 2px;
                        }
                        .panel1-firetag{
                           position: absolute; 
                           right: 12px;
                        }
                        
                        
                        
                        .semi-transparent-button {
                            background: none repeat scroll 0 0 rgba(30, 52, 142, 0.6);
                            border-radius: 8px;
                            box-sizing: border-box;
                            color: #fff;
                            display: block;
                            letter-spacing: 1px;
                            margin: 0 auto;
                            max-width: 100px;
                            padding: 8px;
                            text-align: center;
                            text-decoration: none;
                            transition: all 0.3s ease-out 0s;
                            width: 80%;
                        }
                    </style>
	</head>

	<body class="no-skin" >
        <!-- #section:basics/navbar.layout -->
        <!--div id="loadingpage" class="widget-box-overlay"><i class="ace-icon loading-icon fa fa-spinner fa-spin fa-2x white"></i></div-->
        
        <?php include( "header_1.php"); ?>
        
        <div class="main-container" id="main-container" style="background-color: white;">
           
                <?php include("sidebar.php"); ?>
            
                <div class="main-content" style="margin-left: 190px;">
                <div class="main-content-inner">
                  <!-- #section:basics/content.breadcrumbs -->
                    <div class="page-content">

                        <div class="page-content" id="pagecontent" style="margin-left: 10px; margin-top: 10px;">
                            <div class="col-xs-12 col-sm-12 col-md-11 col-lg-11" style="padding-right: 0px">
                                <div class="page-header">
                                    <h1>
                                        我的影片
                                     </h1>
                                </div>

                                <div style="margin-top: 7px; padding-top: 11px; padding-right: 10px;" class="widget-box col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-left: 13px;margin-bottom: 10px">

                                        <div class="btn-group">
                                            <a href='upload_video.php'>
                                                <button id="upload_btn" title='上傳影片' class="btn btn-sm  btn-primary panel-float-left" style="margin-top: 4px; border-radius: 3px;">
                                                    <i class="fa fa-plus fa-lg"></i>
                                                </button>
                                            </a>
                                            <button id="delete_btn" title='刪除影片' class="btn btn-sm  btn-primary panel-float-left" style="margin-top: 4px; border-radius: 3px;;margin-left: 10px">
                                                <i class="fa fa-trash-o fa-lg"></i>
                                            </button>
                                            <button id="upload_img_btn" title='上傳預覽圖' class="btn btn-sm  btn-primary panel-float-left" style="margin-top: 4px; border-radius: 3px;;margin-left: 10px">
                                                <i class="fa fa-plus fa-lg"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="clearfix">

                                    </div>
                                    <hr style="margin-top:0px;margin-bottom: 10px">

                                    <div id="video_place">
                                    
                                    </div>

                                  </div>
                                
                            </div>
                                
                                
                            </div>
                            <div class="col-md-1 col-lg-1"></div>
                            </div>

                            <div id="collect_place">

                            </div>
                    </div>
                </div>
        </div>
        
                <!--div class="main-content">
                            <div class="main-content-inner" style="margin-top: 45px">
                                        <div class="page-content">
                                                    <div class="widget-body">
                                                                <div class="widget-main padding-0">
                                                                  <div class="tab-content padding-0">
                                                                    <div class="tab-pane in active" id="pagecontent">
                                                                    </div>

                                                                  </div>
                                                                </div>
                                                    </div>
                                        </div>
                            </div>
                </div-->
        

        
        <!-- /.main-content -->
  
  
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110">
                    </i>
        </a>
        
        <div class="modal fade in" id="myModal_uploadimg" style="" aria-hidden="false">
            <!--div class="modal-backdrop fade in" style="height: 665px;"></div-->
                <div class="modal-dialog">
                        <div class="modal-content">
                                <div class="modal-header">
                                        <button data-dismiss="modal" class="close" type="button">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <h4 class="modal-title" style="font-size: 25px">上傳預覽圖</h4>
                                </div>
                                <div class="modal-body" style="padding: 25px">
                                        <input multiple="" type="file" id="file" />
                                </div>
                        </div>
                </div>
        </div>


        <!-- <![endif]-->
        <script>
                    
                        $(document).ready( function() {

                                
                                $('#file').ace_file_input({
				     style:'well',
				     btn_choose:'Drop files here or click to choose',
				     btn_change:null,
				     no_icon:'ace-icon fa fa-cloud-upload',
				     droppable:true,
				     thumbnail:'small'//large | fit
				     //,icon_remove:null//set null, to hide remove/reset button
				     /**,before_change:function(files, dropped) {
				      //Check an example below
				      //or examples/file-upload.html
				      return true;
				     }*/
				     /**,before_remove : function() {
				      return true;
				     }*/
				     ,
				     preview_error : function(filename, error_code) {
				      //name of the file that failed
				      //error_code values
				      //1 = 'FILE_LOAD_FAILED',
				      //2 = 'IMAGE_LOAD_FAILED',
				      //3 = 'THUMBNAIL_FAILED'
				      //alert(error_code);
				     }
   
                                }).on('change', function(e){
                                        
                                        var JudgeFilesType = e.originalEvent.currentTarget.files[0].name.split(".");
                                        JudgeFilesType = JudgeFilesType[JudgeFilesType.length-1];
                                        JudgeFilesType = JudgeFilesType.toLowerCase();

                                        console.log( JudgeFilesType );
                                        //if( JudgeFilesType === "txt" ){
                                        //$(this).css('border', '2px dotted #0B85A1');
                                        e.preventDefault();
                                        //var files = e.originalEvent.dataTransfer.files;
                                        var files = e.originalEvent.currentTarget.files;

                                        console.log( files );
                                        handleFileUpload( files , $(e.target).parent() , JudgeFilesType );
                                        
                                     
                                });
                        });
                        
                        function init() {
                            
                                video_list();
                                
                                $( "#delete_btn" ).unbind( "click" ).bind( "click" , function(){
                                        
                                        if( $( "#video_place" ).children("div.active")[0] !== undefined )
                                        {
                                                
                                                var yt_id = [];
                                                var i = 0;
                                                $.each( $( "#video_place" ).children("div.active") , function( index , value ){

                                                        yt_id[i] = $( value ).children( "img" ).attr( "video" );
                                                        i++;

                                                });

                                                console.log( yt_id );
                                                
                                                $.ajax({
                                                            type    : "POST",  
                                                            url     : "php/user_delete_video.php" ,
                                                            data    : { yt_id : yt_id },
                                                            success: function(data)
                                                            {
                                                                        video_list();
                                                            }

                                                });
                                                //location.href = "video.php?v=" + $( this ).attr( "video" );
                                        }
                                });
                                
                                $( "#upload_img_btn" ).unbind( "click" ).bind( "click" , function(){
                                        
                                        if( $( "#video_place" ).children("div.active").length === 1 )
                                        {
                                                $( "#myModal_uploadimg" ).modal( "show" );
                                        }
                                        else
                                        {
                                                alert( "choose one video" );
                                        }
                                });
                            
                        }
                        
                        function enter_video_event() {
                                
                                
                                $( "#video_place" ).children("div").unbind( "click" ).bind( "click" , function(){
                                        
                                        if( $( this ).hasClass("active") )
                                            $( this ).removeClass("active");
                                        else
                                            $( this ).addClass("active");
                                        
                                });
                                
                                $( "#video_place img" ).unbind( "dblclick" ).bind( "dblclick" , function(){
                                        
                                        console.log( $( this ) );
                                        //location.href = "video.php?v=" + $( this ).attr( "video" );
                                        
                                });
                        }
                        
                        function video_list() {
                            
                                $.ajax({
                                            type    : "POST",  
                                            url     : "php/user_list_video.php" ,
                                            data    : {},
                                            success: function(data)
                                            {
                                                        data = JSON.parse( data );
                                                        console.log( data );
                                                        if( data === false )
                                                        {
                                                                location.href = "http://www.ooxxoox.com/ttshow/mobile/php/ttshow_get.php";
                                                        }
                                                        else
                                                        {
                                                                $( "#video_place" ).html("");
                                                                var tmp = "";
                                                                $.each( data , function( index , value ){
                                                                        
                                                                        if( value.status === "public" || value.status === "unlisted" )//private , 
                                                                        {

                                                                            if( value.title.length > 33 )
                                                                            {
                                                                                        var tmp_title = value.title.substr( 0 , 28 ) + ".." ;
                                                                            }else{
                                                                                        var tmp_title = value.title ;
                                                                            }

                                                                                
                                                                            tmp += '<div style="text-align: center; margin-right: 1px; margin-bottom: 1px; max-width: 230px;" class="col-xs-12 col-sm-6 col-md-4 col-lg-2">' +
                                                                                        '<img style="cursor:pointer; margin-top: 10px;" video="' + value.id + '" width="100%" src="' + value.image + '" alt="" aria-hidden="true">' +
                                                                                        '<h6 style="margin-right:0px; margin-bottom: 10px;">' +
                                                                                            '<a href="https://www.youtube.com/watch?v=' + value.id + '" target="_blank" video="' + value.id + '" dir="ltr" class="yt-uix-sessionlink yt-uix-tile-link  spf-link  yt-ui-ellipsis yt-ui-ellipsis-2">' + tmp_title + '</a>' +
                                                                                        '</h6>' +
                                                                                    '</div>';
                                                                        }
                                                                });

                                                                //tmp += '<div class="clearfix"></div>';
                                                                $( "#video_place" ).html( tmp );
                                                                enter_video_event();
                                                        }
                                            }

                                });
                            
                            
                        }
                        

                        function handleFileUpload(files,obj,type,data2)
                        {
                                                for (var i = 0; i < files.length; i++) 
                                                {
                                                            console.log( files[i] );
                                                                        var fd = new FormData();
                                                                        fd.append('file', files[i]);

                                                                        var status = new createStatusbar(obj); //Using this we can set progress.
                                                                        status.setFileNameSize(files[i].name,files[i].size);
                                                                        //obj.hide();

                                                                        sendHtmlToServer(fd,status,obj,type,data2);
                                                                        //sendFileToServer(fd,status);
                                                }
                        }


                        var rowCount=0;
                        function createStatusbar(obj)
                        {
                                    rowCount++;
                                    var row="odd";
                                    if(rowCount %2 ===0) row ="even";
                                    this.statusbar = $("<div class='statusbar "+row+"'></div>");
                                    this.filename = $("<div class='filename'></div>").appendTo(this.statusbar);
                                    this.size = $("<div class='filesize'></div>").appendTo(this.statusbar);
                                    this.progressBar = $("<div class='progressBar'><div></div></div>").appendTo(this.statusbar);
                                    this.abort = $("<div class='abort'>Abort</div>").appendTo(this.statusbar);
                                    obj.after(this.statusbar);

                                   this.setFileNameSize = function(name,size)
                                   {
                                                var sizeStr="";
                                                var sizeKB = size/1024;
                                                if(parseInt(sizeKB) > 1024)
                                                {
                                                        var sizeMB = sizeKB/1024;
                                                        sizeStr = sizeMB.toFixed(2)+" MB";
                                                }
                                                else
                                                {
                                                        sizeStr = sizeKB.toFixed(2)+" KB";
                                                }

                                                this.filename.html(name);
                                                this.size.html(sizeStr);
                                   };
                                   this.setProgress = function(progress)
                                   {
                                                var progressBarWidth =progress*this.progressBar.width()/ 100;  
                                                this.progressBar.find('div').animate({ width: progressBarWidth }, 10).html(progress + "% ");
                                                if(parseInt(progress) >= 100)
                                                {
                                                        this.abort.hide();
                                                        //bohan
                                                        this.abort.parent().prev().prev().show();
                                                        //this.abort.parent().next().children().attr( "src" , "" );
                                                        //this.abort.parent().next().show();
                                                        this.abort.parent().remove();
                                                }
                                   };
                                   this.setAbort = function(jqxhr)
                                   {
                                                var sb = this.statusbar;
                                                this.abort.click(function()
                                                {
                                                        jqxhr.abort();
                                                        sb.hide();
                                                });
                                   };
                        }

                        //abin edit ++ 2015.4.8
                        function sendHtmlToServer( formData , status ,  obj , type , data2)
                        {

                                    var uploadURL ='php/user_upload_video_thumbnails.php?videoid=' + $( "#video_place div.active img" ).attr("video") ;
                                    var extraData ={}; //Extra Data.
                                    var jqXHR=$.ajax({
                                                xhr: function() {
                                                            var xhrobj = $.ajaxSettings.xhr();
                                                            if (xhrobj.upload) {
                                                                        xhrobj.upload.addEventListener('progress', function(event) {
                                                                                    var percent = 0;
                                                                                    var position = event.loaded || event.position;
                                                                                    var total = event.total;
                                                                                    if (event.lengthComputable) {
                                                                                                            percent = Math.ceil(position / total * 100);
                                                                                    }
                                                                                    //Set progress
                                                                                    status.setProgress(percent);
                                                                        }, false);
                                                            }
                                                            return xhrobj;
                                                },
                                                url: uploadURL,
                                                type: "POST",
                                                contentType:false,
                                                processData: false,
                                                cache: false,
                                                data: formData,
                                                data2 : data2,
                                                //dataType: "json",
                                                success: function(data){
                                                        
                                                        console.log( data );
                                                        if( data !== "false" )
                                                        {
                                                            $( "#myModal_uploadimg" ).modal( "toggle" );
                                                            video_list();
                                                        }
                                                            
                                                        
                                                        
                                                }
                                    });

                                    status.setAbort(jqXHR);
                        }
                </script>
        
        <script type="text/javascript">
                if ('ontouchstart' in document.documentElement) document.write("<script src='template/assets/js/jquery.mobile.custom.js'>" + "<" + "/script>");
        </script>
        <script src="template/assets/js/bootstrap.js"></script>

        <!-- page specific plugin scripts -->
        <script src="template/assets/js/jquery-ui.js"></script>
        <script src="template/assets/js/jquery.ui.touch-punch.js"></script>

        <!-- ace scripts -->
        <script src="template/assets/js/ace/elements.scroller.js"></script>
        <script src="template/assets/js/ace/elements.colorpicker.js"></script>
        <script src="template/assets/js/ace/elements.fileinput.js"></script>
        <script src="template/assets/js/ace/elements.typeahead.js"></script>
        <script src="template/assets/js/ace/elements.wysiwyg.js"></script>
        <script src="template/assets/js/ace/elements.spinner.js"></script>
        <script src="template/assets/js/ace/elements.treeview.js"></script>
        <script src="template/assets/js/ace/elements.wizard.js"></script>
        <script src="template/assets/js/ace/elements.aside.js"></script>
        <script src="template/assets/js/ace/ace.js"></script>
        <script src="template/assets/js/ace/ace.ajax-content.js"></script>
        <script src="template/assets/js/ace/ace.touch-drag.js"></script>
        <script src="template/assets/js/ace/ace.sidebar.js"></script>
        <script src="template/assets/js/ace/ace.sidebar-scroll-1.js"></script>
        <script src="template/assets/js/ace/ace.submenu-hover.js"></script>
        <!--script src="template/assets/js/ace/ace.widget-box.js"></script>
        <script src="template/assets/js/ace/ace.settings.js"></script>
        <script src="template/assets/js/ace/ace.settings-rtl.js"></script>
        <script src="template/assets/js/ace/ace.settings-skin.js"></script>
        <script src="template/assets/js/ace/ace.widget-on-reload.js"></script>
        <script src="template/assets/js/ace/ace.searchbox-autocomplete.js"></script-->

        <!-- inline scripts related to this page -->
        <script type="text/javascript">
                jQuery(function($) {

                        //jquery tabs
                        if( $( "#tabs" ).length )
                        $( "#tabs" ).tabs().show();



                });
        </script>

        <!-- the following scripts are used in demo only for onpage help and you don't need them -->
        <!--link rel="stylesheet" href="template/assets/css/ace.onpage-help.css" /-->
        <!--link rel="stylesheet" href="template/docs/assets/js/themes/sunburst.css" /-->

        <script type="text/javascript">
                ace.vars['base'] = '..';
        </script>

        
        <script src="js/TouchSwipe-Jquery-Plugin-master/jquery.touchSwipe.min.js"></script>
        
        
        <!-- init       : null -->
        <!-- callback   : FB_connected_callback_init( response ) -->
        
        <style>
                    
                /* <div style="background-image:url('img/global/folder.png');"></div> */
                .pagebg {
                            background-position: 50% 0%;
                            background-size: cover;
                            height: 94%;
                            margin-left: 0%;
                            margin-top: 3%;
                            /*position: absolute;*/
                            width: 94%;
                }
            
        </style>

        <script type="text/javascript">
                
                function FB_connected_callback_init( response )
                {
                            $.member = response;
                            $( "#main-container" ).show();
                            init();
                };

                function FB_unconnected_callback_init()
                {
                            $.member = "";
                            $( "#main-container" ).hide();
                            Login_Popup_show();
                };

                function unlogin_jump()
                {
                            location.href = "index.php";
                }

        </script>

        <script src="js/fb-login.js"></script>

</body>

</html>
