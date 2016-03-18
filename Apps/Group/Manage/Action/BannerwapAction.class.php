<?php

class BannerwapAction extends CommonAction {
	
	public function index() {		
		//分页
		import('Class.Page', APP_PATH);
		$count = M('Banner_wap')->count();

		$page = new Page($count, 10);
		$limit = $page->firstRow. ',' .$page->listRows;
		$list = M('Banner_wap')->order('sort')->limit($limit)->select();

		$this->page = $page->show();
		$this->vlist = $list;
		$this->type = 'WAP 幻灯片列表';

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
		$this->display();
	}

	//
	public function addHandle() {
		//M验证
		$id = I('id', 0, 'intval');
		$validate = array(
			array('name','require','名称名称不能为空！'), 
			array('litpic','require','图片地址不能为空！'), 
			array('url','require','链接地址不能为空！'), 
		);

		$db = M('Banner_wap');
		if (!$db->validate($validate)->create()) {
			$this->error($db->getError());
		}

		if($id = $db->add()) {
			$this->success('添加成功',U(GROUP_NAME. '/Bannerwap/index'));
		}else {
			$this->error('添加失败');
		}
	}

	//编辑文章
	public function edit() {
		//当前控制器名称
		$id = I('id', 0, 'intval');
		if (IS_POST) {
			$this->editHandle();
			exit();
		}
		
		$this->vo = M("Banner_wap")->find($id);
		$this->display();
	}


	//修改处理
	public function editHandle() {
		//M验证
		$id = I('id', 0, 'intval');
		$validate = array(
			array('name','require','名称名称不能为空！'), 
			array('litpic','require','图片地址不能为空！'), 
			array('url','require','链接地址不能为空！'), 
		);

		$db = M('Banner_wap');
		if (!$db->validate($validate)->create()) {
			$this->error($db->getError());
		}

		if (false !== $db->save()) {
			$this->success('修改成功', U(GROUP_NAME. '/Bannerwap/index', array('pid' => $pid)));
		}else {

			$this->error('修改失败');
		}
		
	}

	//彻底删除
	public function del() {
		$id = I('id',0 , 'intval');
		$batchFlag = intval($_GET['batchFlag']);
		//批量删除
		if ($batchFlag) {
			$this->delBatch();
			return;
		}
		
		if (M('Banner_wap')->delete($id)) {
			$this->ajaxReturn(1, "彻底删除成功！", 1);
		}else {
			$this->ajaxReturn(0, "彻底删除失败！", 0);
		}
	}
	//批量彻底删除
	public function delBatch() {
		$idArr = I('key',0 , 'intval');		
		if (!is_array($idArr)) {
			$this->ajaxReturn(0, "请选择要彻底删除的项！", 0);
		}
		$where = array('id' => array('in', $idArr));

		if (M('Banner_wap')->where($where)->delete()) {
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
			M('Banner_wap')->where(array('id'=>$k))->setField('sort',$v);		
		}
		$this->ajaxReturn(1, "更新排序成功！", 1);
	}
}
?>