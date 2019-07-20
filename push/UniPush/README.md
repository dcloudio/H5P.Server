# UniPush推送 


## 使用说明 
1. 打开config.php文件，配置以下常量值：
 - APPID 
 应用AppID，个推平台申请应用后可获取
 - APPKEY 
 应用AppKey，个推平台申请应用后可获取
 - MASTERSECRET 
 应用MasterSecret，个推平台申请应用后可获取
 - HOST 
 个推推送平台服务器地址，推荐使用默认值即可
 - PACKAGENAME
 应用包名，HBuilderX提交云端打包设置的包名


2. 部署服务器后访问以下页面发送推送消息
 - index.php 
 下发推送通知页面，输入cid参数后点击“发送推送通知”按钮

**HBuilderX默认的真机运行基座可在此页面发送[https://demo.dcloud.net.cn/push/unipush.HBuilder/index.php](https://demo.dcloud.net.cn/push/unipush.HBuilder/index.php)**


## 常见问题

### 设置代理
如果开发者自己业务服务器需要通过代理访问外网，请在igetui\utils\HttpManager.php页面
查找以下代码修改为部署服务器环境的代理服务器
```
curl_setopt($curl, CURLOPT_PROXY, '10.241.32.57:3128');//修改为服务器环境的代理地址
```

### 支持语言
这里仅提供PHP示例，官方还支持C#、JAVA、PYTHON、Node.js、C++等语言，请参考个推官方[文档中心](http://docs.getui.com/)。

