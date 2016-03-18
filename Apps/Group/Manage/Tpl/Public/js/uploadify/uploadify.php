<?php
@session_start();
$SITE_URL = 'http://'.$_SERVER['HTTP_HOST'];
$php_path = dirname(__FILE__) . '/';

$save_path = $php_path . '../xyhcms/uploads/img/'.date('Ymd', time()).'/';
 
$targetFolder = '/xyhcms/uploads/img/'.date('Ymd', time()).'/';  // Relative to the root

if (!file_exists($save_path)) {
	mkdir($save_path);
}
 
$type_id = $_POST['type_id'];
$pid     = $_POST['pid'];
 
if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'].time();
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png','xls','xlsx','rar','zip','ppt','doc','docx'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	$targetFiles = rtrim($targetPath,'/') . '/' . md5($targetFile).".".$fileParts['extension'];
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFiles);
		
		$url =  $targetFolder. md5($targetFile).".".$fileParts['extension'];
		
		$info = "{\"result\":\"SUCCESS\",\"message\":\"\u4e0a\u4f20\u6210\u529f\",\"image\":{\"id\":$pid,\"title\":\"$fileParts[filename]\",\"content\":\"$fileParts[filename]\",\"thm_url\":\"$url\",\"url\":\"$url\",\"sort\":0}}";
	} else {
	    $info = "{\"result\":\"FAILURE\",\"message\":\"\u4e0a\u4f20\u5931\u8d25\",\"image\":{\"aid\":0,\"abid\":0,\"type_id\":0,\"utype\":-99,\"uid\":-9,\"uu\":null,\"Filedata\":null}}";
		 
	}
	echo $info;
}
?>