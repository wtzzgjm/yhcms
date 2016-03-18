<?php
class PublicAction extends CommonAction {
	//增加点击数
	public function click(){	
		$id = I('id', 0, 'intval');
		$tablename = I('tn', '');
		if (C('HTML_CACHE_ON') == true) {
			echo 'document.write('. getClick($id, $tablename) .')';
		}
		else {
			echo getClick($id, $tablename);
		}
	}
	//验证码
	public function verify(){	
		import('ORG.Util.Image');//导入验证码Image类库
		return Image::buildImageVerify(4, 1);
	}
}