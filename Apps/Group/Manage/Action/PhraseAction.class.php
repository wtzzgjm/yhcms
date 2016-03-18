<?php

class PhraseAction extends CommonContentAction {
	
	public function index() {

		$pid = I('pid', 0, 'intval');//类别ID
		$keyword = I('keyword', '', 'htmlspecialchars,trim');//关键字

		//所有子栏目列表
		import('Class.Category', APP_PATH);
		$cate = getCategory();
		$this->subcate = Category::getChilds($cate, $pid);
		$this->poscate = Category::getParents($cate, $pid);
		
		
		if ($pid) {
			$idarr = Category::getChildsId($cate, $pid, 1);//所有子类ID
			//$where = array('phrase.status' => 0, 'cid' => $pid);
			$where = array('phrase.status' => 0, 'cid' => array('in', $idarr));
		}else {
			$where = array('phrase.status' => 0);
		}

		
		if (!empty($keyword)) {
			$where['phrase.title'] = array('LIKE', "%{$keyword}%");
		}
		
		//分页
		import('Class.Page', APP_PATH);
		$count = D('PhraseView')->where($where)->count();

		$page = new Page($count, 10);
		$limit = $page->firstRow. ',' .$page->listRows;
		$art = D('PhraseView')->where($where)->order('phrase.id DESC')->limit($limit)->select();

		$this->pid = $pid;
		$this->keyword = $keyword;
		$this->page = $page->show();
		$this->vlist = $art;
		$this->type = '短语列表';

		$this->display();
	}
	//添加文章
	public function add() {

		
		//当前控制器名称		
		$actionName = strtolower($this->getActionName());
		if (IS_POST) {
			$pid = I('pid', 0, 'intval');
			$cid = I('cid', 0, 'intval');
			$flags = I('flags', array(),'intval');
			$jumpurl = I('jumpurl', '');
			$content = I('content', '', 'trim');
			if (empty($content)) {
				$this->error('内容不能为空');
			}
			if (!$cid) {
				$this->error('请选择栏目');
			}
			$pid = $cid;//转到自己的栏目


			$flag = 0;
			foreach ($flags as $v) {
				$flag += $v;
			}

			$data =array(
				'color' => I('color'),
				'cid'	=> $cid,
				'keywords' => I('keywords','','trim'),
				'title' => $content,
				'publishtime' => time(),
				'updatetime' => time(),
				'click' => rand(10,95),
				'status' => 0,
				'commentflag' => I('commentflag', 0,'intval'),
				'flag'	=> $flag,
				'jumpurl' => $jumpurl,
				'aid'	=> $_SESSION[C('USER_AUTH_KEY')]

			);

			if($id = M('phrase')->add($data)) {

				//更新静态缓存
				delCacheHtml('List/index_'.$cid, false, 'list:index');	
				delCacheHtml('Index_index', false, 'index:index');

				$this->success('添加成功',U(GROUP_NAME. '/Phrase/index', array('pid' => $pid)));
			}else {
				$this->error('添加失败');
			}
			exit();
		}


		$this->pid = I('pid', 0, 'intval');
		$cate = getCategory(2);
		import('Class.Category', APP_PATH);
		$cate = Category::unlimitedForLevel($cate);
		$this->cate = Category::getLevelOfModel($cate, $actionName);
		$this->flagtypelist = getArrayOfItem('flagtype');//文档属性
		$this->display();
	}



	//编辑文章
	public function edit() {
		//当前控制器名称
		$id = I('id', 0, 'intval');
		$actionName = strtolower($this->getActionName());
		
		if (IS_POST) {
			//$id = I('id', 0, 'intval');
			$pid = I('pid', 0, 'intval');
			$flags = I('flags', array(),'intval');
			$cid = I('cid', 0, 'intval');
			$content = I('content', '', 'trim');

			if (empty($content)) {
				$this->error('内容不能为空');
			}
			if (!$cid) {
				$this->error('请选择栏目');
			}
			
			$pid = $cid;//转到自己的栏目

			$data =array(
				'id' => $id,
				'color' => I('color'),
				'cid'	=> $cid,
				'keywords' => I('keywords','','trim'),
				'title' => $content,
				'commentflag' => I('commentflag', 0,'intval'),
				'updatetime' => time(),
				'jumpurl' => I('jumpurl', ''),
			);

			$data['flag'] = 0;
			foreach ($flags as $v) {
				$data['flag'] += $v;
			}

			//获取属于分类信息,得到modelid
			import('Class.Category', APP_PATH);			
			$selfCate = Category::getSelf(getCategory(0), $data['cid']);//当前栏目信息
			$modelid = $selfCate['modelid'];

			if (false !== M('phrase')->save($data)) {

				
				//更新静态缓存
				delCacheHtml('List/index_'.$data['cid'].'_', false, 'list:index');
				delCacheHtml('List/index_'.$selfCate['ename'], false, 'list:index');//还有只有名称
				delCacheHtml('Show/index_*_'. $id, false, 'show:index');//不太精确，会删除其他模块同id文档		

				$this->success('修改成功', U(GROUP_NAME. '/Phrase/index', array('pid' => $pid)));
			}else {

				$this->error('修改失败');
			}
			exit();
		}

		$this->pid = I('pid', 0, 'intval');
		$cate = getCategory(2);
		import('Class.Category', APP_PATH);
		$cate = Category::unlimitedForLevel($cate);
		$this->cate = Category::getLevelOfModel($cate, $actionName);

		$this->vo = M($actionName)->find($id);
		$this->flagtypelist = getArrayOfItem('flagtype');//文档属性
		$this->display();
	}



	//回收站文章列表
	public function trach() {
		import('Class.Page', APP_PATH);
		$where = array('phrase.status' => 1);
		$count = D('PhraseView')->where($where)->count();

		$page = new Page($count, 10);
		$limit = $page->firstRow. ',' .$page->listRows;
		$art = D('PhraseView')->where($where)->limit($limit)->select();

		$this->pid = I('pid', 0, 'intval');
		$this->page = $page->show();
		$this->vlist = $art;		
		$this->type = '文章回收站';
		$this->subcate = '';
		$this->display('index');
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

		if (false !== M('phrase')->where(array('id' => $id))->setField('status', 1)) {

			delCacheHtml('Show/index_*_'. $id.'.', false, 'show:index');	
			$this->success('删除成功', U(GROUP_NAME. '/Phrase/index', array('pid' => $pid)));
			
		}else {
			$this->error('删除失败');
		}
	}

	//批量删除到回收站
	public function delBatch() {

		$idArr = I('key',0 , 'intval');
		$pid = I('get.pid', 0, 'intval');

		if (!is_array($idArr)) {
			$this->error('请选择要删除的项');
		}

		if (false !== M('phrase')->where(array('id' => array('in', $idArr)))->setField('status', 1)) {
			
			//更新静态缓存
			foreach ($idArr as $v) {
				delCacheHtml('Show/index_*_'. $v.'.', false, 'show:index');	
			}
			$this->success('批量删除成功', U(GROUP_NAME. '/Phrase/index', array('pid' => $pid)));
			
		}else {
			$this->error('批量删除文失败');
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

		if (false !== M('phrase')->where(array('id' => $id))->setField('status', 0)) {
			
			$this->success('还原成功', U(GROUP_NAME. '/Phrase/trach', array('pid' => $pid)));
			
		}else {
			$this->error('还原失败');
		}
	}

	//批量还原文章
	public function restoreBatch() {
		
		$idArr = I('key',0 , 'intval');
		$pid = I('get.pid', 0, 'intval');
		if (!is_array($idArr)) {
			$this->error('请选择要还原的项');
		}

		if (false !== M('phrase')->where(array('id' => array('in', $idArr)))->setField('status', 0)) {
			
			$this->success('还原成功', U(GROUP_NAME. '/Phrase/trach', array('pid' => $pid)));
			
		}else {
			$this->error('还原失败');
		}
	}

	//彻底删除文章
	public function clear() {

		$id = I('id',0 , 'intval');
		$batchFlag = I('get.batchFlag', 0, 'intval');
		//批量删除
		if ($batchFlag) {
			$this->clearBatch();
			return;
		}

		$pid = I('get.pid', 0, 'intval');

		if (M('phrase')->delete($id)) {
			$this->success('彻底删除成功', U(GROUP_NAME. '/Phrase/trach', array('pid' => $pid)));
		}else {
			$this->error('彻底删除失败');
		}
	}


	//批量彻底删除文章
	public function clearBatch() {

		$idArr = I('key',0 , 'intval');		
		$pid = I('get.pid', 0, 'intval');
		if (!is_array($idArr)) {
			$this->error('请选择要彻底删除的项');
		}
		$where = array('id' => array('in', $idArr));

		if (M('phrase')->where($where)->delete()) {
			$this->success('彻底删除成功', U(GROUP_NAME. '/Phrase/trach', array('pid' => $pid)));
		}else {
			$this->error('彻底删除失败');
		}
	}

	
}



?>