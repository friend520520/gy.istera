<?php
    header("Access-Control-Allow-Origin:*");
    header('Access-Control-Allow-Credentials:true');
    header('Access-Control-Allow-Methods:GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers:Origin, No-Cache, X-Requested-With, If-Modified-Since, Pragma, Last-Modified, Cache-Control, Expires, Content-Type, X-E4M-With');
    header('Content-Type:text/html; charset=utf-8');

    require 'gmail.php';
    include '../global.php';
    $callback = array();
    
    try{

            if( isset($_REQUEST["email"]) && !empty($_REQUEST["email"]) )
            {

                    $con=mysqli_connect("localhost","root","ggyyggy","th");
                    $con->query("SET NAMES utf8");
                    $email = $_REQUEST["email"];
                    
                    if (mysqli_connect_errno()) {
                        echo "false";
                    }
                    else {
                        while( true )
                        {
                            $token = getRandom( 20 );
                            $result = mysqli_query($con, "SELECT * FROM account WHERE a_forget_token='$token'");
                            
                            if (mysqli_num_rows($result) > 0) {

                            }
                            else {
                                break;
                            }
                        }
                        
                        if( mysqli_query($con, "UPDATE account SET a_forget_token='$token' WHERE a_email='" . $email . "'") ) {
                                
                                $account = get_sql($con, "account", "WHERE a_email='" . $email . "'");
                                $account = $account ? $account[0]['a_id'] : "";
                                
                                $url        = 'http://www.ggyyggy.com/th/forget_password_newpassword.php' ;
                                $html = '<div class="readMsgBody">
                                            <div id="bodyreadMessagePartBodyControl243f" class="ExternalClass MsgBodyContainer" data-link="class{:~tag.cssClasses(PlainText, IsContentFiltered)}">
                                                <div>
                                                    <div style="font-size:14px;min-height:auto;padding:15px 15px 10px;overflow:visible;line-height:170%;min-height:100px;">
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                            <tbody>
                                                                <tr valign="top">
                                                                    <td width="100%">
                                                                        <table width="100%" cellspacing="0" border="0">
                                                                            <tbody>
                                                                                <tr valign="top">
                                                                                    <td width="1%">
                                                                                        
                                                                                    </td>
                                                                                    <td>
                                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                                            <tbody>
                                                                                                <tr valign="top">
                                                                                                    <td align="left" style="padding-right:3px;line-height:12px;"><font size="-2" face="verdana,geneva,sans-serif"> </font></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td align="right" style="padding:6px 0pt 0pt 4px;"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <table width="100%" cellpadding="3" border="0" align="center">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td bgcolor="#ffffcc" align="center"><font size="-1" face="Arial"><b> 此信件為系統發出信件，請勿直接回覆。</b> </font></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table width="100%" cellspacing="0" cellpadding="4" border="0" align="center">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td bgcolor="#d0e3ff"><font face="arial"><b>親愛的再興師生 您好！</b>                  </font></td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td>
                                                                                        <table width="100%" cellspacing="0" cellpadding="4" border="0" align="center">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td align="left"> <font size="-1" face="arial"><p> 感謝您使用了郵箱 <a href="#">' . $email . '</a> 在再興生活APP 申請帳號</p>                            <p>請您於透過本封信函進行e-mail認證，以啟用您的會員帳號。</p>                            <br>                          以下是您的資料，請勿遺失</font></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table width="100%" border="0" bgcolor="#f0f6ff">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>
                                                                                        <table cellspacing="0" cellpadding="4" border="0">
                                                                                            <tbody>
                                                                                                <tr>
                                                                                                    <td width="96" align="right"><font size="-1" face="Arial"><u></u>您的帳號是：<u></u></font></td>
                                                                                                    <td width="154" align="left"><font face="arial"><b>' . $account . '</b></font></td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td height="12"></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <p align="left"><font size="-1" face="Arial,Helvetica">認證方式：</font></p>
                                                                        <p align="left"><font size="-1" face="Arial,Helvetica">1.請點選下方連結進行認證。</font></p>
                                                                        <p align="left"><a target="_blank" style="width:109px;min-height:28px;border:0;color:#fff;text-align:center;display:block;background-color:#f60;" href="' . $url . '?token=' . $token . '"> 按此認證</a></p>
                                                                        <p align="left"><font size="-1" face="Arial,Helvetica">2.若上方連結無法點選，請您可將網址複製後貼到瀏覽器視窗中，<wbr>亦可完成認證動作。</font></p>
                                                                        <p align="left"><a target="_blank" href="' . $url . '?token=' . $token . '">' . $url . '?token=' . $token . '</a></p>
                                                                        <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                                            <tbody>
                                                                                <tr> </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table width="585" cellspacing="0" cellpadding="1" border="0"> </table>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td height="8"><img width="1" height="1"></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="ecxyj6qo"></div>
                                                        <div class="ecxadL"> </div>
                                                    </div>
                                                    <div class="ecxadL"> </div>
                                                </div>
                                            </div>
                                        </div>';
                                mstart( $email , $html );
                                
                        }
                        else {
                                $callback['msg'] = "SET TOKEN ERROR";
                                $callback['success'] = false;
                                echo json_encode($callback);
                        }
                        ////////////////////////
                        mysqli_close($con);
                        
                    }
            }
    }
    catch (Exception $e)
    {
            $callback['msg'] = $exc->getTraceAsString();
            $callback['success'] = false;
            echo json_encode($callback);
    }


    function getRandom( $count )
    {
        $var = "";
        for( $i=1 ; $i<=$count ; $i++ )
        {
            $ASCII = getASCII();
            $var .= $ASCII;
        }
        return $var;
    }

    function getASCII()
    {//48~57,65~90 //48~83 65-58=7
        $count = ceil(lcg_randf(47, 83));
        if( $count >= 58 )
        {
            $count += 7;
        }
        return chr( $count );
    }

    function lcg_randf($min, $max)
    {
        return $min + lcg_value() * abs($max - $min);
    }
    
?>