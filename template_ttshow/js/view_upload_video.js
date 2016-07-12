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
                        var files = e.originalEvent.currentTarget.files
                        
                        if( $( "#title_input" ).val() === "" )
                        {
                                alert("input title");
                        }
                        else if( $( "#tag_input" ).val() === "" )
                        {
                                alert("input tag");
                        }
                        else if( $( "#description_input" ).val() === "" )
                        {
                                alert("input description");
                        }
                        else
                                handleFileUpload( files , $(e.target).parent() , JudgeFilesType );
                        /*}
                        else
                        alert("Please upload txt");*/

            });
}


function handleFileUpload(files,obj,type)
{
                        for (var i = 0; i < files.length; i++) 
                        {
                                    console.log( files[i] );
                                                var fd = new FormData();
                                                fd.append('file', files[i]);

                                                var status = new createStatusbar(obj); //Using this we can set progress.
                                                status.setFileNameSize(files[i].name,files[i].size);
                                                //obj.hide();

                                                sendHtmlToServer(fd,status,obj,type);
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


function sendHtmlToServer( formData , status ,  obj , type )
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
            
            var uploadURL ='php/user_upload_video.php?privacyStatus=' 
                                + $( "#pub_select" ).val() + "&title=" + $( "#title_input" ).val() + "&tag=" + $( "#tag_input" ).val() + "&description=" + $( "#description_input" ).val();
            var extraData ={}; //Extra Data.
            var jqXHR=$.ajaxq_upload( "upload" , {
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
                        //dataType: "json",
                        success: function(data){
                                
                                console.log( data );
                                if( data === "success" )
                                {
                                        
                                        alert("success");
                                        $( "#title_input" ).val("");
                                        $( "#tag_input" ).val("");
                                        $( "#description_input" ).val("");
                                        $( "#upload_place .ace-file-input .remove" ).trigger("click");
                                        
                                }
                                
                        }
            });

            status.setAbort(jqXHR);
}
