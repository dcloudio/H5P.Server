<?php

require_once(dirname(__FILE__) . '/' . 'config.php');


class MiPush
{
    /**
     * 推送消息
     * 
     * @param string $form  需要提交的数据(数组)
     * @param string $p     平台信息，'a'表示Android，'i'表示iOS
     */
    public static function pushMessage($form, $p='a'){
        try{
            $ret = MiPush::postDataCurl($form, $p);
            echo $ret;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    /**
     * 以post方式提交表单数据到服务器
     * 
     * @param string $form  需要提交的数据(数组)
     * @param string $p     平台信息，'a'表示Android，'i'表示iOS
     * @param bool $useCert 是否需要证书，默认不需要
     * @param int $second   url执行超时时间，默认30s
     */
    private static function postDataCurl($form, $p='a', $useCert=false, $second=30){
        $appsecret = APPSECRET_ANDROID;
        if($p=='i'){
            $appsecret = APPSECRET_IOS;
        }

        $ch = curl_init();
        //设置超时
        curl_setopt($ch, CURLOPT_TIMEOUT, $second);
        
        //这里设置代理
//        curl_setopt($ch, CURLOPT_PROXY, '0.0.0.0');
//        curl_setopt($ch, CURLOPT_PROXYPORT, '0');

        curl_setopt($ch, CURLOPT_URL, HOST_V2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);//不做严格校验

        //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //设置HTTP请求的自定义header
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: key='.$appsecret
            ));
    
        if($useCert == true){
            //设置使用证书：cert 与 key 分别属于两个.pem文件
            curl_setopt($ch, CURLOPT_SSLCERTTYPE, 'PEM');
            curl_setopt($ch, CURLOPT_SSLCERT, SSLCERT_PATH);
            curl_setopt($ch, CURLOPT_SSLKEYTYPE, 'PEM');
            curl_setopt($ch, CURLOPT_SSLKEY, SSLKEY_PATH);
        }

        //post提交方式
        curl_setopt($ch, CURLOPT_POST, TRUE);
        if(!is_array($form)){
            $form = array();
        }
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($form));

        //运行curl
        $ret = curl_exec($ch);
        //返回结果
        if($ret){
            $hsize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            curl_close($ch);
            return substr($ret, $hsize);;
        } else { 
            $error = curl_errno($ch);
            curl_close($ch);
            throw new Exception("POST(curl)出错，错误码:$error",$error);
        }
    }

    /**
     * 创建普通通知表单
     * @param $i  推送的设备标识
     * @param $t  推送通知标题
     * @param $c  推送通知内容
     * @param $p  推送透传内容(客户端暂时未处理此数据)
     * @return Array
     */
    public static function createNotiForm($i, $t, $c, $p){
        $form = array(
            'registration_id'=>$i,                      //  根据registration_id，发送消息到指定设备上。可以提供多个registration_id，发送给一组设备，不同的registration_id之间用“,”分割。
            'restricted_package_name'=>PACKAGENAME,     // App的包名 
            'title'=>$t,                                // 通知栏展示的通知的标题
            'description'=>$c,                          // 通知栏展示的通知的描述
            'notify_type'=>-1,                           // DEFAULT_ALL = -1;DEFAULT_SOUND=1;//使用默认提示音提示；DEFAULT_VIBRATE=2;//使用默认震动提示；DEFAULT_LIGHTS=4;//使用默认led灯光提示；
            'notify_id'=>0                              // 默认情况下，通知栏只显示一条推送消息。如果通知栏要显示多条推送消息，需要针对不同的消息设置不同的notify_id
        );

        // 消息的内容 
        if(!empty($p)){
            $form['payload'] = $p;
        }

        return $form;
    }


    /**
     * 创建普通通知表单（iOS）
     * @param $i  推送的设备标识
     * @param $c  推送通知内容
     * @param $p  推送透传内容(客户端暂时未处理此数据)
     * @return Array
     */
    public static function createNotiFormIOS($i, $c, $p){
        $form = array(
            'description'=>$c,                          // 通知栏展示的通知的描述
            'extra.sound_url'=>'default',               // string类型，可选项，自定义消息铃声。当值为空时为无声，default为系统默认声音。
//            'extra.badge'=>1,                           // int类型，可选项，通知角标。
//            'extra.category'=>1,                        // int类型，可选项，iOS8推送消息快速回复类别。
            'registration_id'=>$i                       //  根据registration_id，发送消息到指定设备上。可以提供多个registration_id，发送给一组设备，不同的registration_id之间用“,”分割。
        );

        // 消息的内容 
        if(!empty($p)){
            $form['extra.payload'] = $p;
        }

        return $form;
    }


    /**
     * 创建链接通知表单
     * @param $i  推送的设备标识
     * @param $t  推送通知标题
     * @param $c  推送通知内容
     * @param $l  推送通知链接地址
     * @return Array
     */
    public static function createLinkForm($i, $t, $c, $l){
        $form = array(
            'registration_id'=>$i,                      //  根据registration_id，发送消息到指定设备上。可以提供多个registration_id，发送给一组设备，不同的registration_id之间用“,”分割。
            'restricted_package_name'=>PACKAGENAME,     // App的包名 
            'title'=>$t,                                // 通知栏展示的通知的标题
            'description'=>$c,                          // 通知栏展示的通知的描述
            'notify_type'=>-1,                           // DEFAULT_ALL = -1;DEFAULT_SOUND=1;//使用默认提示音提示；DEFAULT_VIBRATE=2;//使用默认震动提示；DEFAULT_LIGHTS=4;//使用默认led灯光提示；
            'pass_through'=>0,                          // 0表示通知栏消息, 1表示透传消息
            'extra.notify_effect'=>3,                   // 1 通知栏点击后打开app的Launcher Activity; 2 通知栏点击后打开app的任一Activity（开发者还需要传入extra.intent_uri）; 3 通知栏点击后打开网页（开发者还需要传入extra.web_uri）
            'extra.web_uri'=>$l,                        // 打开某一个网页地址
            'notify_id'=>0                              // 默认情况下，通知栏只显示一条推送消息。如果通知栏要显示多条推送消息，需要针对不同的消息设置不同的notify_id
        );

        return $form;
    }


    /**
     * 创建透传通知表单
     * @param $i  推送的设备标识
     * @param $p  推送数据内容
     * @return Array
     */
    public static function createTranMessage($i, $p){
        $form = array(
            'registration_id'=>$i,                      //  根据registration_id，发送消息到指定设备上。可以提供多个registration_id，发送给一组设备，不同的registration_id之间用“,”分割。
            'restricted_package_name'=>PACKAGENAME,     // App的包名 
            'payload'=>$p,
            'notify_type'=>0,                           // DEFAULT_ALL = -1;DEFAULT_SOUND=1;//使用默认提示音提示；DEFAULT_VIBRATE=2;//使用默认震动提示；DEFAULT_LIGHTS=4;//使用默认led灯光提示；
            'pass_through'=>1,                          // 0表示通知栏消息, 1表示透传消息
            'notify_id'=>0                              // 默认情况下，通知栏只显示一条推送消息。如果通知栏要显示多条推送消息，需要针对不同的消息设置不同的notify_id
        );

        return $form;
    }

    /**
     * 创建透传通知表单
     * @param $i  推送的设备标识
     * @param $p  推送数据内容
     * @return Array
     */
    public static function createTranMessageIOS($i, $p){
        $form = array(
            'extra.content-available'=>1,               // 透传消息（iOS7以后支持）
            'extra.sound_url'=>'default',               // string类型，可选项，自定义消息铃声。当值为空时为无声，default为系统默认声音。
//            'extra.badge'=>1,                           // int类型，可选项，通知角标。
//            'extra.category'=>1,                        // int类型，可选项，iOS8推送消息快速回复类别。
            'description'=>'transmit',                          // 通知栏展示的通知的描述
            'registration_id'=>$i                       //  根据registration_id，发送消息到指定设备上。可以提供多个registration_id，发送给一组设备，不同的registration_id之间用“,”分割。
        );

        // 消息的内容 
        if(!empty($p)){
        try{
            $pj = json_decode($p, true);
            if(!empty($pj)){
            foreach ($pj as $key => $value) {
                    $form['extra.'.$key] = is_array($value)?json_encode($value):$value;
                }
            }
        }catch(Exception $e){
            // ignore error 
        }
        }

        return $form;
    }

}

?>