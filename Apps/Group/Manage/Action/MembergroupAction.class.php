<?php

class MembergroupAction extends CommonAction {
	
	public function index() {
					
		//分页
		import('Class.Page', APP_PATH);
		$count = M('membergroup')->count();

		$page = new Page($count, 10);
		$limit = $page->firstRow. ',' .$page->listRows;
		$list = M('membergroup')->order('id')->limit($limit)->select();

		$this->page = $page->show();
		$this->vlist = $list;
		$this->type = '会员组列表';

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
		$validate = array(
			array('name','require','会员组名必须填写！'), 
			array('name','','会员组名已经存在！',0,'unique',1), 
		);
		$db = M('membergroup');
		if (!$db->validate($validate)->create()) {
			$this->error($db->getError());
		}
		if($id = M('membergroup')->add()) {
			$this->success('添加成功',U(GROUP_NAME. '/Membergroup/index'));
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
		
		$this->vo = M($actionName)->find($id);
		$this->display();
	}


	//修改文章处理
	public function editHandle() {

		$name = I('name', '', 'trim');
		$id = I('id', 0, 'intval');
		if (empty($name)) {
			$this->error('会员组名必须填写！');
		}
		
		if (M('membergroup')->where(array('name' => $name, 'id' => array('neq', $id)))->find()) {
			$this->error('会员组名已经存在！');
		}

		if (false !== M('membergroup')->save($_POST)) {
			$this->success('修改成功', U(GROUP_NAME. '/Membergroup/index', array('pid' => $pid)));
		}else {

			$this->error('修改失败');
		}
	}
	//彻底删除文章
	public function del() {

		$id = I('id',0 , 'intval');
		$batchFlag = intval($_GET['batchFlag']);
		//批量删除
		if ($batchFlag) {
			$this->delBatch();
			return;
		}
		
		if (M('membergroup')->delete($id)) {
			$this->ajaxReturn(1, "彻底删除成功！", 1);
		}else {
			$this->ajaxReturn(0, "彻底删除失败！", 0);
		}
	}
	//批量彻底删除文章
	public function delBatch() {

		$idArr = I('key',0 , 'intval');		
		if (!is_array($idArr)) {
			$this->ajaxReturn(0, "请选择要彻底删除的项败！", 0);
		}
		$where = array('id' => array('in', $idArr));

		if (M('membergroup')->where($where)->delete()) {
			$this->ajaxReturn(1, "彻底删除成功！", 1);
		}else {
			$this->ajaxReturn(0, "彻底删除失败！", 0);
		}
	}
}
?>