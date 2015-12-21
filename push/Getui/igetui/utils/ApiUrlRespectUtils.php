<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-5-7
 * Time: 下午2:15
 */
class ApiUrlRespectUtils
{
    static $appkeyAndFasterHost = array();
    static $appKeyAndHost = array();
    static $appkeyAndLastExecuteTime = array();
    public static function getFastest($appkey,$hosts)
    {

        if ($hosts == null || count($hosts)==0)
        {
            throw new Exception("Hosts cann't be null or size must greater than 0");
        }
        if(isset(ApiUrlRespectUtils::$appkeyAndFasterHost[$appkey]) && count(array_diff($hosts,isset(ApiUrlRespectUtils::$appKeyAndHost[$appkey])?ApiUrlRespectUtils::$appKeyAndHost[$appkey]:null)) == 0)
        {
            return ApiUrlRespectUtils::$appkeyAndFasterHost[$appkey];
        }
        else
        {
            $fastest = ApiUrlRespectUtils::getFastestRealTime($hosts);
            ApiUrlRespectUtils::$appKeyAndHost[$appkey] = $hosts;
            ApiUrlRespectUtils::$appkeyAndFasterHost[$appkey] = $fastest;
            return $fastest;
        }
    }

    public static function getFastestRealTime($hosts)
    {
        $mint=60.0;
        $s_url=$hosts[0];
        for ($i=0;$i<count($hosts);$i++)
        {
            $start = array_sum(explode(" ",microtime()));
            $opts = array('http'=>array('method'=>"GET",'timeout'=>3,));
            $context = stream_context_create($opts);
            try {
                $homepage = file_get_contents($hosts[$i], false, $context);
            } catch (Exception $e) {
                echo($e);
            }
            $ends = array_sum(explode(" ",microtime()));
            if ($homepage==NULL ||$homepage="")
            {
                $diff=60.0;
            }
            else
            {
                $diff=$ends-$start;
            }
            if ($mint > $diff)
            {
                $mint=$diff;
                $s_url=$hosts[$i];
            }
        }
        return $s_url;
    }
}