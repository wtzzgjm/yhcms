<?php
class NavwapAction extends CommonAction {
	
	
	public $icostr = array('fa-home','fa-globe','fa-file-picture-o','fa-refresh','fa-user-plus','fa-mobile-phone','fa-phone','fa-comments','fa-map-marker','fa-pencil','fa-file-o','fa-file','fa-align-justify','fa-user','fa-picture-o','fa-envelope','fa-barcode','fa-tint','fa-truck','fa-edit','fa-gift','fa-warning','fa-trophy','fa-bullhorn','fa-thumbs-up','fa-shopping-cart','fa-star','fa-video-camera');
	
	public function index() {		
		//分页
		$nav = M('Nav_wap')->order('sort')->select();
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
		$this->type = '菜单列表';

		$this->display();
	}
	//添加
	public function add() {
		//当前控制器名称		
		$actionName = strtolower($this->getActionName());

		$ncount = M('Nav_wap')->count();
		/*if ($ncount == 5) {
			$this->error('添加失败，菜单数已达到上限 5 个，请删除后再添加');
		}*/
		if (IS_POST) {
			$this->addHandle();
			exit();
		}
		$cate = M('category')->order('sort')->select();
		import('Class.Category', APP_PATH);
		$this->cate = Category::unlimitedForLevel($cate, '---', 0);

		$nav = M('Nav_wap')->order('sort')->select();
		$this->nav = Category::unlimitedForLevel($nav, '- - - ', 0);
		$this->icolist = $this->icostr;
		$this->display();
	}

	//
	public function addHandle() {
		//M验证
		$id = I('id', 0, 'intval');
		$pid = I('pid', 0, 'intval');
		$validate = array(
			array('name','require','菜单名称不能为空！'), 
			array('sort','require','排序数值不能为空！'), 
		);

		$db = M('Nav_wap');

		if (!$db->validate($validate)->create()) {
			$this->error($db->getError());
		}

		$data = $_POST;
		switch ($data['navtype']) {
			case '1':
				$data['url'] = $data['tel'];
				break;
			case '2':
				$data['url'] = $data['qq'];
				break;
			case '3':
				$data['url'] = $data['mapurl'];
				break;
			case '4':
				$data['url'] = '/';
				break;
		}

		if($db->add($data)) {
			$this->success('添加成功',U(GROUP_NAME. '/Navwap/index'));
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

		$nav = M('Nav_wap')->order('sort')->where("id <> $id")->select();
		$this->nav = Category::unlimitedForLevel($nav, '- - - ', 0);

		$vo = M('Nav_wap')->find($id);
		$this->vo = $vo ;
		$this->isrelock = strstr($vo['url'], '@');
		$this->icolist = $this->icostr;
		$this->display();
	}


	//修改处理
	public function editHandle() {
		//M验证
		$id = I('id', 0, 'intval');
		$validate = array(
			array('name','require','菜单名称不能为空！'), 
			array('sort','require','排序数值不能为空！'),  
		);

		$db = M('Nav_wap');
		if (!$db->validate($validate)->create()) {
			$this->error($db->getError());
		}
		$data = $_POST;
		switch ($data['navtype']) {
			case '1':
				$data['url'] = $data['tel'];
				break;
			case '2':
				$data['url'] = $data['qq'];
				break;
			case '3':
				$data['url'] = $data['mapurl'];
				break;
			case '4':
				$data['url'] = '/';
				break;
		}

		if (false !== $db->save($data)) {
			$this->success('修改成功', U(GROUP_NAME. '/Navwap/index', array('pid' => $pid)));
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
		if (M('Nav_wap')->delete($id)) {
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
		$db = M('Nav_wap');
		$mlist = $db->where(array('id' => array('in', $idArr)))->select();
		$jg = 0;
		$error = 0;
		foreach ($mlist as $k => $v) {
			//查询是否有子类
			if ($db->delete($v['id'])) {
				$jg = $jg + 1;
			}
		}
		//更新栏目缓存
		if ($jg) {
			$this->ajaxReturn(1, "批量删除成功！", 1);
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
			M('Nav_wap')->where(array('id'=>$k))->setField('sort',$v);
			//echo 'id:'.$k.'___v:'.$v.'<br/>';//debug			
		}
		$this->ajaxReturn(1, "更新排序成功！", 1);
		//$this->redirect(GROUP_NAME. '/Category/index');
	}
}
?>