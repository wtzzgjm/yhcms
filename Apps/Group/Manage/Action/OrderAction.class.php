<?php

class OrderAction extends CommonAction {
	public function index() {
		if(IS_POST) {
			if(F('config.ordermail',$_POST,CONF_PATH)) {
				$this->success('修改成功',U(GROUP_NAME. '/Order/index'));
			}else {
				$this->error('修改失败！');
			}
			exit();
		}
		$this->order_mail_sms = C('is_sms_');
		$this->order_mail_acc = C('order_email_acc');
		$this->order_mail_psw = C('order_email_psw');
		$this->order_mail_smtp = C('order_email_smtp');
		$this->order_mail_adds = C('order_email_adds');
		$this->display();
	}

	public function show() {
		//分页
		import('Class.Page', APP_PATH);
		$count = M('ordering')->count();
		$pagerows = I('pagerows', 0, 'intval') ? I('pagerows', 0, 'intval') : 10;
		$page = new Page($count, $pagerows);
		$limit = $page->firstRow. ',' .$page->listRows;

		$orderdata = M('ordering')->order('id desc')->limit($limit)->select();
		foreach ($orderdata as $k => $v) {
			$orderdata[$k]['is_email'] = $v['is_email'] == 1 ? '是' : '否';
		}
		$this->vlist = $orderdata;
		$this->page = $page->show();
		$this->pagerows = $pagerows;
		$this->display();
	}

	public function del () {
		$jg = M('ordering')->where("id='".I('id')."'")->delete();
		if($jg) {
			$this->ajaxReturn(1,'订单删除成功',1);
		}else {
			$this->ajaxReturn(2,'订单删除失败',2);
		}
	}

	public function alldel() {
		if(IS_POST) {
			$idarr = implode(',',I('key'));
			$jg = M('ordering')->where("id IN (".$idarr.")")->delete();
			if($jg) {
				$this->ajaxReturn(1,'批量删除成功',1);
			}else {
				$this->ajaxReturn(1,'批量删除失败',1);
			}
		}
	}

	public function read() {
		$jg = M('ordering')->where("id='".I('id')."'")->find();
		if($jg) {
			M('ordering')->where("id='".I('id')."'")->setField("is_look","1");
			$this->ajaxReturn(1,$jg,1);
		}else {
			$this->ajaxReturn(2,'出错了,未获取到信息',2);
		}
	}
}