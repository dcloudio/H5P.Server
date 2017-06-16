<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: text/plain');

require_once 'aop/AopClient.php';
require_once 'aop/request/AlipayTradeAppPayRequest.php';

// 获取支付金额
$amount='';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $amount=$_POST['total'];
}else{
    $amount=$_GET['total'];
}

$total = floatval($amount);
if(!$total){
    $total = 1;
}

$aop = new AopClient;
$aop->gatewayUrl = "https://openapi.alipay.com/gateway.do";
$aop->appId = "app_id";
$aop->rsaPrivateKey = '请填写开发者私钥去头去尾去回车，一行字符串';
$aop->format = "json";
$aop->charset = "UTF-8";
$aop->signType = "RSA2";
$aop->alipayrsaPublicKey = '请填写支付宝公钥，一行字符串';
//实例化具体API对应的request类,类名称和接口名称对应,当前调用接口名称：alipay.trade.app.pay
$request = new AlipayTradeAppPayRequest();

// 异步通知地址
$notify_url = urlencode('商户外网可以访问的异步地址');
// 订单标题
$subject = 'DCloud项目捐赠';
// 订单详情
$body = 'DCloud致力于打造HTML5最好的移动开发工具，包括终端的Runtime、云端的服务和IDE，同时提供各项配套的开发者服务。'; 
// 订单号，示例代码使用时间值作为唯一的订单ID号
$out_trade_no = date('YmdHis', time());

//SDK已经封装掉了公共参数，这里只需要传入业务参数
$bizcontent = "{\"body\":\"".$body."\","
                . "\"subject\": \"".$subject."\","
                . "\"out_trade_no\": \"".$out_trade_no."\","
                . "\"timeout_express\": \"30m\","
                . "\"total_amount\": \"".$total."\","
                . "\"product_code\":\"QUICK_MSECURITY_PAY\""
                . "}";
$request->setNotifyUrl($notify_url);
$request->setBizContent($bizcontent);
//这里和普通的接口调用不同，使用的是sdkExecute
$response = $aop->sdkExecute($request);

// 注意：这里不需要使用htmlspecialchars进行转义，直接返回即可
echo $response;
?>