<?php
class CmdID extends PBEnum
{
  const GTHEARDBT  = 0;
  const GTAUTH  = 1;
  const GTAUTH_RESULT  = 2;
  const REQSERVHOST  = 3;
  const REQSERVHOSTRESULT  = 4;
  const PUSHRESULT  = 5;
  const PUSHOSSINGLEMESSAGE  = 6;
  const PUSHMMPSINGLEMESSAGE  = 7;
  const STARTMMPBATCHTASK  = 8;
  const STARTOSBATCHTASK  = 9;
  const PUSHLISTMESSAGE  = 10;
  const ENDBATCHTASK  = 11;
  const PUSHMMPAPPMESSAGE  = 12;
  const SERVERNOTIFY  = 13;
  const PUSHLISTRESULT  = 14;
  const SERVERNOTIFYRESULT  = 15;
}
class GtAuth extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
    $this->fields["4"] = "PBString";
    $this->values["4"] = "";
  }
  function sign()
  {
    return $this->_get_value("1");
  }
  function set_sign($value)
  {
    return $this->_set_value("1", $value);
  }
  function appkey()
  {
    return $this->_get_value("2");
  }
  function set_appkey($value)
  {
    return $this->_set_value("2", $value);
  }
  function timestamp()
  {
    return $this->_get_value("3");
  }
  function set_timestamp($value)
  {
    return $this->_set_value("3", $value);
  }
  function seqId()
  {
    return $this->_get_value("4");
  }
  function set_seqId($value)
  {
    return $this->_set_value("4", $value);
  }
}
class GtAuthResult_GtAuthResultCode extends PBEnum
{
  const successed  = 0;
  const failed_noSign  = 1;
  const failed_noAppkey  = 2;
  const failed_noTimestamp  = 3;
  const failed_AuthIllegal  = 4;
  const redirect  = 5;
}
class GtAuthResult extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "PBString";
    $this->values["4"] = "";
  }
  function code()
  {
    return $this->_get_value("1");
  }
  function set_code($value)
  {
    return $this->_set_value("1", $value);
  }
  function redirectAddress()
  {
    return $this->_get_value("2");
  }
  function set_redirectAddress($value)
  {
    return $this->_set_value("2", $value);
  }
  function seqId()
  {
    return $this->_get_value("3");
  }
  function set_seqId($value)
  {
    return $this->_set_value("3", $value);
  }
  function info()
  {
    return $this->_get_value("4");
  }
  function set_info($value)
  {
    return $this->_set_value("4", $value);
  }
}
class ReqServList extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
  }
  function seqId()
  {
    return $this->_get_value("1");
  }
  function set_seqId($value)
  {
    return $this->_set_value("1", $value);
  }
  function timestamp()
  {
    return $this->_get_value("3");
  }
  function set_timestamp($value)
  {
    return $this->_set_value("3", $value);
  }
}
class ReqServListResult_ReqServHostResultCode extends PBEnum
{
  const successed  = 0;
  const failed  = 1;
  const busy  = 2;
}
class ReqServListResult extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = array();
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
  }
  function code()
  {
    return $this->_get_value("1");
  }
  function set_code($value)
  {
    return $this->_set_value("1", $value);
  }
  function host($offset)
  {
    $v = $this->_get_arr_value("2", $offset);
    return $v->get_value();
  }
  function append_host($value)
  {
    $v = $this->_add_arr_value("2");
    $v->set_value($value);
  }
  function set_host($index, $value)
  {
    $v = new $this->fields["2"]();
    $v->set_value($value);
    $this->_set_arr_value("2", $index, $v);
  }
  function remove_last_host()
  {
    $this->_remove_last_arr_value("2");
  }
  function host_size()
  {
    return $this->_get_arr_size("2");
  }
  function seqId()
  {
    return $this->_get_value("3");
  }
  function set_seqId($value)
  {
    return $this->_set_value("3", $value);
  }
}
class PushResult_EPushResult extends PBEnum
{
  const successed_online  = 0;
  const successed_offline  = 1;
  const successed_ignore  = 2;
  const failed  = 3;
  const busy  = 4;
  const success_startBatch  = 5;
  const success_endBatch  = 6;
}
class PushResult extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PushResult_EPushResult";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "PBString";
    $this->values["4"] = "";
    $this->fields["5"] = "PBString";
    $this->values["5"] = "";
    $this->fields["6"] = "PBString";
    $this->values["6"] = "";
    $this->fields["7"] = "PBString";
    $this->values["7"] = "";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function taskId()
  {
    return $this->_get_value("2");
  }
  function set_taskId($value)
  {
    return $this->_set_value("2", $value);
  }
  function messageId()
  {
    return $this->_get_value("3");
  }
  function set_messageId($value)
  {
    return $this->_set_value("3", $value);
  }
  function seqId()
  {
    return $this->_get_value("4");
  }
  function set_seqId($value)
  {
    return $this->_set_value("4", $value);
  }
  function target()
  {
    return $this->_get_value("5");
  }
  function set_target($value)
  {
    return $this->_set_value("5", $value);
  }
  function info()
  {
    return $this->_get_value("6");
  }
  function set_info($value)
  {
    return $this->_set_value("6", $value);
  }
  function traceId()
  {
    return $this->_get_value("7");
  }
  function set_traceId($value)
  {
    return $this->_set_value("7", $value);
  }
}
class PushListResult extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PushResult";
    $this->values["1"] = array();
  }
  function results($offset)
  {
    return $this->_get_arr_value("1", $offset);
  }
  function add_results()
  {
    return $this->_add_arr_value("1");
  }
  function set_results($index, $value)
  {
    $this->_set_arr_value("1", $index, $value);
  }
  function remove_last_results()
  {
    $this->_remove_last_arr_value("1");
  }
  function results_size()
  {
    return $this->_get_arr_size("1");
  }
}
class Button extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
  }
  function text()
  {
    return $this->_get_value("1");
  }
  function set_text($value)
  {
    return $this->_set_value("1", $value);
  }
  function next()
  {
    return $this->_get_value("2");
  }
  function set_next($value)
  {
    return $this->_set_value("2", $value);
  }
}
class AppStartUp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
  }
  function android()
  {
    return $this->_get_value("1");
  }
  function set_android($value)
  {
    return $this->_set_value("1", $value);
  }
  function symbia()
  {
    return $this->_get_value("2");
  }
  function set_symbia($value)
  {
    return $this->_set_value("2", $value);
  }
  function ios()
  {
    return $this->_get_value("3");
  }
  function set_ios($value)
  {
    return $this->_set_value("3", $value);
  }
}
class ActionChain_Type extends PBEnum
{
  const refer  = 0;
  const notification  = 1;
  const popup  = 2;
  const startapp  = 3;
  const startweb  = 4;
  const smsinbox  = 5;
  const checkapp  = 6;
  const eoa  = 7;
  const appdownload  = 8;
  const startsms  = 9;
  const httpproxy  = 10;
  const smsinbox2  = 11;
  const mmsinbox2  = 12;
  const popupweb  = 13;
  const dial  = 14;
  const reportbindapp  = 15;
  const reportaddphoneinfo  = 16;
  const reportapplist  = 17;
  const terminatetask  = 18;
  const reportapp  = 19;
  const enablelog  = 20;
  const disablelog  = 21;
  const uploadlog  = 22;
}
class ActionChain_SMSStatus extends PBEnum
{
  const unread  = 0;
  const read  = 1;
}
class ActionChain extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "ActionChain_Type";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
    $this->fields["100"] = "PBString";
    $this->values["100"] = "";
    $this->fields["101"] = "PBString";
    $this->values["101"] = "";
    $this->fields["102"] = "PBString";
    $this->values["102"] = "";
    $this->fields["103"] = "PBString";
    $this->values["103"] = "";
    $this->fields["104"] = "PBBool";
    $this->values["104"] = "";
    $this->fields["105"] = "PBBool";
    $this->values["105"] = "";
    $this->fields["106"] = "PBBool";
    $this->values["106"] = "";
    $this->fields["107"] = "PBString";
    $this->values["107"] = "";
    $this->fields["120"] = "PBString";
    $this->values["120"] = "";
    $this->fields["121"] = "Button";
    $this->values["121"] = array();
    $this->fields["140"] = "PBString";
    $this->values["140"] = "";
    $this->fields["141"] = "AppStartUp";
    $this->values["141"] = "";
    $this->fields["142"] = "PBBool";
    $this->values["142"] = "";
    $this->fields["143"] = "PBInt";
    $this->values["143"] = "";
    $this->fields["160"] = "PBString";
    $this->values["160"] = "";
    $this->fields["161"] = "PBString";
    $this->values["161"] = "";
    $this->fields["162"] = "PBBool";
    $this->values["162"] = "";
    $this->values["162"] = new PBBool();
    $this->values["162"]->value = false;
    $this->fields["180"] = "PBString";
    $this->values["180"] = "";
    $this->fields["181"] = "PBString";
    $this->values["181"] = "";
    $this->fields["182"] = "PBInt";
    $this->values["182"] = "";
    $this->fields["183"] = "ActionChain_SMSStatus";
    $this->values["183"] = "";
    $this->fields["200"] = "PBInt";
    $this->values["200"] = "";
    $this->fields["201"] = "PBInt";
    $this->values["201"] = "";
    $this->fields["220"] = "PBString";
    $this->values["220"] = "";
    $this->fields["223"] = "PBBool";
    $this->values["223"] = "";
    $this->fields["225"] = "PBBool";
    $this->values["225"] = "";
    $this->fields["226"] = "PBBool";
    $this->values["226"] = "";
    $this->fields["227"] = "PBBool";
    $this->values["227"] = "";
    $this->fields["241"] = "PBString";
    $this->values["241"] = "";
    $this->fields["242"] = "PBString";
    $this->values["242"] = "";
    $this->fields["260"] = "PBBool";
    $this->values["260"] = "";
    $this->fields["280"] = "PBString";
    $this->values["280"] = "";
    $this->fields["281"] = "PBString";
    $this->values["281"] = "";
    $this->fields["300"] = "PBBool";
    $this->values["300"] = "";
    $this->fields["320"] = "PBString";
    $this->values["320"] = "";
    $this->fields["340"] = "PBInt";
    $this->values["340"] = "";
    $this->fields["360"] = "PBString";
    $this->values["360"] = "";
  }
  function actionId()
  {
    return $this->_get_value("1");
  }
  function set_actionId($value)
  {
    return $this->_set_value("1", $value);
  }
  function type()
  {
    return $this->_get_value("2");
  }
  function set_type($value)
  {
    return $this->_set_value("2", $value);
  }
  function next()
  {
    return $this->_get_value("3");
  }
  function set_next($value)
  {
    return $this->_set_value("3", $value);
  }
  function logo()
  {
    return $this->_get_value("100");
  }
  function set_logo($value)
  {
    return $this->_set_value("100", $value);
  }
  function logoURL()
  {
    return $this->_get_value("101");
  }
  function set_logoURL($value)
  {
    return $this->_set_value("101", $value);
  }
  function title()
  {
    return $this->_get_value("102");
  }
  function set_title($value)
  {
    return $this->_set_value("102", $value);
  }
  function text()
  {
    return $this->_get_value("103");
  }
  function set_text($value)
  {
    return $this->_set_value("103", $value);
  }
  function clearable()
  {
    return $this->_get_value("104");
  }
  function set_clearable($value)
  {
    return $this->_set_value("104", $value);
  }
  function ring()
  {
    return $this->_get_value("105");
  }
  function set_ring($value)
  {
    return $this->_set_value("105", $value);
  }
  function buzz()
  {
    return $this->_get_value("106");
  }
  function set_buzz($value)
  {
    return $this->_set_value("106", $value);
  }
  function bannerURL()
  {
    return $this->_get_value("107");
  }
  function set_bannerURL($value)
  {
    return $this->_set_value("107", $value);
  }
  function img()
  {
    return $this->_get_value("120");
  }
  function set_img($value)
  {
    return $this->_set_value("120", $value);
  }
  function buttons($offset)
  {
    return $this->_get_arr_value("121", $offset);
  }
  function add_buttons()
  {
    return $this->_add_arr_value("121");
  }
  function set_buttons($index, $value)
  {
    $this->_set_arr_value("121", $index, $value);
  }
  function remove_last_buttons()
  {
    $this->_remove_last_arr_value("121");
  }
  function buttons_size()
  {
    return $this->_get_arr_size("121");
  }
  function appid()
  {
    return $this->_get_value("140");
  }
  function set_appid($value)
  {
    return $this->_set_value("140", $value);
  }
  function appstartupid()
  {
    return $this->_get_value("141");
  }
  function set_appstartupid($value)
  {
    return $this->_set_value("141", $value);
  }
  function autostart()
  {
    return $this->_get_value("142");
  }
  function set_autostart($value)
  {
    return $this->_set_value("142", $value);
  }
  function failedAction()
  {
    return $this->_get_value("143");
  }
  function set_failedAction($value)
  {
    return $this->_set_value("143", $value);
  }
  function url()
  {
    return $this->_get_value("160");
  }
  function set_url($value)
  {
    return $this->_set_value("160", $value);
  }
  function withcid()
  {
    return $this->_get_value("161");
  }
  function set_withcid($value)
  {
    return $this->_set_value("161", $value);
  }
  function is_withnettype()
  {
    return $this->_get_value("162");
  }
  function set_is_withnettype($value)
  {
    return $this->_set_value("162", $value);
  }
  function address()
  {
    return $this->_get_value("180");
  }
  function set_address($value)
  {
    return $this->_set_value("180", $value);
  }
  function content()
  {
    return $this->_get_value("181");
  }
  function set_content($value)
  {
    return $this->_set_value("181", $value);
  }
  function ct()
  {
    return $this->_get_value("182");
  }
  function set_ct($value)
  {
    return $this->_set_value("182", $value);
  }
  function flag()
  {
    return $this->_get_value("183");
  }
  function set_flag($value)
  {
    return $this->_set_value("183", $value);
  }
  function successedAction()
  {
    return $this->_get_value("200");
  }
  function set_successedAction($value)
  {
    return $this->_set_value("200", $value);
  }
  function uninstalledAction()
  {
    return $this->_get_value("201");
  }
  function set_uninstalledAction($value)
  {
    return $this->_set_value("201", $value);
  }
  function name()
  {
    return $this->_get_value("220");
  }
  function set_name($value)
  {
    return $this->_set_value("220", $value);
  }
  function autoInstall()
  {
    return $this->_get_value("223");
  }
  function set_autoInstall($value)
  {
    return $this->_set_value("223", $value);
  }
  function wifiAutodownload()
  {
    return $this->_get_value("225");
  }
  function set_wifiAutodownload($value)
  {
    return $this->_set_value("225", $value);
  }
  function forceDownload()
  {
    return $this->_get_value("226");
  }
  function set_forceDownload($value)
  {
    return $this->_set_value("226", $value);
  }
  function showProgress()
  {
    return $this->_get_value("227");
  }
  function set_showProgress($value)
  {
    return $this->_set_value("227", $value);
  }
  function post()
  {
    return $this->_get_value("241");
  }
  function set_post($value)
  {
    return $this->_set_value("241", $value);
  }
  function headers()
  {
    return $this->_get_value("242");
  }
  function set_headers($value)
  {
    return $this->_set_value("242", $value);
  }
  function groupable()
  {
    return $this->_get_value("260");
  }
  function set_groupable($value)
  {
    return $this->_set_value("260", $value);
  }
  function mmsTitle()
  {
    return $this->_get_value("280");
  }
  function set_mmsTitle($value)
  {
    return $this->_set_value("280", $value);
  }
  function mmsURL()
  {
    return $this->_get_value("281");
  }
  function set_mmsURL($value)
  {
    return $this->_set_value("281", $value);
  }
  function preload()
  {
    return $this->_get_value("300");
  }
  function set_preload($value)
  {
    return $this->_set_value("300", $value);
  }
  function taskid()
  {
    return $this->_get_value("320");
  }
  function set_taskid($value)
  {
    return $this->_set_value("320", $value);
  }
  function duration()
  {
    return $this->_get_value("340");
  }
  function set_duration($value)
  {
    return $this->_set_value("340", $value);
  }
  function date()
  {
    return $this->_get_value("360");
  }
  function set_date($value)
  {
    return $this->_set_value("360", $value);
  }
}
class PushInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "PBString";
    $this->values["4"] = "";
    $this->fields["5"] = "PBString";
    $this->values["5"] = "";
    $this->fields["6"] = "PBString";
    $this->values["6"] = "";
    $this->fields["7"] = "PBString";
    $this->values["7"] = "";
    $this->fields["8"] = "PBString";
    $this->values["8"] = "";
    $this->fields["9"] = "PBString";
    $this->values["9"] = "";
    $this->fields["10"] = "PBInt";
    $this->values["10"] = "";
    $this->fields["11"] = "PBBool";
    $this->values["11"] = "";
    $this->fields["12"] = "PBString";
    $this->values["12"] = "";
    $this->fields["13"] = "PBBool";
    $this->values["13"] = "";
    $this->fields["14"] = "PBString";
    $this->values["14"] = "";
  }
  function message()
  {
    return $this->_get_value("1");
  }
  function set_message($value)
  {
    return $this->_set_value("1", $value);
  }
  function actionKey()
  {
    return $this->_get_value("2");
  }
  function set_actionKey($value)
  {
    return $this->_set_value("2", $value);
  }
  function sound()
  {
    return $this->_get_value("3");
  }
  function set_sound($value)
  {
    return $this->_set_value("3", $value);
  }
  function badge()
  {
    return $this->_get_value("4");
  }
  function set_badge($value)
  {
    return $this->_set_value("4", $value);
  }
  function payload()
  {
    return $this->_get_value("5");
  }
  function set_payload($value)
  {
    return $this->_set_value("5", $value);
  }
  function locKey()
  {
    return $this->_get_value("6");
  }
  function set_locKey($value)
  {
    return $this->_set_value("6", $value);
  }
  function locArgs()
  {
    return $this->_get_value("7");
  }
  function set_locArgs($value)
  {
    return $this->_set_value("7", $value);
  }
  function actionLocKey()
  {
    return $this->_get_value("8");
  }
  function set_actionLocKey($value)
  {
    return $this->_set_value("8", $value);
  }
  function launchImage()
  {
    return $this->_get_value("9");
  }
  function set_launchImage($value)
  {
    return $this->_set_value("9", $value);
  }
  function contentAvailable()
  {
    return $this->_get_value("10");
  }
  function set_contentAvailable($value)
  {
    return $this->_set_value("10", $value);
  }
  function invalidAPN()
  {
    return $this->_get_value("11");
  }
  function set_invalidAPN($value)
  {
    return $this->_set_value("11", $value);
  }
  function apnJson()
  {
    return $this->_get_value("12");
  }
  function set_apnJson($value)
  {
    return $this->_set_value("12", $value);
  }
  function invalidMPN()
  {
    return $this->_get_value("13");
  }
  function set_invalidMPN($value)
  {
    return $this->_set_value("13", $value);
  }
  function mpnXml()
  {
    return $this->_get_value("14");
  }
  function set_mpnXml($value)
  {
    return $this->_set_value("14", $value);
  }
}
class Transparent extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "PBString";
    $this->values["4"] = "";
    $this->fields["5"] = "PBString";
    $this->values["5"] = "";
    $this->fields["6"] = "PBString";
    $this->values["6"] = "";
    $this->fields["7"] = "PushInfo";
    $this->values["7"] = "";
    $this->fields["8"] = "ActionChain";
    $this->values["8"] = array();
    $this->fields["9"] = "PBString";
    $this->values["9"] = array();
  }
  function id()
  {
    return $this->_get_value("1");
  }
  function set_id($value)
  {
    return $this->_set_value("1", $value);
  }
  function action()
  {
    return $this->_get_value("2");
  }
  function set_action($value)
  {
    return $this->_set_value("2", $value);
  }
  function taskId()
  {
    return $this->_get_value("3");
  }
  function set_taskId($value)
  {
    return $this->_set_value("3", $value);
  }
  function appKey()
  {
    return $this->_get_value("4");
  }
  function set_appKey($value)
  {
    return $this->_set_value("4", $value);
  }
  function appId()
  {
    return $this->_get_value("5");
  }
  function set_appId($value)
  {
    return $this->_set_value("5", $value);
  }
  function messageId()
  {
    return $this->_get_value("6");
  }
  function set_messageId($value)
  {
    return $this->_set_value("6", $value);
  }
  function pushInfo()
  {
    return $this->_get_value("7");
  }
  function set_pushInfo($value)
  {
    return $this->_set_value("7", $value);
  }
  function actionChain($offset)
  {
    return $this->_get_arr_value("8", $offset);
  }
  function add_actionChain()
  {
    return $this->_add_arr_value("8");
  }
  function set_actionChain($index, $value)
  {
    $this->_set_arr_value("8", $index, $value);
  }
  function remove_last_actionChain()
  {
    $this->_remove_last_arr_value("8");
  }
  function actionChain_size()
  {
    return $this->_get_arr_size("8");
  }
  function condition($offset)
  {
    $v = $this->_get_arr_value("9", $offset);
    return $v->get_value();
  }
  function append_condition($value)
  {
    $v = $this->_add_arr_value("9");
    $v->set_value($value);
  }
  function set_condition($index, $value)
  {
    $v = new $this->fields["9"]();
    $v->set_value($value);
    $this->_set_arr_value("9", $index, $v);
  }
  function remove_last_condition()
  {
    $this->_remove_last_arr_value("9");
  }
  function condition_size()
  {
    return $this->_get_arr_size("9");
  }
}
class OSMessage extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["2"] = "PBBool";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
    $this->fields["4"] = "Transparent";
    $this->values["4"] = "";
    $this->fields["5"] = "PBString";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
    $this->fields["7"] = "PBInt";
    $this->values["7"] = "";
    $this->fields["8"] = "PBInt";
    $this->values["8"] = "";
  }
  function isOffline()
  {
    return $this->_get_value("2");
  }
  function set_isOffline($value)
  {
    return $this->_set_value("2", $value);
  }
  function offlineExpireTime()
  {
    return $this->_get_value("3");
  }
  function set_offlineExpireTime($value)
  {
    return $this->_set_value("3", $value);
  }
  function transparent()
  {
    return $this->_get_value("4");
  }
  function set_transparent($value)
  {
    return $this->_set_value("4", $value);
  }
  function extraData()
  {
    return $this->_get_value("5");
  }
  function set_extraData($value)
  {
    return $this->_set_value("5", $value);
  }
  function msgType()
  {
    return $this->_get_value("6");
  }
  function set_msgType($value)
  {
    return $this->_set_value("6", $value);
  }
  function msgTraceFlag()
  {
    return $this->_get_value("7");
  }
  function set_msgTraceFlag($value)
  {
    return $this->_set_value("7", $value);
  }
  function priority()
  {
    return $this->_get_value("8");
  }
  function set_priority($value)
  {
    return $this->_set_value("8", $value);
  }
}
class Target extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
  }
  function appId()
  {
    return $this->_get_value("1");
  }
  function set_appId($value)
  {
    return $this->_set_value("1", $value);
  }
  function clientId()
  {
    return $this->_get_value("2");
  }
  function set_clientId($value)
  {
    return $this->_set_value("2", $value);
  }
}
class PushOSSingleMessage extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "OSMessage";
    $this->values["2"] = "";
    $this->fields["3"] = "Target";
    $this->values["3"] = "";
  }
  function seqId()
  {
    return $this->_get_value("1");
  }
  function set_seqId($value)
  {
    return $this->_set_value("1", $value);
  }
  function message()
  {
    return $this->_get_value("2");
  }
  function set_message($value)
  {
    return $this->_set_value("2", $value);
  }
  function target()
  {
    return $this->_get_value("3");
  }
  function set_target($value)
  {
    return $this->_set_value("3", $value);
  }
}
class MMPMessage extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["2"] = "Transparent";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
    $this->fields["7"] = "PBBool";
    $this->values["7"] = "";
    $this->values["7"] = new PBBool();
    $this->values["7"]->value = true;
    $this->fields["8"] = "PBInt";
    $this->values["8"] = "";
  }
  function transparent()
  {
    return $this->_get_value("2");
  }
  function set_transparent($value)
  {
    return $this->_set_value("2", $value);
  }
  function extraData()
  {
    return $this->_get_value("3");
  }
  function set_extraData($value)
  {
    return $this->_set_value("3", $value);
  }
  function msgType()
  {
    return $this->_get_value("4");
  }
  function set_msgType($value)
  {
    return $this->_set_value("4", $value);
  }
  function msgTraceFlag()
  {
    return $this->_get_value("5");
  }
  function set_msgTraceFlag($value)
  {
    return $this->_set_value("5", $value);
  }
  function msgOfflineExpire()
  {
    return $this->_get_value("6");
  }
  function set_msgOfflineExpire($value)
  {
    return $this->_set_value("6", $value);
  }
  function isOffline()
  {
    return $this->_get_value("7");
  }
  function set_isOffline($value)
  {
    return $this->_set_value("7", $value);
  }
  function priority()
  {
    return $this->_get_value("8");
  }
  function set_priority($value)
  {
    return $this->_set_value("8", $value);
  }
}
class PushMMPSingleMessage extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "MMPMessage";
    $this->values["2"] = "";
    $this->fields["3"] = "Target";
    $this->values["3"] = "";
  }
  function seqId()
  {
    return $this->_get_value("1");
  }
  function set_seqId($value)
  {
    return $this->_set_value("1", $value);
  }
  function message()
  {
    return $this->_get_value("2");
  }
  function set_message($value)
  {
    return $this->_set_value("2", $value);
  }
  function target()
  {
    return $this->_get_value("3");
  }
  function set_target($value)
  {
    return $this->_set_value("3", $value);
  }
}
class StartMMPBatchTask extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "MMPMessage";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
  }
  function message()
  {
    return $this->_get_value("1");
  }
  function set_message($value)
  {
    return $this->_set_value("1", $value);
  }
  function expire()
  {
    return $this->_get_value("2");
  }
  function set_expire($value)
  {
    return $this->_set_value("2", $value);
  }
  function seqId()
  {
    return $this->_get_value("3");
  }
  function set_seqId($value)
  {
    return $this->_set_value("3", $value);
  }
}
class StartOSBatchTask extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "OSMessage";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
  }
  function message()
  {
    return $this->_get_value("1");
  }
  function set_message($value)
  {
    return $this->_set_value("1", $value);
  }
  function expire()
  {
    return $this->_get_value("2");
  }
  function set_expire($value)
  {
    return $this->_set_value("2", $value);
  }
}
class SingleBatchItem extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
  }
  function seqId()
  {
    return $this->_get_value("1");
  }
  function set_seqId($value)
  {
    return $this->_set_value("1", $value);
  }
  function data()
  {
    return $this->_get_value("2");
  }
  function set_data($value)
  {
    return $this->_set_value("2", $value);
  }
}
class SingleBatchRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "SingleBatchItem";
    $this->values["2"] = array();
  }
  function batchId()
  {
    return $this->_get_value("1");
  }
  function set_batchId($value)
  {
    return $this->_set_value("1", $value);
  }
  function batchItem($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_batchItem()
  {
    return $this->_add_arr_value("2");
  }
  function set_batchItem($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_batchItem()
  {
    $this->_remove_last_arr_value("2");
  }
  function batchItem_size()
  {
    return $this->_get_arr_size("2");
  }
}
class PushListMessage extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "Target";
    $this->values["3"] = array();
  }
  function seqId()
  {
    return $this->_get_value("1");
  }
  function set_seqId($value)
  {
    return $this->_set_value("1", $value);
  }
  function taskId()
  {
    return $this->_get_value("2");
  }
  function set_taskId($value)
  {
    return $this->_set_value("2", $value);
  }
  function targets($offset)
  {
    return $this->_get_arr_value("3", $offset);
  }
  function add_targets()
  {
    return $this->_add_arr_value("3");
  }
  function set_targets($index, $value)
  {
    $this->_set_arr_value("3", $index, $value);
  }
  function remove_last_targets()
  {
    $this->_remove_last_arr_value("3");
  }
  function targets_size()
  {
    return $this->_get_arr_size("3");
  }
}
class EndBatchTask extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
  }
  function taskId()
  {
    return $this->_get_value("1");
  }
  function set_taskId($value)
  {
    return $this->_set_value("1", $value);
  }
  function seqId()
  {
    return $this->_get_value("2");
  }
  function set_seqId($value)
  {
    return $this->_set_value("2", $value);
  }
}
class PushMMPAppMessage extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "MMPMessage";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = array();
    $this->fields["3"] = "PBString";
    $this->values["3"] = array();
    $this->fields["4"] = "PBString";
    $this->values["4"] = array();
    $this->fields["5"] = "PBString";
    $this->values["5"] = "";
  }
  function message()
  {
    return $this->_get_value("1");
  }
  function set_message($value)
  {
    return $this->_set_value("1", $value);
  }
  function appIdList($offset)
  {
    $v = $this->_get_arr_value("2", $offset);
    return $v->get_value();
  }
  function append_appIdList($value)
  {
    $v = $this->_add_arr_value("2");
    $v->set_value($value);
  }
  function set_appIdList($index, $value)
  {
    $v = new $this->fields["2"]();
    $v->set_value($value);
    $this->_set_arr_value("2", $index, $v);
  }
  function remove_last_appIdList()
  {
    $this->_remove_last_arr_value("2");
  }
  function appIdList_size()
  {
    return $this->_get_arr_size("2");
  }
  function phoneTypeList($offset)
  {
    $v = $this->_get_arr_value("3", $offset);
    return $v->get_value();
  }
  function append_phoneTypeList($value)
  {
    $v = $this->_add_arr_value("3");
    $v->set_value($value);
  }
  function set_phoneTypeList($index, $value)
  {
    $v = new $this->fields["3"]();
    $v->set_value($value);
    $this->_set_arr_value("3", $index, $v);
  }
  function remove_last_phoneTypeList()
  {
    $this->_remove_last_arr_value("3");
  }
  function phoneTypeList_size()
  {
    return $this->_get_arr_size("3");
  }
  function provinceList($offset)
  {
    $v = $this->_get_arr_value("4", $offset);
    return $v->get_value();
  }
  function append_provinceList($value)
  {
    $v = $this->_add_arr_value("4");
    $v->set_value($value);
  }
  function set_provinceList($index, $value)
  {
    $v = new $this->fields["4"]();
    $v->set_value($value);
    $this->_set_arr_value("4", $index, $v);
  }
  function remove_last_provinceList()
  {
    $this->_remove_last_arr_value("4");
  }
  function provinceList_size()
  {
    return $this->_get_arr_size("4");
  }
  function seqId()
  {
    return $this->_get_value("5");
  }
  function set_seqId($value)
  {
    return $this->_set_value("5", $value);
  }
}
class ServerNotify_NotifyType extends PBEnum
{
  const normal  = 0;
  const serverListChanged  = 1;
  const exception  = 2;
}
class ServerNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "ServerNotify_NotifyType";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "PBString";
    $this->values["4"] = "";
  }
  function type()
  {
    return $this->_get_value("1");
  }
  function set_type($value)
  {
    return $this->_set_value("1", $value);
  }
  function info()
  {
    return $this->_get_value("2");
  }
  function set_info($value)
  {
    return $this->_set_value("2", $value);
  }
  function extradata()
  {
    return $this->_get_value("3");
  }
  function set_extradata($value)
  {
    return $this->_set_value("3", $value);
  }
  function seqId()
  {
    return $this->_get_value("4");
  }
  function set_seqId($value)
  {
    return $this->_set_value("4", $value);
  }
}
class ServerNotifyResult extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
  }
  function seqId()
  {
    return $this->_get_value("1");
  }
  function set_seqId($value)
  {
    return $this->_set_value("1", $value);
  }
  function info()
  {
    return $this->_get_value("2");
  }
  function set_info($value)
  {
    return $this->_set_value("2", $value);
  }
}
?>