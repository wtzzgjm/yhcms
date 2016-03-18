<?php
class ApiAction extends CommonAction{
	public function getlist(){
		header( 'Access-Control-Allow-Origin:*' );
		$this->type = I('type', 'product', 'trim');
		$this->fn = I('fn', 'getlist', 'trim');

		$this->titlelen = I('titlelen', 10, 'intval');
		$this->desclen = I('desclen', 20, 'intval');
		$this->page = I('page', 1, 'intval');
		$this->count = I('count', 10, 'intval');
		$this->flag = I('flag', '', 'trim');
		$this->cid = I('cid', 0, 'intval');

		$this->limit_start = ($this->page - 1) * $this->count;

		switch ($this->flag) {
			case 'img':
				$flag_value = 1;
				break;
			case 'top':
				$flag_value = 2;
				break;
			case 'rec':
				$flag_value = 4;
				break;
			case 'trec':
				$flag_value = 8;
				break;
			case 'ban':
				$flag_value = 16;
				break;
			case 'goto':
				$flag_value = 31;
				break;
			default:
				$flag_value = 0;
				break;
		}
		$this->flag_value = $flag_value;
		
		switch ($this->type) {
			case 'index':
				$this->getindex();
				break;
			case 'article':
				$this->getarticle();
				break;
			case 'product':
				$this->getproduct();
				break;
			case 'picture':
				$this->getpicture();
				break;
			case 'category':
				$this->getcategorylist();
				break;
			default:
				$this->geterror();
				break;
		}
		exit();
	}
	public function geterror(){
		$data['status'] = 'error';
		$data['message'] = '参数有误！';
		if($this->fn == 'nocallback') {
			echo json_encode($data);
		}else {
			echo $this->fn."(".json_encode($data).")";
		}
	}
	public function getarticle(){
		if ($this->flag_value) {
			$flag = $this->flag_value;
			$where['_string'] = C('DB_PREFIX')."article.flag & $flag = $flag";
		}
		if ($this->cid) {
			import('Class.Category', APP_PATH);
			$cate = getCategory();

			$idarr = Category::getChildsId($cate, $this->cid, 1);
			$where['cid'] = array('in', $idarr);
		}
		$where['status'] = 0;

		$list = M('article')->where($where)->limit($this->limit_start.','.$this->count)->order("publishtime desc")->select();
	
		$imgcount = 0;
		foreach ($list as $k => $v) {
			$jumpflag = ($v['flag'] & B_JUMP) == B_JUMP? true : false;
			$jg['id'] = $v['id'];
			$jg['url'] = $this->getContentUrl($v['id'], $v['cid'], $jumpflag, $v['jumpurl']);
			$jg['title'] = $v['title'];
			$jg['titles'] = str2sub($v['title'], $this->titlelen, 0);
			$jg['desc'] = $v['description'];
			$jg['descs'] = str2sub($v['description'], $this->desclen, 0);
			$icount = 0;
			if ($v['litpic']) {
				$imgcount = $imgcount + 1;
				$icount = 1;
			}
			$jg['img'] = $v['litpic'];
			$jg['imgcount'] = $icount;

			$c = M("category")->find($v['cid']);
			$jg['catid'] = $v['cid'];
			$jg['catname'] = $c['name'];
			$jg['catename'] = $c['ename'];
			/**/
			$jg['modelid'] = $c['modelid'];
			$jg['click'] = $v['click'];
			$jg['time'] = date('Y-m-d',$v['publishtime']);
			/**/
			$jglist[] = $jg;
		}

		$data['status'] = 'success';
		$data['message'] = '获取正常！';
		$data['data'] = $jglist;
		$data['imgcount'] = $imgcount;
		$data['count'] = count($jglist);

		if($this->fn == 'nocallback') {
			echo json_encode($data);
		}else {
			echo $this->fn."(".json_encode($data).")";
		}
	}
	public function getproduct(){
		if ($this->flag_value) {
			$flag = $this->flag_value;
			$where['_string'] = C('DB_PREFIX')."product.flag & $flag = $flag";
		}
		if ($this->cid) {
			import('Class.Category', APP_PATH);
			$cate = getCategory();

			$idarr = Category::getChildsId($cate, $this->cid, 1);
			$where['cid'] = array('in', $idarr);
		}
		$where['status'] = 0;

		$list = M('product')->where($where)->limit($this->limit_start.','.$this->count)->order("publishtime desc")->select();
		$imgcount = 0;
		foreach ($list as $k => $v) {
			$jumpflag = ($v['flag'] & B_JUMP) == B_JUMP? true : false;
			$jg['id'] = $v['id'];
			$jg['url'] = $this->getContentUrl($v['id'], $v['cid'], $jumpflag, $v['jumpurl']);
			$jg['title'] = $v['title'];
			$jg['titles'] = str2sub($v['title'], $this->titlelen, 0);
			$jg['desc'] = $v['description'];
			$jg['descs'] = str2sub($v['description'], $this->desclen, 0);
			$icount = 0;
			$ppp = "";
			if ($v['pictureurls']) {
				$pstr = str_replace("$$$$$$", "", $v['pictureurls']);
				$plist = explode('|||', $pstr);
				foreach ($plist as $k1 => $v1) {
					if ($v1) {
						$imgcount = $imgcount + 1;
						$icount = $icount + 1;
						$ppp = $ppp? $ppp .'%*%'.$v1 : $v1;
					}
				}
			}
			$jg['img'] = $ppp;
			$jg['imgcount'] = $icount;

			$c = M("category")->find($v['cid']);
			$jg['catid'] = $v['cid'];
			$jg['catname'] = $c['name'];
			$jg['catename'] = $c['ename'];
			/**/
			$jg['modelid'] = $c['modelid'];
			$jg['click'] = $v['click'];
			$jg['time'] = date('Y-m-d',$v['publishtime']);
			/**/
			$jglist[] = $jg;
		}

		$data['status'] = 'success';
		$data['message'] = '获取正常！';
		$data['data'] = $jglist;
		$data['imgcount'] = $imgcount;
		$data['count'] = count($jglist);
		
		if($this->fn == 'nocallback') {
			echo json_encode($data);
		}else {
			echo $this->fn."(".json_encode($data).")";
		}
	}
	public function getpicture(){
		if ($this->flag_value) {
			$flag = $this->flag_value;
			$where['_string'] = C('DB_PREFIX')."picture.flag & $flag = $flag";
		}
		if ($this->cid) {
			import('Class.Category', APP_PATH);
			$cate = getCategory();

			$idarr = Category::getChildsId($cate, $this->cid, 1);
			$where['cid'] = array('in', $idarr);
		}
		$where['status'] = 0;

		$list = M('picture')->where($where)->limit($this->limit_start.','.$this->count)->order("publishtime desc")->select();
		$imgcount = 0;
		foreach ($list as $k => $v) {
			$jumpflag = ($v['flag'] & B_JUMP) == B_JUMP? true : false;
			$jg['id'] = $v['id'];
			$jg['url'] = $this->getContentUrl($v['id'], $v['cid'], $jumpflag, $v['jumpurl']);
			$jg['title'] = $v['title'];
			$jg['titles'] = str2sub($v['title'], $this->titlelen, 0);
			$jg['desc'] = $v['description'];
			$jg['descs'] = str2sub($v['description'], $this->desclen, 0);
			$icount = 0;
			$ppp = "";
			if ($v['pictureurls']) {
				$pstr = str_replace("$$$$$$", "", $v['pictureurls']);
				$plist = explode('|||', $pstr);
				foreach ($plist as $k1 => $v1) {
					if ($v1) {
						$imgcount = $imgcount + 1;
						$icount = $icount + 1;
						$ppp = $ppp? $ppp .'%*%'.$v1 : $v1;
					}
				}
			}
			$jg['img'] = $ppp;
			$jg['imgcount'] = $icount;

			$c = M("category")->find($v['cid']);
			$jg['catid'] = $v['cid'];
			$jg['catname'] = $c['name'];
			$jg['catename'] = $c['ename'];
			/**/
			$jg['modelid'] = $c['modelid'];
			$jg['click'] = $v['click'];
			$jg['time'] = date('Y-m-d',$v['publishtime']);
			/**/
			$jglist[] = $jg;
		}

		$data['status'] = 'success';
		$data['message'] = '获取正常！';
		$data['data'] = $jglist;
		$data['imgcount'] = $imgcount;
		$data['count'] = count($jglist);
		
		if($this->fn == 'nocallback') {
			echo json_encode($data);
		}else {
			echo $this->fn."(".json_encode($data).")";
		}

	}
	public function getindex(){
		if ($this->flag_value) {
			$flag = $this->flag_value;
			$where1['_string'] = C('DB_PREFIX')."product.flag & $flag = $flag";
			$where2['_string'] = C('DB_PREFIX')."picture.flag & $flag = $flag";
			$where3['_string'] = C('DB_PREFIX')."article.flag & $flag = $flag";
		}

		$where1['status'] = 0;
		$where2['status'] = 0;
		$where3['status'] = 0;

		$list1 = M('product')->where($where1)->limit($this->limit_start.','.$this->count)->order("publishtime desc")->select();
		$list2 = M('picture')->where($where2)->limit($this->limit_start.','.$this->count)->order("publishtime desc")->select();
		$list3 = M('article')->where($where3)->limit($this->limit_start.','.$this->count)->order("publishtime desc")->select();

		foreach ($list1 as $k => $v) {
			$list4[] = array('a' => $v, 'b' => $v['publishtime']);
		}
		foreach ($list2 as $k => $v) {
			$list4[] = array('a' => $v, 'b' => $v['publishtime']);
		}
		foreach ($list3 as $k => $v) {
			$list4[] = array('a' => $v, 'b' => $v['publishtime']);
		}

		for($i = 1; $i < count($list4); $i++){
	        for($j = $i; $i < count($list4); $i++){
	        
	        	if ($list4[$i]['b'] < $list4[$j]['b']) {
	        		$zz = $list4[$i];
	        		$list4[$i] = $list4[$j];
	        		$list4[$j] = $zz;
	        	}
	    	}
	    }
	    $num = 0;
	    foreach ($list4 as $k => $v) {
	    	$num = $num + 1;
	    	if ($num <= $this->count) {
	    		$list[] = $v['a'];
	    	}
	    }

		$imgcount = 0;
		foreach ($list as $k => $v) {
			$jumpflag = ($v['flag'] & B_JUMP) == B_JUMP? true : false;
			$jg['id'] = $v['id'];
			$jg['url'] = $this->getContentUrl($v['id'], $v['cid'], $jumpflag, $v['jumpurl']);
			$jg['title'] = $v['title'];
			$jg['titles'] = str2sub($v['title'], $this->titlelen, 0);
			$jg['desc'] = $v['description'];
			$jg['descs'] = str2sub($v['description'], $this->desclen, 0);
			$icount = 0;
			$ppp = "";
			if ($v['pictureurls']) {
				$pstr = str_replace("$$$$$$", "", $v['pictureurls']);
				$plist = explode('|||', $pstr);
				foreach ($plist as $k1 => $v1) {
					if ($v1) {
						$imgcount = $imgcount + 1;
						$icount = $icount + 1;
						$ppp = $ppp? $ppp .'%*%'.$v1 : $v1;
					}
				}
			}else{
				$ppp = $v['litpic'];
				$imgcount = $imgcount + 1;
				$icount = 1;
			}
			$jg['img'] = $ppp;
			$jg['imgcount'] = $icount;
			
			$c = M("category")->find($v['cid']);
			$jg['catid'] = $v['cid'];
			$jg['catname'] = $c['name'];
			$jg['catename'] = $c['ename'];
			/**/
			$jg['time'] = date('Y-m-d',$v['publishtime']);
			$jg['modelid'] = $c['modelid'];
			$jg['click'] = $v['click'];
			/**/
			$jglist[] = $jg;
		}

		$data['status'] = 'success';
		$data['message'] = '获取正常！';
		$data['data'] = $jglist;
		$data['imgcount'] = $imgcount;
		$data['count'] = count($jglist);
		
		if($this->fn == 'nocallback') {
			echo json_encode($data);
		}else {
			echo $this->fn."(".json_encode($data).")";
		}

	}
	public function getcategorylist(){
		$where['pid'] = $this->cid;

		$cate = D('category')->where($where)->order('sort')->select();


		foreach ($cate as $k => $v) {
			$c1 = D('category')->where("pid = '".$v['id']."'")->order('sort')->select();
			foreach ($c1 as $k1 => $v1) {
				$c2 = D('category')->where("pid = '".$v1['id']."'")->order('sort')->select();
				foreach ($c2 as $k2 => $v2) {
					$c3 = D('category')->where("pid = '".$v2['id']."'")->order('sort')->select();
					foreach ($c3 as $k3 => $v3) {
						$son3[] = array('id' => $v3['id'], 'modelid'=> $v3['modelid'],'ename'=> $v3['ename'], 'name'=> $v3['name'], 'son'=>null);
					}
					$son2[] = array('id' => $v2['id'], 'modelid'=> $v2['modelid'],'ename'=> $v2['ename'],'name'=> $v2['name'],  'son'=>$son3);
				}

				$son1[] = array('id' => $v1['id'], 'modelid'=> $v1['modelid'],'ename'=> $v1['ename'],'name'=> $v1['name'],  'son'=>$son2);
			}
			$jg[] = array('id' => $v['id'], 'modelid'=> $v['modelid'],'ename'=> $v['ename'],'name'=> $v['name'], 'son'=>$son1);
		}
		$data['status'] = 'success';
		$data['message'] = '获取正常！';
		$data['data'] = $jg;
		

		if($this->fn == 'nocallback') {
			echo json_encode($data);
		}else {
			echo $this->fn."(".json_encode($data).")";
		}
	}


	public function getContentUrl($id, $cid, $jumpflag = false, $jumpurl = '') {
	    $url = '';
	    //如果是跳转，直接就返回跳转网址
	    if ($jumpflag && !empty($jumpurl)) {
	        return $jumpurl;
	    }

	    $url  = '/'.$cid.'/'.$id.".html";

	    return $url;
	}
	//根据分类以及ID获取对应标题内容以及图片
	public function getcon(){
		$this->type = I('type', 'product', 'trim');
		$this->fn = I('fn', 'getlist', 'trim');
		$this->id = I('id', 0, 'intval');
		

		switch ($this->type) {
			case 'article':
				$v = M('article')->find($this->id);
				break;
			case 'product':
				$v = M('product')->find($this->id);
				break;
			case 'picture':
				$v = M('picture')->find($this->id);
				break;
		}


		if ($v['pictureurls']) {
			$pstr = str_replace("$$$$$$", "", $v['pictureurls']);
			$plist = explode('|||', $pstr);
			foreach ($plist as $k1 => $v1) {
				if ($v1) {
					$imgcount = $imgcount + 1;
					$icount = $icount + 1;
						$ppp = $ppp? $ppp .'%*%'.$v1 : $v1;
					}
			}
		}else{
			$ppp = $v['litpic'];
		}
		$jg['id'] = $this->id;
		$jg['title'] = $v['title'];
		$jg['content'] = $v['content'];
		/**/
		$c = M("category")->find($v['cid']);
		$jg['click'] = $v['click'];
		$jg['time'] = date('Y-m-d',$v['publishtime']);
		$jg['modelid'] = $c['modelid'];
		$jg['catid'] = $v['cid'];
		/**/
		$jg['pic'] = $ppp;

		$data['status'] = 'success';
		$data['message'] = '获取正常！';
		$data['data'] = $jg;
		
		if($this->fn == 'nocallback') {
			echo json_encode($data);
		}else {
			echo $this->fn."(".json_encode($data).")";
		}
	}
	public function getkeywords(){
		$data['hxkey'] = C('cfg_site_hxkey');
		$data['cwkey'] = C('cfg_site_cwkey');


		$areatype = intval(C('cfg_site_area')) ? C('cfg_site_area') : 3;
		switch ($areatype) {
            case '1':
                $area = M('area')->where("is_top='1'")->order('sort')->select();
                break;
            case '2':
                $area = M('area')->where("is_top='0'")->order('sort')->select();
                break;
            case '3':
                $area = M('area')->order('sort')->select();
                break;
       	}
        //地区核心
        $areastr = "";
        if($area){
        	foreach ($area as $k => $v) {
            	$areastr = $areastr ? $areastr.",".$v['sname'] : $v['sname'];
        	}
        }
        
		$data['area'] = $areastr;

		echo json_encode($data);
	}
	public function checkuser(){
		$username = I('un','','trim');
		$password = I('up','','trim');
		$type = I('type','','trim');


		$user = M('admin')->where(array('username' => $username))->find();

		if (!$user || ($user['password'] != get_password($password, $user['encrypt'])) || $user['islock']) {
			$this->redirect('Manage/Login/index');
		}else{

			//更新数据库的参数
			$data = array('id' => $user['id'] ,//保存时会自动为此ID的更新
				'logintime' => time(),
				'loginip' => get_client_ip()
			);

			$logdata = array(
				'username' => $username,//保存时会自动为此ID的更新
				'log_time' => time(),
				'log_ip' => get_client_ip(),
				'log_type' => "客户端登陆",
				'log_url' => __URL__,
			);
			
			$jg = M('log')->add($logdata);

			//更新数据库
			M('admin')->save($data);

			//保存Session
			session('yang_adm_uid', $user['id']);
			session('yang_adm_username', $user['username']);
			session('yang_adm_logintime', date('Y-m-d H:i:s', $user['logintime']));
			session('yang_adm_loginip', $user['loginip']);

			//超级管理员
			if (9 == $user['usertype']) {
				session('yang_adm_superadmin',true);
			}

			import('ORG.Util.RBAC');
			RBAC::saveAccessList();//静态方法，读取权限放到session

			if ($type == "index") {
				$this->redirect('Manage/Index/index');
				exit();
			}
			if ($type == "order") {
				$this->redirect('Manage/Order/show');
				exit();
			}
			echo "请求参数错误！";
		}
	}
	//返回最近更新文章/产品/询盘相关参数
	public function checkstart(){
		//文章信息
		$article_time = M("article")->order("updatetime desc")->limit("0,1")->getField("updatetime");
		$data['article_time'] = date('Y-m-d', $article_time);
		//产品信息
		$product_time = M("product")->order("updatetime desc")->limit("0,1")->getField("updatetime");
		$data['product_time'] = date('Y-m-d', $product_time);
		//询盘信息
		$order_num = M("ordering")->where("is_look = '0'")->count();
		$data['order_num'] = $order_num ;
		echo json_encode($data);
	}
}
?>