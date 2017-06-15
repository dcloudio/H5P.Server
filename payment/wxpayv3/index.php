<?php
header('Access-Control-Allow-Origin: *');
header('Content-type: text/plain');

require_once "WxPay.Api.php";
require_once "WxPay.Data.php";


// 获取支付金额
$amount='';
if($_SERVER['REQUEST_METHOD']=='POST'){
    $amount=$_POST['total'];
}else{
    $amount=$_GET['total'];
}
$total = floatval($amount);
$total = round($total*100); // 将元转成分
if(empty($total)){
    $total = 100;
}

// 商品名称
$subject = 'DCloud项目捐赠';
// 订单号，示例代码使用时间值作为唯一的订单ID号
$out_trade_no = date('YmdHis', time());

$unifiedOrder = new WxPayUnifiedOrder();
$unifiedOrder->SetBody($subject);//商品或支付单简要描述
$unifiedOrder->SetOut_trade_no($out_trade_no);
$unifiedOrder->SetTotal_fee($total);
$unifiedOrder->SetTrade_type("APP");
$result = WxPayApi::unifiedOrder($unifiedOrder);
if (is_array($result)) {
    echo json_encode($result);
}

?>