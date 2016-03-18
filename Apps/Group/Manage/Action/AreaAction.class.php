<?php

class AreaAction extends CommonAction{
	
	public function index(){
		$pid = I('pid', 0,'intval');

		//分页
		import('Class.Page', APP_PATH);
		$count = M('area')->where(array('pid' => $pid))->count();

		$page = new Page($count, 50);
		$limit = $page->firstRow. ',' .$page->listRows;
		$list = M('area')->where(array('pid' => $pid))->order('sort,id')->limit($limit)->select();
		foreach ($list as $k => $v) {
			$list[$k]['cnum'] = M('area')->where("pid='".$v['id']."' AND is_top = 1")->count();
		}
		$this->page = $page->show();
		$this->vlist = $list;
		$this->pid = $pid;
		$this->type = '地区列表';

		$this->display();
	}

	public function add() {
		//当前控制器名称
		$actionName = strtolower($this->getActionName());

		if (IS_POST) {
			//M验证
			
			$data['id'] = M('area')->max('id') + 1;

			$data['name'] = I('name', '', 'trim');
			$data['sname'] = I('sname', '', 'trim');
			$data['ename'] = I('ename', '', 'trim');
			$data['pid'] = I('pid', 0, 'intval');			
			$data['sort'] = I('sort',  0, 'intval');
			$is_top = I('is_top',  0, 'intval');
			$data['is_top'] = $is_top[0];

			if (empty($data['name'])) {
				$this->error('名称不能为空');
			}
			if (empty($data['sname'])) {
				$this->error('简称不能为空');
			}

			$vo = M('area')->where(array('name' => $data['name']))->find();
			if ($vo) {
				$this->error('区域名称已经存在，请重新填写');
			}

			if (false !== M('area')->add($data)) {
				$this->success('添加成功',U(GROUP_NAME. '/Area/index', array('pid' => $data['pid'])));
			}else {

				$this->error('添加失败');
			}
			exit();
		}

		$pid = I('pid', 0, 'intval');
		$this->pid = $pid;

		import('Class.Category', APP_PATH);
		$arealist = M($actionName)->order('sort')->select();
		$this->arealist = Category::unlimitedForLevel($arealist, '- - - ', 0);

		$this->type = '添加区域信息';
		$this->display();
	}

	//编辑
	public function edit() {
		//当前控制器名称
		$id = I('id', 0, 'intval');
		$pid = I('pid', 0, 'intval');
		$actionName = strtolower($this->getActionName());

		if (IS_POST) {
			//M验证
			$data['id'] = I('id',  0, 'intval');
			$data['name'] = I('name', '', 'trim');
			$data['sname'] = I('sname', '', 'trim');
			$data['ename'] = I('ename', '', 'trim');
			$data['pid'] = I('pid', 0, 'intval');			
			$data['sort'] = I('sort',  0, 'intval');
			$is_top = I('is_top',  0, 'intval');
			$data['is_top'] = $is_top[0];

			if (empty($data['name'])) {
				$this->error('名称不能为空');
			}
			if (empty($data['sname'])) {
				$this->error('简称不能为空');
			}

			if (empty($data['id'])) {
				$this->error('参数错误');
			}
			$vo = M('area')->where(array('id' => array('neq', $data['id']), 'name' => $data['name']))->find();
			if ($vo) {
				$this->error('区域名称已经存在，请重新填写');
			}

			if (false !== M('area')->save($data)) {
				$this->success('修改成功',U(GROUP_NAME. '/Area/index', array('pid' => $data['pid'])));
			}else {

				$this->error('修改失败');
			}
			exit();
		}

		$this->vo = M($actionName)->find($id);
		if ($pid) {
			$pinfo = M($actionName)->find($pid);
			$this->pname = $pinfo['name'];
		}else {
			$this->pname = '顶级';
		}

		import('Class.Category', APP_PATH);
		$arealist = M($actionName)->order('sort')->select();
		$this->arealist = Category::unlimitedForLevel($arealist, '- - - ', 0);

		$this->type = '修改区域信息';
		$this->display();
	}


	//批量更新排序
	public function sort() {
		$pid = intval($_GET['pid']);
		$actionName = strtolower($this->getActionName());
		//exit();
		foreach ($_POST as $k => $v) {
			if ($k == 'key') {
				continue;
			}
			M($actionName)->where(array('id'=>$k))->setField('sort',$v);
			//echo 'id:'.$k.'___v:'.$v.'<br/>';//debug
		}
		$this->ajaxReturn(1, "更新排序成功！", 1);
		//$this->redirect(GROUP_NAME. '/Area/index', array('pid' => $pid));
	}
	//ajax更改是否推荐
	public function upis_top(){
		$id = I('id', 0, 'intval');;
		$area = D('Area')->where(array('id' => $id))->find();
		$area['is_top'] = $area['is_top'] == 1 ? 0 : 1 ;
		D('Area')->save($area);
		$this->ajaxReturn(1, "更改推荐成功！", $area['is_top']);
	}

	public function del() {
		$id = I('id',0 , 'intval');
		$batchFlag = I('get.batchFlag', 0, 'intval');
		//批量删除
		if ($batchFlag) {
			$this->clearBatch();
			return;
		}
		$pid = I('get.pid', 0, 'intval');
		$childarea = M('Area')->where(array('pid' => $id))->select();
		if ($childCate) {
			$this->ajaxReturn(0, "删除失败：请先删除本区域下的子区域！", 0);
		}

		if (M('Area')->delete($id)) {
			$this->ajaxReturn(1, "彻底删除成功！", 1);
		}else {
			$this->ajaxReturn(0, "彻底删除失败！", 0);
		}
	}

	public function clearBatch() {
		$idArr = I('key',0 , 'intval');		
		$pid = I('get.pid', 0, 'intval');
		if (!is_array($idArr)) {
			$this->ajaxReturn(0, "请选择要测底删除的项！", 0);
		}
		$where = array('id' => array('in', $idArr));
		$modelid = D('ArticleView')->where(array('id' => $idArr[0]))->getField('modelid');//

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

	public function createJsArea(){
		if (getJsOfCity()) {
			$this->success('生成js成功',U(GROUP_NAME. '/Area/index', array('pid' => 0)));
		}else {
			$this->success('生成js失败');
		}
	}


	//批量推荐
	public function batchis_top() {
		$a = M('area')->where("id IN (".implode(',',I('key')).")")->setField('is_top','1');
		if($a) {
			$this->ajaxReturn(1,'批量推荐成功!',1);
		}else {
			$this->ajaxReturn(2,'批量推荐失败!',2);
		}
		exit();
	}

	//批量取消推荐
	public function no_top() {
		$a = M('area')->where("id IN (".implode(',',I('key')).")")->setField('is_top','0');
		if($a) {
			$this->ajaxReturn(1,'取消推荐成功!',1);
		}else {
			$this->ajaxReturn(2,'取消推荐失败!',2);
		}
		exit();
	}

	public function autoadd() {
		$dq = "'北京','天津','上海','重庆','新疆','乌鲁木齐','宁夏区','银川市','内蒙古','呼和浩特','包头市','锡林浩特','二连浩特','广西','南宁','桂林','河池','黑龙江','哈尔滨','大庆','吉林','长春','辽宁','沈阳','大连','丹东','河北','石家庄','唐山','保定','山东','济南','青岛','淄博','东营','泰安','临沂','江苏','南京','昆山','常州','无锡','苏州','如皋','镇江','徐州','连云港','盐城','扬州','泰州','南通','宿迁','江阴','金坛','溧阳','常熟','张家港','太仓','吴江','海门','启东','东台','高邮','仪征','丹阳','扬中','句容','泰兴','姜堰','靖江','兴化','安徽','合肥','蚌埠','马鞍山','桐城','浙江','杭州','嘉兴','宁波','金华','温州','台州','义乌','丽水','绍兴','舟山','衢州','建德','余饶','奉化','乐清','诸暨','永康','福建','福州','厦门','泉州','广东','广州','深圳','汕头','惠州','珠海','河源','东莞','中山','海南','海口','三亚','云南','昆明','曲靖','大理','贵州','贵阳','六盘水','遵义','四川','成都','绵阳','自贡','湖南','长沙','株洲','岳阳','湖北','武汉','襄樊','河南','郑州','洛阳','开封','安阳','新乡','许昌','南阳','驻马店','山西','太原','大同','陕西','西安','咸阳','宝鸡','甘肃','兰州','嘉峪关','天水','青海','西宁','江西','南昌','九江','赣州'";

		$where = "(name IN(".$dq.")) OR (sname IN(".$dq."))";
		$data['is_top'] = 1;
		$id = M('Area')->where($where)->save($data);

		if($id) {
			$this->success('操作成功');
		}else {
			$this->error('操作失败');
		}
	}

	public function autocancel() {
		$where = 'is_top = 1';
		$data['is_top'] = 0;
		$id = M('Area')->where($where)->save($data);

		if($id) {
			$this->success('操作成功');
		}else {
			$this->error('操作失败');
		}
	}
}
?>