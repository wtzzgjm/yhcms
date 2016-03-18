<?php
return array(
	'USER_AUTH_KEY'   => 'uid',			//用户认证识别号
	//加载自定义标签
	'TAGLIB_LOAD' => true,//加载标签库打开,好像不用也行
	'APP_AUTOLOAD_PATH' => '@.TagLib',//自动载入TagLib文件夹的文件
	'TAGLIB_PRE_LOAD'=>'yhcms',//预加载的tag名//使用方法：<yhcms:tagxxx />//不添加也行
	'TAGLIB_BUILD_IN' => 'Cx,yhcms', //作为内置标签引入//Cx为ThinkPHP核心标签(如foreach,if)，必须加上
	
	'DEFAULT_THEME'  => '',//默认主题风格
	'TMPL_PATH'  => '/template/'.C('cfg_themestyle').'/Mobile/',//模板路径

	'DEFAULT_THEME'  => C('cfg_themestyle'),//默认主题风格
	'TMPL_PARSE_STRING' => array(
		'__PUBLIC__' => __ROOT__.'/template/'.C('cfg_themestyle').'/Mobile',
		'__DATA__' => __ROOT__. '/Data',
	),
);
?>