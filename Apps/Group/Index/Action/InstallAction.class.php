<?php
class InstallAction extends Action{
	public function _initialize() {
		$this->lock = 'Data/install.lock';
		if(is_file($this->lock)){
			$this->redirect("/");
		}
	}
	public function index(){
		$this->display();
	}
	public function setup1(){
		$this->check_env = check_env();
    	$this->check_func = check_func();
    	$this->check_dirfile = check_dirfile();
		$this->display();
	}
	public function setup2(){
		$this->display();
	}
	public function setup3(){
		$this->display();
		if (IS_POST) {
			//检测信息
	        $data = I('post.');
	        if(!$data['DB_HOST']){
	        	show_msg('请填写数据库地址！',false);
	        }
	        if(!$data['DB_PORT']){
	        	show_msg('请填写数据库端口！',false);
	        }
	        if(!$data['DB_NAME']){
	        	show_msg('请填写数据库名称！',false);
	        }
	        if(!$data['DB_USER']){
	        	show_msg('请填写数据库用户名！',false);
	        }
	        if(!$data['DB_PREFIX']){
	        	show_msg('请填写数据表前缀！',false);
	        }
	        //检查数据库
	        $link = @mysql_connect($data['DB_HOST'] . ':' . $data['DB_PORT'], $data['DB_USER'], $data['DB_PWD']);
	        if(!$link) {
	            show_msg('数据库连接失败，请检查连接信息是否正确！',false);
	        }
	        $mysqlInfo = mysql_get_server_info($link);
	        if($mysqlInfo < '5.1.0') {
	            show_msg('mysql版本低于5.1，无法继续安装！',false);
	        }
	        $status = @mysql_select_db($data['DB_NAME'], $link);
	        if(!$status) {
	            //尝试创建数据库
	            $sql = "CREATE DATABASE IF NOT EXISTS `".$data['DB_NAME']."` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;";
	            if(!mysql_query($sql)){
	                show_msg('数据库'. $data['DB_NAME'].'自动创建失败，请手动建立数据库！',false);
	            }
	            mysql_select_db($data['DB_NAME'], $link);
	        }
	        show_msg('数据库检查创建完成...');
	        
	        //修改数据库文件
	        if(F('config.db', $data, CONF_PATH)){
	            show_msg('配置数据库信息完成...');
	        }else{
	            show_msg('配置数据库信息失败！请手动修改['.$file.']文件！',false);
	        }

	        //安装数据库
	        $file = 'Data/install.sql';
	        $sqlData = mysqlupdate($file, 'yh_', $data['DB_PREFIX']);
	        foreach ($sqlData as $sql) {
	        	$sql = str_replace("/demo/uploads/", __ROOT__."/uploads/", $sql);
	            $rst = mysql_query($sql);
	            if($rst === false){
	                show_msg(mysql_error(),false);
	            }
	        }
	        //创建文件锁
	        file_put_contents($this->lock, NOW_TIME);
	        //设置域名
	        $cfg['cfg_webname'] = C('cfg_webname');
	        $cfg['cfg_weburl'] = "http://".$this->_server('HTTP_HOST').__ROOT__;
	        $cfg['cfg_themestyle'] = C('cfg_themestyle');
	        $cfg['cfg_powerby'] = C('cfg_powerby');
	        $cfg['cfg_cookie_encode'] = C('cfg_cookie_encode');
			F('config.site', $cfg, CONF_PATH);
	        //安装完毕
	        show_msg('安装程序执行完毕！后台默认帐号密码均为：admin');
	        $homeUrl = __ROOT__;
	        $adminUrl = __ROOT__.'/yhcms.php';
	        echo "<script type=\"text/javascript\">insok(\"{$homeUrl}\",\"{$adminUrl}\")</script>";
		}
		
	}
}
?>