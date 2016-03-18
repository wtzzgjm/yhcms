<?php

class ProductAction extends CommonContentAction {
	
	public function index() {
		
		$pid = I('pid', 0, 'intval');//类别ID
		$keyword = I('sesskey') == '1' ? session('keyword') : I('key', '', 'htmlspecialchars,trim');//关键字
		$flag = I("flag");//类型

		//所有子栏目列表
		import('Class.Category', APP_PATH);
		$cate = getCategory();//全部分类
		//$this->subcate = Category::getChilds($cate, $pid);
		$subcate = M('Category')->where("pid = '$pid'")->select();
		foreach ($subcate as $k => $v) {
			$modelname = "";
			switch ($v['modelid']) {
				case '1':
					$modelname = "Article";
					break;
				case '2':
					$modelname = "Page";
					break;
				case '3':
					$modelname = "Product";
					break;
				case '4':
					$modelname = "Picture";
					break;
			}
			$subcate[$k]['modelname'] = $modelname;
		}
		$this->subcate = $subcate;
		$this->poscate = Category::getParents($cate, $pid);

		if ($pid) {			
			$idarr = Category::getChildsId($cate, $pid, 1);//所有子类ID
			$where = array('product.status' => 0, 'cid' => array('in', $idarr));
		}else {
			$where = array('product.status' => 0);
		}
		
		if (!empty($keyword)) {
			$where['product.title'] = array('LIKE', "%{$keyword}%");
		}
		if ($flag > 0) {
			$where['_string'] = "product.flag & $flag = $flag";
		}

		//分页
		import('Class.Page', APP_PATH);
		$count = D('ProductView')->where($where)->count();

		$pagerows = I('pagerows', 0, 'intval') ? I('pagerows', 0, 'intval') : 10;
		$page = new Page($count, $pagerows);
		$limit = $page->firstRow. ',' .$page->listRows;
		$art = D('ProductView')->where($where)->order('product.id DESC')->limit($limit)->select();
		$this->pagerows = $pagerows;
		$this->flag = $flag;
		$this->pid = $pid;
		$this->keyword = $keyword;
		$this->page = $page->show();
		$this->vlist = $art;
		$this->type = '产品列表';
		$this->flagtypelist = getArrayOfItem('flagtype');//文档属性
		/*if(IS_POST) {
			if($flag>0) {
				$data = array('title'=>array('like','%'.I('key').'%'),'flag'=>$flag,'status'=>'0');
			}else {
				$data = array('title'=>array('like','%'.I('key').'%'),'status'=>'0');
			}
			$searchjg = M('product')->where($data)->select();
			if($searchjg) {
				$this->vlist = $searchjg;
				$this->page = '';
				$this->is_showpage = 1;
			}
		}*/
		if ($keyword) {
			session("keyword", $keyword);
			$urldata['sesskey'] = "1";
		}
		$urldata['pid'] = $pid;
		$urldata['flag'] = $flag;
		$this->p = I('p', 0, 'intval');
		session('urldata', $urldata);
		$this->display();
	}
	//添加产品
	public function add() {
		//当前控制器名称		
		$actionName = strtolower($this->getActionName());
		$this->pid = I('pid', 0, 'intval');

		if (IS_POST) {
			$this->addHandle();
			exit();
		}

		$cate = getCategory(2);
		import('Class.Category', APP_PATH);
		$cate = Category::unlimitedForLevel($cate);
		$cate = Category::getLevelOfModel($cate, $actionName);
		foreach ($cate as $k => $v) {
			$isdown = 0;
			if (M('Category')->where("pid='".$v['id']."'")->find()) {
				$isdown = 1;
			}
			$cate[$k]['isdown'] = $isdown;
		}
		$this->cate = $cate;
		$this->flagtypelist = getArrayOfItem('flagtype');//文档属性

		$cinfo = $this->getTopCate(I('pid'));
		$this->other = $cinfo['other'];
		$this->display();
	}
	//批量添加产品
	public function batchadd() {	
		$this->cid = I('cid', 0, 'intval');
		$actionName = strtolower($this->getActionName());
		if (IS_POST) {
			$url = I('url', array(), 'htmlspecialchars,rtrim');
			$sort = I('sort', array(), 'intval');
			$title = I('title', array(), 'htmlspecialchars,rtrim');
			$description = I('description', array(), 'htmlspecialchars,rtrim');
			$zj = 0 ;
			foreach ($url as $k => $v) {
				$pictureurls = $v.'$$$'.'$$$';//array('url'=> $v ,'alt'=> '');
				$imgtbSize = explode(',', C('cfg_imgthumb_size'));//配置缩略图第一个参数
                $imgTSize = explode('X', $imgtbSize[0]);
				if (!empty($imgTSize)) {
					$pic = get_picture($v, $imgTSize[0], $imgTSize[1]);
				}else {
					$pic = $v;
				}

				session('topCate', $this->cid);
				
				$data =array(
					'title' => $title[$k],
					'cid'	=> $this->cid,
					'litpic'	=> $pic,
					'description' => $description[$k],
					'content' => $description[$k],
					'pictureurls' => $pictureurls,
					'publishtime' => time(),
					'updatetime' => time(),
					'click' => rand(10,95),
					'status' => 0,
					'sort' => 0,
					'flag' => $pictureurls ? 1 : 0,
					'aid'	=> $_SESSION[C('USER_AUTH_KEY')]
				);
				$addid = M('product')->add($data);
				if($addid){$zj ++ ;}
			}

			$this->msg = "<br><font style='color:red;'><b>提示：成功添加 [ $zj ] 条产品记录</b></font>";
		}

		$cate = getCategory(2);
		import('Class.Category', APP_PATH);
		$cate = Category::unlimitedForLevel($cate);
		$cate = Category::getLevelOfModel($cate, $actionName);

		foreach ($cate as $k => $v) {
			$isdown = 0;
			if (M('Category')->where("pid='".$v['id']."'")->find()) {
				$isdown = 1;
			}
			$cate[$k]['isdown'] = $isdown;
		}
		$this->cate = $cate;
		$this->flagtypelist = getArrayOfItem('flagtype');//文档属性
		$this->display();
	}
	//
	public function addHandle() {
		$pid = I('pid', 0, 'intval');
		$cid = I('cid', 0, 'intval');
		$title = I('title', '', 'htmlspecialchars,rtrim');
		$etitle = I('etitle', '', '');
		$tag = I('tag', '', 'htmlspecialchars,rtrim');
		$flags = I('flags', array(),'intval');
		$jumpurl = I('jumpurl', '');
		$description = I('description', '', 'htmlspecialchars');
		$content = I('content', '', '');
		$pic = '';
		//存入p_id 存入session
		session('topCate', $cid);
		if (empty($title)) {
			$this->error('产品名称不能为空');
		}
		if (!$cid) {
			$this->error('请选择栏目');
		}
		$pid = $cid;//转到自己的栏目

		if (empty($etitle)) {
			//$etitle = get_pinyin(iconv('utf-8','gb2312//ignore',$title),0);
		}else {
			if (!ctype_alnum($etitle)) {
				$this->error('别名只能由字母和数字组成，不能包含特殊字符！');
			}else{
				if (ctype_digit($etitle)) {
					$this->error('别名不能由全数字组成！');
				}
			}

			if (M('product')->where("etitle='".$etitle."'")->find()) {
				$this->error('别名已存在，请重新输入！');
			}
		}
		

		if (empty($description)) {			
			$description = str2sub(strip_tags($content), 120);
		}

		//获取属于分类信息,得到modelid
		import('Class.Category', APP_PATH);			
		$selfCate = Category::getSelf(getCategory(0), $cid);//当前栏目信息
		$modelid = $selfCate['modelid'];

		$pictureurls_arr  = array();

		$imgPostUrls = I('pictureurls', '');
		if (is_array($imgPostUrls)) {
			foreach ($imgPostUrls as $k => $v) {
				$pictureurls_arr[] = $v.'$$$'.'$$$';//array('url'=> $v ,'alt'=> '');
				if ($k == 0) {
					$imgtbSize = explode(',', C('cfg_imgthumb_size'));//配置缩略图第一个参数
                	$imgTSize = explode('X', $imgtbSize[0]);
					if (!empty($imgTSize)) {
						$pic = get_picture($v, $imgTSize[0], $imgTSize[1]);
					}else {
						$pic = $v;
					}
				}
			}
		}
		$pictureurls = join('|||',$pictureurls_arr);
		$pic = isset($pic) ? $pic : '';

		//图片标志
		if (!empty($pic) && !in_array(B_PIC, $flags)) {
			$flags[] = B_PIC;
		}
		$flag = 0;
		foreach ($flags as $v) {
			$flag += $v;
		}

		$data =array(
			'title' => $title,
			'etitle' => $etitle,
			'tag' => $tag,
			'color' => I('color'),
			'cid'	=> $cid,
			'litpic'	=> $pic,
			'keywords' => I('keywords', '', 'htmlspecialchars,trim'),
			'description' => $description,
			'content' => $content,
			'pictureurls' => $pictureurls,
			'price' => I('price', 0, 'intval'),
			'trueprice' => I('trueprice', 0, 'intval'),
			'brand' => I('brand', ''),
			'units' => I('units', ''),
			'specification' => I('specification', ''),
			'publishtime' => time(),
			'updatetime' => time(),
			'click' => rand(10,95),
			'status' => 0,
			'sort' => 0,
			'commentflag' => I('commentflag', 0,'intval'),
			'flag'	=> $flag,
			'jumpurl' => $jumpurl,
			'aid'	=> $_SESSION[C('USER_AUTH_KEY')]

		);

		if($id = M('product')->add($data)) {
			//更新上传附件表
			//更新图片集
		
			if (!empty($imgPostUrls)) {
				$attid = M('attachment')->where(array('filepath' => array('in', $imgPostUrls)))->getField('id', true);
				$dataAtt = array();
				if ($attid) {
					foreach ($attid as $v) {
						$dataAtt[] = array('attid' => $v,'arcid' => $id, 'modelid' => $modelid);
					}
					M('attachmentindex')->addAll($dataAtt);
				}
				
			}

			//内容中的图片
			$img_arr = array();
			$reg = "/<img[^>]*src=\"((.+)\/(.+)\.(jpg|gif|bmp|png))\"/isU";
			preg_match_all($reg, $content, $img_arr, PREG_PATTERN_ORDER);
			// 匹配出来的不重复图片
			$img_arr = array_unique($img_arr[1]);
			if (!empty($img_arr)) {
				$attid = M('attachment')->where(array('filepath' => array('in', $img_arr)))->getField('id', true);
				$dataAtt = array();
				if ($attid) {
					foreach ($attid as $v) {
						$dataAtt[] = array('attid' => $v,'arcid' => $id, 'modelid' => $modelid);
					}
					M('attachmentindex')->addAll($dataAtt);
				}
				
			}

			
			//更新静态缓存
			delCacheHtml('List/index_'.$cid, false, 'list:index');	
			delCacheHtml('Index_index', false, 'index:index');
			$this->success('添加成功',U(GROUP_NAME. '/Product/index', array('pid' => $pid)));
		}else {
			$this->error('添加失败');
		}
	}
	//批量更改属性
	public function shux() {
		$idArr = I('key',0 , 'intval');
		$pid = I('get.pid', 0, 'intval');
		$flag = I('flagss', 0, 'intval');
		if (!is_array($idArr)) {
			$this->ajaxReturn(0, "请选择要删除的项！", 0);
		}
		if (false !== M('product')->where(array('id' => array('in', $idArr)))->setField('flag', $flag)) {
			//更新静态缓存
			foreach ($idArr as $v) {
				delCacheHtml('Show/index_*_'. $v.'.', false, 'show:index');	
			}
			$this->ajaxReturn(1, "批量更改类型成功！", 1);
		}else {
			$this->ajaxReturn(0, "批量更改类型失败！", 0);
		}

	}
	//更改单个属性
	public function status() {
		$id = I('id',0 , 'intval');
		$db = M('Product');
		$data = $db->where(array('id' => $id))->find();
		$data['flag'] = $data['flag'] < 4 ? 4 : 0;

		$db->save($data);

		$this->redirect(U('Product/index', session('urldata')));
		//echo "<script language=\"javascript\">location.href = '".session('go_url')."'</script>";
	}
	//编辑
	public function edit() {
		//当前控制器名称
		$id = I('id', 0, 'intval');
		$actionName = strtolower($this->getActionName());

		if (IS_POST) {
			$this->editHandle();
			exit();
		}
		
		$this->pid = I('pid', 0, 'intval');
		$cate = getCategory(2);
		import('Class.Category', APP_PATH);
		$cate = Category::unlimitedForLevel($cate);
		$cate = Category::getLevelOfModel($cate, $actionName);
		foreach ($cate as $k => $v) {
			$isdown = 0;
			if (M('Category')->where("pid='".$v['id']."'")->find()) {
				$isdown = 1;
			}
			$cate[$k]['isdown'] = $isdown;
		}
		$this->cate = $cate;
		
		$vo = M($actionName)->find($id);
		$pictureurls = array();
		if (!empty($vo['pictureurls'])) {	
			$temparr = explode('|||', $vo['pictureurls']);		
			foreach ($temparr as $key => $v) {
				$temparr2 = explode('$$$', $v);
				$pictureurls[] = array('url' => ''.$temparr2[0], 'alt' => ''.$temparr2[1]);
			}
		}
		
		$vo['pictureurls'] = $pictureurls;
		$vo['content'] = htmlspecialchars($vo['content']);
		$this->vo = $vo;
		$this->flagtypelist = getArrayOfItem('flagtype');//文档属性

		$cinfo = $this->getTopCate(I('pid'));
		$this->other = $cinfo['other'];
		$this->p = I('p', 0, 'intval');
		$this->display();
	}


	//修改文章处理
	public function editHandle() {

		$data =array(			
			'id'	=> I('id', 0 , 'intval'),
			'title' => I('title','','htmlspecialchars,rtrim'),
			'etitle' => I('etitle'),
			'tag' => I('tag','',''),
			'color' => I('color'),
			'cid'	=> I('cid', 0, 'intval'),
			'keywords' => I('keywords', '', 'htmlspecialchars,trim'),
			'description' =>  I('description', ''),
			'content' => I('content', '', ''),
			'price' => I('price', 0, 'intval'),
			'trueprice' => I('trueprice', 0, 'intval'),
			'brand' => I('brand', ''),
			'units' => I('units', ''),
			'specification' => I('specification', ''),
			'updatetime' => time(),
			'commentflag' => I('commentflag', 0,'intval'),
			'jumpurl' => I('jumpurl', ''),

		);

		

		$id = $data['id'] ;
		$pid = I('pid', 0, 'intval');
		$flags = I('flags', array(),'intval');
		$title = I('title', '', 'trim');

		if (empty($data['title'])) {
			$this->error('产品名称不能为空');
		}
		if (!$data['cid']) {
			$this->error('请选择栏目');
		}
		
		if (empty($data['etitle'])) {
			//$data['etitle'] = get_pinyin(iconv('utf-8','gb2312//ignore',$data['title']),0);
		}else {
			if (!ctype_alnum($data['etitle'])) {
				$this->error('别名只能由字母和数字组成，不能包含特殊字符！');
			}else{
				if (ctype_digit($etitle)) {
					$this->error('别名不能由全数字组成！');
				}
			}
			
			if (M('product')->where(array('etitle' => $data['etitle'], 'id' => array('neq' , $id)))->find()) {
				$this->error('别名已存在，请重新输入！');
			}
		}
	
		$pid = $data['cid'];//转到自己的栏目

		if (empty($data['description'])) {			
			$data['description'] = str2sub(strip_tags($data['content']), 120);
		}


		//获取属于分类信息,得到modelid
		import('Class.Category', APP_PATH);			
		$selfCate = Category::getSelf(getCategory(0), $data['cid']);//当前栏目信息
		$modelid = $selfCate['modelid'];


		$pictureurls_arr  = array();
		$imgPostUrls = I('pictureurls', '');
		if (is_array($imgPostUrls)) {
			foreach ($imgPostUrls as $k => $v) {
				$pictureurls_arr[] = $v.'$$$'.'$$$';//array('url'=> $v ,'alt'=> '');
				if ($k == 0) {
					$imgtbSize = explode(',', C('cfg_imgthumb_size'));//配置缩略图第一个参数
                	$imgTSize = explode('X', $imgtbSize[0]);
					if (!empty($imgTSize)) {
						$pic = get_picture($v, $imgTSize[0], $imgTSize[1]);
					}else {
						$pic = $v;
					}
				}
			}
		}
		$data['pictureurls'] = join('|||',$pictureurls_arr);	
		$data['litpic'] = isset($pic) ? $pic : '';

		//图片标志
		if (!empty($data['litpic']) && !in_array(B_PIC, $flags)) {
			$flags[] = B_PIC;
		}
		$data['flag'] = 0;
		foreach ($flags as $v) {
			$data['flag'] += $v;
		}

		if (false !== M('product')->save($data)) {

			//del
			M('attachmentindex')->where(array('arcid' => $id, 'modelid' => $modelid))->delete();
			//更新图片集		
			if (!empty($imgPostUrls)) {
				$attid = M('attachment')->where(array('filepath' => array('in', $imgPostUrls)))->getField('id', true);
				$dataAtt = array();
				if ($attid) {
					foreach ($attid as $v) {
						$dataAtt[] = array('attid' => $v,'arcid' => $id, 'modelid' => $modelid);
					}
					M('attachmentindex')->addAll($dataAtt);
				}
				
			}

			//内容中的图片
			$img_arr = array();
			$reg = "/<img[^>]*src=\"((.+)\/(.+)\.(jpg|gif|bmp|png))\"/isU";
			preg_match_all($reg, $data['content'], $img_arr, PREG_PATTERN_ORDER);
			// 匹配出来的不重复图片
			$img_arr = array_unique($img_arr[1]);
			if (!empty($img_arr)) {
				$attid = M('attachment')->where(array('filepath' => array('in', $img_arr)))->getField('id', true);
				$dataAtt = array();
				if ($attid) {
					foreach ($attid as $v) {
						$dataAtt[] = array('attid' => $v,'arcid' => $id, 'modelid' => $modelid);
					}
					M('attachmentindex')->addAll($dataAtt);
				}
				
			}

			//更新静态缓存
			delCacheHtml('List/index_'.$data['cid'].'_', false, 'list:index');
			delCacheHtml('List/index_'.$selfCate['ename'], false, 'list:index');//还有只有名称
			delCacheHtml('Show/index_*_'. $id, false, 'show:index');//不太精确，会删除其他模块同id文档	
			$p = I('p', 0, 'intval');
			$this->success('修改成功', U(GROUP_NAME. '/Product/index', array('pid' => $pid,'p' => $p)));
		}else {

			$this->error('修改失败');
		}
		
	}


	//回收站文章列表
	public function trach() {
		import('Class.Page', APP_PATH);
		$where = array('product.status' => 1);
		$count = D('ProductView')->where($where)->count();

		$pagerows = I('pagerows', 0, 'intval') ? I('pagerows', 0, 'intval') : 10;

		$page = new Page($count, $pagerows);
		$limit = $page->firstRow. ',' .$page->listRows;
		$art = D('ProductView')->where($where)->order('product.id DESC')->limit($limit)->select();

		$this->pid = I('pid', 0, 'intval');
		$this->page = $page->show();
		$this->pagerows = $pagerows;
		$this->vlist = $art;		
		$this->type = '产品回收站';
		$this->subcate = '';
		$this->display('index');
	}

	//删除产品到回收站
	public function del() {
		$id = I('id',0 , 'intval');
		$batchFlag = I('get.batchFlag', 0, 'intval');
		//批量删除
		if ($batchFlag) {
			$this->delBatch();
			return;
		}
		$pid = I('pid',0 , 'intval');//单纯的GET没问题

		if (false !== M('product')->where(array('id' => $id))->setField('status', 1)) {

			delCacheHtml('Show/index_*_'. $id.'.', false, 'show:index');	
			$this->ajaxReturn(1, "删除成功！", 1);
			
		}else {
			$this->ajaxReturn(0, "删除失败！", 0);
		}
	}

	//批量删除到回收站
	public function delBatch() {
		$idArr = I('key',0 , 'intval');
		$pid = I('get.pid', 0, 'intval');
		if (!is_array($idArr)) {
			$this->ajaxReturn(0, "请选择要删除的项！", 0);
		}
		if (false !== M('product')->where(array('id' => array('in', $idArr)))->setField('status', 1)) {
			//更新静态缓存
			foreach ($idArr as $v) {
				delCacheHtml('Show/index_*_'. $v.'.', false, 'show:index');	
			}
			$this->ajaxReturn(1, "批量删除成功！", 1);
		}else {
			$this->ajaxReturn(0, "批量删除失败！", 0);
		}
	}

	//还原产品
	public function restore() {
		$id = I('id',0 , 'intval');
		$batchFlag = I('get.batchFlag', 0, 'intval');
		//批量删除
		if ($batchFlag) {
			$this->restoreBatch();
			return;
		}
		
		$pid = I('get.pid', 0, 'intval');

		if (false !== M('product')->where(array('id' => $id))->setField('status', 0)) {
			$this->ajaxReturn(1, "还原成功！", 1);
		}else {
			$this->ajaxReturn(0, "还原失败！", 0);
		}
	}

	//批量还原产品
	public function restoreBatch() {
		$idArr = I('key',0 , 'intval');
		$pid = I('get.pid', 0, 'intval');
		if (!is_array($idArr)) {
			$this->ajaxReturn(0, "请选择要还原的项！", 0);
		}

		if (false !== M('product')->where(array('id' => array('in', $idArr)))->setField('status', 0)) {
			$this->ajaxReturn(1, "还原成功！", 1);
		}else {
			$this->ajaxReturn(0, "还原失败！", 0);
		}
	}

	//彻底删除
	public function clear() {
		$id = I('id',0 , 'intval');
		$batchFlag = I('get.batchFlag', 0, 'intval');
		//批量删除
		if ($batchFlag) {
			$this->clearBatch();
			return;
		}
		
		$pid = I('get.pid', 0, 'intval');
		$modelid = D('ProductView')->where(array('id' => $id))->getField('modelid');

		//删除图片附件
		if(I('del_picc') == 1) {
			$litpic = M('product')->where("id='".$id."'")->getField('pictureurls');
			$litpic = explode('|||', $litpic);
			$imgSizeArr = explode(',',C('cfg_imgthumb_width'));
			for($i=0;$i<count($litpic);$i++) {
				$img_arr = explode('$$$$$$', $litpic[$i]);
				for($j=0;$j<count($imgSizeArr);$j++) {
					@unlink('.'.$img_arr[0].'!'.$imgSizeArr[$j].'X.jpg');
				}
				@unlink('.'.$img_arr[0]);
			}
		}

		if (M('product')->delete($id)) {
			// delete picture index
			if ($modelid) {
				M('attachmentindex')->where(array('arcid' => $id , 'modelid' => $modelid ))->delete();//test
			}
			$this->ajaxReturn(1, "彻底删除成功！", 1);
		}else {
			$this->ajaxReturn(0, "彻底删除失败！", 0);
		}
	}


	//批量彻底删除
	public function clearBatch() {

		$idArr = I('key',0 , 'intval');		
		$pid = I('get.pid', 0, 'intval');
		if (!is_array($idArr)) {
			$this->ajaxReturn(0, "请选择要彻底删除的项！", 0);
		}
		$where = array('id' => array('in', $idArr));
		$modelid = D('ProductView')->where(array('id' => $idArr[0]))->getField('modelid');//for delete picture index,use

		//删除图片附件
		if(I('del_picc') == 1) {
			$litpic = M('product')->where($where)->select();
			$litpic_arr = array();
			foreach ($litpic as $k => $v) {
				$imgjg = explode('|||', $v['pictureurls']);
				for($i=0;$i<count($imgjg);$i++) {
					$imgjgg = explode('$$$$$$', $imgjg[$i]);
					$litpic_arr[] = $imgjgg[0];
				}
			}
			$imgSizeArr = explode(',',C('cfg_imgthumb_width'));
			for($i = 0;$i<count($litpic_arr);$i++) {
				for($j=0;$j<count($imgSizeArr);$j++) {
					@unlink('.'.$litpic_arr[$i].'!'.$imgSizeArr[$j].'X.jpg');
				}
				@unlink('.'.$litpic_arr[$i]);
			}
		}
		

		if (M('product')->where($where)->delete()) {
			// delete picture index
			if ($modelid) {
				M('attachmentindex')->where(array('arcid' => array('in', $idArr) , 'modelid' => $modelid ))->delete();
			}

			$this->ajaxReturn(1, "彻底删除成功！", 1);
		}else {
			$this->ajaxReturn(0, "彻底删除失败！", 0);
		}
	}
	//批量更新排序
	public function sort() {
		foreach ($_POST as $k => $v) {
			if ($k == 'key') {
				continue;
			}
			M('product')->where(array('id'=>$k))->setField('sort',$v);
			//echo 'id:'.$k.'___v:'.$v.'<br/>';//debug			
		}
		$this->ajaxReturn(1, "更新排序成功！", 1);
		//$this->redirect(GROUP_NAME. '/Category/index');
	}

	//排序ajax请求
	public function pxajax() {
		if(IS_POST) {
			$jg = M('Product')->where("id='".I('cid')."'")->save(array('sort'=>I('val')));
			if($jg) {
				$this->ajaxReturn(1,1,1);//更新排序成功
			}
		}
	}

	public function getTopCate($cid) {
		$pinfo = M('Category')->where("id = '$cid'")->find();
		if($pinfo['pid'] != 0) {
			$cinfo = $this->getTopCate($pinfo['pid']);
		}else {
			$cinfo =  $pinfo;
		}
		return $cinfo;
	}
}
?>