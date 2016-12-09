<?php
header('Access-Control-Allow-Origin: *');
header("Content-Type: text/plain; charset=utf-8");


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


require_once(dirname(__FILE__) . '/' . 'mipush.php');


// 判断推送消息类型
switch ( $type ) {
    case 'noti'://点击通知启动应用消息
    	if(!checkTitleContent()){
    		return;
    	}
        if(empty($token)){
            MiPush::pushMessage(MiPush::createNotiForm($cid, $title, $content, $payload));
        }else{
            MiPush::pushMessage(MiPush::createNotiFormIOS($cid, $content, $payload), 'i');
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
        if(empty($token)){
            MiPush::pushMessage(MiPush::createLinkForm($cid, $title, $content, $url));
        }else{
            echo( 'Unsupported push link message!' );
        }
        break;
    case 'down'://点击通知弹框下载消息
    	echo( 'Unsupported push download message!' );
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
        if(empty($token)){
            MiPush::pushMessage(MiPush::createTranMessage($cid, $payload));
        }else{
            MiPush::pushMessage(MiPush::createTranMessageIOS($cid, $payload), 'i');
            //echo( 'Unsupported push transmit message!' );
        }
        break;
    default:
        echo( 'Unsupported push type!' );
        return;
        break;
}
