<?php

class SystemAction extends CommonAction {
	
	public function site() {
		if (IS_POST) {
			if (!strpos($_POST['cfg_weburl'], "://")) {
				$_POST['cfg_weburl'] = "http://".$_POST['cfg_weburl'];
			}
			//保存文件：F(文件名,$array,路径)
			//CONF_PATH == APP_PATH. '/Conf/' == './App/Conf/'
			if(F('config.site',$_POST,CONF_PATH)) {
				$this->success('修改成功',U(GROUP_NAME. '/System/site'));
			}else {
				$this->error('修改失败！');
			}
			exit();
		}
		$this->styleDirList = getFileFolderList('./template/' , 1);

		$this->display();
	}
	//缩略图配置
	public function thumbnail(){
		if (IS_POST) {
			$imgthumb_size = strtoupper($_POST['cfg_imgthumb_size']);
			/*if (empty($imgthumb_size)) {
				$this->error('缩略图组尺寸不能为空');
			}*/
			$_POST['cfg_imgthumb_size']= str_replace(array('，','Ｘ'), array(',','X'), $imgthumb_size);
			$_POST['cfg_imgthumb_width']= str_replace(array('，','Ｘ'), array(',','X'), $_POST['cfg_imgthumb_width']);
			if(F('config.thumbnail',$_POST,CONF_PATH)) {
				$this->success('修改成功',U(GROUP_NAME. '/System/thumbnail'));
			}else {
				$this->error('修改失败！');
			}
			exit();
		}
		$this->display();
	}
	public function mobile() {
		$stylestr = file_get_contents("template/".C('cfg_themestyle')."/Mobile/css/style.txt");
		if ($stylestr) {
			$stylearr = explode("\\", $stylestr);
			$colorarr = array('ff0000','ff6600','eaff00','138a00','00e6c3','0f00a4','9100a6','000000','4c4c4c');
			$jg = array();
			foreach ($colorarr as $k => $v) {
				$jg[$k]['color'] = $v;
				$jg[$k]['show'] = in_array($v, $stylearr) ? 1 : 0;
			}
			$this->colorshow = $jg;
		}

		if (IS_POST) {
			if(F('config.mobile',$_POST,CONF_PATH)) {
				$this->success('修改成功',U(GROUP_NAME. '/System/mobile'));
			}else {
				$this->error('修改失败！');
			}
			exit();
		}
		$this->display();
	}
	public function seo() {
		if (IS_POST) {
			if(F('config.seo',$_POST,CONF_PATH)) {
				$this->success('修改成功',U(GROUP_NAME. '/System/seo'));
			}else {
				$this->error('修改失败！');
			}
			exit();
		}
		$this->cwkey = explode(",", C('cfg_site_cwkey'));
		$this->display();
	}
	public function weixin() {
		if (IS_POST) {
			if(F('config.weixin',$_POST,CONF_PATH)) {
				$this->success('修改成功',U(GROUP_NAME. '/System/weixin'));
			}else {
				$this->error('修改失败！');
			}
			exit();
		}
		$this->token = C('cfg_wx_token') ? C('cfg_wx_token') : 'yhcmswx'.time();
		$this->display();
	}
	public function fun() {
		if (IS_POST) {
			if(F('config.fun',$_POST,CONF_PATH)) {
				$this->success('修改成功',U(GROUP_NAME. '/System/fun'));
			}else {
				$this->error('修改失败！');
			}
			exit();
		}
		$this->display();
	}

	public function url() {
		if (IS_POST) {
			//保存文件：F(文件名,$array,路径)
			//CONF_PATH == APP_PATH. '/Conf/' == './App/Conf/'
			$_url_route_rules = explode("\n", str_replace(array("\t","\r"), array("",""), $_POST['URL_ROUTE_RULES']));
			$url_route_rules = array();
			//$url_route_rules = 'array(';
			foreach ($_url_route_rules as $v) {
				$temparr = explode('=>', $v);
				if (empty($temparr[0]) && empty($temparr[1])) {
					continue;
				}
				$url_route_rules[$temparr[0]] = $temparr[1];
				//$url_route_rules .= "'".$temparr[0]."' => '".$temparr[1]. "',"; 
				
			}
					
			//Index路由开启(自定义)
			$url_model = I('URL_MODEL', 0, 'intval');			
			//$url_model = I('URL_MODEL__INDEX', 0, 'intval');
			$url_route_on = I('URL_ROUTER_ON', 0, 'intval') ? 'true': 'false';
			$url_pathinfo_depr= I('URL_PATHINFO_DEPR', '/');
			$url_pathinfo_depr = str_replace("\\\\", "\\", $url_pathinfo_depr);
			//1和4不能开启路由
			if ($url_model == 0 || $url_model == 3) {
				$url_route_on = 'false';
			}


			//静态缓存开启			
			//$html_cache_on = isset($_POST['HTML_CACHE_ON']) && !empty($_POST['HTML_CACHE_ON']) ? 'true': 'false';

			//Index静态缓存(自定义)
			$html_cache_on__index = isset($_POST['HTML_CACHE_ON__INDEX']) && !empty($_POST['HTML_CACHE_ON__INDEX']) ? 'true': 'false';
			//Mobile静态缓存(自定义)
			$html_cache_on__mobile = isset($_POST['HTML_CACHE_ON__NOBILE']) && !empty($_POST['HTML_CACHE_ON__NOBILE']) ? 'true': 'false';
		

			$html_cache_index_on = I('html_cache_index_on', 0, 'intval');
			$html_cache_list_on = I('html_cache_list_on', 0, 'intval');
			$html_cache_show_on = I('html_cache_show_on', 0, 'intval');			
			$html_cache_special_on = I('html_cache_special_on', 0, 'intval');
			$html_cache_index_time = I('html_cache_index_time', 0, 'intval');
			$html_cache_list_time = I('html_cache_list_time', 0, 'intval');
			$html_cache_show_time = I('html_cache_show_time', 0, 'intval');
			$html_cache_special_time = I('html_cache_special_time', 0, 'intval');

			$html_cache_rules = array();
			if ($html_cache_index_on) {
				$html_cache_rules['index:index'] = array('{:group}/Index_{:action}', $html_cache_index_time);
			}
			if ($html_cache_list_on) {
				$html_cache_rules['list:index'] = array('{:group}/List/{:action}_{e}{cid|intval}_{p|intval}', $html_cache_list_time);
			}
			if ($html_cache_show_on) {
				$html_cache_rules['show:index'] = array('{:group}/Show/{:action}_{e}{cid|intval}_{id|intval}', $html_cache_show_time);
			}

			if ($html_cache_special_on) {
				$html_cache_rules['special:index'] = array('{:group}/Special/{:action}_{cid|intval}_{p|intval}', $html_cache_special_time);//首页
				$html_cache_rules['special:shows'] = array('{:group}/Special/{:action}_{id|intval}', $html_cache_special_time);//页面
			}

			$str = '<?php return array (';
			$str .= "'URL_MODEL' => ". $url_model.',';//禁用，bug
			$str .= "'URL_MODEL__INDEX' => ". $url_model.',';//bug

			$str .= "'URL_PATHINFO_DEPR' => '". $url_pathinfo_depr."',";
			$str .= "'URL_ROUTER_ON' => ". $url_route_on.',';				
			$str .="'URL_ROUTER_ON__INDEX' => ". $url_route_on.',';
			
			$str .="'URL_ROUTE_RULES' => " . str_replace("\\\\", "\\", var_export($url_route_rules,true)) . ",";

			//静态缓存 
			//$str .= "'HTML_CACHE_ON' => ". $html_cache_on.',';	
			$str .= "'HTML_CACHE_ON__INDEX' => ". $html_cache_on__index.',';
			$str .= "'HTML_CACHE_ON__NOBILE' => ". $html_cache_on__mobile.',';
			$str .= "'HTML_CACHE_RULES' => ". var_export($html_cache_rules,true).',';	


			$str .=');?>';

			//print($str);exit();


			//p($url_route_rules);exit();
			//if(F('config.url',$_POST,CONF_PATH)) {
			if(file_put_contents(CONF_PATH.'/config.url.php',$str)) {
				$this->success('修改成功',U(GROUP_NAME. '/System/url'));

			}else {

				$this->error('修改失败！');
			}
			exit();
		}


		//$_url_route_rules = var_export(C("URL_ROUTE_RULES"), true);
		//$url_route_rules = implode("\n", C("URL_ROUTE_RULES"));
		//$url_route_rules = str_replace('\\\\', '\\', $url_route_rules);

		$_url_route_rules = C("URL_ROUTE_RULES");
		$url_route_rules = '';
		foreach ($_url_route_rules as $key => $v) {
			$url_route_rules .= $key. "\t=>\t". $v ."\n";
		}

		$html_cache_rules = C('HTML_CACHE_RULES');
		if (isset($html_cache_rules['index:index'])) {
			$this->html_cache_index_on = true;
			$this->html_cache_index_time = $html_cache_rules['index:index'][1];
		}else {
			$this->html_cache_index_on = false;
			$this->html_cache_index_time = 1200;
		}
		if (isset($html_cache_rules['list:index'])) {
			$this->html_cache_list_on = true;
			$this->html_cache_list_time = $html_cache_rules['list:index'][1];
		}else {
			$this->html_cache_list_on = false;
			$this->html_cache_list_time = 1200;
		}

		if (isset($html_cache_rules['show:index'])) {
			$this->html_cache_show_on = true;
			$this->html_cache_show_time = $html_cache_rules['show:index'][1];
		}else {
			$this->html_cache_show_on = false;
			$this->html_cache_show_time = 1200;		
		}

		//专题
		if (isset($html_cache_rules['special:index'])) {
			$this->html_cache_special_on = true;
			$this->html_cache_special_time = $html_cache_rules['show:index'][1];
		}else {
			$this->html_cache_special_on = false;
			$this->html_cache_special_time = 1200;		
		}



		$this->url_route_rules = $url_route_rules ;
		$this->display();
	}
	public function update() {
		header("Content-Type:text/html; charset=utf-8");//不然返回中文乱码
		//清除缓存
        $this->clearCache();
	}

	public function clearCache($dellog = false) {
		$text = '';
		//清除缓存
		is_dir(DATA_PATH . '_fields/') && delDirAndFile(DATA_PATH . '_fields/', false);
		is_dir(CACHE_PATH) && delDirAndFile(CACHE_PATH, false);//模板缓存（混编后的）
		$text .= '<p>清除模板缓存成功!</p>';
		is_dir(DATA_PATH) && delDirAndFile(DATA_PATH, false);//项目数据（当使用快速缓存函数F的时候，缓存的数据）
		$text .= '<p>清除项目数据成功!</p>';
		is_dir(TEMP_PATH) && delDirAndFile(TEMP_PATH, false);//项目缓存（当S方法缓存类型为File的时候，这里每个文件存放的就是缓存的数据）
		$text .= '<p>清除项目项目缓存成功!</p>';
		if ($dellog) {
			is_dir(LOG_PATH) && delDirAndFile(LOG_PATH, false);//日志
		}
		is_file(RUNTIME_FILE) && @unlink(RUNTIME_FILE);
		$text .= '清除完成';
		$this->text = $text;
        
        $this->display();
	}
	public function keyword() {
		$type = I('type', 0, 'intval');
		$text = '';
		if ($type) {
			$proinfo = M('category')->where("modelid = '3'")->select();
			$cwkey = explode(',', C('cfg_site_cwkey'));
			$info = $this->setKeyword($proinfo, $cwkey, $type);
			if($info) {
				$text .= '<p>关键词生成成功</p>';
			}
		}
		$this->text = $text;
        $this->display();
	}

	public function setKeyword($infolist, $cwkey, $type) {
 		foreach ($infolist as $k => $v) {
 			$seotitle = '';
 			$keyword = '';
 			//判断是否使用的是封面模版
 			if ($v['template_list'] == 'List_product.html') {
 				if ($type == 1) {
	 				$seotitle = $v['name'].'-'.C('cfg_webname');
	 				$keyword = $v['name'].'-'.C('cfg_webname');
	 			}
	 			if ($type == 2) {
	 				$sarr = array();
	 				$karr = array();
	 				foreach ($cwkey as $k2 => $v2) {
						$sarr[] = $v['name'].$v2;
						$karr[] = $v['name'].$v2;
					}
					$seotitle = implode(',', $sarr).'-'.C('cfg_webname');
	 				$keyword = implode(',', $karr).'-'.C('cfg_webname');
	 			}
	 			if ($type == 3) {
					$seotitle = $v['name'].'('.implode(',', $cwkey).')-'.C('cfg_webname');
	 				$keyword = $v['name'].'('.implode(',', $cwkey).')-'.C('cfg_webname');
	 			}
	 			if ($type == 4) {
	 				$sarr = array();
	 				$karr = array();
	 				foreach ($cwkey as $k2 => $v2) {
						$sarr[] = '[dq]'.$v['name'].$v2;
						$karr[] = '[dq]'.$v['name'].$v2;
					}
					$seotitle = implode(',', $sarr).'-'.C('cfg_webname');
	 				$keyword = implode(',', $karr).'-'.C('cfg_webname');
	 			}
	 			if ($type == 5) {
					$seotitle = '[dq]'.$v['name'].'('.implode(',', $cwkey).')-'.C('cfg_webname');
	 				$keyword = '[dq]'.$v['name'].'('.implode(',', $cwkey).')-'.C('cfg_webname');
	 			}
 			}else{
 				//封面模版
 				$hxkey = explode(',', c('cfg_site_hxkey'));
 				if($type == 1 || $type == 2 || $type == 3){
 					$seotitle = c('cfg_site_hxkey').'-'.$v['name'].'-'.C('cfg_webname');
 					$keyword = c('cfg_site_hxkey').'-'.$v['name'].'-'.C('cfg_webname');
 				}
 				if($type == 4 || $type == 5){
 					$sarr = array();
	 				$karr = array();
	 				foreach ($hxkey as $k2 => $v2) {
						$sarr[] = '[dq]'.$v2;
						$karr[] = '[dq]'.$v2;
					}
					$seotitle = implode(',', $sarr).'-'.$v['name'].'-'.C('cfg_webname');
	 				$keyword = implode(',', $karr).'-'.$v['name'].'-'.C('cfg_webname');
 				}
 			}
 			
			$data['seotitle'] = $seotitle;
			$data['keywords'] = $keyword;
			M('category')->where("id = '".$v['id']."'")->save($data);
 		}
 		return true;
	}

	public function guide() {
		if (IS_POST) {
			//先切割,获得http
			$harr = explode('//', C('cfg_weburl'));

			//如果存在协议 则 使用 否则 默认 http
			$http = $harr[0] ? $harr[0] : 'http:';

			//读取原配置文件
			$oldconf = array(
				'cfg_webname'       => C('cfg_webname'),
				'cfg_themestyle'    => C('cfg_themestyle'),
				'cfg_powerby'       => C('cfg_powerby'),
				'cfg_beian'         => C('cfg_beian'),
				'cfg_cookie_encode' => C('cfg_cookie_encode')
			);

			//判断 是否开启 引导页
			if($_POST['cfg_is_guide'] == 1) {
				$oldconf['cfg_weburl'] = $http.'//'.$_SERVER["HTTP_HOST"].'/index.html';
				F('config.site',$oldconf,CONF_PATH);
			}else {
				$oldconf['cfg_weburl'] = $http.'//'.$_SERVER["HTTP_HOST"];
				F('config.site',$oldconf,CONF_PATH);
			}
			$this->clearCacheNoText();
			
			if(F('config.guide',$_POST,CONF_PATH)) {
				$this->success('修改成功',U(GROUP_NAME. '/System/guide'));
			}else {
				$this->error('修改失败！');
			}
			exit();
		}
		$this->display();
	}

	public function clearCacheNoText($dellog = false) {
		//清除缓存
		is_dir(DATA_PATH . '_fields/') && delDirAndFile(DATA_PATH . '_fields/', false);
		is_dir(CACHE_PATH) && delDirAndFile(CACHE_PATH, false);//模板缓存（混编后的）

		is_dir(DATA_PATH) && delDirAndFile(DATA_PATH, false);//项目数据（当使用快速缓存函数F的时候，缓存的数据）

		is_dir(TEMP_PATH) && delDirAndFile(TEMP_PATH, false);//项目缓存（当S方法缓存类型为File的时候，这里每个文件存放的就是缓存的数据）

		if ($dellog) {
			is_dir(LOG_PATH) && delDirAndFile(LOG_PATH, false);//日志
		}
		is_file(RUNTIME_FILE) && @unlink(RUNTIME_FILE);

	}
}
?>