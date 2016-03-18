<?php
class IndexAction extends CommonAction{
	public function index(){
		$this->title = C('cfg_webname');
		$this->sitetitle = str_replace('[dq]', '', C('cfg_webtitle'));
		$this->display($this->tpl_file);
	}
}

?>