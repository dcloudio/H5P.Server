## 支付宝功能申请
1. 登录支付宝账号，签约申请“移动快捷支付”功能，操作流程参考：
[支付宝帮助中心](http://help.alipay.com/support/index_sh.htm)
2. 获取PID，参考教程：
[获取合作者身份ID](http://help.alipay.com/support/help_detail.htm?help_id=396880&keyword=%B2%E9%D1%AF)
3. 生成密钥（公钥和私钥），并提交到支付宝，参考教程：
[生成RSA密钥](http://help.alipay.com/support/help_detail.htm?help_id=397433&keyword=%C3%DC%D4%BF)
[上传公钥](http://help.alipay.com/support/help_detail.htm?help_id=477353&keyword=%C9%CC%BB%A7%B9%AB%D4%BF)


## 配置支付参数
index.php中需要配置在支付宝申请的参数才能正确生成支付订单：

1. **$priKey**

卖家接入支付宝生成密钥时获取的私钥字符串，直接使用pem文件的完整字符串，包括开头行“-----BEGIN RSA PRIVATE KEY-----”和结尾行“-----END RSA PRIVATE KEY-----”。

2. $partner
卖家支付宝合作者身份ID，以2088开头的16位纯数字。

3. $seller_id
卖家支付宝账号，通常为邮箱地址。

4. $base_path
商品介绍网址，根据业务需求配置恰当的url地址即可。

5. $notify_url
支付完成通知网址，用于接收支付操作完成的通知。

6. $subject
支付订单的标题，根据业务需求配置。

7. $body
支付订单的详细介绍，根据业务需求配置。

8. $out_trade_no
支付订单号，示例代码中简单使用当前时间戳作为订单号，实际业务中建议生成一串UUID字符串来代替。
