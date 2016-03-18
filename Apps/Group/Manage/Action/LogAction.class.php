<?php
class LogAction extends CommonAction {
	public function index() {
		//当成一对一来处理 
		$count = M('log')->count();
		import('Class.Page', APP_PATH);
		$page = new Page($count, 10);
		$limit = $page->firstRow. ',' .$page->listRows;
		$log = M('log')->order('log_time desc')->limit($limit)->select() ;	//view

		$this->log = $log;
		$this->page = $page->show();
		$this->display();
	}
}

?>