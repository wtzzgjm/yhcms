<?php
class CategoryAction extends CommonAction {
	//分类列表
	public function index() {
		//CategoryView 视图模型
		$cate = D('CategoryView')->order('category.sort')->select();
		//$cate = getCategory();
		import('Class.Category', APP_PATH);
		$this->cate = Category::unlimitedForLevel($cate, '&nbsp;&nbsp;&nbsp;&nbsp;', 0);

		$this->display();
	}
	//添加分类
	public function add() {
		if (IS_POST) {
			$this->addHandle();
			exit();
		}
		$this->pid = I('pid', 0, 'intval');
		$cate = M('category')->order('sort')->select();
		import('Class.Category', APP_PATH);
		$this->cate = Category::unlimitedForLevel($cate, '---',0);
		$this->mlist = M('model')->where(array('status' => 1))->order('sort')->select();
		$this->styleListList = getFileFolderList('./template/'.C('cfg_themestyle').'/Index' , 2, 'List_*');
		$this->styleShowList = getFileFolderList('./template/'.C('cfg_themestyle').'/Index' , 2, 'Show_*');
		$mid = M('category')->where("id = '".I('id', 0, '')."'")->find();
		if($mid['modelid'] == 3 && $mid['pid'] == 0) {
			$this->mid = 3; //顶级产品栏目
		}

		$data = M('category')->find($this->pid);
		$this->data = $data;

		$this->display();
	}
	//添加分类处理
	public function addHandle() {
		$data = I('post.', '');
		$data['name'] = trim($data['name']);
		$data['litpic'] = trim($data['litpic']);
		$data['ename'] = trim($data['ename']);		
		$data['type'] = empty($data['type'])? 0 : intval($data['type']);

		if (isset($data['type']) && $data['type'] ==1 ) {
			$data['modelid'] = 0;
		}
		//M验证
		if (empty($data['name'])) {
			$this->error('栏目名称不能为空！');
		}
		if (empty($data['ename'])) {
			$data['ename'] = get_pinyin(iconv('utf-8','gb2312//ignore',$data['name']),0);
		}elseif ($data['type'] == 0) {
			if (!ctype_alnum(str_replace("_", "", $data['ename']))) {
				$this->error('别名只能由字母和数字组成，不能包含特殊字符！');
			}
		}
		if (M('category')->where("ename='".$data['ename']."'")->find()) {
			$this->error('别名已存在，请重新输入！');
		}

		//产品模型自动生成关键词
		/*if($data['modelid'] == 3) {
			$cwkey = explode(',', C('cfg_site_cwkey'));
			$seotitle = array();
			$keyword = array();
			foreach ($cwkey as $k => $v) {
				$seotitle[] = '[dq]'.$data['name'].$v;
				$keyword[] = '[dq]'.$data['name'].$v;
			}
			$data['seotitle'] = implode(',', $seotitle);
			$data['keywords'] = implode(',', $keyword);
		}*/
	
		if (M('category')->add($data)) {
			getCategory(0,1);//清除栏目缓存
			getCategory(1,1);//清除栏目缓存
			getCategory(2,1);//清除栏目缓存
			$this->success('添加栏目成功<script type="text/javascript" language="javascript">window.parent.get_cate();</script>',U(GROUP_NAME. '/Category/add'));
		}else {
			$this->error('添加栏目失败');
		}
	}


	//修改分类
	public function edit() {
		if (IS_POST) {
			$this->editHandle();
			exit();
		}
		$id = I('id', 0, 'intval');
		$data = M('category')->find($id);
		if (!$data) {
			$this->error('记录不存在');
		}
		$this->data = $data;
		$cate = M('category')->order('sort')->select();
		import('Class.Category', APP_PATH);
		$this->cate = Category::unlimitedForLevel($cate, '---',0);
		$this->mlist = M('model')->where(array('status' => 1))->order('sort')->select();		
		$this->styleListList = getFileFolderList('./template/'.C('cfg_themestyle').'/Index' , 2, 'List_*');
		$this->styleShowList = getFileFolderList('./template/'.C('cfg_themestyle').'/Index' , 2, 'Show_*');
		
		$mid = M('category')->where("id = '".I('id', 0, '')."'")->find();
		if($mid['modelid'] == 3 && $mid['pid'] == 0) {
			$this->mid = 3; //顶级产品栏目
		}
		
		$this->display();
	}

	//修改分类处理
	public function editHandle() {
		$data = I('post.', '');				
		$id = $data['id'] = intval($data['id']);
		$pid = $data['pid'];
		$data['name'] = trim($data['name']);
		$data['litpic'] = trim($data['litpic']);
		$data['ename'] = trim($data['ename']);		
		$data['type'] = empty($data['type'])? 0 : intval($data['type']);

		if (isset($data['type']) && $data['type'] ==1 ) {
			$data['modelid'] = 0;
		}

		if ($id == $pid) {
			$this->error('失败！不能设置自己为自己的子栏目，请重新选择父级栏目');
		}
		//M验证
		if (empty($data['name'])) {
			$this->error('栏目名称不能为空！');
		}
		if (empty($data['ename'])) {
			$data['ename'] = get_pinyin(iconv('utf-8','gb2312//ignore',$data['name']),0);
		}elseif ($data['type'] == 0) {
			if (!ctype_alnum(str_replace("_", "", $data['ename']))) {
				$this->error('别名只能由字母和数字组成，不能包含特殊字符！');
			}
		}
		if (M('category')->where(array('ename' => $data['ename'], 'id' => array('neq' , $id)))->find()) {
			$this->error('别名已存在，请重新输入！');
		}

		//产品模型自动生成关键词
		/*if($data['modelid'] == 3) {
			$cwkey = explode(',', C('cfg_site_cwkey'));
			$seotitle = array();
			$keyword = array();
			foreach ($cwkey as $k => $v) {
				$seotitle[] = '[dq]'.$data['name'].$v;
				$keyword[] = '[dq]'.$data['name'].$v;
			}
			$data['seotitle'] = implode(',', $seotitle);
			$data['keywords'] = implode(',', $keyword);
		}
*/
		if (false !== M('category')->save($data)) {
			getCategory(0,1);//清除栏目缓存
			getCategory(1,1);
			getCategory(2,1);
			$this->success('修改栏目成功<script type="text/javascript" language="javascript">window.parent.get_cate();</script>',U(GROUP_NAME. '/Category/index'));
		}else {
			$this->error('修改栏目失败');
		}
	}

	//批量更新排序
	public function sort() {
		foreach ($_POST as $k => $v) {
			if ($k == 'key') {
				continue;
			}
			M('category')->where(array('id'=>$k))->setField('sort',$v);
			//echo 'id:'.$k.'___v:'.$v.'<br/>';//debug			
		}
		$this->ajaxReturn(1, "更新排序成功！", 1);
		//$this->redirect(GROUP_NAME. '/Category/index');
	}

	//修改分类处理
	public function del() {
		$id = I('id', 0, 'intval');
		$batchFlag = I('get.batchFlag', 0, 'intval');
		//批量删除
		if ($batchFlag) {
			$this->delBatch();
			return;
		}
		//查询是否有子类
		$childCate = M('category')->where(array('pid' => $id))->select();
		if ($childCate) {
			$this->ajaxReturn(0, "删除失败：请先删除本栏目下的子栏目！", 0);
		}
		$cdata = M('category')->where(array('id' => $id))->find();
		if (M('category')->delete($id)) {

			if ($cdata['modelid'] == 1) {
				//文章
				$m = M('article');
			}
			if ($cdata['modelid'] == 3) {
				//产品
				$m = M('article');
			}
			if ($cdata['modelid'] == 4) {
				//案例
				$m = M('article');
			}
			if ($m) {
				$m->where("cid='".$cdata['id']."'")->setField(array('status'=>'1'));
			}
			
			//更新栏目缓存
			getCategory(0, 1);
			getCategory(1, 1);
			getCategory(2, 1);
			$this->ajaxReturn(1, "删除栏目成功！", 1);
		}else {
			$this->ajaxReturn(0, "删除栏目失败!", 0);
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
		$mlist = M('category')->where(array('id' => array('in', $idArr)))->select();
		$jg = 0;
		$error = 0;
		foreach ($mlist as $k => $v) {
			//查询是否有子类
			$childCate = M('category')->where(array('pid' => $v['id']))->select();
			if ($childCate) {
				$error = $error + 1;
			}else{
				$cdata = M('category')->where(array('id' => $v['id']))->find();
				if (M('category')->delete($v['id'])) {

					if ($cdata['modelid'] == 1) {
						//文章
						$m = M('article');
					}
					if ($cdata['modelid'] == 3) {
						//产品
						$m = M('article');
					}
					if ($cdata['modelid'] == 4) {
						//案例
						$m = M('article');
					}
					if ($m) {
						$m->where("cid='".$cdata['id']."'")->setField(array('status'=>'1'));
					}
					$jg = $jg + 1;
				}
			}
			
		}
		//更新栏目缓存
			
		/////////////////////////////
		if ($jg) {
			getCategory(0, 1);
			getCategory(1, 1);
			getCategory(2, 1);
			if ($error) {
				$this->ajaxReturn(1, "批量删除成功,有 $error 条记录是存在子栏目的不能进行删除！", 1);
			}else{
				$this->ajaxReturn(1, "批量删除成功！", 1);
			}
			
		}else {
			$this->ajaxReturn(0, "批量删除失败！", 0);
		}
	}

	//验证是否为顶级栏目，是顶级栏目返回提示信息
	public function getmessage() {
		$cid = I('cid', 1, 'intval');
		$clist = M('Category')->where("pid='$cid'")->select();

		if ($clist) {
			$str = "<font color='red'>友情提示：非终极栏目建议用封面页模板进行数据调用，不要直接添加数据。</font>";
			$this->ajaxReturn(1, $str, 1);
		}else{
			$str = "";
			$this->ajaxReturn(0, $str, 0);
		}
	}

	//排序ajax请求
	public function pxajax() {
		if(IS_POST) {
			$jg = M('Category')->where("id='".I('cid')."'")->save(array('sort'=>I('val')));
			if($jg) {
				$this->ajaxReturn(1, 1,1);//更新排序成功
			}
		}
	}
}
?>