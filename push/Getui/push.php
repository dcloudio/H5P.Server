<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: text/html; charset=utf-8");


if ( $_SERVER['REQUEST_METHOD'] != 'POST' ) {
    echo( 'Invalid request method: '.$_SERVER['REQUEST_METHOD'] );
    return;
}

// 判断提交参数[必选]: 推送消息类型
if ( !isset($_POST['pushtype']) ) {
    echo( 'Invalid push type!' );
    return;
}
$type = $_POST['pushtype'];

// 判断提交参数[必选]: 终端标识
if ( !isset($_POST['cid']) ) {
    echo( 'Invalid push client ID!' );
    return;
}
$cid = $_POST['cid'];

// 判断提交参数[可选]: 终端APNS的token
$token = null;
if ( isset($_POST['token']) ) {
    $token = $_POST['token'];
}

// 判断提交参数[可选]: 透传数据
$payload = null;
if ( isset($_POST['payload']) ) {
    $payload = $_POST['payload'];
}


$title = null;
$content = null;
// 检查获取标题及推送内容
function checkTitleContent(){
    global $title,$content;
	if ( isset($_POST['title']) ) {
	    $title = $_POST['title'];
	}
    if ( empty($title) ) {
	    $title = 'HBuilder';
	}

	if ( !isset($_POST['content']) ) {
	    echo( 'Invalid push content!' );
	    return false;
	}
	$content = $_POST['content'];
	if ( empty($content) ) {
	    echo( 'Empty push content!' );
	    return false;
	}
	return true;
}


require_once(dirname(__FILE__) . '/' . 'igetui.php');


// 判断推送消息类型
switch ( $type ) {
    case 'noti'://点击通知启动应用消息
    	if(!checkTitleContent()){
    		return;
    	}
        if(empty($token)||isOnline($cid)){
            pushMessageToSingle(createNotiMessage($title, $content, $payload), $cid);
        }else{
            apnMessageToSingle($token, $content, $payload);
        }
        break;
    case 'link'://点击通知打开网页消息
    	if(!checkTitleContent()){
    		return;
    	}
        if ( !isset($_POST['url']) ) {
            echo( 'Invalid link push url!' );
            return;
        }
        $url = $_POST['url'];
        if ( empty($url) ) {
            echo( 'Empty link push url!' );
            return;
        }
        if(empty($token)||isOnline($cid)){
            pushMessageToSingle(createLinkMessage($title, $content, $url), $cid);
        }else{
            $payload = json_encode(array('type'=>'link','url'=>$url));
            apnMessageToSingle($token, $content, $payload);
        }
        break;
    case 'down'://点击通知弹框下载消息
    	if(!checkTitleContent()){
    		return;
    	}
        // Download pop title.
        $ptitle = '';
        if ( isset($_POST['ptitle']) ) {
            $ptitle = $_POST['ptitle'];
        }
        if ( empty($ptitle) ) {
            $ptitle = 'HBuilder';
        }
        // Download pop content.
        if ( !isset($_POST['pcontent']) ) {
            echo( 'Invalid download pop content!' );
            return;
        }
        $pcontent = $_POST['pcontent'];
        if ( empty($pcontent) ) {
            echo( 'Empty download pop content!' );
            return;
        }
        // Download title.
        $dtitle = '';
        if ( isset($_POST['dtitle']) ) {
            $dtitle = $_POST['dtitle'];
        }
        if ( empty($dtitle) ) {
            $dtitle = 'HBuilder';
        }
        // Download url.
        if ( !isset($_POST['durl']) ) {
            echo( 'Invalid download push url!' );
            return;
        }
        $durl = $_POST['durl'];
        if ( empty($durl) ) {
            echo( 'Empty download push url!' );
            return;
        }
        if(empty($token)||isOnline($cid)){
            pushMessageToSingle(createDownMessage($title, $content, $ptitle, $pcontent, $dtitle, $durl), $cid);
        }else{
            $payload = json_encode(array('type'=>'down','ptitle'=>$ptitle,'pcontent'=>$pcontent,'durl'=>$durl));
            apnMessageToSingle($token, $content, $payload);
        }
        break;
    case 'tran':
        checkTitleContent();
        // Payload content
        if ( !isset($_POST['payload']) ) {
            echo( 'Invalid payload content!' );
            return;
        }
        $payload = $_POST['payload'];
        if ( empty($payload) ) {
            echo( 'Empty payload content!' );
            return;
        }
        if(empty($token)||empty($content)||isOnline($cid)){
            pushMessageToSingle(createTranMessage($payload), $cid);
        }else{
            apnMessageToSingle($token, $content, $payload);
        }
        break;
    default:
        echo( 'Unsupported push type!' );
        return;
        break;
}
