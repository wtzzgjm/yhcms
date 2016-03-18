<?php
class PublicAction extends CommonAction {
	public function index() {
		echo "";
	}

	//后台内容主页
	public function main() {
		/* phpversion */
		$this->phpversion = phpversion();
		$this->software = $_SERVER["SERVER_SOFTWARE"] ;
		$this->os = PHP_OS;
		$mysql_ver = M()->query('SELECT VERSION();');
		if(is_array($mysql_ver)) {
			$this->mysql_ver = $mysql_ver[0]['VERSION()'];
		}else {
			$this->mysql_ver = '';
		}
		/* uploads */
		$this->environment_upload = ini_get('file_uploads') ? ini_get('upload_max_filesize') : '不支持';

		$version = file_get_contents('http://'.$_SERVER['HTTP_HOST'].__ROOT__."/version.txt");
		$this->version = $version;
		$this->yycms_info =  F('ver', '', './Data/resource/');
		$this->display();
	}

	public function getFileOfImg() {

		header("Content-Type: text/html; charset=utf-8");

		$action = I('action', '', 'trim');
		if (IS_POST && $action != 'get') {
			exit();
		}
	    //需要遍历的目录列表，最好使用缩略图地址，否则当网速慢时可能会造成严重的延时

        //显示有缩略图　文件
        $files = M('attachment')->where(array('filetype' => 1, 'haslitpic' => 1))->order('uploadtime DESC')->getField('filepath',50);//最新50条
       
        if ( !count($files) ) return;
        rsort($files,SORT_STRING);
        $str = "";
        foreach ( $files as $file ) {        	
            $str .= $file . "ue_separate_ue";
            $file = preg_replace('/\.(.+)$/', '_m.$1', $file);//缩略图            
            $str .= $file . "ue_separate_ue";
        }
        echo $str;

	}
	
	//上传图片
	public function upload() {
		header("Content-Type:text/html; charset=utf-8");//不然返回中文乱码
		$tb = I('get.tb', 0, 'intval'); //缩略图地址前缀/,1:_s,2:_m,0默认
		
		//百度编辑新版要求--start
		//获取存储目录--对应百度编辑器
		$imgSavePathConfig = array (
       		'upload',
    	);
	    if ( isset( $_GET[ 'fetch' ] ) ) {

	        header( 'Content-Type: text/javascript' );
	        echo 'updateSavePath('. json_encode($imgSavePathConfig) .');';
	        return;

	    }
	    //百度编辑要求--end 
	
		 //文件上传地址提交给他，并且上传完成之后返回一个信息，让其写入数据库     
        if(empty($_FILES)){  
            //$this->error('必须选择上传文件');              
            echo json_encode(array(
						'url' => '', 'title' => '',	'original' => '',
		     			'state' => '必须选择上传文件'
		     	));
        }else{  
            $info = $this->_uploadPicture();//获取图片信息
          
            //p($info);exit();

            if(isset($info) && is_array($info)){  
                //写入数据库的自定义c方法  
				if(!$this->_uploadData($info)){  
                    //echo '上传入库失败'; 
                    echo json_encode(array(
						'url' => '',
		     			'title' => '',
		     			'original' => '',
		     			'state' => '上传入库失败'
		     			));
                    exit();
                }
                //$picture_url = ltrim($info[0]['savepath'],'.').$info[0]['savename'];                
                $picture_url = $info[0]['savepath'].$info[0]['savename'];
                //返回缩略图地址

                $picture_turl = $picture_url;
                if ($tb != 3) 
                {

                	//$picture_url = preg_replace('/\.(.+)$/', '_m.$1', $picture_url);//缩略图的_m,_s后缀
                	$imgtbSize = explode(',', C('cfg_imgthumb_size'));//配置缩略图第一个参数
                	$imgTSize = explode('X', $imgtbSize[0]);


					if (!empty($imgTSize)) {
						$picture_turl = get_picture($picture_url, $imgTSize[0], $imgTSize[1]);
					}
                }
                
                echo json_encode(array(
				'url' => $picture_url,
				'turl' => $picture_turl,
     			'title' => $info[0]['name'],
     			'original' => $info[0]['name'],
     			'state' => 'SUCCESS',
     			'size' => round($info[0]['size']/1024,2)
     			));


            }else{  
            //echo "{'url':'','title':'','original':'','state':'". $info ."'}";
           		echo json_encode(array(
				'url' => '',  'title' => '', 'original' => '',
     			'state' => '失败:'. $info 
     			));
   
            }  
        }  

	}

	//上传图片批量上传组件使用
	public function uploadify() {
		header("Content-Type:text/html; charset=utf-8");//不然返回中文乱码
		$tb = I('get.tb', 0, 'intval'); //缩略图地址前缀/,1:_s,2:_m,0默认

		//百度编辑新版要求--start
		//获取存储目录--对应百度编辑器
		$imgSavePathConfig = array (
       		'upload',
    	);
	    if ( isset( $_GET[ 'fetch' ] ) ) {

	        header( 'Content-Type: text/javascript' );
	        echo 'updateSavePath('. json_encode($imgSavePathConfig) .');';
	        return;

	    }
	    //百度编辑要求--end 
	
		//文件上传地址提交给他，并且上传完成之后返回一个信息，让其写入数据库     
        if(empty($_FILES)){  
            //$this->error('必须选择上传文件');    
            echo json_encode(array(
						'result' => 'FAILURE','message' => '必须选择上传文件','image' => array('aid'=>0,'abid'=>0,'type_id'=>0,'utype'=>-99,'uid'=>-9,'uu'=>null,'Filedata'=>null)
		     	));
        }else{  
            $info = $this->_uploadPicture();//获取图片信息
            $fileinfo = pathinfo($_FILES['Filedata']['name']);
            //p($info);exit();
            if(isset($info) && is_array($info)){  
                //写入数据库的自定义c方法  
				if(!$this->_uploadData($info)){  
                    //echo '上传入库失败'; 
                    echo json_encode(array(
						'url' => '',
		     			'title' => '',
		     			'original' => '',
		     			'state' => '上传入库失败'
		     			));
                    exit();
                }
                //$picture_url = ltrim($info[0]['savepath'],'.').$info[0]['savename'];                
                $picture_url = $info[0]['savepath'].$info[0]['savename'];
                //返回缩略图地址

                $picture_turl = $picture_url;
                if ($tb != 3) 
                {

                	//$picture_url = preg_replace('/\.(.+)$/', '_m.$1', $picture_url);//缩略图的_m,_s后缀
                	$imgtbSize = explode(',', C('cfg_imgthumb_size'));//配置缩略图第一个参数
                	$imgTSize = explode('X', $imgtbSize[0]);


					if (!empty($imgTSize)) {
						$picture_turl = get_picture($picture_url, $imgTSize[0], $imgTSize[1]);
					}
                }

                echo json_encode(array(
                'result' => 'SUCCESS',
                'message'=> '上传成功',
                'image' => array('id'=>1,'title'=>$fileinfo['filename'],'content'=>$fileinfo['filename'],'sort'=>0,'thm_url'=>$picture_turl,'url'=>$picture_url)
     			));

            }else{ 
            	echo json_encode(array(
						'result' => 'FAILURE','message' => '失败:'. $info,'image' => array('aid'=>0,'abid'=>0,'type_id'=>0,'utype'=>-99,'uid'=>-9,'uu'=>null,'Filedata'=>null)
		     	));
            }  
        }  

	}

	//上传文件
	public function uploadFile() {
		header("Content-Type:text/html; charset=utf-8");//不然返回中文乱码
		
	
		 //文件上传地址提交给他，并且上传完成之后返回一个信息，让其写入数据库     
        if(empty($_FILES)){  
            //$this->error('必须选择上传文件');              
            echo json_encode(array(
						'url' => '', 'title' => '',	'original' => '',
		     			'state' => '必须选择上传文件'
		     	));
        }else{  
            $info = $this->_uploadFile();//获取图片信息
          
            //p($info);exit();

            if(isset($info) && is_array($info)){  
                //写入数据库的自定义c方法  
				if(!$this->_uploadData($info)){  
                    //echo '上传入库失败'; 
                    echo json_encode(array(
						'url' => '',
		     			'title' => '',
		     			'original' => '',
		     			'state' => '上传入库失败'
		     			));
                    exit();
                }

                $file_url = $info[0]['savepath'].$info[0]['savename'];
                //返回地址
               
                
                echo json_encode(array(
				'url' => $file_url,
     			'title' => $info[0]['name'],
     			'original' => $info[0]['name'],
     			'state' => 'SUCCESS',
     			'size' => round($info[0]['size']/1024,2)
     			));


            }else{  
            //echo "{'url':'','title':'','original':'','state':'". $info ."'}";
           		echo json_encode(array(
				'url' => '',  'title' => '', 'original' => '',
     			'state' => '失败:'. $info 
     			));
   
            }  
        }  

	}

	/**
	*图片(上传后)数组入库
	*filearr:图片数组
	**/	
	public function _uploadData($filearr) {

		$db=M('attachment');  
		$num  = 0;
		
		for($i = 0; $i < count($filearr); ++$i) {  
			$savepath = $filearr[$i]['savepath'];

			/*
			if (!empty($savepath) && substr($savepath,0,1)  == '.') {//判断首字符是否是'.'
				$savepath = substr($savepath,1,(strlen($savepath)-1));//去掉第一个字符
			}
			*/

		    $data['filepath'] = $savepath .$filearr[$i]['savename'];  
		    $data['title'] = $filearr[$i]['name'];  
		    $data['haslitpic'] = empty($filearr[$i]['haslitpic']) ? 0 : 1;
		    $filetype =1;
		    //后缀
		    switch ($filearr[$i]['extension']) {
		       	case 'gif':
		       		$filetype =1;
		       		break;
		       	case 'jpg':
		       		$filetype =1;
		       		break;
		       	case 'png':
		       		$filetype =1;
		       		break;
		       	case 'bmp':
		       		$filetype =1;
		       		break;
		       	case 'swf'://flash
		       		$filetype =2;
		       		break;
		       	case 'mp3'://音乐
		       		$filetype =3;
		       		break;
		       	case 'wav':
		       		$filetype =3;
		       		break;
		       	case 'rm'://电影
		       		$filetype =4;
		       		break;

		       	case 'doc'://
		       		$filetype =5;
		       		break;
		       	case 'docx'://
		       		$filetype =5;
		       		break;
		       	case 'xls'://
		       		$filetype =5;
		       		break;
		       	case 'ppt'://
		       		$filetype =5;
		       		break;
		       	case 'zip'://
		       		$filetype =6;
		       		break;
		       	case 'rar'://
		       		$filetype =6;
		       		break;
		       	case '7z'://
		       		$filetype =6;
		       		break;
		       	
		       	default://其他
		       		$filetype = 0;
		       		break;
		       }   
		    $data['filetype'] = $filetype;
		    $data['filesize'] = $filearr[$i]['size'];
		    $data['uploadtime'] = time();
		    $data['aid'] = $_SESSION[C('USER_AUTH_KEY')];//管理员ID
			if( $db->add($data))  
			{
				++$num;
			}  
			//echo $db->getLastSql();
		}  
		
		if($num==count($filearr))  
		{  
		    return true;     
		}else  
		{  
		    return false;  
		} 


	}

	//上传图片
	public function _uploadPicture() {
		$ext = '';//原文件后缀
		$ext_dest = 'jpg';//生成缩略图格式
		foreach ($_FILES as $key => $v) {
			$strtemp = explode('.', $v['name']);
			$ext = end($strtemp);//获取文件后缀，或$ext = end(explode('.', $_FILES['fileupload']['name']));
			break;
		}
		$tb = I('get.tb', 0, 'intval'); //缩略图地址前缀/,1:_s,2:_m,0默认
		import('ORG.Net.UploadFile');//导入ThinkPHP的上传类
		//..这里可以配置上传类的参数config，设置N个配置项，可在这里设置new UploadFile($config)
		$upload = new UploadFile();
		//只修改几个配置项，可在这里设置
		$upload->autoSub =true;//是否使用子目录保存图片
		$upload->subType = 'date';//子目录保存规则
		$upload->dateFormat = 'Ymd';
		$upload->maxSize = getUploadMaxsize();//设置上传文件大小
		//设置上传文件类型
		$upload->allowExts = explode(',', 'jpg,gif,png,jpeg');
		//上传目录
		$upload->savePath ='./uploads/img/';

		//$upload->saveRule = 'time';
		$upload->saveRule = 'uniqid';//设置上传文件规则
		$upload->uploadReplace = true; //是否存在同名文件是否覆盖

		/*缩略图设置*/
		//设置需要生成缩略图,仅对图像文件有效
		//读取配置文件中的设置

		if ($tb != 3) {
			$imgtbSize = explode(',', C('cfg_imgthumb_size'));
			$imgtbArray = array();
			foreach ($imgtbSize as $v) {
				$t_size = explode('X', $v);

				if (empty($t_size) || empty($t_size[0]) || empty($t_size[1])) {
					continue;
				}
				$imgtbArray[] = array('w' => intval($t_size[0]), 'h' => intval($t_size[1]));
			}
		}
		


		/*

		$strWidth = '';
		$strHeight ='';
		$strSuffix ='';
		foreach ($imgtbArray as $i => $v) {
			if ($i !=0) {
				$strWidth .= ',';
				$strHeight .= ',';
				$strSuffix .= ',';
			}
			$strWidth .= $v['w'];
			$strHeight .= $v['h'];
			$strSuffix .= '.'.$ext.'!'.$v['w'].'X'.$v['h'];

		}



		//系统缩略图设置
		$upload->thumb = true;
		//设置引用图片类库包路径
		//$upload->imageClassPath = 'ORG.Util.Image';
		//设置需要生成缩略图片的文件后缀
		//$upload->thumbPrefix = 'm_,s_'; //生成2张缩略图前缀
		$upload->thumbPrefix = ''; //缩略图前缀
		$upload->thumbExt = $ext_dest;//缩略图后缀,但他根据后缀转换类型，还是默认的格式
		//$upload->thumbMaxWidth = '300,100';//设置缩略图最大宽度
		$upload->thumbMaxWidth = $strWidth;//设置缩略图最大宽度
		$upload->thumbMaxHeight = $strHeight;//设置缩略图最大宽度
		//$upload->thumbSuffix = '_m,_s';//
		$upload->thumbSuffix = $strSuffix;//
		$upload->thumbPath = './uploads/img/'.date('Ym', time()) .'/';// . $path . date('Ymd', time()) . '/'; //缩略图保存路径
		$upload->thumbType = C('cfg_imgthumb_type') ? 1:0; // 缩略图生成方式 1 按设置大小截取 0 按原图等比例缩略
		
		$upload->thumbRemoveOrigin = false;//删除原图
		
		*/
		//$upload->upload('./uploads/img/')
		if($upload->upload()) {
			$info = $upload->getUploadFileInfo();//获取图片信息
			$real_path = './uploads/img/'.$info[0]['savename'];

			//读取配置文件固定宽等比缩略
			if ($tb != 3) {
				$imgtbFixWidth = explode(',', C('cfg_imgthumb_width'));
				$imgtbFixArray = array();
				foreach ($imgtbFixWidth as $v) {
					if (empty($v) || intval($v) == 0) {
						continue;
					}
					$imgtbFixArray[] = array('w' => intval($v), 'h' => intval($v * 100));
				}
			}
		
			if (!empty($imgtbFixArray) || !empty($imgtbArray)) {
				import('ORG.Util.Image.ThinkImage');
				$Think_img = new ThinkImage(THINKIMAGE_GD); 
				$thumbType = C('cfg_imgthumb_type') ? 3:1;//配置大小
				//生成缩略图,固定大小
				foreach ($imgtbArray as $i => $v) {					
					$strSuffix = '!'.$v['w'].'X'.$v['h'];
					$Think_img->open($real_path)->thumb($v['w'],$v['h'], $thumbType)->save($real_path.$strSuffix.'.'.$ext_dest,$ext_dest);

				}
				//生成缩略图，不放大，等宽，高度不限
				foreach ($imgtbFixArray as $v) {
					$strSuffix = '!'.$v['w'].'X';
					$Think_img->open($real_path)->thumb($v['w'],$v['h'], 1)->save($real_path.$strSuffix.'.'.$ext_dest,$ext_dest);
				}
				
			}
			
			//转换成网站根目录绝对路径,.Uploads 转成 /目录/Uploads
			$info[0]['savepath'] = __ROOT__.ltrim($info[0]['savepath'],'.');//去掉第一个"."字符
			$info[0]['haslitpic'] = 1;
					
			return $info;		

		}else {
			
			//$str = array('err' =>1 ,'msg' => $upload->getErrorMsg() );
			return $upload->getErrorMsg();
		}


	}



	//上传文件
	public function _uploadFile() {
		$ext = '';//原文件后缀
		foreach ($_FILES as $key => $v) {
			$strtemp = explode('.', $v['name']);
			$ext = end($strtemp);//获取文件后缀，或$ext = end(explode('.', $_FILES['fileupload']['name']));
			break;
		}

		import('ORG.Net.UploadFile');//导入ThinkPHP的上传类
		//..这里可以配置上传类的参数config，设置N个配置项，可在这里设置new UploadFile($config)
		$upload = new UploadFile();
		//只修改几个配置项，可在这里设置
		$upload->autoSub =true;//是否使用子目录保存图片
		$upload->subType = 'date';//子目录保存规则
		$upload->dateFormat = 'Ymd';
		$upload->maxSize = getUploadMaxsize();//设置上传文件大小
		//设置上传文件类型
		$upload->allowExts = explode(',', 'jpg,gif,png,jpeg,doc,docx,xls,ppt,zip,rar,mp3');
		//上传目录
		$upload->savePath ='./uploads/file/';

		//$upload->saveRule = 'time';
		$upload->saveRule = 'uniqid';//设置上传文件规则
		$upload->uploadReplace = true; //是否存在同名文件是否覆盖	

		if($upload->upload()) {
			$info = $upload->getUploadFileInfo();//获取文件信息					
			//转换成网站根目录绝对路径,.Uploads 转成 /目录/Uploads
			$info[0]['savepath'] = __ROOT__.ltrim($info[0]['savepath'],'.');//去掉第一个"."字符	
			$info[0]['haslitpic'] = 0;//没有缩略图					
			return $info;		

		}else {
			
			return $upload->getErrorMsg();
		}


	}

	//文件/夹管理
	function browseFile($spath = '', $stype = 'file') {
		$base_path = '/uploads/img';
		$enocdeflag = I('encodeflag', 0, 'intval');
		switch ($stype) {
			case 'picture':
				$base_path = '/uploads/img';
				break;
			case 'file':
				$base_path = '/uploads/file';
				break;			
			case 'ad':
				$base_path = '/uploads/ad';
				break;
			default:
				exit('参数错误');
				break;
		}

		if ($enocdeflag) {
			$spath = base64_decode($spath);
		}
	
		$spath = str_replace('.', '', ltrim($spath,$base_path));
	
		$path = $base_path . '/'. $spath;
		import('Class.Dir', APP_PATH);
	
		$dir = new Dir('.'. $path);//加上.
		$list = $dir->toArray();
		for ($i=0; $i < count($list); $i++) { 
			
			$list[$i]['isImg'] = 0;
			if ($list[$i]['isFile']) {
				$url =  __ROOT__.rtrim($path,'/') . '/'. $list[$i]['filename'];
				$ext = explode('.', $list[$i]['filename']);
        		$ext = end($ext);
				if (in_array($ext, array('jpg','png','gif'))) {
					$list[$i]['isImg'] = 1;
				}
			}else {
				//为了兼容URL_MODEL(1、2)
				if (C('URL_MODEL') == 1 || C('URL_MODEL') == 2) {
					$url = U(GROUP_NAME. '/Public/browseFile', array('stype' => $stype, 'encodeflag' => 1 ,'spath'=>base64_encode(rtrim($path,'/') . '/'. $list[$i]['filename'])));
				}else {
					$url = U(GROUP_NAME. '/Public/browseFile', array('stype' => $stype, 'spath'=> rtrim($path,'/') . '/'. $list[$i]['filename']));
				}
				
			}	
			$list[$i]['url'] = $url;			
			$list[$i]['size'] = get_byte($list[$i]['size']);
		}
		//p($list);
		$parentpath = substr($path, 0, strrpos($path, '/'));
		//为了兼容URL_MODEL(1、2)
		if (C('URL_MODEL') == 1 || C('URL_MODEL') == 2) {
			$this->purl = U(GROUP_NAME. '/Public/browseFile', array('spath'=> base64_encode($parentpath),'encodeflag' => 1, 'stype' => $stype));
		}else {
			$this->purl = U(GROUP_NAME. '/Public/browseFile', array('spath'=> $parentpath, 'stype' => $stype));
		}
		$this->type = '浏览文件';
		$this->vlist = $list;
		$this->stype = $stype;
		$this->display();

	}
}

?>