# 微信支付V3

##使用说明
1. 打开WxPay.Config.php文件，配置以下常量值：

|  名称  |  说明  |  获取方法  |
|  APPID  |  应用APPID  |  开户邮件中可获取  |
|  MCHID  |  商户号  | 开户邮件中可获取  |
|  KEY  |  API密钥(32位数字或英文字符)  | 登录商户平台的[API安全](https://pay.weixin.qq.com/index.php/account/api_cert)中设置  |
|  NOTIFY_URL  |  商户号  | 订单通知URL地址  |

2. 部署服务器后访问index.php获取订单，需要提交total参数(单位为元)，如：
[http://demo.dcloud.net.cn/payment/wxpayv3.StreamApp/?total=1](http://demo.dcloud.net.cn/payment/wxpayv3.StreamApp/?total=1)


##[支付场景介绍](https://pay.weixin.qq.com/wiki/doc/api/app.php?chapter=8_1)

##[支付流程说明](https://pay.weixin.qq.com/wiki/doc/api/app.php?chapter=8_3)

##获取APIKEY
新版微信已经更新APIKEY的获取方式，需要登录到微信支付商户平台配置，在“账户设置”->“[API安全](https://pay.weixin.qq.com/index.php/account/api_cert)”中的**API密钥**下进行设置。

##常见问题
###支持语言
这里仅提供PHP示例，官方还支持JAVA、C#语言，请参考考官方文档[SDK下载](https://pay.weixin.qq.com/wiki/doc/api/app.php?chapter=11_1)。

###其他接口
这里仅提供简单的生成订单示例，支付的完整业务流程中如“查询订单”、“关闭订单”、“申请退款”等请参考官方教程[API列表](https://pay.weixin.qq.com/wiki/doc/api/app.php?chapter=9_1)。
