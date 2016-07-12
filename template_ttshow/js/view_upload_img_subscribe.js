$(document).ready(function() {
        
        upload_event();
        
});

function update_qrcode( Text ) {  //document.forms[0].elements['msg'].value.

            var text = Text
                    .replace(/^[\s\u3000]+|[\s\u3000]+$/g, '');
            //document.getElementById('qr').innerHTML = create_qrcode(text);
            //$( "#shareModal" ).find( ".modal-body #shareModal_qrcode" )[0].innerHTML = create_qrcode(text);
            $( "#QRcode" )[0].innerHTML = create_qrcode(text);

};

function create_qrcode(text, typeNumber, errorCorrectLevel, table) {

            var qr = qrcode(typeNumber || 4, errorCorrectLevel || 'M');
            qr.addData(text);
            qr.make();

            //	return qr.createTableTag();
            return qr.createImgTag();

};

function upload_event()
{

            $("#file").unbind('change').bind('change', function(e) {
                        
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
                        if( files.size > 5242880 )
                            alert( "file > 5M" );
                        else
                            handleFileUpload( files , $(e.target).parent() , JudgeFilesType );
                        /*}
                        else
                        alert("Please upload txt");*/

            });
            //abin edit ++ 2015.4.8
            $("[id=transient_file]").unbind('change').bind('change', function(e) {
                        
                        var JudgeFilesType = e.originalEvent.currentTarget.files[0].name.split(".");
                        JudgeFilesType = JudgeFilesType[JudgeFilesType.length-1];
                        JudgeFilesType = JudgeFilesType.toLowerCase();
                        
                        console.log( $(e.target) );
                        
                        if( JudgeFilesType == "jpg" || JudgeFilesType == "jpeg" || JudgeFilesType == "png" || JudgeFilesType == "gif" ) {
                            var files = e.originalEvent.currentTarget.files;
                            $.upload_file.upload = "transient_file";
                            $.upload_file.transient_file = $("#" + $(e.target).attr("target") ).attr("img");
                            $.upload_file.transient_file = $.upload_file.transient_file.substr( $.upload_file.transient_file.lastIndexOf("/")+1,$.upload_file.transient_file.length );
                            $.upload_file.subname = JudgeFilesType;
                            if( files.size > 5242880 ) {
                                alert( "file > 5M" );
                            }
                            else {
                                handleFileUpload( files , $(e.target).parent().parent().parent().find("[id=bar]") , JudgeFilesType , { id : "transient_file" , target : $(e.target).attr("target") } );
                            }
                        } else {
                                alert("error!!");
                        }
                        console.log( JudgeFilesType );

                        e.preventDefault();
            });
            $("#apply_channel_form").find("#user_uploadIcon").unbind('change').bind('change', function(e) {
                        $(this).find("#user_uploadIcon_o").css("display","block");
                        $(this).find("#user_uploadIcon_c").css("display","none");
                        var JudgeFilesType = e.originalEvent.currentTarget.files[0].name.split(".");
                        JudgeFilesType = JudgeFilesType[JudgeFilesType.length-1];
                        JudgeFilesType = JudgeFilesType.toLowerCase();
                        console.log( JudgeFilesType );
                        e.preventDefault();
                        var files = e.originalEvent.currentTarget.files;
                        $.UserMsg.upload = "user"
                        console.log( files );
                        if( files.size > 5242880 )
                            alert( "file > 5M" );
                        else
                            handleFileUpload( files , $(e.target).parent() , JudgeFilesType , { id : "apply_channel_form" } );
            });
            
            $("#apply_member_form").find("#user_uploadIcon").unbind('change').bind('change', function(e) {
                        $(this).find("#user_uploadIcon_o").css("display","block");
                        $(this).find("#user_uploadIcon_c").css("display","none");
                        var JudgeFilesType = e.originalEvent.currentTarget.files[0].name.split(".");
                        JudgeFilesType = JudgeFilesType[JudgeFilesType.length-1];
                        JudgeFilesType = JudgeFilesType.toLowerCase();
                        console.log( JudgeFilesType );
                        e.preventDefault();
                        var files = e.originalEvent.currentTarget.files;
                        $.UserMsg.upload = "user"
                        console.log( files );
                        if( files.size > 5242880 )
                            alert( "file > 5M" );
                        else
                            handleFileUpload( files , $(e.target).parent() , JudgeFilesType , { id : "apply_member_form" } );
            });
            
            $("#user_uploadCover_photo").unbind('change').bind('change', function(e) {
                        $(this).find("#user_uploadCover_photo_o").css("display","block");
                        $(this).find("#user_uploadCover_photo_c").css("display","none");
                        var JudgeFilesType = e.originalEvent.currentTarget.files[0].name.split(".");
                        JudgeFilesType = JudgeFilesType[JudgeFilesType.length-1];
                        JudgeFilesType = JudgeFilesType.toLowerCase();
                        console.log( JudgeFilesType );
                        e.preventDefault();
                        var files = e.originalEvent.currentTarget.files;
                        $.UserMsg.upload = "user"
                        console.log( files );
                        if( files.size > 5242880 )
                            alert( "file > 5M" );
                        else
                            handleFileUpload( files , $(e.target).parent() , JudgeFilesType , { id : "user_uploadCover_photo" } );
            });
            
            
            $("#myModalEditSpecial_uploadIcon").unbind('change').bind('change', function(e) {
                        $(this).find("#CheckSpecial_drop_img_o").css("display","block");
                        $(this).find("#CheckSpecial_drop_img_c").css("display","none");
                        var JudgeFilesType = e.originalEvent.currentTarget.files[0].name.split(".");
                        JudgeFilesType = JudgeFilesType[JudgeFilesType.length-1];
                        JudgeFilesType = JudgeFilesType.toLowerCase();
                        console.log( JudgeFilesType );
                        e.preventDefault();
                        var files = e.originalEvent.currentTarget.files;
                        $.UserMsg.upload = "special_icon"
                        console.log( files );
                        if( files.size > 5242880 )
                            alert( "file > 5M" );
                        else
                            handleFileUpload( files , $(e.target).parent() , JudgeFilesType , { id : "myModalEditSpecial_uploadIcon" } );
            });
            //abin edit -- 2015.4.8
}


function handleFileUpload(files,obj,type,data2)
{
                        for (var i = 0; i < files.length; i++) 
                        {
                                    console.log( files[i] );
                                                var fd = new FormData();
                                                console.log( files[i] );
                                                fd.append('file', files[i]);

                                                var status = new createStatusbar(obj); //Using this we can set progress.
                                                //status.setFileNameSize(files[i].name,files[i].size); //bohan0625--
                                                //obj.hide();

                                                sendHtmlToServer(fd,status,obj,type,data2);
                                                //sendFileToServer(fd,status);
                        }
}


var rowCount=0;
function createStatusbar(obj)
{
            console.log( obj );
            rowCount++;
            var row="odd";
            if(rowCount %2 ===0) row ="even";
            this.statusbar = $("<div class='statusbar "+row+"'></div>");
            //this.filename = $("<div class='filename'></div>").appendTo(this.statusbar); //bohan0625--
            //this.size = $("<div class='filesize'></div>").appendTo(this.statusbar); //bohan0625--
            this.progressBar = $("<div class='progressBar' style='width: 100%; padding: 0px; margin: 0px;'><div style='text-align: center;'></div></div>").appendTo(this.statusbar);
            //this.abort = $("<div class='abort'>Abort</div>").appendTo(this.statusbar); //bohan0625--
            //abin edit ++
            this.statusbar.attr("class","")
            //abin edit ++
            obj.after(this.statusbar);

           /*this.setFileNameSize = function(name,size)
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
           };*/////bohan0625--
           this.setProgress = function(progress)
           {
                        var progressBarWidth =progress*this.progressBar.width()/ 100;  
                        this.progressBar.find('div').animate({ width: progressBarWidth }, 10).html(progress + "% ");
                        if(parseInt(progress) >= 100)
                        {
                                console.log( this.progressBar );
                                
                                this.progressBar.parent().remove();
                                /*this.abort.hide();
                                //bohan
                                this.abort.parent().prev().prev().show();
                                //this.abort.parent().next().children().attr( "src" , "" );
                                //this.abort.parent().next().show();
                                this.abort.parent().remove();*/
                        }
           };
           /*this.setAbort = function(jqxhr)
           {
                        var sb = this.statusbar;
                        this.abort.click(function()
                        {
                                jqxhr.abort();
                                //abin ++
                                if( $.upload_file != undefined && $.upload_file.upload == "transient_file" ) {
                                        $("#usericon").css("background-image",'url("template/assets/img/icon_uplaod-02.png")');
                                        $("#usericon").attr("img", "" );
                                        $("#cooperate_icon").css("background-image",'url("template/assets/img/icon_uplaod-02.png")');
                                        $("#cooperate_icon").attr("img", "" );
                                }
                                //abin --
                                sb.hide();
                        });
           };*/////bohan0625--
}

//abin edit ++ 2015.4.8
function sendHtmlToServer( formData , status ,  obj , type , data2)
{
            var time = new Date();
            var s = time.getFullYear().toString() + 
                    ( time.getMonth() + 1 ).toString() + 
                    time.getDate() + time.getHours().toString() + 
                    time.getMinutes().toString() + 
                    time.getSeconds().toString() + 
                    time.getMilliseconds().toString();

            console.log( s );

            //console.log( "obj.attr('un') = " + obj.attr('un') );

            //search_parent( obj , ".state" );
            //console.log( "state = " + $.state );
            /*if( type === "png" || type === "jpg" || type === "gif" )
                var filetype = "img";
            else if( type === "mp4" )
                var filetype = "mp4";*/
            //opts.obj = obj;
            
            //var uploadURL ='php/user_upload_image.php?id=' + $("#id").val() ;
	    /* ++ abin ++ */
            if( $.upload_file.upload == "transient_file" ) {
                    console.log( "$.upload_file.transient_file = " + $.upload_file.transient_file );
                    var uploadURL ='php/user_upload_image.php?upload=' + $.upload_file.upload + "&subname=" + $.upload_file.subname + "&transient_file=" + $.upload_file.transient_file + "&ttshow=" + getCookie( "ttshow" );
            } else {
                    var uploadURL ='php/user_upload_image.php?id=' + $.UserMsg.email + "&ttshow=" + getCookie( "ttshow" );
            }
	    /*-- abin -- */
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
                                console.log( data2 );
                                if( this.data2.id == "transient_file" && data.search("http") != -1 ) {
                                        data = JSON.parse( data );
                                        var d = new Date();
                                        $("#"+data2.target).css("background-image","url(" + data.http + "?" + d.getTime() + ")");
                                        $("#"+data2.target).attr("img", data.http );
                                        $("#"+data2.target).attr("src", data.http );//bohan0525++
                                        $("[target="+data2.target+"]").parent().parent().hide();
                                        $("#"+data2.target).show();
                                        $.upload_file.transient_file = data.filename;
                                        $.upload_file.beforeunload[data2.target] = data.filename;
                                }
                                /*
                                else if( this.data2.id == "apply_channel_form" && data.search("http") != -1 ) {
                                        $("#apply_channel_form").find("#user_uploadIcon_c").attr("src",data);
                                        $("#apply_channel_form").find("#user_uploadIcon_o").css("display","none");
                                        $("#apply_channel_form").find("#user_uploadIcon_c").css("display","block");
                                } else if( this.data2.id == "apply_member_form" && data.search("http") != -1 ) {
                                        $("#apply_member_form").find("#user_uploadIcon_c").attr("src",data);
                                        $("#apply_member_form").find("#user_uploadIcon_o").css("display","none");
                                        $("#apply_member_form").find("#user_uploadIcon_c").css("display","block");
                                } else if( this.data2.id == "user_uploadCover_photo" && data.search("http") != -1 ) {
                                        $("#user_uploadCover_photo_c").attr("src",data);
                                        $("#user_uploadCover_photo_o").css("display","none");
                                        $("#user_uploadCover_photo_c").css("display","block");
                                } else if( this.data2.id == "myModalEditSpecial_uploadIcon" && data.search("http") != -1 ) {
                                        $("#CheckSpecial_drop_img_c").attr("src",data);
                                        $("#CheckSpecial_drop_img_o").css("display","none");
                                        $("#CheckSpecial_drop_img_c").parent().css("display","block");
                                }
                                */
                                console.log( data );
                        }
            });

            //status.setAbort(jqXHR); //bohan0625--
}
//abin edit -- 2015.4.8
