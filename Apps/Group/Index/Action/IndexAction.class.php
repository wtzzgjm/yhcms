<?php
class IndexAction extends CommonAction{
	public function index(){
		if(C('cfg_is_guide') == 1) {
			$guuide_tpl = '.'.C('TMPL_PATH').MODULE_NAME.'_default.html';
			$this->display($guuide_tpl);
			exit();
		}
		goMobile();

		//延时发布判断
		$ys_data_ = M('article')->where("status='1' AND publish = '1'")->select();
		foreach ($ys_data_ as $k => $v) {
			if($v['publishtime'] <= time()) {
				$ys_data_[$k]['status'] = 0;
				$ys_data_[$k]['publish'] = 0;
				M('article')->save($ys_data_[$k]);
			}
		}

		$this->title = C('cfg_webname');
		$this->sitetitle = str_replace('[dq]', session('areasname'), C('cfg_webtitle'));
		$this->sitekeywords = str_replace('[dq]', session('areasname'), C('cfg_keywords'));
		$this->sitedescription = str_replace('[dq]', session('areasname'), C('cfg_description'));
		$this->display($this->tpl_file);
	}
	public function diqu(){
		//遍历地区如果为空则检测生成
		$area = M('area')->order('sort')->select();
		foreach ($area as $k => $v) {
			if($v['ename'] == "") {
				$v['ename'] = get_pinyin(iconv('utf-8','gb2312//ignore', $v['sname']),0);
				M('area')->save($v);
			}
		}
		$this->rmlist = M('area')->where("is_top='1'")->order('sort')->select();

		$zmlist = array();
		for($i=ord("a"); $i <= ord("z"); $i++){
			$dqzm = array();
			$dqzm['name'] = chr($i);
			$dqzm['vv'] = M('area')->where("ename like '".chr($i)."%'")->order('sort')->select();
		  	$zmlist[$i] = $dqzm;
		}
		$this->zmlist = $zmlist;
		$this->display($this->tpl_file);
	}

	public function weixinapi() {

		define("TOKEN", C('cfg_wx_token'));
		define("APPID", C('cfg_wx_appid'));
		define("APPSECRET", C('cfg_wx_appsecret'));
		import('Class.ThinkWechat', APP_PATH);
		$weixin = new ThinkWechat();
		
		if($_GET["echostr"]){
			$weixin->valid();
		} elseif ($_GET["type"] == "set_menu") {
			//更新自定义菜单
			$menustr = '{"button":[';
			$wxmenu = M('Wxmenu')->where("pid = '0'")->order('sort')->select();
			$isone = true;
			foreach ($wxmenu as $k => $v) {
				if (!$isone) {
					$menustr .= ',';
				}
				$wx = M('Wxmenu')->where("pid = '".$v['id']."'")->order('sort')->select();
				if ($wx) {
					$menustr .= '{';
					$menustr .= '"name":"'.$v['name'].'",';
					$menustr .= '"sub_button":[';
					$isone1 = true;
					foreach ($wx as $k1 => $v1) {
						if (!$isone1) {
							$menustr .= ',';
						}
						$menustr .= '{';
						$menustr .= '"type":"view",';
						$menustr .= '"name":"'.$v1['name'].'",';
						$menustr .= '"url":"'.$v1['url'].'"';
						$menustr .= '}';
						$isone1 = false;
					}
            		$menustr .= ']}';
				} else{
					$menustr .= '{';
					$menustr .= '"type":"view",';
					$menustr .= '"name":"'.$v['name'].'",';
					$menustr .= '"url":"'.$v['url'].'"';
					$menustr .= '}';
				}

				$isone = false;
			}
			$menustr .= ']}';
			$text = $weixin->set_diymenu($menustr);
			header("Content-Type:text/html; charset=utf-8");
			echo "<font color='red'>状态码：".$text."";
			echo "<br><h3>提示</h3><hr>";
			
			echo '成功状态码：'.'{"errcode":0,"errmsg":"ok"}'."</br>";
			echo '错误示例码：'.'{"errcode":40018,"errmsg":"invalid button name size"}'."</br>";
			echo '错误码对应表：'.'<a href="http://mp.weixin.qq.com/wiki/index.php?title=%E5%85%A8%E5%B1%80%E8%BF%94%E5%9B%9E%E7%A0%81%E8%AF%B4%E6%98%8E" target="_blank">点击查看</a>'."</font></br>";
		} elseif ($_GET["type"] == "get_menu") {
			$text = $weixin->get_diymenu();
			var_dump($text);
		} else{
			$data = $weixin->responseMsg();
		}
		
	}

	public function sitemap(){
		$this->display($this->tpl_file);
	}

	public function tag(){
		$tag = I('tag', '', 'htmlspecialchars,trim');
		$tag = mb_convert_encoding($tag, "UTF-8", "GBK");

		$this->tag = $tag;
		$this->display($this->tpl_file);
	}

	public function home() {
		goMobile();
		
		//延时发布判断
		$ys_data_ = M('article')->where("status='1' AND publish = '1'")->select();
		foreach ($ys_data_ as $k => $v) {
			if($v['publishtime'] <= time()) {
				$ys_data_[$k]['status'] = 0;
				$ys_data_[$k]['publish'] = 0;
				M('article')->save($ys_data_[$k]);
			}
		}

		$this->title = C('cfg_webname');
		$this->sitetitle = str_replace('[dq]', session('areasname'), C('cfg_webtitle'));
		$this->sitekeywords = str_replace('[dq]', session('areasname'), C('cfg_keywords'));
		$this->sitedescription = str_replace('[dq]', session('areasname'), C('cfg_description'));

		$index_tpl = '.'.C('TMPL_PATH').MODULE_NAME.'_index.html';
		$this->display($index_tpl);
	}

}
?>