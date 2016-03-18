<?php
/***
***公共验证控制器CommonAction
***/
class CommonAction extends Action {
	//_initialize自动运行方法，在每个方法前，系统会首先运动这个方法
	public function _initialize() {
		$url_str = $_SERVER['SERVER_NAME'];
		//$url = C('MASTER_URL').'/index.php?m=Api&a=get_cc&url='.$url_str;  
		//$html = file_get_contents($url);  
		/*if($html != "1"){
			$html = file_get_contents(C('MASTER_URL').'/error.html');
			echo($html);
			exit();
		}*/

		//模板路径
		$this->tpl_file = '.'.C('TMPL_PATH').MODULE_NAME.'_'.ACTION_NAME.'.html';
		$this->tpl_Public_header = '.'.C('TMPL_PATH').'Public_header.html';
		$this->tpl_Public_footer = '.'.C('TMPL_PATH').'Public_footer.html';
		$this->tpl_Public_search = '.'.C('TMPL_PATH').'Public_search.html';

		$this->tpl_Public_add1 = '.'.C('TMPL_PATH').'Public_add1.html';
		$this->tpl_Public_add2 = '.'.C('TMPL_PATH').'Public_add2.html';
		$this->tpl_Public_add3 = '.'.C('TMPL_PATH').'Public_add3.html';
		$this->tpl_Public_add4 = '.'.C('TMPL_PATH').'Public_add4.html';
		$this->tpl_Public_add5 = '.'.C('TMPL_PATH').'Public_add5.html';
		$this->tpl_Public_add6 = '.'.C('TMPL_PATH').'Public_add6.html';
		$this->tpl_Public_add7 = '.'.C('TMPL_PATH').'Public_add7.html';
		$this->tpl_Public_add8 = '.'.C('TMPL_PATH').'Public_add8.html';
		$this->tpl_Public_add9 = '.'.C('TMPL_PATH').'Public_add9.html';
		
		$lock = 'Data/install.lock';
		if(!is_file($lock)){
			$this->redirect('/install/index');
		}
		//update site
		if(file_get_contents("http://www.baidu.com")){
			$url_str = $_SERVER['SERVER_NAME'];
			$url = C('MASTER_URL').'/index.php?m=Api&a=set_site&url='.$url_str."&title=".C('cfg_webname');
			file_get_contents($url);
		}

		$area_ename = I('diqu', '', 'trim');
		if($area_ename) {
			$areaobj = M('Area')->where("ename='$area_ename'")->find();
			if($areaobj){
				$this->areaobj = $areaobj;
				$this->areasname = $areaobj['sname'];
				$this->areaurl = "diqu_".$areaobj['ename'];
				session('areasname', $this->areasname);
				session('areaurl', $this->areaurl);
			} else{
				session('areasname', null);
				session('areaurl', null);
			}
		} else {
			session('areasname', null);
			session('areaurl', null);
		}

		//获取分站列表
		$arealist = M('Area')->where("is_top='1'")->select();
		$this->arealist = $arealist;
	}
	//更新关键词内链
	public function upsitelink($content){
		$list = M('Sitelink')->where("isok='1'")->order('id desc')->select();
		foreach ($list as $k => $v) {
			$astr = "<a href='".$v['url']."' target='".$v['otype']."'>".$v['name']."</a>";
			$v['num'] =  empty($v['num']) ? -1 : $v['num'];
			$content = str_replace_limit($v['name'], $astr, $content, $v['num']);
		}
		return $content;
	}

	public function getPCate($cid) {
		$cateinfo = M('Category')->where("id = '$cid'")->find();
		if($cateinfo['pid'] != 0) {
			$cateinfo = $this->getPCate($cateinfo['pid']);
		}
		return $cateinfo;
	}
}
?>