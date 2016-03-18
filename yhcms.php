<?php
$lock = 'Data/install.lock';
if(!is_file($lock)){
	header('location:install/index');
	exit();
}
header('location:index.php?g=Manage');
?>