<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-5-9
 * Time: 下午3:17
 */
class LogUtils
{
    static $debug = true;
    public static function debug($log)
    {
        if (LogUtils::$debug)
            echo date('y-m-d h:i:s',time()).($log) . "\r\n";
    }
}