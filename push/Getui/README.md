# 个推推送平台 

## 使用说明 
1. 打开config.php文件，配置以下常量值：
 - APPID 
 应用AppID，个推平台申请应用后可获取。
 - APPKEY 
 应用AppKey，个推平台申请应用后可获取。
 - MASTERSECRET 
 应用MasterSecret，个推平台申请应用后可获取。
 - HOST 
 个推推送平台服务器地址，推荐使用默认值即可。

2. 部署服务器后访问以下页面发送推送消息
 - push.noti.php 
 推送点击通知打开应用类消息
 - push.link.php 
 推送点击通知打开网页类消息
 - push.down.php 
 推送点击通知弹框下载了消息
 - push.tran.php
 推送透传消息


##常见问题
###支持语言
这里仅提供PHP示例，官方还支持C#、JAVA、PYTHON、Node.js、C++等语言，请参考个推官方[文档中心](http://docs.getui.com/)。

