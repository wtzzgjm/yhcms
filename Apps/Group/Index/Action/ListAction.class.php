<?php
class ListAction extends CommonAction{
	public function index(){
		$cid = I('cid', 0,'intval');
		$ename = I('e', '', 'htmlspecialchars,trim');
		$cate = getCategory(1);
		import('Class.Category', APP_PATH);	
		
		if (!empty($ename)) {//ename不为空
			$self = Category::getSelfByEName($cate, $ename);//当前栏目信息
		}else {//$cid来判断

			$self = Category::getSelf($cate, $cid);//当前栏目信息
		}		

		if(empty($self)) {
			$this->error('栏目不存在');
		}

		//获取顶级栏目信息
		$getPCate = $this->getPCate($self['id']);
		$getPCate['url'] = getUrl($getPCate);
		$this->pcate = $getPCate;
	
		$cid = $self['id'];//当使用ename获取的时候，就要重新给$cid赋值，不然0
		$_GET['cid'] = $cid;//栏目ID
		$self['url'] = getUrl($self);

		$this->description = $self['description'];
		$self['description'] = htmlspecialchars_decode($self['description']);
		
		$this->cate = $self;
		$this->flag_son = Category::hasChild($cate, $cid);//是否包含子类
		$this->title = empty($self['seotitle']) ? $self['name'] : str_replace('[dq]', session('areasname'), $self['seotitle']);
		$this->keywords = empty($self['keywords']) ? $self['keywords'] : str_replace('[dq]', session('areasname'), $self['keywords']);
		
		$this->cid = $cid;

		$this->url = "List/index/cid/$cid.html";

		$patterns = array('/^List_/', '/.html$/');
		$replacements = array('', '');
		$template_list = preg_replace($patterns, $replacements, $self['template_list']);
		
		if (empty($template_list)) {
			$this->error('模板不存在');
		}

		switch ($self['tablename']) {
			case 'article':
				$this->display('.'.C('TMPL_PATH').MODULE_NAME.'_'.$template_list.'.html');
				return;
				break;
			case 'product':
				$this->display('.'.C('TMPL_PATH').MODULE_NAME.'_'.$template_list.'.html');
				return;
				break;
			case 'picture':
				$this->display('.'.C('TMPL_PATH').MODULE_NAME.'_'.$template_list.'.html');
				return;
				break;	
			case 'page':
				{
					$cate = M('Category')->Field('content')->find($cid);
					$self['content'] = $cate['content'];
					$this->cate = $self;
					$this->display('.'.C('TMPL_PATH').MODULE_NAME.'_'.$template_list.'.html');
				}
				return;
				break;	
			case 'phrase':
				$this->display('.'.C('TMPL_PATH').MODULE_NAME.'_'.$template_list.'.html');
				return;
				break;		
			default:
				$this->error('参数错误');
				break;
		}
		$this->display($this->tpl_file);

	}
	//page
	public function page($cid = 0){
		if($cid == 0) $this->error('参数错误');

		$self = $this->cate;

		$cate = M('Category')->Field('content')->find($cid);
		$self['content'] = $cate['content'];
		$this->cate = $self;
		$this->display('page');
	}

	//page
	public function article($cid = 0){
		
		if($cid == 0) $this->error('参数错误');

		$this->cid = $cid;		
		$this->display('article');
	}
	//product
	public function product($cid = 0){
		if($cid == 0) $this->error('参数错误');
		$this->display('product');
	}

	//picture
	public function picture($cid = 0){
		
		if($cid == 0) $this->error('参数错误');
		$this->display('picture');
	}
}

?>