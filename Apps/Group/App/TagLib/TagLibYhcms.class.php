<?php
class TagLibYhcms extends TagLib {
	protected $tags = array(
		//自定义标签
		//文章列表
		'artlist'	=> array(
			'attr'	=> 'flag,typeid,arcid,titlelen,infolen,orderby,keyword,limit,pagesize',//attr 属性列表,arcid[new|20140413] 指定文档ID
			'close'	=> 1,// close 是否闭合（0 或者1 默认为1，表示闭合）
		),
		//产品列表分页
		'prolist'	=> array(
			'attr'	=> 'flag,typeid,arcid,titlelen,infolen,orderby,keyword,limit,pagesize',
			'close'	=> 1,
		),
		//图片列表分页
		'piclist'	=> array(
			'attr'	=> 'flag,typeid,arcid,titlelen,infolen,orderby,keyword,limit,pagesize',
			'close'	=> 1,
		),

		//通用列表
		'list'	=> array(
			'attr'	=> 'flag,typeid,titlelen,infolen,orderby,keyword,limit,pagesize',
			'close'	=> 1,
		),

		//专题列表分页
		'spelist'	=> array(
			'attr'	=> 'flag,typeid,titlelen,infolen,orderby,keyword,limit,pagesize',
			'close'	=> 1,
		),

		//栏目
		'catlist'	=> array(
			'attr'	=> 'typeid,type,orderby,limit,flag',//flag为是否全部显示
			'close'	=> 1,
		),

		//幻灯片
		'banner'	=> array(
			'attr'	=> 'limit',
			'close'	=> 1,
		),

		//导航
		'navlist'	=> array(
			'attr'	=> 'typeid',
			'close'	=> 1,
		),

		//地区导航
		'arealist'	=> array(
			'attr'	=> 'limit',
			'close'	=> 1,
		),

		//类名和链接
		'type'	=> array(
			'attr'	=> 'typeid',
			'close'	=> 1,
		),
		//user list
			'userlist'	=> array(
			'attr'	=> 'typeid,titlelen,infolen,orderby,limit,pagesize',//attr 属性列表
			'close'	=> 1,
		),
		//announce list
		'announcelist'	=> array(
			'attr'	=> 'titlelen,infolen,orderby,limit,pagesize',//attr 属性列表
			'close'	=> 1,
		),


		//friendLink list
		'flink'	=> array(
			'attr'	=> 'typeid,titlelen,infolen,orderby,limit,pagesize',//attr 属性列表
			'close'	=> 1,
		),

		'iteminfo'	=> array(
			'attr'	=> 'name,titlelen',
			'close'	=> 1,
		),


		'block'	=> array(
			'attr'	=> 'name,infolen,textflag',
			'close'	=> 0,
		),


		'field'	=> array(
			'attr'	=> 'typeid,artid,name,infolen,imgindex,imgwidth,imgheight',//imgindex,imgwidth,imgheight针对图片
			'close'	=> 0,
		),

		'position'	=> array(
			'attr'	=> 'typeid,ismobile,sname,surl,delimiter',
			'close'	=> 0,
		),
		'areaposition'	=> array(
			'attr'	=> 'typeid,ismobile,sname,surl,delimiter',
			'close'	=> 0,
		),
		'sitekeywords'	=> array('close' => 0),
		'sitedescription'	=> array('close' => 0),

		'cfg_webname'	=> array('close' => 0),//网站名称
		'cfg_weburl'	=> array('close' => 0),//网站主页
		'cfg_webtitle'	=> array('close' => 0),//网站标题
		'cfg_themestyle'	=> array('close' => 0),//模板默认风格
		'cfg_keywords'	=> array('close' => 0),//站点关键词
		'cfg_description'	=> array('close' => 0),//站点描述
		'cfg_powerby'	=> array('close' => 0),//网站版权信息

		'sitetitle'	=> array('close' => 0),
		'siteurl'	=> array('close' => 0),

		'searchurl'	=> array('close' => 0),
		'gbookurl'	=> array('close' => 0),
		'gbookaddurl'	=> array('close' => 0),
		'vcodeurl'	=> array('close' => 0),		
		'mobileauto'	=> array(
			'attr'	=> 'flag',//0自动,1是php,2是js
			'close' => 0
		),

		'prev'	=> array(
			'attr'	=> 'titlelen',//attr 属性列表
			'close' => 0
		),
		'next'	=> array(			
			'attr'	=> 'titlelen',//attr 属性列表
			'close' => 0
		),
		'areaprev'	=> array(
			'attr'	=> 'titlelen',//attr 属性列表
			'close' => 0
		),
		'areanext'	=> array(			
			'attr'	=> 'titlelen',//attr 属性列表
			'close' => 0
		),
		'click'	=> array('close' => 0),
	);

	//标签名前加下划线
	//文章列表
	public function _artlist($attr, $content) {
		$attr = $this->parseXmlAttr($attr, 'artlist');
		////非debug参属性参数只处理 一次
		$flag = empty($attr['flag'])? '': $attr['flag'];
		$typeid = !isset($attr['typeid']) || $attr['typeid'] == '' ? -1 : trim($attr['typeid']);//-1后面自动获取
		$arcid  = empty($attr['arcid'])? '' : $attr['arcid'];//新增加20140413
		$titlelen = empty($attr['titlelen'])? 0 : intval($attr['titlelen']);
		$infolen = empty($attr['infolen'])? 0 : intval($attr['infolen']);		
		$orderby = empty($attr['orderby'])? 'id DESC' : $attr['orderby'];
		$limit = empty($attr['limit'])? '10' : $attr['limit'];
		$pagesize = empty($attr['pagesize'])? '0' : $attr['pagesize'];
		$keyword = empty($attr['keyword'])? '': trim($attr['keyword']);

		$flag = flag2sum($flag);
		$arcid = string2filter($arcid, ',', true);

		
		$str = <<<str
<?php
	\$_typeid = $typeid;	
	\$_keyword = "$keyword";
	\$_arcid = "$arcid";
	if(\$_typeid == -1) \$_typeid = I('get.cid', 0, 'intval');
	if (\$_typeid>0 || substr(\$_typeid,0,1) == '$') {
		import('Class.Category', APP_PATH);
		\$ids = Category::getChildsId(getCategory(), \$_typeid, true);
		//p(\$ids);
		\$where = array('article.status' => 0, 'article.cid'=> array('IN',\$ids));
	}else {
		\$where = array('article.status' => 0);
	}

	if (\$_keyword != '') {
		\$where['article.title'] = array('like','%'.\$_keyword.'%');
	}
	if (!empty(\$_arcid)) {
		\$where['article.id'] = array('IN', \$_arcid);
	}

	if ($flag > 0) {	
		\$where['_string'] = 'article.flag & $flag = $flag ';	
	}

	//分页
	if ($pagesize > 0) {
		
		import('ORG.Util.Page');
		\$count = D('ArticleView')->where(\$where)->count();

		\$thisPage = new Page(\$count, $pagesize);
		
		\$ename = I('e', '', 'htmlspecialchars,trim');
		if (!empty(\$ename) && C('URL_ROUTER_ON') == true) {
			\$thisPage->url = ''.\$ename. '/p';
		}
		//设置显示的页数
		\$thisPage->rollPage = 3;
		\$thisPage->setConfig('theme',' %upPage% %downPage% %linkPage%');
		\$limit = \$thisPage->firstRow. ',' .\$thisPage->listRows;	
		\$page = \$thisPage->show();
	}else {
		\$limit = "$limit";
	}
	

	\$_artlist = D('ArticleView')->where(\$where)->order("$orderby")->limit(\$limit)->select();

	if (empty(\$_artlist)) {
		\$_artlist = array();
	}
	

	foreach(\$_artlist as \$autoindex => \$artlist):	

	\$_jumpflag = (\$artlist['flag'] & B_JUMP) == B_JUMP? true : false;
	\$artlist['url'] = getContentUrl(\$artlist['id'], \$artlist['cid'], \$artlist['ename'], \$_jumpflag, \$artlist['jumpurl']);

	if($titlelen) \$artlist['title'] = str2sub(\$artlist['title'], $titlelen, 0);
	if($infolen) \$artlist['description'] = str2sub(\$artlist['description'], $infolen, 0);

?>
str;
	$str .= $content;
	$str .='<?php endforeach;?>';
	return $str;

	}


	//产品列表
	public function _prolist($attr, $content) {
		$attr = $this->parseXmlAttr($attr, 'prolist');
		$flag = empty($attr['flag'])? '': $attr['flag'];
		$typeid = !isset($attr['typeid']) || $attr['typeid'] == '' ? -1 : trim($attr['typeid']);
		$arcid  = empty($attr['arcid'])? '' : $attr['arcid'];
		$titlelen = empty($attr['titlelen'])? 0 : intval($attr['titlelen']);
		$infolen = empty($attr['infolen'])? 0 : intval($attr['infolen']);		
		$orderby = empty($attr['orderby'])? 'id DESC' : $attr['orderby'];
		$limit = empty($attr['limit'])? '10' : $attr['limit'];
		$pagesize = empty($attr['pagesize'])? '0' : $attr['pagesize'];
		$keyword = empty($attr['keyword'])? '': trim($attr['keyword']);

		$flag = flag2sum($flag);
		$arcid = string2filter($arcid, ',', true);

		$str = <<<str
<?php
	\$_typeid = $typeid;	
	\$_keyword = "$keyword";
	\$_arcid = "$arcid";
	if(\$_typeid == -1) \$_typeid = I('get.cid', 0, 'intval');
	if (\$_typeid>0 || substr(\$_typeid,0,1) == '$') {
		import('Class.Category', APP_PATH);
		\$ids = Category::getChildsId(getCategory(), \$_typeid, true);
		//p(\$ids);
		\$where = array('product.status' => 0, 'product.cid'=> array('IN',\$ids));
	}else {
		\$where = array('product.status' => 0);
	}


	if (\$_keyword != '') {
		\$where['product.title'] = array('like','%'.\$_keyword.'%');
	}
	if (!empty(\$_arcid)) {
		\$where['product.id'] = array('IN', \$_arcid);
	}


	if ($flag > 0) {	
		\$where['_string'] = 'product.flag & $flag = $flag ';	
	}

	//分页
	if ($pagesize > 0) {
		
		import('ORG.Util.Page');
		\$count = D('ProductView')->where(\$where)->count();

		\$thisPage = new Page(\$count, $pagesize);
		
		\$ename = I('e', '', 'htmlspecialchars,trim');
		if (!empty(\$ename) && C('URL_ROUTER_ON') == true) {
			\$thisPage->url = ''.\$ename. '/p';
		}
		//设置显示的页数
		\$thisPage->rollPage = 3;
		\$thisPage->setConfig('theme',' %upPage% %downPage% %linkPage%');
		\$limit = \$thisPage->firstRow. ',' .\$thisPage->listRows;	
		\$page = \$thisPage->show();
	}else {
		\$limit = "$limit";
	}
	

	\$_prolist = D('ProductView')->where(\$where)->order("$orderby")->limit(\$limit)->select();

	if (empty(\$_prolist)) {
		\$_prolist = array();
	}


	foreach(\$_prolist as \$autoindex => \$prolist):	
	\$_jumpflag = (\$prolist['flag'] & B_JUMP) == B_JUMP? true : false;
	\$prolist['url'] = getContentUrl(\$prolist['id'], \$prolist['cid'], \$prolist['ename'], \$_jumpflag, \$prolist['jumpurl']);
	\$prolist['areaurl'] = getContentareaUrl(\$prolist['id'], \$prolist['cid'], \$prolist['ename'], \$_jumpflag, \$prolist['jumpurl']);	


	if($titlelen) \$prolist['title'] = str2sub(\$prolist['title'], $titlelen, 0);
	if($infolen) \$prolist['description'] = str2sub(\$prolist['description'], $infolen, 0);

?>
str;
	$str .= $content;
	$str .='<?php endforeach;?>';
	return $str;

	}


	//图片列表
	public function _piclist($attr, $content) {
		$attr = $this->parseXmlAttr($attr, 'piclist');
		$flag = empty($attr['flag'])? '': $attr['flag'];
		$typeid = !isset($attr['typeid']) || $attr['typeid'] == '' ? -1 : trim($attr['typeid']);
		$arcid  = empty($attr['arcid'])? '' : $attr['arcid'];
		$titlelen = empty($attr['titlelen'])? 0 : intval($attr['titlelen']);
		$infolen = empty($attr['infolen'])? 0 : intval($attr['infolen']);		
		$orderby = empty($attr['orderby'])? 'id DESC' : $attr['orderby'];
		$limit = empty($attr['limit'])? '10' : $attr['limit'];
		$pagesize = empty($attr['pagesize'])? '0' : $attr['pagesize'];
		$keyword = empty($attr['keyword'])? '': trim($attr['keyword']);

		$flag = flag2sum($flag);
		$arcid = string2filter($arcid, ',', true);
		
		$str = <<<str
<?php
	\$_typeid = $typeid;		
	\$_keyword = "$keyword";
	\$_arcid = "$arcid";
	if(\$_typeid == -1) \$_typeid = I('cid', 0, 'intval');
	if (\$_typeid>0 || substr(\$_typeid,0,1) == '$') {
		import('Class.Category', APP_PATH);
		\$ids = Category::getChildsId(getCategory(), \$_typeid, true);
		//p(\$ids);
		\$where = array('picture.status' => 0, 'picture.cid'=> array('IN',\$ids));
	}else {
		\$where = array('picture.status' => 0);
	}

	if (\$_keyword != '') {
		\$where['picture.title'] = array('like','%'.\$_keyword.'%');
	}
	if (!empty(\$_arcid)) {
		\$where['picture.id'] = array('IN', \$_arcid);
	}


	if ($flag > 0) {	
		\$where['_string'] = 'picture.flag & $flag = $flag ';	
	}

	//分页
	if ($pagesize > 0) {
		
		import('ORG.Util.Page');
		\$count = D('PictureView')->where(\$where)->count();

		\$thisPage = new Page(\$count, $pagesize);
		
		\$ename = I('e', '', 'htmlspecialchars,trim');
		if (!empty(\$ename) && C('URL_ROUTER_ON') == true) {
			\$thisPage->url = ''.\$ename. '/p';
		}
		//设置显示的页数
		\$thisPage->rollPage = 3;
		\$thisPage->setConfig('theme',' %upPage% %downPage% %linkPage%');
		\$limit = \$thisPage->firstRow. ',' .\$thisPage->listRows;	
		\$page = \$thisPage->show();
	}else {
		\$limit = "$limit";
	}
	

	\$_piclist = D('PictureView')->where(\$where)->order("$orderby")->limit(\$limit)->select();

	if (empty(\$_piclist)) {
		\$_piclist = array();
	}


	foreach(\$_piclist as \$autoindex => \$piclist):
	\$_jumpflag = (\$piclist['flag'] & B_JUMP) == B_JUMP? true : false;
	\$piclist['url'] = getContentUrl(\$piclist['id'], \$piclist['cid'], \$piclist['ename'], \$_jumpflag, \$piclist['jumpurl']);
	if($titlelen) \$piclist['title'] = str2sub(\$piclist['title'], $titlelen, 0);
	if($infolen) \$piclist['description'] = str2sub(\$piclist['description'], $infolen, 0);

?>
str;
	$str .= $content;
	$str .='<?php endforeach;?>';
	return $str;

	}

	//文章列表
	public function _list($attr, $content) {
		$attr = $this->parseXmlAttr($attr, 'list');
		$flag = empty($attr['flag'])? '': $attr['flag'];
		$typeid = !isset($attr['typeid']) || $attr['typeid'] == '' ? -1 : trim($attr['typeid']);//只接收一个栏目ID
		$titlelen = empty($attr['titlelen'])? 0 : intval($attr['titlelen']);
		$infolen = empty($attr['infolen'])? 0 : intval($attr['infolen']);		
		$orderby = empty($attr['orderby'])? 'id DESC' : $attr['orderby'];
		$limit = empty($attr['limit'])? '10' : $attr['limit'];
		$pagesize = empty($attr['pagesize'])? '0' : $attr['pagesize'];
		$keyword = empty($attr['keyword'])? '': trim($attr['keyword']);
		

		$flag = flag2sum($flag);

		$str = <<<str
<?php
	\$_typeid = $typeid;	
	\$_keyword = "$keyword";
	if(\$_typeid == -1) \$_typeid = I('cid', 0, 'intval');
	if (\$_typeid>0 || substr(\$_typeid,0,1) == '$') {
		import('Class.Category', APP_PATH);
		\$_selfcate = Category::getSelf(getCategory(), \$_typeid);
		\$_tablename = strtolower(\$_selfcate['tablename']);
		\$ids = Category::getChildsId(getCategory(), \$_typeid, true);
		//p(\$ids);
		\$where = array(\$_tablename.'.status' => 0, \$_tablename .'.cid'=> array('IN',\$ids));
	}else {
		\$_tablename = 'article';
		\$where = array(\$_tablename.'.status' => 0);
		
	}
	if (\$_keyword != '') {
		\$where[\$_tablename.'.title'] = array('like','%'.\$_keyword.'%');
	}


	if ($flag > 0) {	
		\$where['_string'] = \$_tablename.'.flag & $flag = $flag ';	
	}

	if (!empty(\$_tablename) && \$_tablename != 'page') {
	
		//分页
		if ($pagesize > 0) {
			
			import('ORG.Util.Page');
			\$count = D(ucfirst(\$_tablename ).'View')->where(\$where)->count();

			\$thisPage = new Page(\$count, $pagesize);
			
			\$ename = I('e', '', 'htmlspecialchars,trim');
			if (!empty(\$ename) && C('URL_ROUTER_ON') == true) {
				\$thisPage->url = ''.\$ename. '/p';
			}
			//设置显示的页数
			\$thisPage->rollPage = 3;
			\$thisPage->setConfig('theme',' %upPage% %downPage% %linkPage%');
			\$limit = \$thisPage->firstRow. ',' .\$thisPage->listRows;	
			\$page = \$thisPage->show();

		}else {
			\$limit = "$limit";
		}	

		\$_list = D(ucfirst(\$_tablename ).'View')->where(\$where)->order("$orderby")->limit(\$limit)->select();
		if (empty(\$_list)) {
			\$_list = array();
		}
	}else {
		\$_list = array();
	}


	//Load('extend');//调用msubstr()

	foreach(\$_list as \$autoindex => \$list):

	\$_jumpflag = (\$list['flag'] & B_JUMP) == B_JUMP? true : false;
	\$list['url'] = getContentUrl(\$list['id'], \$list['cid'], \$list['ename'], \$_jumpflag, \$list['jumpurl']);
	\$list['areaurl'] = getContentareaUrl(\$list['id'], \$list['cid'], \$list['ename'], \$_jumpflag, \$list['jumpurl']);
	if($titlelen) \$list['title'] = str2sub(\$list['title'], $titlelen, 0);	
	if($infolen) \$list['description'] = str2sub(\$list['description'], $infolen, 0);

?>
str;
	$str .= $content;
	$str .='<?php endforeach;?>';
	return $str;

	}



	//专题列表
	public function _spelist($attr, $content) {
		$attr = $this->parseXmlAttr($attr, 'spelist');
		$flag = empty($attr['flag'])? '': $attr['flag'];
		$typeid = !isset($attr['typeid']) || $attr['typeid'] == '' ? 0 : trim($attr['typeid']);//只接收一个栏目ID
		$titlelen = empty($attr['titlelen'])? 0 : intval($attr['titlelen']);
		$infolen = empty($attr['infolen'])? 0 : intval($attr['infolen']);		
		$orderby = empty($attr['orderby'])? 'id DESC' : $attr['orderby'];
		$limit = empty($attr['limit'])? '10' : $attr['limit'];
		$pagesize = empty($attr['pagesize'])? '0' : $attr['pagesize'];
		$keyword = empty($attr['keyword'])? '': trim($attr['keyword']);
		

		$flag = flag2sum($flag);
		
		$str = <<<str
<?php
	\$_typeid = $typeid;	
	\$_keyword = "$keyword";
	if (\$_typeid>0) {
		import('Class.Category', APP_PATH);
		\$_selfcate = Category::getSelf(getCategory(), \$_typeid);
		if (\$_selfcate) {
			\$_tablename = strtolower(\$_selfcate['tablename']);
			\$ids = Category::getChildsId(getCategory(), \$_typeid, true);

			\$where = array('special.status' => 0, 'special.cid'=> array('IN',\$ids));
		}else {
			\$_typeid = 0;
		}			
		
	}
	if (\$_typeid == 0) {
		\$where = array('special.status' => 0);
		
	}

	if (\$_keyword != '') {
		\$where['special.title'] = array('like','%'.\$_keyword.'%');
	}


	if ($flag > 0) {	
		\$where['_string'] = 'special.flag & $flag = $flag ';	
	}


	//分页
	if ($pagesize > 0) {
		
		import('ORG.Util.Page');
		\$count = D('SpecialView')->where(\$where)->count();

		\$thisPage = new Page(\$count, $pagesize);
		
		\$ename = I('e', '', 'htmlspecialchars,trim');
		if (!empty(\$ename) && C('URL_ROUTER_ON') == true) {
			\$thisPage->url = ''.\$ename. '/p';
		}
		//设置显示的页数
		\$thisPage->rollPage = 3;
		\$thisPage->setConfig('theme',' %upPage% %downPage% %linkPage%');
		\$limit = \$thisPage->firstRow. ',' .\$thisPage->listRows;	
		\$page = \$thisPage->show();

	}else {
		\$limit = "$limit";
	}	

	\$_spelist = D('SpecialView')->where(\$where)->order("$orderby")->limit(\$limit)->select();
	if (empty(\$_spelist)) {
		\$_spelist = array();
	}


	foreach(\$_spelist as \$autoindex => \$spelist):

	if ((\$spelist['flag'] & B_JUMP)  && !empty(\$spelist['jumpurl'])) {
        \$spelist['url'] = \$spelist['jumpurl'];
    }else {
    	//开启路由
	    if(C('URL_ROUTER_ON') == true) {
	        \$spelist['url'] = U('Special/'.\$spelist['id'],'');
	    }else {
	        \$spelist['url']  = U('Special/shows', array('id'=> \$spelist['id']));     
	        
	    }
    }
	

	if($titlelen) \$spelist['title'] = str2sub(\$spelist['title'], $titlelen, 0);	
	if($infolen) \$spelist['description'] = str2sub(\$spelist['description'], $infolen, 0);

?>
str;
	$str .= $content;
	$str .='<?php endforeach;?>';
	return $str;

	}



	//当前栏目名称
	public function _type($attr, $content) {
		$attr = $this->parseXmlAttr($attr, 'artlist');
		$typeid = empty($attr['typeid'])? 0 : intval($attr['typeid']);
		if ($typeid == 0) {
			$typeid = $attr['typeid'];
		}
		$str = <<<str
<?php

	import('Class.Category', APP_PATH);	
	\$type = Category::getSelf(getCategory(0), $typeid);		
	\$type['url'] = getUrl(\$type);
	

?>
str;
		$str .= $content;
		return $str;

	}

	//幻灯片
	public function _banner($attr, $content) {
		$attr = !empty($attr)? $this->parseXmlAttr($attr, 'banner') : null;

		$limit = $attr['limit'] == '' ? -1 : intval($attr['limit']);
		$str = <<<str
<?php
	\$_bannerlist = D('Banner')->order('sort')->limit($limit)->select();
	foreach(\$_bannerlist as \$autoindex => \$banner):
		
?>
str;

	$str .= $content;
	$str .='<?php endforeach;?>';
	return $str;

	}

	//分类
	public function _catlist($attr, $content) {
		$attr = $this->parseXmlAttr($attr, 'catlist');
		$typeid = !isset($attr['typeid']) || $attr['typeid'] == '' ? -1 : trim($attr['typeid']);//只接收一个栏目ID
		$type = empty($attr['type'])? 'son' : $attr['type'];//son表示下级栏目,self表示同级栏目,top顶级栏目(top忽略typeid)
		$flag = empty($attr['flag']) ? 0: intval($attr['flag']);//0(不显示链接和单页),1(全部显示),2
		$orderby = empty($attr['orderby'])? 'id DESC' : $attr['orderby'];
		$limit = empty($attr['limit'])? '10' : $attr['limit'];
		$str = <<<str
<?php
	\$_typeid = intval($typeid);
	\$type = "$type";
	if(\$_typeid == -1) \$_typeid = I('cid', 0, 'intval');
	\$__catlist = getCategory(1);

	import('Class.Category', APP_PATH);	
	if ($flag == 0) {
		//where array('status' => 1, 'type' => 0 , 'modelid' => array('neq',2));//2是单页模型
		\$__catlist = Category::clearPageAndLink(\$__catlist);
	}
	
	//\$type为top,忽略$typeid
	if(\$_typeid == 0 || \$type == 'top') {
		\$_catlist  = Category::unlimitedForLayer(\$__catlist);
	}else {
		//同级分类
		if (\$type == 'self') {
			\$_typeinfo  = Category::getSelf(\$__catlist, \$_typeid );
			//if (\$_typeinfo['pid'] != 0) {
				\$_catlist  = Category::unlimitedForLayer(\$__catlist, 'child', \$_typeinfo['pid']);
			//}
		}else {
			//son，子类列表
			\$_catlist  = Category::unlimitedForLayer(\$__catlist, 'child', \$_typeid);
		}
	}

	foreach(\$_catlist as \$autoindex => \$catlist):
	if(\$autoindex >= $limit) break;
	\$catlist['url'] = getUrl(\$catlist);
	\$catlist['areaurl'] = getareaUrl(\$catlist);
?>
str;
	$str .= $content;
	$str .='<?php endforeach;?>';
	return $str;

	}

	//导航
	public function _navlist($attr, $content) {
		$attr = !empty($attr)? $this->parseXmlAttr($attr, 'navlist') : null;
		$typeid = $attr['typeid'] == '' ? 1 : intval($attr['typeid']);//不能用empty,0,'','0',会认为true
		$str = <<<str
<?php
	\$_typeid = $typeid;
	if(\$_typeid == -1) \$_typeid = I('cid', 0, 'intval');

	\$_navlist = M('Nav')->where("navtype='".\$_typeid."'")->order('sort')->select();
	import('Class.Category', APP_PATH);	
	if(\$_typeid == 0) {
		\$_navlist  = Category::unlimitedForLayer(\$_navlist);
	}else {
		\$_navlist  = Category::unlimitedForLayer(\$_navlist, 'child', 0);
	}

	foreach(\$_navlist as \$autoindex => \$navlist):

		if(strstr(\$navlist['url'], '@')){
			\$cdata = M('category')->find(str_replace('@', '', \$navlist['url']));
			\$navlist['url'] = getUrl(\$cdata);
		}else{
			\$navlist['url'] = \$navlist['url'];
		}
?>
str;
	
	$str .= $content;
	$str .='<?php endforeach;?>';
	return $str;

	}

	//地区导航
	public function _arealist($attr, $content) {
		//$attr = $this->parseXmlAttr($attr, 'navlist');
		$attr = !empty($attr)? $this->parseXmlAttr($attr, 'arealist') : null;
		$limit = $attr['limit'] == '' ? -1 : intval($attr['limit']);
		$str = <<<str
<?php
	\$_arealist = \$arealist;
	foreach(\$_arealist as \$autoindex => \$arealist):
		\$idstr = '';
		if(\$id){
			\$idstr = \$id.'.html';
		}
		\$cstr = '';
		if(\$cate['ename']){
			\$cstr = \$cate['ename'].'/';
		}

		\$arealist['url'] = C('cfg_weburl').'/diqu_'.\$arealist['ename'].'/'.\$cstr.\$idstr;

		\$arealist['name'] = \$arealist['sname'].\$cate['name'];	
?>
str;

	$str .= $content;
	$str .='<?php endforeach;?>';
	return $str;

	}



	//user list
	public function _userlist($attr, $content) {
		$attr = $this->parseXmlAttr($attr, 'userlist');
		$typeid = isset($attr['typeid']) ? trim($attr['typeid']) : 0;
		$typeid = trim($typeid) == '' ? 0 : $typeid;
		$titlelen = empty($attr['titlelen'])? 0 : intval($attr['titlelen']);
		$infolen = empty($attr['infolen'])? 0 : intval($attr['infolen']);		
		$orderby = empty($attr['orderby'])? 'id DESC' : $attr['orderby'];
		$limit = empty($attr['limit'])? '10' : $attr['limit'];
		$pagesize = empty($attr['pagesize'])? '0' : $attr['pagesize'];
		//echo "$typeid---------";

		
		$str = <<<str
<?php
	\$_typeid = $typeid;	
	if (\$_typeid>0 || substr(\$_typeid,0,1) == '$') {
		\$where = array('member.islock' => 0, 'member.groupid'=> \$_typeid);
	}else {
		\$where = array('member.islock' => 0);
	}

	//分页
	if ($pagesize > 0) {
		
		import('ORG.Util.Page');
		\$count = D('MemberView')->where(\$where)->count();

		\$thisPage = new Page(\$count, $pagesize);
		
		//设置显示的页数
		\$thisPage->rollPage = 3;
		\$thisPage->setConfig('theme',' %upPage% %downPage% %linkPage%');
		\$limit = \$thisPage->firstRow. ',' .\$thisPage->listRows;	
		\$page = \$thisPage->show();
	}else {
		\$limit = "$limit";
	}
	

	\$_userlist = D('MemberView')->where(\$where)->order("$orderby")->limit(\$limit)->select();
	if (empty(\$_userlist)) {
		\$_userlist = array();
	}

	foreach(\$_userlist as \$autoindex => \$userlist):
	//开启路由
	if(C('URL_ROUTER_ON') == true) {
		\$userlist['url'] = U('u/'. \$userlist['id']);
	}else {
		\$userlist['url'] = U(GROUP_NAME.'/Public/user', array('id'=> \$userlist['id']));
	}


?>
str;
	$str .= $content;
	$str .='<?php endforeach;?>';
	return $str;

	}

	//announce list
	public function _announcelist($attr, $content) {
		$attr = $this->parseXmlAttr($attr, 'announcelist');
		$titlelen = empty($attr['titlelen'])? 0 : intval($attr['titlelen']);
		$infolen = empty($attr['infolen'])? 0 : intval($attr['infolen']);		
		$orderby = empty($attr['orderby'])? 'starttime DESC' : $attr['orderby'];
		$limit = empty($attr['limit'])? '10' : $attr['limit'];
		$pagesize = empty($attr['pagesize'])? '0' : $attr['pagesize'];
	

		
		$str = <<<str
<?php

	\$where = array('endtime' => array('gt',time()));


	//分页
	if ($pagesize > 0) {
		
		import('ORG.Util.Page');
		\$count = M('announce')->where(\$where)->count();

		\$thisPage = new Page(\$count, $pagesize);
		

		//设置显示的页数
		\$thisPage->rollPage = 3;
		\$thisPage->setConfig('theme',' %upPage% %downPage% %linkPage%');
		\$limit = \$thisPage->firstRow. ',' .\$thisPage->listRows;	
		\$page = \$thisPage->show();
	}else {
		\$limit = "$limit";
	}
	

	\$_announcelist = M('announce')->where(\$where)->order("$orderby")->limit(\$limit)->select();
	if (empty(\$_announcelist)) {
		\$_announcelist = array();
	}

	foreach(\$_announcelist as \$autoindex => \$announcelist):

	if($titlelen) \$announcelist['title'] = str2sub(\$announcelist['title'], $titlelen, 0);
	if($infolen) \$announcelist['content'] = str2sub(strip_tags(\$announcelist['content']), $infolen, 0);//清除html再截取


?>
str;
	$str .= $content;
	$str .='<?php endforeach;?>';
	return $str;

	}

//friend Link list
	public function _flink($attr, $content) {
		$attr = $this->parseXmlAttr($attr, 'flink');
		$typeid = isset($attr['typeid']) ? trim($attr['typeid']) : 0;
		$typeid = trim($typeid) == '' ? 0 : $typeid;
		$titlelen = empty($attr['titlelen'])? 0 : intval($attr['titlelen']);
		$infolen = empty($attr['infolen'])? 0 : intval($attr['infolen']);		
		$orderby = empty($attr['orderby'])? 'sort ASC' : $attr['orderby'];
		$limit = empty($attr['limit'])? '10' : $attr['limit'];
		$pagesize = empty($attr['pagesize'])? '0' : $attr['pagesize'];
		//echo "$typeid---------";

		
		$str = <<<str
<?php
	\$_typeid = $typeid;	
	if (\$_typeid>0 || substr(\$_typeid,0,1) == '$') {
		\$where = array('ischeck'=> \$_typeid);
	}else {
		\$where = array('id' => array('gt',0));
	}

	//分页
	if ($pagesize > 0) {
		
		import('ORG.Util.Page');
		\$count = M('link')->where(\$where)->count();

		\$thisPage = new Page(\$count, $pagesize);
		

		//设置显示的页数
		\$thisPage->rollPage = 3;
		\$thisPage->setConfig('theme',' %upPage% %downPage% %linkPage%');
		\$limit = \$thisPage->firstRow. ',' .\$thisPage->listRows;	
		\$page = \$thisPage->show();
	}else {
		\$limit = "$limit";
	}
	

	\$_flink = M('link')->where(\$where)->order("$orderby")->limit(\$limit)->select();
	if (empty(\$_flink)) {
		\$_flink = array();
	}

	foreach(\$_flink as \$autoindex => \$flink):



?>
str;
	$str .= $content;
	$str .='<?php endforeach;?>';
	return $str;

	}


	//iteminfo List
	public function _iteminfo($attr, $content) {
		$attr = $this->parseXmlAttr($attr, 'iteminfo');
		$name = isset($attr['name']) ? trim($attr['name']) : '';
		$titlelen = empty($attr['titlelen'])? 0 : intval($attr['titlelen']);
		$limit = empty($attr['limit'])? '10' : $attr['limit'];
		
		$str = <<<str
<?php
	
	if ("$name" == '') {
		\$_iteminfo= array();
	}else {
		\$_iteminfo = getArrayOfItem("$name");
	}



	foreach(\$_iteminfo as \$autoindex => \$iteminfo):
	if($titlelen>0) \$iteminfo = str2sub(\$iteminfo, $titlelen);

?>
str;
	$str .= $content;
	$str .='<?php endforeach;?>';
	return $str;

	}


	public function _block($attr, $content) {
		$attr = !empty($attr)? $this->parseXmlAttr($attr, 'block') : null;
		$name = isset($attr['name']) ? $attr['name'] : '';
		$infolen = empty($attr['infolen']) ? 0 : intval($attr['infolen']);
		$textflag = empty($attr['textflag']) ? 0 : 1;

		$name = trim(htmlspecialchars($name));
		$str =<<<str
<?php

	\$block = getBlock("$name");
	\$block_content = '';
	if (\$block) {
		if (\$block['blocktype'] == 2) {
			if (!$textflag) {
				\$block_content = '<img src="'. \$block['content'] .'" />';
			}else {
				\$block_content = \$block['content'];
			}
			
		}else {
			if($infolen) {
				\$block_content = str2sub(strip_tags(\$block['content']), $infolen, 0);//清除html再截取
			}else {
				\$block_content = \$block['content'];
			}
		}
	}
	echo \$block_content;


?>
str;

		return $str;
	}


	//调用栏目或内容的指定字段
	public function _field($attr, $content) {
		$attr = $this->parseXmlAttr($attr, 'field');
		$typeid = !isset($attr['typeid']) || $attr['typeid'] == '' ? 0 : trim($attr['typeid']);//只接收一个栏目ID
		$artid = empty($attr['artid'])? 0 : intval($attr['artid']);
		$infolen = empty($attr['infolen'])? 0 : intval($attr['infolen']);	
		$name = empty($attr['name'])? '': trim($attr['name']);
		$imgindex = empty($attr['imgindex'])? 0 : intval($attr['imgindex']);	
		$imgwidth = empty($attr['imgwidth'])? 0 : intval($attr['imgwidth']);	
		$imgheight = empty($attr['imgheight'])? 0 : intval($attr['imgheight']);	
		

		
		$str = <<<str
<?php
	\$_typeid = $typeid;	
	\$_fieldname = "$name";
	\$_tempstr = '';
	if (\$_typeid>0 && !empty(\$_fieldname)) {
		import('Class.Category', APP_PATH);
		\$_selfcate = Category::getSelf(getCategory(), \$_typeid);
		\$_tablename = strtolower(\$_selfcate['tablename']);

		if (\$_tablename == 'page' || $artid == 0) {
			\$_tempstr = M('category')->where(array('id' => \$_typeid))->getField(\$_fieldname);
		}elseif (!empty(\$_selfcate )) {
			\$_tempstr = M(\$_tablename)->where(array('id' => $artid))->getField(\$_fieldname);
			if (\$_fieldname == 'pictureurls' || \$_fieldname == 'litpic') {
				if (empty(\$_tempstr)) {
					\$_tempstr = get_picture('', $imgwidth, $imgheight);
				}elseif (\$_fieldname == 'litpic') {
					\$_tempstr = get_picture(\$_tempstr, $imgwidth, $imgheight);
				}elseif (\$_fieldname == 'pictureurls') {
						\$_pictureurls_arr = explode('|||', \$_tempstr);			
						\$_pictureurls  = array();
						foreach (\$_pictureurls_arr as \$v) {
							\$temp_arr = explode('$$$', \$v);
							if (!empty(\$temp_arr[0])) {
								\$_pictureurls[] = array(
									'url' => \$temp_arr[0],
									'alt' => \$temp_arr[1]
								);
							}				
						}
					if(!isset(\$_pictureurls[$imgindex]['url'])) \$_pictureurls[$imgindex]['url'] = '';
					\$_tempstr = get_picture(\$_pictureurls[$imgindex]['url'],$imgwidth, $imgheight);
				}
			}
			 
		}
		if ($infolen >0 && !empty(\$_tempstr)) {
			\$_tempstr = str2sub(strip_tags(\$_tempstr), $infolen, 0);//清除html再截取
		}	
		
	}

	echo \$_tempstr;

?>
str;

	return $str;

	}




	/**/
	public function _position($attr, $content) {
		//非debug参数只处理 一次
		$attr = !empty($attr)?$this->parseXmlAttr($attr, 'position') : null;
		$typeid = !isset($attr['typeid']) || $attr['typeid'] == '' ? -1: trim($attr['typeid']);//只接收一个栏目ID
		$ismobile = empty($attr['ismobile'])? 0 : 1;
		$sname = isset($attr['sname'])? trim($attr['sname']) : '';	
		$surl = isset($attr['surl'])? trim($attr['surl']) : '';	
		$delimiter = isset($attr['delimiter'])? trim($attr['delimiter']) : '';

		$str =<<<str
<?php
		\$_sname = "$sname";
		\$_typeid =$typeid;
		//debug关闭后,typeid值不变
		//没有下面这步，非debug下，会写死了
		if(\$_typeid == -1) \$_typeid = I('cid', 0, 'intval');

		if (\$_typeid == 0 &&  \$_sname == '') {
			\$_sname = isset(\$title) ? \$title : '';
		}
		echo getPosition(\$_typeid, \$_sname, "$surl", $ismobile, "$delimiter");

?>
str;

		return $str;
	}

	public function _areaposition($attr, $content) {
		//非debug参数只处理 一次
		$attr = !empty($attr)?$this->parseXmlAttr($attr, 'position') : null;
		$typeid = !isset($attr['typeid']) || $attr['typeid'] == '' ? -1: trim($attr['typeid']);//只接收一个栏目ID
		$ismobile = empty($attr['ismobile'])? 0 : 1;
		$sname = isset($attr['sname'])? trim($attr['sname']) : '';	
		$surl = isset($attr['surl'])? trim($attr['surl']) : '';	
		$delimiter = isset($attr['delimiter'])? trim($attr['delimiter']) : '';

		$str =<<<str
<?php
		\$_sname = "$sname";
		\$_typeid =$typeid;
		//debug关闭后,typeid值不变
		//没有下面这步，非debug下，会写死了
		if(\$_typeid == -1) \$_typeid = I('cid', 0, 'intval');

		if (\$_typeid == 0 &&  \$_sname == '') {
			\$_sname = isset(\$title) ? \$title : '';
		}
		echo getareaPosition(\$_typeid, \$_sname, "$surl", $ismobile, "$delimiter");

?>
str;

		return $str;
	}


	public function _prev($attr, $content) {
		$attr = !empty($attr)? $this->parseXmlAttr($attr, 'prev') : null;
		$titlelen = empty($attr['titlelen']) ? 0 : intval($attr['titlelen']);
		$str =<<<str
<?php

	if(empty(\$content['id']) || empty(\$content['cid']) || empty(\$cate['tablename']) ) {
		echo '无记录';
	} else {
		//上一条记录
        \$_vo=D(ucfirst(\$cate['tablename'].'View'))->where(array(\$cate['tablename'].'.status' => 0, 'id' => array('lt',\$content['id'])))->order('id desc')->find();

        if (\$_vo) {

			\$_jumpflag = (\$_vo['flag'] & B_JUMP) == B_JUMP? true : false;
        	\$_vo['url'] = getContentUrl(\$_vo['id'], \$_vo['cid'], \$_vo['ename'], \$_jumpflag, \$_vo['jumpurl']);
			if($titlelen) \$_vo['title'] = str2sub(\$_vo['title'], $titlelen, 0);	
			echo '<a href="'. \$_vo['url'] .'">'. \$_vo['title'] .'</a>';
        } else {
        	echo '第一篇';
        }
	}

?>
str;

		return $str;
	}

	public function _next($attr, $content) {
		$attr = !empty($attr)? $this->parseXmlAttr($attr, 'next') : null;
		$titlelen = empty($attr['titlelen']) ? 0 : intval($attr['titlelen']);
		$str =<<<str
<?php
	if(empty(\$content['id']) || empty(\$content['cid']) || empty(\$cate['tablename']) ) {
		echo '无记录';
	} else {
		//下一条记录
        \$_vo=D(ucfirst(\$cate['tablename'].'View'))->where(array(\$cate['tablename'].'.status' => 0,'id' => array('gt',\$content['id'])))->order('id ASC')->find();

        if (\$_vo) {	

			\$_jumpflag = (\$_vo['flag'] & B_JUMP) == B_JUMP? true : false;
        	\$_vo['url'] = getContentUrl(\$_vo['id'], \$_vo['cid'], \$_vo['ename'], \$_jumpflag, \$_vo['jumpurl']);				
			if($titlelen) \$_vo['title'] = str2sub(\$_vo['title'], $titlelen, 0);	
			echo '<a href="'. \$_vo['url'] .'">'. \$_vo['title'] .'</a>';
        } else {
        	echo '最后一篇';
        }
	}

?>
str;

		return $str;
	}
		public function _areaprev($attr, $content) {
		$attr = !empty($attr)? $this->parseXmlAttr($attr, 'areaprev') : null;
		$titlelen = empty($attr['titlelen']) ? 0 : intval($attr['titlelen']);
		$str =<<<str
<?php

	if(empty(\$content['id']) || empty(\$content['cid']) || empty(\$cate['tablename']) ) {
		echo '无记录';
	} else {
		//上一条记录
        \$_vo=D(ucfirst(\$cate['tablename'].'View'))->where(array(\$cate['tablename'].'.status' => 0, 'id' => array('lt',\$content['id'])))->order('id desc')->find();

        if (\$_vo) {

			\$_jumpflag = (\$_vo['flag'] & B_JUMP) == B_JUMP? true : false;
        	\$_vo['url'] = getContentareaUrl(\$_vo['id'], \$_vo['cid'], \$_vo['ename'], \$_jumpflag, \$_vo['jumpurl']);
			if($titlelen) \$_vo['title'] = str2sub(\$_vo['title'], $titlelen, 0);	
			echo '<a href="'. \$_vo['url'] .'">'.session('areasname'). \$_vo['title'] .'</a>';
        } else {
        	echo '第一篇';
        }
	}

?>
str;

		return $str;
	}

	public function _areanext($attr, $content) {
		$attr = !empty($attr)? $this->parseXmlAttr($attr, 'areanext') : null;
		$titlelen = empty($attr['titlelen']) ? 0 : intval($attr['titlelen']);
		$str =<<<str
<?php
	if(empty(\$content['id']) || empty(\$content['cid']) || empty(\$cate['tablename']) ) {
		echo '无记录';
	} else {
		//下一条记录
        \$_vo=D(ucfirst(\$cate['tablename'].'View'))->where(array(\$cate['tablename'].'.status' => 0,'id' => array('gt',\$content['id'])))->order('id ASC')->find();

        if (\$_vo) {	

			\$_jumpflag = (\$_vo['flag'] & B_JUMP) == B_JUMP? true : false;
        	\$_vo['url'] = getContentareaUrl(\$_vo['id'], \$_vo['cid'], \$_vo['ename'], \$_jumpflag, \$_vo['jumpurl']);				
			if($titlelen) \$_vo['title'] = str2sub(\$_vo['title'], $titlelen, 0);	
			echo '<a href="'. \$_vo['url'] .'">'.session('areasname'). \$_vo['title'] .'</a>';
        } else {
        	echo '最后一篇';
        }
	}

?>
str;

		return $str;
	}

	//针对内容页
	public function _click($attr, $content) {

		$str =<<<str
<?php

	if (!empty(\$id) && !empty(\$tablename)) {


		//开启静态缓存
		if (C('HTML_CACHE_ON') == true) {
			echo '<script type="text/javascript" src="'.U(GROUP_NAME. '/Public/click', array('id' => \$id, 'tn' => \$tablename)).'"></script>';
		}
		else {
			echo getClick(\$id, \$tablename);
		}
		
		
	}

?>
str;
		return $str;
	}

	public function _cfg_webname($attr, $content) {return str_replace('[dq]', session('areasname'), C('cfg_webname'));}//网站名称
	public function _cfg_weburl($attr, $content) {return C('cfg_weburl');}//网站主页
	public function _cfg_webtitle($attr, $content) {return str_replace('[dq]', session('areasname'), C('cfg_webtitle'));}//网站标题
	public function _cfg_themestyle($attr, $content) {return C('cfg_themestyle');}//模板默认风格
	public function _cfg_keywords($attr, $content) {return str_replace('[dq]', session('areasname'), C('cfg_keywords'));}//站点关键词
	public function _cfg_description($attr, $content) {return str_replace('[dq]', session('areasname'), C('cfg_description'));}//站点描述
	public function _cfg_email($attr, $content) {return C('cfg_email');}//客服邮箱
	public function _cfg_powerby($attr, $content) {return C('cfg_powerby');}//网站版权信息
	public function _siteurl($attr, $content) {
		return C('cfg_weburl');
	}

	public function _sitekeywords($attr, $content) {
		return str_replace('[dq]', session('areasname'), C('cfg_keywords'));
	}

	public function _sitedescription($attr, $content) {
		return str_replace('[dq]', session('areasname'), C('cfg_description'));
	}
	
	public function _searchurl($attr, $content) {
		return U('Search/index');
	}

	public function _gbookurl($attr, $content) {
		return U('Guestbook/index');
	}

	public function _gbookaddurl($attr, $content) {
		return U('Guestbook/add');
	}
	public function _vcodeurl($attr, $content) {
		return U('Public/verify', '');
	}

	public function _mobileauto($attr, $content) {
		$attr = !empty($attr)? $this->parseXmlAttr($attr, 'mobileauto') : null;
		$flag = empty($attr['flag']) ? 0 : intval($attr['flag']);

		$str =<<<str
<?php
		\$_flag = $flag;
		switch (\$_flag) {
			case 0:
				if (C('cfg_mobile_auto') == 1) {
					//开启静态缓存
					if (C('HTML_CACHE_ON') == true) {
						echo '<script type="text/javascript" src="__DATA__/static/js/mobile_auto.js"></script>';
					}
					else {
						goMobile();
					}
				}
				break;
			case 1:
				goMobile();
				break;
			case 2:
				if (C('cfg_mobile_auto') == 1) {
					echo '<script type="text/javascript" src="__DATA__/static/js/mobile_auto.js"></script>';					
				}
				break;
			
			default:
				break;
		}
	

?>
str;

		return $str;
	}


}


?>