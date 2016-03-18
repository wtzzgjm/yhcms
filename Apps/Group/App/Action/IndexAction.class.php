<?php
class IndexAction extends CommonAction{
	public function index(){
		$this->title = C('cfg_webname');
		$this->display($this->tpl_file);
	}
}
?>