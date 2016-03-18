<?php
class ShowAction extends CommonAction{
	public function index(){
		$id = I('id');
		$cid = I('cid', 0,'intval');
		$ename = I('e', '', 'htmlspecialchars,trim');

		if (is_numeric($ename)) {
			$cid = (int)$ename;
		}
		
		if(!$cid){
			$cid = M('Product')->where("id=$id OR etitle='$id'")->getField('cid');
		}

		$cate = getCategory(1);
		import('Class.Category', APP_PATH);	
		
		if (!empty($ename) && !is_numeric($ename)) {//ename不为空
			$self = Category::getSelfByEName($cate, $ename);//当前栏目信息
		}else {//$cid来判断
			$self = Category::getSelf($cate, $cid);//当前栏目信息
		}

		if(empty($self)) {
			$this->error('栏目不存在');
		}

		if (empty($id)) {
			$this->error('参数错误');
		}else{
			if (!is_numeric($id)) {
				$id = M($self['tablename'])->where("etitle='$id'")->getField("id");
			}
		}

		$cid = $self['id'];//当使用ename获取的时候，就要重新给$cid赋值，不然0
		$_GET['cid'] = $cid;//栏目ID
		$self['url'] = getUrl($self);
				
		$patterns = array('/^Show_/', '/.html$/');
		$replacements = array('', '');
		$template_show = preg_replace($patterns, $replacements, $self['template_show']);
		if (empty($template_show)) {
			$this->error('模板不存在');
		}

		if($self['tablename'] == 'picture') {
			$content = M($self['tablename'])->where(array('status' => 0, 'id' => $id))->find();
		}else {
			$content = M($self['tablename'])->where(array('status' => 0, array('id' => $id, 'etitle' => $id, '_logic' => 'OR')))->find();
		}
		if (empty($content)) {
			$this->error('内容不存在');
		}

		//获取顶级栏目信息
		$getPCate = $this->getPCate($self['id']);
		$getPCate['url'] = getUrl($getPCate);

		$this->pcate = $getPCate;

		//当前url
		$_jumpflag = ($content['flag'] & B_JUMP) == B_JUMP? true : false;
		$content['url'] = getContentUrl($content['id'], $content['cid'], $self['ename'], $_jumpflag, $content['jumpurl']);
		$content['myurl'] = 'http://'.$_SERVER['HTTP_HOST'].$content['url'];
		switch ($self['tablename']) {
			case 'picture':
				//把序列化过的数组恢复
				$pictureurls_arr = empty($content['pictureurls']) ? array() : explode('|||', $content['pictureurls']);
				
				$pictureurls  = array();
					foreach ($pictureurls_arr as $v) {
						$temp_arr = explode('$$$', $v);
						if (!empty($temp_arr[0])) {
							$pictureurls[] = array(
								'url' => $temp_arr[0],
								'alt' => $temp_arr[1]
							);
						}				
					}
				$content['pictureurls'] = $pictureurls;
				//p($pictureurls);
				break;
			case 'product':
				//把序列化过的数组恢复
				$pictureurls_arr = empty($content['pictureurls']) ? array() : explode('|||', $content['pictureurls']);
				
				$pictureurls  = array();
				foreach ($pictureurls_arr as $v) {
					$temp_arr = explode('$$$', $v);
					if (!empty($temp_arr[0])) {
						$pictureurls[] = array(
							'url' => $temp_arr[0],
							'alt' => $temp_arr[1]
						);
					}				
				}
				$content['pictureurls'] = $pictureurls;
				//p($pictureurls);
				break;	
			default:
				break;
		}

		$this->cate = $self;

		//TAG处理
		$tagarr = explode(',', $content['tag']);
		$tagstr = "";
		foreach ($tagarr as $k => $v) {
			if($tagstr) $tagstr .= "&nbsp;,&nbsp;";
			$tagstr .= "<a href='__ROOT__/tag/$v.html' >$v</a>";
		}

		$content['tag'] = $tagstr;

		//长尾关键词_start
		$cwkey = I('cwkey', '', 'htmlspecialchars,trim');
		$cwkeyvalue = '';
		if ($cwkey) {
			$cwlist = explode(',', C('cfg_site_cwkey'));
			$cwkeyvalue = $cwlist[$cwkey];
		}
		$this->cwkey = $cwkey;
		//长尾关键词_end

		$this->title = $content['title'].$cwkeyvalue;
		$this->keywords = empty($content['keywords']) ? str_replace('[dq]', session('areasname'), C('cfg_webtitle')) : str_replace('[dq]', session('areasname'), $content['keywords']);
		$this->description = empty($content['description'])? $content['title']: $content['description'];
		$this->commentflag = $content['commentflag'];//是否允许评论,debug,以后加上个全局评价 $content['commentflag'] && CFG_Comment

		$content['content'] = $this->upsitelink($content['content']);
		$this->content = $content;

		$this->tablename = $self['tablename'];
		$this->url = "Show/index/cid/$cid/id/$id.html";
		$this->id = $id;

		//写入订购链接
		$order['url'] = '/Order/'.$id;
		$this->order = $order;

		//$this->display($template_show);
		$this->display('.'.C('TMPL_PATH').C('DEFAULT_THEME').'/'.MODULE_NAME.'_'.$template_show.'.html');		
	}

	public function clicknum(){
		$id = I('id', 0, 'intval');
		$tablename = I('tablename', '');
		if (empty($id) || empty($cid)) {
			exit();
		}

		import('Class.Category', APP_PATH);
		$self = Category::getSelf(getCategory(1), $cid);//当前栏目信息
		
		if(empty($self)) {
			exit();
		}
		$num = M($self['tablename'])->where(array('id' => $id))->getField('click');
		M($self['tablename'])->where(array('id' => $id))->setInc('click');
		echo $num;
	}

	public function article($id = 0){
		$id = I('id', 0, 'intval');
		if ($id == 0) {
			$this->error('参数错误');
		}

		$content = M('article')->where(array('status' => 0, 'id' => $id))->find();
		$cid = $content['cid'];

		$cate = getCategory(1);
		import('Class.Category', APP_PATH);
		$self = Category::getSelf($cate, $cid);//当前栏目信息
		
		$this->cate = $self;
		if(empty($self)) {
			$this->error('栏目不存在');
		}

		$patterns = array('/^Show_/', '/.html$/');
		$replacements = array('', '');
		$template_show = preg_replace($patterns, $replacements, $self['template_show']);
		if (empty($template_show)) {
			$this->error('模板不存在');
		}
		$this->title = $content['title'];
		$this->keywords = $content['keywords'];
		$this->description = $content['description'];
		$this->commentflag = $content['commentflag'];//是否允许评论,debug,以后加上个全局评价 $content['commentflag'] && CFG_Comment
		$this->content = $content;
		$this->id = $id;

		$this->display($template_show);
	}

	//产品列表
	public function product(){
		$id = I('id', 0, 'intval');
		if ($id == 0) {
			$this->error('参数错误');
		}

		$content = M('product')->where(array('status' => 0, 'id' => $id))->find();
		$cid = $content['cid'];

		$cate = getCategory(1);
		import('Class.Category', APP_PATH);
		$self = Category::getSelf($cate, $cid);//当前栏目信息
		
		$this->cate = $self;


		if(empty($self)) {
			$this->error('栏目不存在');
		}
		$patterns = array('/^Show_/', '/.html$/');
		$replacements = array('', '');
		$template_show = preg_replace($patterns, $replacements, $self['template_show']);
		if (empty($template_show)) {
			$this->error('模板不存在');
		}

		//把序列化过的数组恢复
		$pictureurls_arr = empty($content['pictureurls']) ? null : explode('|||', $content['pictureurls']);
		
		$pictureurls  = array();
		foreach ($pictureurls_arr as $v) {
			$temp_arr = explode('$$$', $v);
			if (!empty($temp_arr[0])) {
				$pictureurls[] = array(
					'url' => $temp_arr[0],
					'alt' => $temp_arr[1]
				);
			}				
		}

		$content['pictureurls'] = $pictureurls;

		$this->title = $content['title'];
		$this->keywords = $content['keywords'];
		$this->description = $content['description'];
		$this->commentflag = $content['commentflag'];//是否允许评论,debug,以后加上个全局评价 $content['commentflag'] && CFG_Comment
		$this->content = $content;
		$this->id = $id;
		$this->display($template_show);
	}
	//图集列表
	public function picture(){
		$id = I('id', 0, 'intval');
		if ($id == 0) {
			$this->error('参数错误');
		}

		$content = M('picture')->where(array('status' => 0, 'id' => $id))->find();
		$cid = $content['cid'];

		$cate = getCategory(1);
		import('Class.Category', APP_PATH);
		$self = Category::getSelf($cate, $cid);//当前栏目信息
		
		$this->cate = $self;
		if(empty($self)) {
			$this->error('栏目不存在');
		}
		$patterns = array('/^Show_/', '/.html$/');
		$replacements = array('', '');
		$template_show = preg_replace($patterns, $replacements, $self['template_show']);
		if (empty($template_show)) {
			$this->error('模板不存在');
		}

		//把序列化过的数组恢复
		$pictureurls_arr = empty($content['pictureurls']) ? null : explode('|||', $content['pictureurls']);
		
		$pictureurls  = array();
			foreach ($pictureurls_arr as $v) {
				$temp_arr = explode('$$$', $v);
				if (!empty($temp_arr[0])) {
					$pictureurls[] = array(
						'url' => $temp_arr[0],
						'alt' => $temp_arr[1]
					);
				}				
			}
		$content['pictureurls'] = $pictureurls;

		$this->title = $content['title'];
		$this->keywords = $content['keywords'];
		$this->description = $content['description'];
		$this->commentflag = $content['commentflag'];//是否允许评论,debug,以后加上个全局评价 $content['commentflag'] && CFG_Comment

		$this->content = $content;
		$this->id = $id;

		$this->display($template_show);
	}
	
	public function phrase(){
		$id = I('id', 0, 'intval');
		if ($id == 0) {
			$this->error('参数错误');
		}

		$content = M('phrase')->where(array('status' => 0, 'id' => $id))->find();
		$cid = $content['cid'];

		$cate = getCategory(1);
		import('Class.Category', APP_PATH);
		$self = Category::getSelf($cate, $cid);//当前栏目信息
		
		$this->cate = $self;
		if(empty($self)) {
			$this->error('栏目不存在');
		}

		$patterns = array('/^Show_/', '/.html$/');
		$replacements = array('', '');
		$template_show = preg_replace($patterns, $replacements, $self['template_show']);
		if (empty($template_show)) {
			$this->error('模板不存在');
		}
		$this->title = $content['title'];
		$this->keywords = $content['keywords'];
		$this->commentflag = $content['commentflag'];//是否允许评论,debug,以后加上个全局评价 $content['commentflag'] && CFG_Comment

		$this->content = $content;
		$this->id = $id;

		$this->display($template_show);
	}

	public function order() {
		$protitle = M('product')->where("id='".$_GET['id']."'")->getField('title');
		$this->proname = $protitle;
		$this->title = $protitle."-产品订购";
		if(IS_POST) {
			$data = I('post.');
			$verify = I('vcode','','md5');
			if ($_SESSION['verify'] != $verify) {
				$this->error('验证码不正确');
			}
			if (empty($data['num'])) {
				$this->error('请填写订购数量');
			}
			if (empty($data['name'])) {
				$this->error('联系人姓名不能为空');
			}
			/*if (empty($data['adds'])) {
				$this->error('联系人地址不能为空');
			}*/
			if (empty($data['tel'])) {
				$this->error('联系人电话不能为空');
			}
			
			$data['time'] = time();
			$data['p_name'] = $protitle;
			$data['p_id'] = $_GET['id'];
			$jg = M('ordering')->add($data);

			if(C('is_sms_') == 2) {
				$title = $protitle;
				$name = '姓名:'.$data['name']."\r\n";
				$tel = '电话: '.$data['tel']."\r\n";
				if($data['adds']) {
					$adds = '地址: '.$data['adds']."\r\n";
				}
				if($data['email']) {
					$email = 'E-mail: '.$data['email']."\r\n";
				}
				if($data['qq']) {
					$qq = 'QQ: '.$data['qq']."\r\n";
				}
				if($data['content']) {
					$con = '备注: '.$data['content']."\r\n";
				}
				$num = '订购数量: '.$data['num']."\r\n";

				$content = $name.$tel.$adds.$email.$qq."\r\n".'订购产品名:'.$title."\r\n".$num."\r\n".$con;
				$jg2 = set_mail(C('order_email_acc'),C('order_email_psw'),C('order_email_smtp'),C('order_email_adds'),$title,$content);
				if($jg&&$jg2) {
					$db['is_email'] = 1;
					M('ordering')->where("id='".$jg."'")->save($db);
					$this->success('订单提交成功');
				}else{
					if(!$jg2) {
						$this->error('邮件发送失败');
					}else {
						$this->error('订单提交失败');
					}
				}
				exit();
			}

			if($jg) {
				$this->success('订单提交成功');
			}else {
				$this->error('订单提交失败');
			}
			exit();
		}
		$this->display('.'.C('TMPL_PATH').C('DEFAULT_THEME').'/'.MODULE_NAME.'_'.ACTION_NAME.'.html');
	}

	public function getPCate($cid) {
		$cateinfo = M('Category')->where("id = '$cid'")->find();
		if($cateinfo['pid'] != 0) {
			$cateinfo = $this->getPCate($cateinfo['pid']);
		}
		return $cateinfo;
	}
}

?>