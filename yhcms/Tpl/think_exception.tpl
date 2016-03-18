<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<head>
  	<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
  	<title>YHCMS页面提示</title>
  	<script type="text/javascript">
   	function refresh(){
    	location.href = "<{$jumpUrl}>";
   	}
   	setTimeout("refresh()",<{$waitSecond}>000);
  	</script>
  	<style type="text/css">
   	*{margin:0px;padding:0px;font-size:12px;font-family:Arial,Verdana;}
   	body{background:#368EE0;}
   	#wrapper{width:450px;height:200px;background:#FFF;position:absolute;top:40%;left:50%;margin-top:-100px;margin-left:-225px;}
   	p.msg-title{width:100%;height:30px;line-height:30px;text-align:center;color:#368EE0;margin-top:40px;font:14px Arial,Verdana;font-weight:bold;}
   	p.error{width:100%;height:40px;line-height:40px;text-align:center;color:#368EE0;margin-top:5px;margin-bottom:5px;}
   	p.notice{width:100%;height:25px;line-height:25px;text-align:center;}
  	</style>
</head>
<body>
  	<div id="wrapper">
   		<p class="msg-title"><?php echo strip_tags($e['message']);?></p>
   		<?php if(isset($e['file'])) {?>
	   		<present name="error">
	    		<p class="error">错误位置</p>
	   		</present>
			<present name="closeWin">
		    	<p class="notice">FILE: <?php echo $e['file'] ;?> &#12288;LINE: <?php echo $e['line'];?></p>
		   	</present>
		<?php }?>
		<?php if(isset($e['trace'])) {?>
			<present name="error">
	    		<p class="error">TRACE</p>
	   		</present>
			<present name="closeWin">
		    	<p class="notice"><?php echo nl2br($e['trace']);?></p>
		   	</present>
		<?php }?>
		<center>
			<a href="http://www.yhcms.cn/" target="_blank"><span>官方网站</span></a>
		</center>
  	</div>
</body>
</html>