<?php
header('Access-Control-Allow-Origin: *');


require_once(dirname(__FILE__).'/'.'igetui.php');
require_once(dirname(__FILE__).'/'.'igetui/template/notify/IGt.Notify.php');


// 返回错误信息
function error($des){
    header('Content-type: text/plain; charset=utf-8');
    echo '!!ERROR!!'.PHP_EOL;
    echo $des;
    echo PHP_EOL;
}

// 创建支持厂商通道的透传消息
function createPushMessage($p, $i, $t, $c){
    $template =  new IGtTransmissionTemplate();
    $template->set_appId(APPID);//应用appid
    $template->set_appkey(APPKEY);//应用appkey
    $template->set_transmissionType(2);//透传消息类型:1为激活客户端启动

    //为了保证应用切换到后台时接收到个推在线推送消息，转换为{title:'',content:'',payload:''}格式数据，UniPush将在系统通知栏显示
    //如果开发者不希望由UniPush处理，则不需要转换为上述格式数据（将触发receive事件，由应用业务逻辑处理）
    //注意：iOS在线时转换为此格式也触发receive事件
    $payload = array('title'=>$t, 'content'=>$c);
    $pj = json_decode($p, TRUE);
    $payload['payload'] = is_array($pj)?$pj:$p;
    $template->set_transmissionContent(json_encode($payload));//透传内容

    //兼容使用厂商通道传输
    $notify = new IGtNotify();
    $notify->set_title($t);
    $notify->set_content($c);
    $notify->set_intent($i);
    $notify->set_type(NotifyInfo_type::_intent);
    $template->set3rdNotifyInfo($notify);


    //iOS平台设置APN信息，如果应用离线（不在前台运行）则通过APNS下发推送消息
    $apn = new IGtAPNPayload();
    $apn->alertMsg = new DictionaryAlertMsg();
    $apn->alertMsg->body = $c;
    $apn->add_customMsg('payload', is_array($pj)?json_encode($pj):$p);//payload兼容json格式字符串
    $template->set_apnInfo($apn);
    //个推老版本接口: $template ->set_pushInfo($actionLocKey,$badge,$message,$sound,$payload,$locKey,$locArgs,$launchImage);
    //$template->set_pushInfo('', 0, $c, '', $p, '', '', '');

    return $template;
}

$cid = '';
$title = '';
$content = '';
$payload = '';
$package = PACKAGENAME;//包名

switch (@$_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $cid = @$_POST['cid'];
        $title = @$_POST['title'];
        $content = @$_POST['content'];
        $payload = @$_POST['payload'];
        break;
    case 'GET':
        $cid = @$_GET['cid'];
        $title = @$_GET['title'];
        $content = @$_GET['content'];
        $payload = @$_GET['payload'];
        break;
    default:
        break;
}

if(empty($cid)){
    error('无效的终端标识（cid）');
    return;
}else if(empty($title)){
    error('无效的通知标题（title）');
    return;
}else if(empty($content)){
    error('无效的通知内容（content）');
    return;
}


// 生成指定格式的intent支持厂商推送通道
$intent = "intent:#Intent;action=android.intent.action.oppopush;launchFlags=0x14000000;component={$package}/io.dcloud.PandoraEntry;S.UP-OL-SU=true;S.title={$title};S.content={$content};S.payload={$payload};end";


pushMessageToSingle(createPushMessage($payload,$intent,$title,$content), $cid);

