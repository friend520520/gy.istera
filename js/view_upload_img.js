$(document).ready(function() {
        
        upload_event();
        
});

function allow_subname( val ) {
        
        var subname;
        val = val || "images";
        
        switch( val ){
            case "images":
                subname = [ "jpg" , "jpeg" , "png" , "gif" ];
                break;
            case "all":
                subname = [ "chm" , "pdf" , "zip" , "rar" , "tar" ,
                            "gz" , "bzip2" , "gif" , "jpg" , "jpeg" ,
                            "png" , "torrent" , "bmp" , "txt" , "doc" ,
                            "swf" , "7z" , "mp3" , "dat" , "avi" ,
                            "mpg" , "mpeg" , "rmvb" , "rm" , "wmv" ,
                            "wma" , "flv" , "mp4" , "asf" , "asx" ,
                            "mov" , "qt" , "wav" , "wax" , "3gp" ,
                            "vob" , "mkv" , "iso" , "tgz" ];
                break;
            case "php":
                subname = [ "php" ];
                break;
            case "xls":
                subname = [ "xls" ];
                break;
        }
        return subname;
}

function upload_event()
{
            
            $("[id=upload_language]").unbind('change').bind('change', function(e) {
                        
                        var JudgeFilesType = e.originalEvent.currentTarget.files[0].name.split(".");
                        JudgeFilesType = JudgeFilesType[JudgeFilesType.length-1];
                        JudgeFilesType = JudgeFilesType.toLowerCase();
                        
                        var files = e.originalEvent.currentTarget.files;
                        
                        var allow = allow_subname( $( this ).attr( "allow" ) );
                        
                        console.log( allow );
                        if( $.inArray( JudgeFilesType , allow ) === -1 ) {
                            show_remind( "格式錯誤，請上傳" + allow.join( "、" ) + "等格式之檔案" , "error" );
                        }
                        else {
                            var files = e.originalEvent.currentTarget.files;
                            if( files.size > 5242880 ) {
                                alert( "file > 5M" );
                            }
                            else {
                                handleFileUpload( files , $(e.target).parent().find("[id=bar]") , "upload_language" , $(e.target).attr("target") );
                            }
                        }
                        e.preventDefault();
            });
            $( ".clear_upload" ).unbind( "click" ).bind( "click" , function(){
                    var target = $( this ).attr( "target" );
                    $( "[id=" + target + "]" ).css( "background-image" , "" );
                    $.upload_file[ target ] = "CLEAR";
            });
            
            $("#my_cloud_disk").unbind('change').bind('change', function(e) {
                    
                    var JudgeFilesType = e.originalEvent.currentTarget.files[0].name.split(".");
                    JudgeFilesType = JudgeFilesType[JudgeFilesType.length-1];
                    JudgeFilesType = JudgeFilesType.toLowerCase();
                    
                    var allow = allow_subname( $( this ).attr( "allow" ) );

                    if( $.inArray( JudgeFilesType , allow ) === -1 ) {
                        show_remind( "格式錯誤，請上傳" + allow.join( "、" ) + "等格式之檔案" , "error" );
                    }
                    else {
                        var files = e.originalEvent.currentTarget.files;
                        if( files.size > 5242880 ) {
                            alert( "file > 5M" );
                        }
                        else {
                            handleFileUpload( files , $(e.target).parent().find("[id=bar]") , "cloud_disk" , "editor_upload_img" );
                        }
                    }
                    e.preventDefault();
            });
            $("[id=transient_file]").unbind('change').bind('change', function(e) {
                        
                        var JudgeFilesType = e.originalEvent.currentTarget.files[0].name.split(".");
                        JudgeFilesType = JudgeFilesType[JudgeFilesType.length-1];
                        JudgeFilesType = JudgeFilesType.toLowerCase();
                        
                        var files = e.originalEvent.currentTarget.files;
                        
                        var allow = allow_subname( $( this ).attr( "allow" ) );
                        
                        console.log( allow );
                        if( $.inArray( JudgeFilesType , allow ) === -1 ) {
                            show_remind( "格式錯誤，請上傳" + allow.join( "、" ) + "等格式之檔案" , "error" );
                        }
                        else {
                            var files = e.originalEvent.currentTarget.files;
                            if( files.size > 5242880 ) {
                                alert( "file > 5M" );
                            }
                            else {
                                handleFileUpload( files , $(e.target).parent().find("[id=bar]") , "transient" , $(e.target).attr("target") );
                            }
                        }
                        e.preventDefault();
            });
            $("[id=static_page_upload]").unbind('change').bind('change', function(e) {
                        
                        var JudgeFilesType = e.originalEvent.currentTarget.files[0].name.split(".");
                        JudgeFilesType = JudgeFilesType[JudgeFilesType.length-1];
                        JudgeFilesType = JudgeFilesType.toLowerCase();
                        
                        var files = e.originalEvent.currentTarget.files;
                        var allow = allow_subname( $( this ).attr( "allow" ) );
                        
                        if( $.inArray( JudgeFilesType , allow ) === -1 ) {
                            show_remind( "格式錯誤，請上傳" + allow.join( "、" ) + "等格式之檔案" , "error" );
                        }
                        else {
                            var files = e.originalEvent.currentTarget.files;
                            if( files.size > 5242880 ) {
                                alert( "file > 5M" );
                            }
                            else {
                                handleFileUpload( files , $(e.target).parent().find("[id=bar]") , "static_pages" , $(e.target).parents("[file]").attr("file") );
                            }
                        }
                        e.preventDefault();
            });

}

function handleFileUpload(files,obj,func,event)
{
        for (var i = 0; i < files.length; i++) 
        {
                var fd = new FormData();
                fd.append('file', files[i]);

                var status = new createStatusbar(obj); //Using this we can set progress.
                status.setFileNameSize(files[i].name,files[i].size);
                //obj.hide();

                sendHtmlToServer(fd,files[i],status,func,event);
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
            this.statusbar.attr("class","")
            obj.append(this.statusbar);

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
                                if( $.upload_file != undefined && $.upload_file.upload == "transient_file" ) {
                                        $("#usericon").css("background-image",'url("template/assets/img/icon_uplaod-02.png")');
                                        $("#usericon").attr("img", "" );
                                        $("#cooperate_icon").css("background-image",'url("template/assets/img/icon_uplaod-02.png")');
                                        $("#cooperate_icon").attr("img", "" );
                                }
                                sb.hide();
                        });
           };
}

function sendHtmlToServer( formData , file , status , func , event)
{
            if( $.upload_ask === "nobody" && func === "transient" ){
                var uploadURL ='php/user_upload_image.php?func=transient_nobody';
            }
            else if( func === "static_pages" ){
                var uploadURL ='php/mgm_static_pages.php?token=' + getCookie("istera_cookie") + '&func=upload&file=' + event;
            }
            else if( func === "upload_language" ){
                var uploadURL ='php/language.php?func=upload_language&token=' + getCookie("istera_cookie");
            }
            else{
                var uploadURL ='php/user_upload_image.php?token=' + getCookie("istera_cookie") + '&func=' + func;
            }
            
            
            var extraData ={}; 
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
                        data2 : event,
                        //dataType: "json",
                        success: function(data){
                                
                                var data = JSON.parse( data );
                                console.log( data );
                                if( data.Success ){
                                    if( this.data2 == "editor_upload_img" ) {
                                            var clone = $("#ttshow_img_list_example_model").clone();
                                            clone.removeAttr("id");
                                            clone.attr( "src" , data.data );
                                            clone.css("background-image","url(\'" + data.data + "\')");
                                            clone.css("display","block");
                                            $( "#ttshow_img_list_space" ).prepend( clone );
                                            $("#ttshow_img_list_space div").unbind('click').bind( 'click' , $.ttshow_change_img_event );
                                    }
                                    else if( this.data2 === "insert_attach" ){
                                            buildAttach( data.data.file , file.name , "" , "新上傳" , "member" );
                                            $.upload_file_transient[ $.upload_file_transient.length ] = data.data.file;
                                            $.upload_file["insert_attach"][ $.upload_file["insert_attach"].length ] = { filename : data.data.file , fileOriname : file.name };
                                    }
                                    else if( func == "transient" ){
                                            $.upload_file_transient[ $.upload_file_transient.length ] = data.data.file;
                                            $.upload_file[ this.data2 ] = data.data.file;
                                            $( "[id="+ this.data2 +"]" ).css( "background-image" , "url('" + data.data.path + data.data.file + "')" ).attr( "src" , data.data.path + data.data.file );
                                    }
                                    else if( func == "static_pages" ){
                                            $( "[file='" + this.data2 + "'] .ace-file-input" ).addClass( "hidden" );
                                            $( "[file='" + this.data2 + "'] [state=already]" ).removeClass( "hidden" );
                                    }
                                    else if( func == "upload_language" ){
                                            show_remind( "上傳成功" );
                                    }
                                }
                                else{
                                    show_remind( data.ErrMsg , "error" );
                                }
                                
                        }
            });
            
            status.setAbort(jqXHR);
}

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
        $.each( $.upload_file_transient , function(index, value) {
                delete_transient_file( value );
        });
});
$(window).unload( function(){
        $.each( $.upload_file_transient , function(index, value) {
                delete_transient_file( value );
        });
});