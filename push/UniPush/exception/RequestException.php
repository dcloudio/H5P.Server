<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-4-28
 * Time: 下午5:05
 */
class RequestException extends Exception
{
    var $requestId;

    public function __construct($requestId, $message, $e)
    {
        parent::__construct($message, $e);
        $this->requestId = $requestId;
    }
    public function getRequestId()
    {
        return $this->requestId;
    }
}