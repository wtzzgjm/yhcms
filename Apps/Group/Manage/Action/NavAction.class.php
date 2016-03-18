<?php

class NavAction extends CommonAction {
	
	public function index() {		
		//分页
		$nav = M('Nav')->order('sort')->select();
		import('Class.Category', APP_PATH);
		$list = Category::unlimitedForLevel($nav, '- - - ', 0);


		//遍历更新url显示
		foreach ($list as $k => $v) {
			if(strstr($v['url'], '@')){
				$cdata = M('category')->find(str_replace('@', '', $v['url']));
				$list[$k]['hrefurl'] = C('cfg_weburl')."/".$cdata['ename'].'/';
			}else{
				$list[$k]['hrefurl'] = $v['url'];
			}
		}
		$this->vlist = $list;
		$this->type = '导航列表';

		$this->display();
	}
	//添加
	public function add() {
		//当前控制器名称		
		$actionName = strtolower($this->getActionName());
		if (IS_POST) {
			$this->addHandle();
			exit();
		}
		$cate = M('category')->order('sort')->select();
		import('Class.Category', APP_PATH);
		$this->cate = Category::unlimitedForLevel($cate, '---', 0);

		$nav = M('nav')->order('sort')->select();
		$this->nav = Category::unlimitedForLevel($nav, '- - - ', 0);

		$this->display();
	}

	//
	public function addHandle() {
		//M验证
		$id = I('id', 0, 'intval');
		$pid = I('pid', 0, 'intval');
		$validate = array(
			array('name','require','导航名称不能为空！'), 
			array('url','require','链接地址不能为空！'), 
			array('sort','require','排序数值不能为空！'), 
		);

		$db = M('Nav');
		if (!$db->validate($validate)->create()) {
			$this->error($db->getError());
		}
		if($id = $db->add()) {
			$this->success('添加成功',U(GROUP_NAME. '/Nav/index'));
		}else {
			$this->error('添加失败');
		}
	}

	//编辑文章
	public function edit() {
		//当前控制器名称
		$id = I('id', 0, 'intval');
		$actionName = strtolower($this->getActionName());
		if (IS_POST) {
			$this->editHandle();
			exit();
		}
		$cate = M('category')->order('sort')->select();
		import('Class.Category', APP_PATH);
		$this->cate = Category::unlimitedForLevel($cate, '---',0);

		$nav = M('nav')->order('sort')->where("id <> $id")->select();
		$this->nav = Category::unlimitedForLevel($nav, '- - - ', 0);

		$vo = M($actionName)->find($id);
		$this->vo = $vo ;

		$this->isrelock = strstr($vo['url'], '@');
		
		$this->display();
	}


	//修改处理
	public function editHandle() {
		//M验证
		$id = I('id', 0, 'intval');
		$validate = array(
			array('name','require','导航名称不能为空！'), 
			array('url','require','链接地址不能为空！'), 
			array('sort','require','排序数值不能为空！'),  
		);

		$db = M('Nav');
		if (!$db->validate($validate)->create()) {
			$this->error($db->getError());
		}

		if (false !== M('Nav')->save()) {
			$this->success('修改成功', U(GROUP_NAME. '/Nav/index', array('pid' => $pid)));
		}else {

			$this->error('修改失败');
		}
		
	}

	//彻底删除
	public function del() {
		$id = I('id',0 , 'intval');
		$batchFlag = intval($_GET['batchFlag']);
		$batchFlag = I('get.batchFlag', 0, 'intval');
		//批量删除
		if ($batchFlag) {
			$this->delBatch();
			return;
		}
		//查询是否有子导航
		$childCate = M('nav')->where(array('pid' => $id))->select();
		if ($childCate) {
			$this->ajaxReturn(0, "删除失败：请先删除本导航下的子导航！", 0);
		}
		if (M('Nav')->delete($id)) {
			$this->ajaxReturn(1, "彻底删除成功！", 1);
		}else {
			$this->ajaxReturn(0, "彻底删除失败！", 0);
		}
	}
	//批量删除到回收站
	public function delBatch() {
		$idArr = I('key',0 , 'intval');
		$pid = I('get.pid',0 , 'intval');
		if (!is_array($idArr)) {
			$this->ajaxReturn(0, "请选择要删除的项！", 0);
		}

		///////////////////////////
		$mlist = M('nav')->where(array('id' => array('in', $idArr)))->select();
		$jg = 0;
		$error = 0;
		foreach ($mlist as $k => $v) {
			//查询是否有子类
			$childCate = M('nav')->where(array('pid' => $v['id']))->select();
			if ($childCate) {
				$error = $error + 1;
			}else{
				if (M('nav')->delete($v['id'])) {
					$jg = $jg + 1;
				}
			}
			
		}
		//更新栏目缓存
			
		/////////////////////////////
		if ($jg) {
			if ($error) {
				$this->ajaxReturn(1, "批量删除成功,有 $error 条记录是存在子栏目的不能进行删除！", 1);
			}else{
				$this->ajaxReturn(1, "批量删除成功！", 1);
			}
		}else {
			$this->ajaxReturn(0, "批量删除失败！", 0);
		}
	}

	//批量更新排序
	public function sort() {
		foreach ($_POST as $k => $v) {
			if ($k == 'key') {
				continue;
			}
			M('Nav')->where(array('id'=>$k))->setField('sort',$v);
			//echo 'id:'.$k.'___v:'.$v.'<br/>';//debug			
		}
		$this->ajaxReturn(1, "更新排序成功！", 1);
		//$this->redirect(GROUP_NAME. '/Category/index');
	}
	
}
?>