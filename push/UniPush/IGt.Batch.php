<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 15-4-9
 * Time: 下午3:45
 */
header("Content-Type: text/html; charset=utf-8");
require_once(dirname(__FILE__) . '/' . 'IGt.Push.php');

class IGtBatch
{
    var $batchId;
    var $innerMsgList = array();
    var $seqId = 0;
    var $APPKEY;
    var $push;
    var $lastPostData;

    public function __construct($appkey, $push)
    {
        $this->APPKEY = $appkey;
        $this->push = $push;
        $this->batchId = uniqid();

    }

    public function getBatchId()
    {
        return $this->batchId;
    }

    public function add($message, $target)
    {
        if ($this->seqId >= 5000) {
            throw new Exception("Can not add over 5000 message once! Please call submit() first.");
        } else {
            $this->seqId += 1;
            $innerMsg = new SingleBatchItem();
            $innerMsg->set_seqId($this->seqId);
            $innerMsg->set_data($this->createSingleJson($message, $target));
            array_push($this->innerMsgList, $innerMsg);
        }
        return $this->seqId . "";
    }

    public function createSingleJson($message, $target)
    {
        $params = $this->push->getSingleMessagePostData($message,$target);
        return json_encode($params);
    }

    public function submit()
    {
        $requestId = LangUtils::randomUUID();
        $data = array();
        $data["appkey"]=$this->APPKEY;
        $data["serialize"] = "pb";
        $data["async"] = GTConfig::isPushSingleBatchAsync();
        $data["action"] = "pushMessageToSingleBatchAction";
        $data['requestId'] = $requestId;
        $singleBatchRequest = new SingleBatchRequest();
        $singleBatchRequest->set_batchId($this->batchId);
        foreach ($this->innerMsgList as $index => $innerMsg) {
            $singleBatchRequest->add_batchItem();
            $singleBatchRequest->set_batchItem($index, $innerMsg);
        }
        $data["singleDatas"] = base64_encode($singleBatchRequest->SerializeToString());
        $this->seqId = 0;
        $this->innerMsgList = array();
        $this->lastPostData = $data;
        $result = $this->push->httpPostJSON(null, $data, true);
        return $result;
    }

    public function retry()
    {
        $result = $this->push->httpPostJSON(null, $this->lastPostData, true);
        return $result;
    }

    public function setApiUrl($apiUrl) {
    }
}