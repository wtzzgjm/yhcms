<?php
class EmptyAction extends Action {
	function _empty() {
		$this->display('./Apps/Group/Manage/Tpl/Public_404.html');
	}
	public function index() {
		$this->display('./Apps/Group/Manage/Tpl/Public_404.html');
	}
}
?>