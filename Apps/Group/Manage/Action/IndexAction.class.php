<?php

class IndexAction extends CommonAction{
	
	public function index(){
		$this->menudoclist = D('CategoryView')->where(array('pid' => 0 , 'type' => 0))->order('category.sort')->select();
        $this->connav = $this->menudoclist[0];

        $version = file_get_contents('http://'.$_SERVER['HTTP_HOST'].__ROOT__."/version.txt");
        $this->version = $version;
        
		$this->display();
	}

	public function getParentCate(){
		header("Content-Type:text/html; charset=utf-8");//不然返回中文乱码
		$count = D('CategoryView')->where(array('pid' => 0 , 'type' => 0))->count();
		$list = D('CategoryView')->where(array('pid' => 0 , 'type' => 0))->order('category.sort')->select();
		$menudoclist = array('count' => $count);
		foreach ($list as $v) {
			$menudoclist['list'][] = array(
				'id' => $v['id'],				
				'name' => $v['name'],		
				'url' => U(GROUP_NAME.'/'. ucfirst($v['tablename']) .'/index', array('pid'=>$v['id']))
			);
		}
		exit(json_encode($menudoclist));
	}
    //生成站点地图
	public function sitemap() {
        $sitemap = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\r\n<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\r\n";  
        //主页
        $sitemap .= "<url>\r\n"."<loc>".C('cfg_weburl')."</loc>\r\n"."<priority>0.6</priority>\r\n<lastmod>".date('Y-m-d')."</lastmod>\r\n<changefreq>weekly</changefreq>\r\n</url>\r\n";
                
            //栏目
        	$cate = D('CategoryView')->order('category.sort')->select();
        	import('Class.Category', APP_PATH);
                $cate = Category::unlimitedForLevel($cate, '&nbsp;&nbsp;&nbsp;&nbsp;', 0);
                foreach($cate as $k=>$v){
                	if(!stristr($v['ename'], "@")) {
                		$htmlurl = C('cfg_weburl')."/".$v['ename']."/";
                		$sitemap .= "<url>\r\n"."<loc>".$htmlurl."</loc>\r\n"."<priority>0.6</priority>\r\n<lastmod>".date('Y-m-d')."</lastmod>\r\n<changefreq>weekly</changefreq>\r\n</url>\r\n";
                	}
                	//文章
                	if($v['tablename'] == "article") {
        				$where = array('article.status' => 0, 'cid' => $v['id']);
                		$art = D('ArticleView')->where($where)->order('article.id DESC')->select();
                		foreach($art as $k1=>$v1){
                			$htmlurl = C('cfg_weburl')."/".$v['ename']."/".$v1['id'].".html";
                			$sitemap .= "<url>\r\n"."<loc>".$htmlurl."</loc>\r\n"."<priority>0.6</priority>\r\n<lastmod>".date('Y-m-d', $v1['publishtime'])."</lastmod>\r\n<changefreq>weekly</changefreq>\r\n</url>\r\n";
                		}
                	}
                	//产品
                	if($v['tablename'] == "product") {
                		$where = array('product.status' => 0, 'cid' => $v['id']);
                		$art = D('ProductView')->where($where)->order('product.id DESC')->select();
                		foreach($art as $k1=>$v1){
                			$htmlurl = C('cfg_weburl')."/".$v['ename']."/".$v1['id'].".html";
                			$sitemap .= "<url>\r\n"."<loc>".$htmlurl."</loc>\r\n"."<priority>0.6</priority>\r\n<lastmod>".date('Y-m-d', $v1['publishtime'])."</lastmod>\r\n<changefreq>weekly</changefreq>\r\n</url>\r\n";
                		}
                	}
                	//图片
                	if($v['tablename'] == "picture") {
                		$where = array('picture.status' => 0, 'cid' => $v['id']);
                		$art = D('PictureView')->where($where)->order('picture.id DESC')->select();
                		foreach($art as $k1=>$v1){
                			$htmlurl = C('cfg_weburl')."/".$v['ename']."/".$v1['id'].".html";
                			$sitemap .= "<url>\r\n"."<loc>".$htmlurl."</loc>\r\n"."<priority>0.6</priority>\r\n<lastmod>".date('Y-m-d', $v1['publishtime'])."</lastmod>\r\n<changefreq>weekly</changefreq>\r\n</url>\r\n";
                		}
                	}
                } 
                $sitemap .= '</urlset>';
                    
                $file = fopen("sitemap.xml","w");
                fwrite($file,$sitemap);
                fclose($file);

        	$this->display();
	}
    //生成关键词列表
    public function keyword() {
        if (IS_POST) {
            $hxgjc = I('hx_gjc','','htmlspecialchars,trim');
            if(!$hxgjc){$this->error('核心关键词不能为空');}
            $cwgjc = I('cw_gjc','','htmlspecialchars,trim');
            $seltype = I('seltype', 0,'intval');

                $hxarr = explode(",", $hxgjc);
                $tmpstr = "";
                foreach ($hxarr as $k => $v) {
                    //核心
                    $tmpstr .= $v."<br>";
                    //长尾
                    if ($cwgjc) {
                        $cwarr = explode(",", $cwgjc);
                        foreach ($cwarr as $k1 => $v1) {
                            $tmpstr .= $v.$v1."<br>";
                        }
                    }
                    switch ($seltype) {
                        case '1':
                            $area = M('area')->where("is_top='1'")->order('sort')->select();
                            break;
                        case '2':
                            $area = M('area')->where("is_top='0'")->order('sort')->select();
                            break;
                        case '3':
                            $area = M('area')->order('sort')->select();
                            break;
                    }
                    //地区核心
                    foreach ($area as $k2 => $v2) {
                        $tmpstr .= $v2['sname'].$v."<br>";
                    }
                    //地区核心长尾
                    if ($cwgjc) {
                        $cwarr = explode(",", $cwgjc);
                        foreach ($area as $k3 => $v3) {
                            foreach ($cwarr as $k4 => $v4) {
                                $tmpstr .= $v3['sname'].$v.$v4."<br>";
                            }
                        }               
                    }
                }

                $this->hxgjc = $hxgjc;
                $this->cwgjc = $cwgjc;
                $this->seltype = $seltype;
                $this->tmpstr = $tmpstr;


            //更新配置文件
            $data['cfg_webtitle'] = C('cfg_webtitle');
            $data['cfg_keywords'] = C('cfg_keywords');
            $data['cfg_description'] = C('cfg_description');
            $data['cfg_site_hxkey'] = C('cfg_site_hxkey');
            $data['cfg_site_cwkey'] = C('cfg_site_cwkey');
            $data['cfg_site_area'] = $seltype;
            F('config.seo', $data, CONF_PATH);
        }
        $this->seltype = $data['cfg_site_area'] ? $data['cfg_site_area'] : '0';
        $this->display();
    }
    public function get_keywords(){
        //获取关键词字符串
        $title = I('title','','trim');
        $cwkey = explode(",", C('cfg_site_cwkey'));
        $tmpstr = "";
        foreach ($cwkey as $k1 => $v1) {
            if (!empty($tmpstr)) {
                $tmpstr .= ",";
            }
            $tmpstr .= "[dq]".$title.$v1;
        }
        $this->ajaxReturn(1, $tmpstr, 1);
    }
    //QQ访问统计功能跳转
    public function qqapi() {
        $this->urlstr = str_replace("http://", "", C('cfg_weburl'));
        $this->display();
    }
    //执行SQL
    public function sql() {
        $sql = I("sql",'','trim');
        if ($sql) {
            $slist = explode('***', $sql);
            $s = M();
            $okcount = 0;
            $errsql = "";  
            foreach ($slist as $k => $v) {
                if ($v) {
                    $jg = $s->execute($v);
                    if ($jg) {
                        $okcount = $okcount + 1;
                    }else{
                        $errsql = $errsql . "SQL语句：". $v . "<br>";
                    }
                }
            }
            $zxstr = "执行结果：<br><br>";
            if($okcount){
                $zxstr .= "成功执行了 $okcount 条SQL语句。<br/>";
            }
            if($errsql){
                $zxstr .= "以下SQL语句执行失败：<br/>".$errsql;
            }
            $this->zxstr = $zxstr;
        }
        
        $this->display();
    }
    //获取分类列表AJAX
    public function getcateajax() {
        if(IS_POST) {
            $id = I('cid',0 , 'intval');
            $clist = M('Category')->where("pid='$id'")->select();
            if ($clist) {
                $this->ajaxReturn($clist,1,1);//请求正常
            }else{
                $this->ajaxReturn(1,1,3);//请求出错
            }
        }else{
            $this->ajaxReturn(1,1,2);//请求出错
        }
    }
}
?>