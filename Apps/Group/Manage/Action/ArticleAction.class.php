<?php

class ArticleAction extends CommonContentAction {
	
	public function index() {
		$pid = I('pid', 0, 'intval');//类别ID
		$keyword = I('sesskey') == '1' ? session('keyword') : I('key', '', 'htmlspecialchars,trim');//关键字
		$flag = I("flag");//类型
		//所有子栏目列表
		import('Class.Category', APP_PATH);
		//$cate = D('CategoryView')->order('category.sort')->select();
		$cate = getCategory();
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
			$where = array('article.status' => 0, 'cid' => array('in', $idarr));
		}else {
			$where = array('article.status' => 0);
		}
		/*if ($pid) {
			$idarr = Category::getChildsId($cate, $pid, 1);//所有子类ID
			$where = array(
				array('article.status' => 1, 'cid' => array('in', $idarr),'publish'=>1),
				array('article.status' => 0, 'cid' => array('in', $idarr)),
				'_logic'=>'and'
			);
		}else {
			$where = array(
				array('article.status' => 1, 'publish'=>1),
				array('article.status' => 0),
				'_logic'=>'and'
			);
		}*/

		if (!empty($keyword)) {
			$where['article.title'] = array('LIKE', "%{$keyword}%");
		}
		if ($flag > 0) {
			$where['_string'] = "article.flag & $flag = $flag";
		}
		//分页
		import('Class.Page', APP_PATH);
		$count = D('ArticleView')->where($where)->count();

		$pagerows = I('pagerows', 0, 'intval') ? I('pagerows', 0, 'intval') : 10;
		$page = new Page($count, $pagerows);
		$limit = $page->firstRow. ',' .$page->listRows;
		$art = D('ArticleView')->where($where)->order('article.id DESC')->limit($limit)->select();

		$this->pid = $pid;
		$this->flag = $flag;
		$this->keyword = $keyword;
		$this->page = $page->show();
		foreach ($art as $k => $v) {
			if($v['status'] == 1) {
				$art[$k]['is_publish'] = 1;
			}
		}
		$this->vlist = $art;
		$this->type = '文章列表';
		$this->pagerows = $pagerows;
		$this->flagtypelist = getArrayOfItem('flagtype');//文档属性
		/*if(IS_POST) {
			if($flag>0) {
				$data = array('title'=>array('like','%'.I('key').'%'),'flag'=>$flag,'status'=>'0');
			}else {
				$data = array('title'=>array('like','%'.I('key').'%'),'status'=>'0');
			}
			$searchjg = M('article')->where($data)->select();
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
		session('urldata', $urldata);
		$this->p = I('p', 0, 'intval');
		$this->display();
	}
	//添加文章
	public function add() {
		//当前控制器名称		
		$actionName = strtolower($this->getActionName());
		$this->pid = I('pid', 0, 'intval');

		if (IS_POST) {
			$this->addPost();
			exit();
		}


		//$cate = D('CategoryView')->where(array('type' => 0))->order('category.sort')->select();
		$cate = getCategory(2);
		import('Class.Category', APP_PATH);
		$cate = Category::unlimitedForLevel($cate);
		$this->flagtypelist = getArrayOfItem('flagtype');//文档属性
		$cate = Category::getLevelOfModel($cate, $actionName);
		foreach ($cate as $k => $v) {
			$isdown = 0;
			if (M('Category')->where("pid='".$v['id']."'")->find()) {
				$isdown = 1;
			}
			$cate[$k]['isdown'] = $isdown;
		}
		$this->cate = $cate;
		$this->display();
	}

	//
	public function addPost() {

		$pid = I('pid', 0, 'intval');
		$cid = I('cid', 0, 'intval');
		$title = I('title', '', 'htmlspecialchars,rtrim');
		$tag = I('tag', '', 'htmlspecialchars,rtrim');	
		$flags = I('flags', array(),'intval');
		$jumpurl = I('jumpurl', '');
		$etitle = I('etitle', '');
		$description = I('description', '', 'htmlspecialchars');
		$content = I('content', '', '');

		$author = I('author', '', '');
		$source = I('source', '', '');
		
		session('artCate', $cid);

		$pic = I('litpic', '', 'htmlspecialchars,trim');

		if (empty($title)) {
			$this->error('标题不能为空');
		}
		if (!$cid) {
			$this->error('请选择栏目');
		}

		if (empty($etitle)) {
			//$etitle = get_pinyin(iconv('utf-8','gb2312//ignore',$title),0);
		}else {
			if (!ctype_alnum($etitle)) {
				$this->error('别名只能由字母和数字组成，不能包含特殊字符！');
			}
		}
		if (!empty($etitle)&&M('article')->where("etitle='".$etitle."'")->find()) {
			$this->error('别名已存在，请重新输入！');
		}

		if(!empty($title)&&M('article')->where("title = '$title'")->find()) {
			$this->error('新闻标题已存在，请重新输入！');
		}

		$pid = $cid;//转到自己的栏目
		if (empty($description)) {			
			$description = str2sub(strip_tags($content), 120);
		}

		//图片标志
		if (!empty($pic) && !in_array(B_PIC, $flags)) {
			$flags[] = B_PIC;
		}
		$flag = 0;
		foreach ($flags as $v) {
			$flag += $v;
		}

		//获取属于分类信息,得到modelid
		import('Class.Category', APP_PATH);			
		$selfCate = Category::getSelf(getCategory(0), $cid);//当前栏目信息
		$modelid = $selfCate['modelid'];

		$data =array(
			'title' => $title ,
			'shorttitle' => I('shorttitle', '', 'htmlspecialchars,trim'),
			'color' => I('color'),
			'cid'	=> $cid,
			'tag'	=> $tag,
			'author'	=> $author,
			'source'	=> $source,
			'litpic'	=> $pic,
			'keywords' => I('keywords','','htmlspecialchars,trim'),
			'description' => $description,
			'content' => $content,
			'publishtime' => time(),
			'updatetime' => time(),
			'click' => rand(10,95),
			'etitle' => $etitle,
			'sort' => 0,
			'status' => 0,
			'commentflag' => I('commentflag', 0,'intval'),
			'flag'	=> $flag,
			'jumpurl' => $jumpurl,
			'aid'	=> $_SESSION[C('USER_AUTH_KEY')]

		);

		//延时发布相关
		if(I('is_ys_time')) {
			$data['publishtime'] = strtotime(I('is_ys_time'));
			$data['status'] = 1;
			$data['publish'] = 1;
		}

		
		if($id = M('article')->add($data)) {

			//更新上传附件表
			if (!empty($pic)) {
				//更新3个小时内的.即10800秒
				$pic = preg_replace('/!(\d+)X(\d+)\.jpg$/i', '', $pic);//清除缩略图的!200X200.jpg后缀
				$attid = M('attachment')->where(array('filepath' => $pic))->getField('id');
				if($attid){
					M('attachmentindex')->add(array('attid' => $attid,'arcid' => $id, 'modelid' => $modelid));
				}
				//halt(M('attachment')->getlastsql());
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
			//$this->display('/Test:empty');exit();


			//更新静态缓存
			delCacheHtml('List/index_'.$cid, false, 'list:index');	
			delCacheHtml('Index_index', false, 'index:index');

			$this->success('添加文章成功',U(GROUP_NAME. '/Article/index', array('pid' => $pid)));
		}else {
			$this->error('添加文章失败');
		}
	}

	//编辑文章
	public function edit() {
		//当前控制器名称
		$id = I('id', 0, 'intval');
		$actionName = strtolower($this->getActionName());
		$this->pid = I('pid', 0, 'intval');

		if (IS_POST) {
			$this->editPost();
			exit();
		}

		//$cate = D('CategoryView')->where(array('type' => 0))->order('category.sort')->select();
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
		$vo['content'] = htmlspecialchars($vo['content']);//ueditor
		$this->vo = $vo;		
		$this->flagtypelist = getArrayOfItem('flagtype');//文档属性
		$this->p = I('p', 0, 'intval');
		$this->display();
	}


	//修改文章处理
	public function editPost() {

		$data =array(
			'id' => I('id', 0, 'intval'),
			'title' => I('title', '', 'htmlspecialchars,rtrim'),
			'etitle' => I('etitle'),
			'tag'	=> I('tag', '', 'htmlspecialchars,rtrim'),
			'shorttitle' => I('shorttitle', '', 'htmlspecialchars,rtrim'),
			'color' => I('color'),
			'cid'	=> I('cid', 0, 'intval'),
			'author'	=> I('author'),
			'source'	=> I('source'),
			'litpic'	=> I('litpic', ''),
			'keywords' => I('keywords', '', 'htmlspecialchars,trim'),
			'description' =>  I('description', ''),
			'content' => I('content', '', ''),
			'updatetime' => time(),
			'commentflag' => I('commentflag', 0,'intval'),
			'jumpurl' => I('jumpurl', ''),
			'publishtime'=>strtotime(I('is_ys_time'))
		);
		$id = $data['id'];			
		$pid = I('pid', 0, 'intval');
		$flags = I('flags', array(),'intval');
		$pic = $data['litpic'];

		//更改发布时间来达到延时发布
		if(strtotime(I('is_ys_time'))>time()) {
			$data['publish'] = 1;
			$data['status'] = 1;
		}else if(strtotime(I('is_ys_time'))<time()) {
			$data['publish'] = 0;
			$data['status'] = 0;
		}

		if (empty($data['title'])) {
			$this->error('标题不能为空');
		}
		if (!$data['cid']) {
			$this->error('请选择栏目');
		}
		if (empty($data['etitle'])) {
			//$data['etitle'] = get_pinyin(iconv('utf-8','gb2312//ignore',$data['title']),0);
		}else{
			if (!ctype_alnum($data['etitle'])) {
				$this->error('别名只能由字母和数字组成，不能包含特殊字符！');
			}
		}
		if (!empty($data['etitle'])&&M('article')->where(array('etitle' => $data['etitle'], 'id' => array('neq' , $id)))->find()) {
			$this->error('别名已存在，请重新输入！');
		}

		if(!empty($title)&&M('article')->where("title = '$title'")->find()) {
			$this->error('新闻标题已存在，请重新输入！');
		}


		$pid = $data['cid'];//转到自己的栏目

		if (empty($data['description'])) {			
			$data['description'] = str2sub(strip_tags($data['content']), 120);
		}


		//图片标志
		if (!empty($pic) && !in_array(B_PIC, $flags)) {
			$flags[] = B_PIC;
		}
		$data['flag'] = 0;
		foreach ($flags as $v) {
			$data['flag'] += $v;
		}

		//获取属于分类信息,得到modelid
		import('Class.Category', APP_PATH);			
		$selfCate = Category::getSelf(getCategory(0), $data['cid']);//当前栏目信息
		$modelid = $selfCate['modelid'];


	
		if (false !== M('article')->save($data)) {
			//del
			M('attachmentindex')->where(array('arcid' => $id, 'modelid' => $modelid))->delete();
			
			//更新上传附件表
			if (!empty($pic)) {

				//$pic = preg_replace('/_(s|m)\.(jpg|gif|bmp|png)$/i', '.$2', $pic);//清除缩略图的_m,_s后缀
				$pic = preg_replace('/!(\d+)X(\d+)\.jpg$/i', '', $pic);//清除缩略图的!200X200.jpg后缀
				$attid = M('attachment')->where(array('filepath' => $pic))->getField('id');
				if($attid){
					M('attachmentindex')->add(array('attid' => $attid,'arcid' => $id, 'modelid' => $modelid));
				}
				//hetlastsql());
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
			$this->success('修改成功', U(GROUP_NAME. '/Article/index', array('pid' => $pid,'p' => $p)));
		}else {
			$this->error('修改失败');
		}
	}

	public function trach() {
		import('Class.Page', APP_PATH);
		$where = array('article.status' => 1,'article.publish' => 0);
		$count = D('ArticleView')->where($where)->count();

		$pagerows = I('pagerows', 0, 'intval') ? I('pagerows', 0, 'intval') : 10;
		
		$page = new Page($count, $pagerows);
		$limit = $page->firstRow. ',' .$page->listRows;
		$art = D('ArticleView')->where($where)->limit($limit)->select();

		$this->pid = I('pid', 0, 'intval');
		$this->page = $page->show();
		$this->vlist = $art;		
		$this->type = '文章回收站';
		$this->subcate = '';
		$this->display('index');
	}
	//批量更改属性
	public function shux() {
		$idArr = I('key',0 , 'intval');
		$pid = I('get.pid', 0, 'intval');
		$flag = I('flagss', 0, 'intval');
		if (!is_array($idArr)) {
			$this->ajaxReturn(0, "请选择要删除的项！", 0);
		}
		if (false !== M('article')->where(array('id' => array('in', $idArr)))->setField('flag', $flag)) {
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
		$db = M('article');
		$data = $db->where(array('id' => $id))->find();
		$data['flag'] = $data['flag'] < 4 ? 4 : 0;

		$db->save($data);
		
		$this->redirect(U('Article/index', session('urldata')));
		//echo "<script language=\"javascript\">location.href = '".session('go_url')."'</script>";
	}
	//删除文章到回收站
	public function del() {
		$id = I('id',0 , 'intval');
		$batchFlag = I('get.batchFlag', 0, 'intval');
		//批量删除
		if ($batchFlag) {
			$this->delBatch();
			return;
		}
		$pid = I('pid',0 , 'intval');//单纯的GET没问题
		if (false !== M('article')->where(array('id' => $id))->setField(array('status'=>1 , 'publish'=>0))) {
			delCacheHtml('Show/index_*_'. $id.'.', false, 'show:index');				
			$this->ajaxReturn(1, "删除成功！", 1);
		}else {
			$this->ajaxReturn(0, "删除失败！",01);
		}
	}

	//批量删除到回收站
	public function delBatch() {
		$idArr = I('key',0 , 'intval');
		$pid = I('get.pid',0 , 'intval');
		if (!is_array($idArr)) {
			$this->ajaxReturn(0, "请选择要删除的项！", 0);
		}
		if (false !== M('article')->where(array('id' => array('in', $idArr)))->setField(array('status'=>1 , 'publish'=>0))) {
			//更新静态缓存
			foreach ($idArr as $v) {
				delCacheHtml('Show/index_*_'. $v.'.', false, 'show:index');	
			}
			//. M('article')->getlastsql();
			$this->ajaxReturn(1, "批量删除成功！", 1);
			
		}else {
			$this->ajaxReturn(0, "批量删除成功！", 0);
		}
	}

	//还原文章
	public function restore() {
		$id = I('id',0 , 'intval');
		$batchFlag = I('get.batchFlag', 0, 'intval');
		//批量删除
		if ($batchFlag) {
			$this->restoreBatch();
			return;
		}

		$pid = I('get.pid', 0, 'intval');

		if (false !== M('article')->where(array('id' => $id))->setField('status', 0)) {
			$this->ajaxReturn(1, "还原成功！", 1);
		}else {
			$this->ajaxReturn(0, "还原失败！", 0);
		}
	}

	//批量还原文章
	public function restoreBatch() {
		$idArr = I('key',0 , 'intval');
		$pid = I('get.pid', 0, 'intval'); 
		if (!is_array($idArr)) {
			$this->ajaxReturn(0, "请选择要还原的项！", 0);
		}

		if (false !== M('article')->where(array('id' => array('in', $idArr)))->setField('status', 0)) {
			$this->ajaxReturn(1, "还原成功！", 1);
		}else {
			$this->ajaxReturn(0, "还原失败！", 0);
		}
	}

	//彻底删除文章
	public function clear() {
		$id = I('id',0 , 'intval');
		$batchFlag = I('get.batchFlag', 0, 'intval');
		/*//批量删除
		if ($batchFlag) {
			$this->clearBatch();
			return;
		}*/
		$pid = I('get.pid', 0, 'intval');
		$modelid = D('ArticleView')->where(array('id' => $id))->getField('modelid');
		//删除图片附件
		if(I('del_picc') == 1) {
			$litpic = M('Article')->where("id='".$id."'")->getField('litpic');
			$litpic = explode('!', $litpic);
			$imgSizeArr = explode(',',C('cfg_imgthumb_width'));
			for($i=0;$i<count($imgSizeArr);$i++) {
				@unlink('.'.$litpic[0].'!'.$imgSizeArr[$i].'X.jpg');
			}
			@unlink('.'.$litpic[0]);
		}

		if (M('article')->delete($id)) {
			// delete picture index
			if ($modelid) {
				M('attachmentindex')->where(array('arcid' => $id , 'modelid' => $modelid ))->delete();//test
			}
			$this->ajaxReturn(1, "彻底删除成功！", 1);
		}else {
			$this->ajaxReturn(0, "彻底删除失败！", 0);
		}
	}


	//批量彻底删除文章
	public function clearBatch() {
		$idArr = I('key',0 , 'intval');		
		$pid = I('get.pid', 0, 'intval');
		if (!is_array($idArr)) {
			$this->ajaxReturn(0, "请选择要测底删除的项！", 0);
		}
		$where = array('id' => array('in', $idArr));
		$modelid = D('ArticleView')->where(array('id' => $idArr[0]))->getField('modelid');//

		//删除图片附件
		if(I('del_picc') == 1) {
			$litpic = M('Article')->where($where)->select();
			$litpic_arr = array();
			foreach ($litpic as $k => $v) {
				$imgjg = explode('!', $v['litpic']);
				$litpic_arr[] = $imgjg[0];
			}
			$imgSizeArr = explode(',',C('cfg_imgthumb_width'));
			for($i = 0;$i<count($litpic_arr);$i++) {
				for($j=0;$j<count($imgSizeArr);$j++) {
					@unlink('.'.$litpic_arr[$i].'!'.$imgSizeArr[$j].'X.jpg');
				}
				@unlink('.'.$litpic_arr[$i]);
			}
		}

		if (M('article')->where($where)->delete()) {
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
			M('Article')->where(array('id'=>$k))->setField('sort',$v);
			//echo 'id:'.$k.'___v:'.$v.'<br/>';//debug			
		}
		$this->ajaxReturn(1, "更新排序成功！", 1);
		//$this->redirect(GROUP_NAME. '/Category/index');
	}


	//排序ajax请求
	public function pxajax() {
		if(IS_POST) {
			$jg = M('Article')->where("id='".I('cid')."'")->save(array('sort'=>I('val')));
			if($jg) {
				$this->ajaxReturn(1,1,1);//更新排序成功
			}
		}
	}
}
?>