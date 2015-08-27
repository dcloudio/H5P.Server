# Uploader
5+中Uploader上传使用HTTP的POST方式提交数据，数据格式符合Multipart/form-data规范，即rfc1867（Form-based File Upload in HTML）协议。

##服务器逻辑
将接收到文件保存到files目录中

##返回数据格式
将提交的数据及文件安装json格式字符串返回，例如：
{
  "strings":{"uid":"28044202","client":"HelloH5+"},
  "error":"0",
  files:{
    "uploadkey1":{"name":"IMG_220342.jpg","url":"files/IMG_220342.jpg","type":"image/jpeg","size":3599470}
  }
}
其中strings中保存的是提交数据（key:value格式），files中保存的是提交的文件。
