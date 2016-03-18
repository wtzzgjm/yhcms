<?php

class WxmenuAction extends CommonAction {
	
	public function index() {		
		//分页
		$wxmenu = M('Wxmenu')->order('sort')->select();
		import('Class.Category', APP_PATH);
		$list = Category::unlimitedForLevel($wxmenu, '- - - ', 0);
		$this->vlist = $list;

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
		$nav = M('Wxmenu')->order('sort')->where("pid='0'")->select();
		$this->nav = $nav;

		$this->display();
	}

	public function addHandle() {
		//M验证
		$id = I('id', 0, 'intval');
		$pid = I('pid', 0, 'intval');


		$validate = array(
			array('name','require','菜单名称不能为空！'), 
			array('url','require','链接地址不能为空！'), 
			array('sort','require','排序数值不能为空！'), 
		);
		$add_err_msg = "";
		$namestr = I('name');
		$isadd_ok = true;
		if($pid == 0){
			$menu_num = M('Wxmenu')->where("pid='0'")->count();
			if ($menu_num == 3) {
				$add_err_msg = "1级菜单最多只能存在3个";
				$isadd_ok = false;
			}
			if(mb_strlen($namestr, 'utf8') > 4){
				$add_err_msg = "1级菜单名称不超过4个汉字";
				$isadd_ok = false;
			}
		} else{
			$menu_num = M('Wxmenu')->where("pid='$pid'")->count();
			if ($menu_num == 5) {
				$add_err_msg = "2级菜单最多只能存在5个";
				$isadd_ok = false;
			}
			if(mb_strlen($namestr, 'utf8') > 8){
				$add_err_msg = "2级菜单名称不超过8个汉字";
				$isadd_ok = false;
			}
		}

		if(!$isadd_ok){
			$this->error($add_err_msg);
		}


		$db = M('Wxmenu');
		if (!$db->validate($validate)->create()) {
			$this->error($db->getError());
		}
		if($id = $db->add()) {
			$this->success('添加成功',U(GROUP_NAME. '/Wxmenu/index'));
		}else {
			$this->error('添加失败');
		}
	}

	public function edit() {
		//当前控制器名称
		$id = I('id', 0, 'intval');
		$actionName = strtolower($this->getActionName());
		if (IS_POST) {
			$this->editHandle();
			exit();
		}
		$nav = M('Wxmenu')->order('sort')->where("id <> $id AND pid = '0'")->select();
		$this->nav = $nav;

		$vo = M($actionName)->find($id);
		$this->vo = $vo ;
		
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

		$db = M('Wxmenu');
		if (!$db->validate($validate)->create()) {
			$this->error($db->getError());
		}

		if (false !== $db->save()) {
			$this->success('修改成功', U(GROUP_NAME. '/Wxmenu/index', array('pid' => $pid)));
		}else {

			$this->error('修改失败');
		}
		
	}

	//彻底删除
	public function del() {
		$id = I('id',0 , 'intval');
		$batchFlag = intval($_GET['batchFlag']);

		//查询是否有子导航
		$childCate = M('Wxmenu')->where(array('pid' => $id))->select();
		if ($childCate) {
			$this->ajaxReturn(0, "删除失败：请先删除本菜单下的子菜单！", 0);
		}
		if (M('Wxmenu')->delete($id)) {
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
			M('Wxmenu')->where(array('id'=>$k))->setField('sort',$v);		
		}
		$this->ajaxReturn(1, "更新排序成功！", 1);
	}
	
}
?>