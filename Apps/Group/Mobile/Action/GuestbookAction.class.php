<?php
class GuestbookAction extends CommonAction {
	public function index() {	
		//分页
		import('ORG.Util.Page');
		$count = M('guestbook')->count();

		$page = new Page($count, 10);
		$limit = $page->firstRow. ',' .$page->listRows;
		$list = M('guestbook')->order('id DESC')->limit($limit)->select();

		$this->page = $page->show();
		$this->vlist = $list;

		$this->title = '留言本';
		$this->display($this->tpl_file);
	}
	//添加

	public function add() {

		if (!IS_POST) {
			exit();
		}
		$content = I('content', '');
		$data =  I('post.');		
		$verify = I('vcode','','md5');

		if (empty($data['username'])) {
			$this->error('姓名不能为空!');
		}
		if (empty($data['content'])) {
			$this->error('留言内容不能为空!');
		}
		if (checkBadWord($content)) {
			$this->error('留言内容包含非法信息，请认真填写!');
		}

		$data['posttime'] = time();
		$data['ip'] = get_client_ip();
	
		$db = M('guestbook');

		if($id = $db->add($data)) {
			$this->success('添加成功',U(GROUP_NAME. '/Guestbook/index').'/');
		}else {
			$this->error('添加失败');
		}
	}
}
?>