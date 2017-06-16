# 支付宝APP支付新版本
HBuilder客户端早已支持支付宝APP支付新版本，与老版本相比，差别就是订单的生成代码不一样，客户端不需要做任何的修改。
此示例是基于支付宝官方PHP SDK（aop、lotusphp_runtime、AopSdk.php）的简单实现，详见index.php代码。

## 使用说明
1. 打开index.php文件，配置以下变量值：
- $aop->appId = "app_id";
应用APPID
- $aop->rsaPrivateKey = '请填写开发者私钥去头去尾去回车，一行字符串';
应用的RSA2密钥（私钥）
- $aop->alipayrsaPublicKey = '请填写支付宝公钥，一行字符串';
应用的支付宝公钥，设置应用RSA2公钥后可查看
- $notify_url = urlencode('商户外网可以访问的异步地址');
支付回调URL地址


2. 部署服务器后访问index.php获取订单，需要提交total参数(单位为元)，如：
[http://demo.dcloud.net.cn/payment/alipayrsa2/?total=1](http://demo.dcloud.net.cn/payment/alipayrsa2/?total=1)
这是使用DCloud账号生成的订单示例地址，其中total值为要支付的金额。

## 示例代码
参考index.php

## 参考资料
### [移动支付老版本和APP支付新版本接入对比](https://doc.open.alipay.com/docs/doc.htm?docType=1&articleId=106541)

### [APP支付密钥配置和支付宝公钥的获取](https://doc.open.alipay.com/docs/doc.htm?treeId=291&articleId=105972&docType=1)

### [APP支付服务端DEMO&SDK](https://doc.open.alipay.com/docs/doc.htm?treeId=54&articleId=106370&docType=1)
