<?php header("X-Frame-Options: DENY");?>

<?php 
    include 'php/config.php';
    include 'php/global.php';
    
    
    $html = init_func();
    //forum.php?mod=attachment&aid=MTExODY2MjE5fDgxZmM0Y2M3fDE0NTI2NzMwODh8NTEyODAxMnwxMDY0NzM5Mg%3D%3D
    //mod=misc&action=attachcredit&aid=111866219&formhash=616bfe76
    function init_func(){
            
            if( check_empty( array( "mod" , "file" , "page" ) ) ) {
                // $_GET['file'] 即為傳入要下載檔名的引數
                //header("Content-type:application");
                
                $mod = $_REQUEST["mod"];
                $file = $_REQUEST["file"];
                $page = $_REQUEST["page"];
                if( !in_array($mod, array("attaching","attachment")) ){//,"attached"
                        //$html = "參數不正確";
                        //return $html;
                        header("Location:".http_default_path."v_article_info.php?p=".$page );
                        exit;
                }
                if( !isset($_COOKIE["funbook_cookie"]) || empty($_COOKIE["funbook_cookie"]) ) {
                        //$html = "未登入";
                        //return $html;
                        header("Location:".http_default_path."v_article_info.php?p=".$page );
                        exit;
                }
                
                $token = md5( $_COOKIE["funbook_cookie"] );
                
                $DB_CON = DB_CON( DB_NAME );
                if( !$DB_CON["success"] ){
                        header("Location:".http_default_path."v_article_info.php?p=".$page );
                        exit;
                }
                $con = $DB_CON["data"];

                $Check_Member = Check_Member( $con , $token );
                if( !$Check_Member["success"] ){
                        mysqli_close($con);
                        //return "帳號已從其他地方登入";
                        header("Location:".http_default_path."v_article_info.php?p=".$page );
                        exit;
                }
                $account = $Check_Member["data"];
                
                $check = Check_Vip( $con , $token );
                $tmp_cond = $check["success"] ? " AND c.cate_display IN ('vip','block')" : " AND c.cate_display = 'block'";
                
                $page_file = get_sql($con, "page_file as pf"
                                    . " join page as p on pf.pf_page_id = p.page_id"
                                    . " join category as c on p.p_main_category_id = c.cate_id"
                                    , "WHERE pf.pf_id='$file' AND p.p_display='block'$tmp_cond");
                
                if( !$page_file ){
                        mysqli_close($con);
                        //return "此檔案不提供下載或沒有此檔案";
                        header("Location:".http_default_path."v_article_info.php?p=".$page );
                        exit;
                }
                
                
                
                date_default_timezone_set('Asia/Taipei');
                if( $mod === "attachment" ){
                        
                        $history = get_sql($con, "page_file_history", "WHERE pfh_a_id='".$account[0]["a_id"]."' AND pfh_pf_id='$file' Order by pfh_date DESC");
                        if( $history ){

                                $datetime = date('Y-m-d H:i:s');
                                $dateTimestamp1 = strtotime($history[0]["pfh_date"]);
                                $dateTimestamp2 = strtotime($datetime);
                                if ( $dateTimestamp2 - $dateTimestamp1 >= (int)$history[0]["pfh_change_time"] ){
                                    $tmp_html = "您的 G幣-5";
                                    $tmp_html2 = "您的 G幣-5，開始下載";
                                }
                                else{
                                    $tmp_html = "檔案在期限內重複下載，不需扣G幣";
                                    $tmp_html2 = "開始下載";
                                }
                        }
                        else{
                                $tmp_html = "您的 G幣-5";
                                $tmp_html2 = "您的 G幣-5，開始下載";
                        }
                        $html = '<div class="f_c altw" style="padding: 20px; margin: 60px auto; background: rgb(255, 255, 255) none repeat scroll 0px 0px; border: 3px solid rgb(242, 242, 242); max-width: 100%; width:580px;">
                                    <div class="alert_info" id="messagetext" style="background: transparent url(&quot;../../static/image/common/info.gif&quot;) no-repeat scroll 8px 8px; font-size: 14px; height: auto ! important; line-height: 160%; min-height: 40px; padding: 6px 0px 6px 58px; max-width: 100%;">
                                        <p style="word-wrap: break-word">'.$tmp_html.'，現在將開始下載「'.$page_file[0]['pf_original_name'].'」</p>
                                        <script type="text/javascript" reload="1">
                                             setTimeout( function(){ window.location.href =\'v_download.php?mod=attaching&page='.$page.'&file='.$file.'\'; show_remind("'.$tmp_html2.'"); }, 3000);
                                        </script>
                                        <p class="alert_btnleft" style="margin-top: 8px">
                                            <a href="v_download.php?mod=attaching&page='.$page.'&file='.$file.'">如果 3 秒後下載仍未開始，請點擊此鏈接</a>
                                        </p>
                                    </div>
                                </div>';
                }
                else if( $mod === "attaching" ){
                        $filepath = page_path.(string)$page_file[0]["page_id"]."/Attachment/".$page_file[0]["pf_name"];
                        if(file_exists($filepath) ){
                                
                                $history = get_sql($con, "page_file_history", "WHERE pfh_a_id='".$account[0]["a_id"]."' AND pfh_pf_id='$file' Order by pfh_date DESC");
                                if( $history ){
                                        
                                        $datetime = date('Y-m-d H:i:s');
                                        $dateTimestamp1 = strtotime($history[0]["pfh_date"]);
                                        $dateTimestamp2 = strtotime($datetime);
                                        if ( $dateTimestamp2 - $dateTimestamp1 >= (int)$history[0]["pfh_change_time"] ){
                                            download_process( $con , $file , $account , $page_file );
                                        }
                                }
                                else{
                                        download_process( $con , $file , $account , $page_file );
                                }
                                header('Content-Type: application/octet-stream');
                                header("Content-Length: " .(string)(filesize($filepath)));
                                header("Content-Disposition: attachment; filename=".$page_file[0]["pf_original_name"]);
                                readfile($filepath);
                                mysqli_close($con);
                                exit;
                                
                        }
                        else{
                                mysqli_close($con);
                                header("Location:http://www.ggyyggy.com/funbook19/" );
                                exit;
                        }
                }
//                else if( $mod === "attached" ){
//                        
//                        $html = '<div class="f_c altw" style="padding: 20px; margin: 60px auto; background: rgb(255, 255, 255) none repeat scroll 0px 0px; border: 3px solid rgb(242, 242, 242); max-width: 100%; width:580px;">
//                                    <div class="alert_info" id="messagetext" style="background: transparent url(&quot;../../static/image/common/info.gif&quot;) no-repeat scroll 8px 8px; font-size: 14px; height: auto ! important; line-height: 160%; min-height: 40px; padding: 6px 0px 6px 58px; max-width: 100%;">
//                                        <p style="word-wrap: break-word">您的 G幣-5 ，現在將開始下載「'.$page_file[0]['pf_original_name'].'」</p>
//                                        <script type="text/javascript" reload="1">
//                                             alert( "開始下載，積分扣一" );
//                                        </script>
//                                        <p class="alert_btnleft" style="margin-top: 8px">
//                                            <a href="v_download.php?mod=attaching&file='.$file.'">如果 3 秒後下載仍未開始，請點擊此鏈接</a>
//                                        </p>
//                                    </div>
//                                </div>';
//                }
                
                mysqli_close($con);
                return $html;

            }
            else{
                //$html = "提供參數不足";
                //return $html;
                header("Location:http://www.ggyyggy.com/funbook19/" );
                exit;
            }
        
    }
    
    function download_process( $con , $file , $account , $page_file ){
            
            $sql = "UPDATE  `page_file` SET pf_download_num=pf_download_num+1 WHERE pf_id='$file'";
            if ( !mysqli_query($con, $sql) ) {
                    mysqli_close($con);
                    exit;
            }
            include 'php/account_event.php';
            //下載附件 事件
            try {
                $fn_count = fn_count( $con, "AV00005", $account[0]["a_id"], "在<a href=\"v_article_info.php?p=".$page_file[0]['page_id']."\"><span style=\"color: #FFB15D\">".$page_file[0]['p_title']."</span></a>的帖子下載".$page_file[0]['pf_original_name'] );
            } catch (Exception $exc) {}
            //下載附件 事件
            if( !$fn_count["success"] ){
                    mysqli_close($con);
                    exit;
            }
            
            //檔案重新下載上限時間
            $system = get_sql($con, "system", "WHERE s_id=1", "s_page_file_time");
            $s_page_file_time = $system ? (int)$system[0]["s_page_file_time"] : 60*60*24*3;//load不到資料庫defaul 3天
            $insert_array = array( "pfh_pf_id" => $file ,
                                   "pfh_a_id" => $account[0]["a_id"] ,
                                   "pfh_date" => date('Y-m-d H:i:s') ,
                                   "pfh_ip" => $_SERVER['REMOTE_ADDR'] ,
                                   "pfh_change_time" => $s_page_file_time );
            if ( !insert_sql($con, "page_file_history", $insert_array) ) {
                    mysqli_close($con);
                    exit;
            }
            
            $date = date('Y-m-d');
            $file_num_d = get_sql($con, "page_file_num_d" , "WHERE pfd_pf_id='$file' AND pfd_date='$date'");
            if( $file_num_d ){
                    $sql = "UPDATE page_file_num_d SET pfd_download_num=pfd_download_num+1 WHERE pfd_id=" . $file_num_d[0]['pfd_id'];
                    if ( !mysqli_query( $con , $sql ) ) {
                            mysqli_close($con);
                            exit;
                    }
            }
            else {
                    $sql = "INSERT INTO page_file_num_d( pfd_pf_id, pfd_download_num, pfd_date ) VALUES ( '$file', 1, '$date')";
                    if ( !mysqli_query( $con , $sql ) ) {
                            mysqli_close($con);
                            exit;
                    }
            }
    }

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Funbook19.com</title>
    <meta name="viewport" content="width=device-width , initial-scale=1.0" />
    <link rel='shortcut icon' href='favicon.ico' type='x-icon'>
    <link href="template/css/style.css" rel="stylesheet" type="text/css">
    <link href="template/css/owl.css" rel="stylesheet" type="text/css">
    <?php include( "js/all_js.php"); ?>
</head>

<body>
<div id="all">
        <?php include 'html/loading.php'; ?>
        <?php include( "html/header.php"); ?>
        <?php echo $html; ?>
        <?php include( "html/bottom.php"); ?>
        <?php include( "html/footer.php"); ?>
        <script>
                
                $( ".f_c.altw a" ).bind( "click" , function(){
                        show_remind("已G幣-5");
                });
                
        </script>
</div>

    



</body>
</html>