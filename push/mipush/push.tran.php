<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>透传通知 - 小米推送</title>
    <script type="text/javascript" charset="utf-8">
function checkSubmit() {
    var cid = document.getElementById('cid');
    if ( !cid.value || cid.value=="" ) {
        alert( "无效终端标识！" );
        cid.focus();
        return false;
    }
    var content = document.getElementById('content');
    if ( !content.value || content.value=="" ) {
        alert( "无效内容！" );
        content.focus();
        return false;
    }
    var payload = document.getElementById('payload');
    if ( !payload.value || payload.value=='' ) {
        alert( "无效的透传内容！" );
        payload.focus();
        return false;
    }
    return true;
}
    </script>
		<style type="text/css">
.des{
	color: blue;
	font-size: 0.5em;
	margin:0 10px 10px 0;
}
.important{
	color: red;
	font-weight: bolder;
}
.tips{
	color: red;
}
.paragraph{
	text-indent: 2em;
}
		</style>
</head>
<body>
		<form action="./push.php" method="POST" onsubmit="return checkSubmit()">
    <input type="hidden" name="pushtype" value="tran"/>
<?php
    if ( isset($_GET['version']) ) {
        echo( '<input type="hidden" name="version" value="'.$_GET['version'].'"/>' );
    }
    if ( isset($_GET['appid']) ) {
        echo( '<input type="hidden" name="appid" value="'.$_GET['appid'].'"/>' );
    }
?>
    <table>
        <tbody>
        <tr>
					<td style="">终端标识:</td>
					<!-- readonly="readonly" placeholder="推送通知终端标识" -->
            <td>
						<input id="cid" name="cid" type="text" style="width:100%" placeholder="推送终端标识"
<?php
if ( isset($_GET['cid']) ) {
		echo( "readonly=\"readonly\" value=\"{$_GET['cid']}\"" );
}
?>
						/><br/>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<p class="des">
	[必填]，小米推送平台设备标识registration id(regid)，接收推送消息终端设备的唯一标识，在5+ API中可通过plus.push.getClientInfo().clientid获取。
						</p>
					</td>
				</tr>
				<tr>
					<td >Token(APN):</td>
					<td>
						<input id="token" name="token" type="text" style="width:100%" placeholder="iOS APN推送设备Token"
<?php
	if ( isset($_GET['token']) ) {
		echo( "readonly=\"readonly\" value=\"{$_GET['token']}\"" );
	}
?>
                />
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <p class="des">
    [选填]，iOS APNS设备标识Token，接收APNS消息终端设备的唯一标识，在5+ API中可通过plus.push.getClientInfo().token获取。<br/>
    <span class="important">仅iOS平台支持，未设置token则不通过APNS通道推送离线消息</span>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2"><hr></td>
        </tr>
        <tr>
            <td>内容:</td>
            <td><textarea id="content" name="content" style="width:100%" rows="3" placeholder="透传推送通知的内容"><?php
if ( isset($_GET['content']) ) {
    echo( $_GET['content'] );
}else{
    echo( '透传推送通知的内容' );
}
?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <p class="des">
	[选填]，推送消息的内容。<br/>
    <span class="important">仅iOS平台APN消息有效</span>
                </p>
            </td>
        </tr>
        <tr>
            <td>透传数据：</td>
            <td><textarea id="payload" name="payload" rows="3" style="width:100%" placeholder="推送通知的透传数据，推荐使用JSON字符串格式，如“{&quot;title&quot;:&quot;标题&quot;,&quot;content&quot;:&quot;内容&quot;,&quot;payload&quot;:&quot;数据&quot;}”"><?php
if ( isset($_GET['payload']) ) {
    echo( $_GET['payload'] );
}
?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <p class="des">
    [必填]，透传数据内容，Android平台如果数据格式符合“{"title":"标题","content":"内容","payload":"数据"}”格式则会显示到系统通知栏，否则作为透传数据传输；iOS平台则将此数据作为透传数据内容传输，必须符合JSON字符串格式，并且键名不能使用"sound_url"、"badge"、"category"。<br/>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;">
                <input type="submit" value="发送推送通知"/>
            </td>
        </tr>
        </tbody>
    </table>
</form>
        <section class="tips">
        <h2>Android</h2>
        <p class="paragraph">
    不管应用在线还是离线，如果透传数据格式符合“{"title":"标题","content":"内容","payload":"数据""}”格式，则在系统通知栏中显示消息，点击消息后触发“click”事件，可通过msg.title获取标题、msg.content获取内容、msg.payload获取数据；否则触发“receive”事件，可通过msg.payload获取完整透传数据。
        </p>
        <h2>iOS</h2>
        <p class="paragraph">
    应用在线/应用切换到后台：触发“receive”事件，可通过msg.payload获取完整透传数据。
        </p>
        <p class="paragraph">
    应用离线（被关闭/未运行过）：客户端无法接收到此透传数据（被丢弃）。
        </p>
        </section>
</body>
</html>
