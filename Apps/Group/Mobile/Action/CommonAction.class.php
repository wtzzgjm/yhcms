<?php
class CommonAction extends Action {
	public function _initialize() {
		$this->mobile_css = C('cfg_mobile_pcolor') != "" ? "style_".C('cfg_mobile_pcolor') : "style";
		

		$this->tpl_file = '.'.C('TMPL_PATH').MODULE_NAME.'_'.ACTION_NAME.'.html';
		$this->tpl_Public_header = '.'.C('TMPL_PATH').'Public_header.html';
		$this->tpl_Public_footer = '.'.C('TMPL_PATH').'Public_footer.html';
		$this->tpl_Public_search = '.'.C('TMPL_PATH').'Public_search.html';//搜索公共页面地址

		$this->tpl_Public_add1 = '.'.C('TMPL_PATH').'Public_add1.html';
		$this->tpl_Public_add2 = '.'.C('TMPL_PATH').'Public_add2.html';
		$this->tpl_Public_add3 = '.'.C('TMPL_PATH').'Public_add3.html';
		$this->tpl_Public_add4 = '.'.C('TMPL_PATH').'Public_add4.html';
		$this->tpl_Public_add5 = '.'.C('TMPL_PATH').'Public_add5.html';
		$this->tpl_Public_add6 = '.'.C('TMPL_PATH').'Public_add6.html';
		$this->tpl_Public_add7 = '.'.C('TMPL_PATH').'Public_add7.html';
		$this->tpl_Public_add8 = '.'.C('TMPL_PATH').'Public_add8.html';
		$this->tpl_Public_add9 = '.'.C('TMPL_PATH').'Public_add9.html';
	}
	public function upsitelink($content){
		$list = M('Sitelink')->where("isok='1'")->order('id desc')->select();
		foreach ($list as $k => $v) {
			$astr = "<a href='".$v['url']."' target='".$v['otype']."'>".$v['name']."</a>";
			$content = str_replace($v['name'], $astr, $content);
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