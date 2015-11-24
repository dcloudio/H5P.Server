<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-5-7
 * Time: 下午2:15
 */
class GTConfig
{
    public static function isPushSingleBatchAsync()
    {
        return "true" == GTConfig::getProperty("gexin_pushSingleBatch_needAsync", null, "false");
    }

    public static function isPushListAsync()
    {
        return "true" == GTConfig::getProperty("gexin_pushList_needAsync", null, "false");
    }

    public static function isPushListNeedDetails()
    {
        return "true" == GTConfig::getProperty("gexin_pushList_needDetails", "needDetails", "false");
    }

    public static function getHttpProxyIp()
    {
        return GTConfig::getProperty("gexin_http_proxy_ip", "gexin.rp.sdk.http.proxyHost");
    }

    public static function getHttpProxyPort()
    {
        return (int)GTConfig::getProperty("gexin_http_proxy_port", "gexin.rp.sdk.http.proxyPort", 80);
    }

    public static function getSyncListLimit()
    {
        return (int)GTConfig::getProperty("gexin_pushList_syncLimit", null, 1000);
    }

    public static function getAsyncListLimit()
    {
        return (int)GTConfig::getProperty("gexin_pushList_asyncLimit", null, 10000);
    }

    public static function getHttpConnectionTimeOut()
    {
        return (int)GTConfig::getProperty("gexin_http_connecton_timeout", "gexin.rp.sdk.http.connection.timeout", 60000);
    }

    public static function getHttpInspectInterval()
    {
        return (int)GTConfig::getProperty("gexin_inspect_interval", "gexin.rp.sdk.http.inspect.timeout", 300000);
    }


    public static function getHttpSoTimeOut()
    {
        return (int)GTConfig::getProperty("gexin_http_so_timeout", "gexin.rp.sdk.http.so.timeout", 30000);
    }

    public static function getHttpTryCount()
    {
        return (int)GTConfig::getProperty("gexin_http_tryCount", "gexin.rp.sdk.http.gexinTryCount", 3);
    }

    public static function getDefaultDomainUrl()
    {
        $urlStr = GTConfig::getProperty("gexin_default_domainurl", null);
        if ($urlStr == null || "".equals(trim($urlStr)))
        {
            $hosts = array("http://sdk.open.api.igexin.com/serviceex","http://sdk.open.api.gepush.com/serviceex","http://sdk.open.api.getui.net/serviceex");
            for($i = 0;$i < 3;$i++)
            {
                array_push($hosts,"http://sdk".$i.".open.api.igexin.com/serviceex");
            }
            return $hosts;
        }
        return explode(",",$urlStr);
    }

    private static function getProperty($key, $oldKey, $defaultValue = null)
    {
        $value = getenv($key);
        if($value != null)
        {
            return $value;
        }
        else

            if($oldKey != null)
            {
                $value = getenv($oldKey);
            }
        if($value == null)
        {
            return $defaultValue;
        }else
        {
            return $value;
        }
    }

    public static function getSDKVersion()
    {
        return "4.0.0.2";
    }
}