<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>消息推送 - UniPush</title>
    <script type="text/javascript" charset="utf-8">
function checkSubmit() {
    var cid = document.getElementById('cid');
    if(!cid.value||cid.value==''){
        alert('请输入终端标识！');
        cid.focus();
        return false;
    }
    var title = document.getElementById('title');
    if(!title.value||title.value==''){
        alert('请输入推送通知的标题！');
        title.focus();
        return false;
    }
    var content = document.getElementById('content');
    if(!content.value||content.value==''){
        alert('请输入推送通知的内容！');
        content.focus();
        return false;
    }
    return true;
}
    </script>
		<style type="text/css">
html,body{
    padding: 0;
    margin: 0;
    text-align: center;
    font-size: 14px;
}
header{
    height: 44px;
    width: 100%;
    background: #D74B28;
}
h1{
    margin: 0;
    padding-top: 10px;
    font-size: 22px;
    color: #FFFFFF;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
table,tr,td{
	padding: 0;
	margin: 0;
	text-align: left;
}
.button {
    color: #FFF;
    background-color: #FFCC33;
    border: 1px solid #ECB100;
    padding: .5em 2em;
    border-radius: 5px;
    text-decoration: none;
    font-size: 1.2em;
}
.button:hover {
    background-color: #ECB100;
}
.des{
	color: blue;
	font-size: 0.8em;
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
	text-align: left;
}
		</style>
</head>
<body>
    <header>
        <h1>HBuilderX真机运行基座unipush推送</h1>
    </header>
    <br/><br/>
<article>
<form action="./push.php" method="POST" onsubmit="return checkSubmit()">
<?php
    $time = date('YmdHis').'';
?>
    <table style="width:100%;">
        <tbody>
        <tr>
					<td style="">终端标识:</td>
					<!-- readonly="readonly" placeholder="推送通知终端标识" -->
            <td>
						<input id="cid" name="cid" type="text" style="width:95%" placeholder="推送终端标识"
<?php
if (isset($_GET['cid'])){
		echo("readonly=\"readonly\" value=\"{$_GET['cid']}\"");
}else{
	echo('value="7752c45791e57b8010b27bb89e122f5b"');
}
?>
						/><br/>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<p class="des">
	[必填]，个推平台设备标识ClientId(cid)，接收推送消息终端设备的唯一标识，在5+ API中可通过plus.push.getClientInfo().clientid获取。
						</p>
					</td>
				</tr>
            </td>
        </tr>
        <tr>
            <td colspan="2"><hr></td>
        </tr>
        <tr>
            <td>标题:</td>
            <td>
            	<input id="title" name="title" type="text" style="width:95%" placeholder="推送通知的标题"
<?php
if(isset($_GET['title'])){
    echo("value=\"{$_GET['title']}@{$time}\"");
}else{
    echo("value=\"我要推送的标题@{$time}\"");
}
?>
				/>
			</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <p class="des">
	[必填]，推送通知的标题，显示在系统消息中心。
                </p>
            </td>
        </tr>
        <tr>
            <td>内容:</td>
            <td><textarea id="content" name="content" style="width:95%" rows="3" placeholder="推送通知的内容"><?php
if(isset($_GET['content'])){
    echo($_GET['content'].'@'.$time);
}else{
    echo('我要推送的通知内容@'.$time);
}
?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <p class="des">
	[必填]，推送消息的内容，显示在系统消息中心。
                </p>
            </td>
        </tr>
        <tr>
            <td>数据：</td>
            <td><textarea id="payload" name="payload" rows="3" style="width:95%" placeholder="推送通知的数据"><?php
if(isset($_GET['payload'])){
    echo($_GET['payload']);
}
?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td>
                <p class="des">
    [选填]，客户端可获取此数据内容，根据数据内容处理点击消息时执行的业务操作（如打开指定页面等）。<br/>
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center;">
                <input type="submit" class="button" value="发送推送通知"/>
            </td>
        </tr>
        </tbody>
    </table>
</form>
</article>
        <section class="tips">
        <h2>Android</h2>
        <p class="paragraph">
在系统消息中心显示推送通知，点击通知启动（激活）应用到前台运行，触发“click”事件。
		</p>
        <p class="paragraph">
应用在线（个推推送通道可用）：推送通知和透传消息都使用个推的推送通道下发推送消息。
		</p>
		<p class="paragraph">
应用离线（个推推送通道不可用）：推送通知，使用个推离线推送通道，离线消息会存储在消息离线库，离线时间内APP在线后下发推送消息。透传消息，如果符合厂商推送的厂商手机（配置了手机厂商推送参数并且在对应厂商的手机上），则使用厂商推送通道下发推送消息；否则使用个推的离线推送通道，离线消息会存储在消息离线库，离线时间内APP在线后下发推送消息。
        </p>
        <h2>iOS</h2>
        <p class="paragraph">
Todo: 开发中...
        </p>
        </section>
</body>
</html>
