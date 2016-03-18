function banner()
{
	//获取页面必要的参数
	var oBan = document.getElementById('ban');
	var oBanUl = oBan.getElementsByTagName('ul')[0];
	var oBanLi = oBan.getElementsByTagName('li');
	var oYd = document.getElementById('yd');
	var oYdDiv = oYd.getElementsByTagName('div');
	var oBox = document.getElementById('box');


	var n=0;//定义一个变量来获取当前滚动到第几张图的位置
	var oB = true;//一定一个变量来检测运动是否结束
	var timerauto = null;//给自动播放定时器加一个变量名
	//小圆点点击的事件
	for(var i=0;i<oYdDiv.length;i++)
	{
		oYdDiv[i].index = i;
		oYdDiv[i].onclick = function ()
		{
			clearInterval(timerauto);
			if(oB == true)
			{
				oB = false;
				var TarLeft = this.index*-oBanLi[0].offsetWidth;
				for(var j=0;j<oYdDiv.length;j++)
				{
					oYdDiv[j].className = '';
				}
				this.className = 'active';
				startMoveTime(oBanUl,{left:TarLeft},500,'Quad','easeOut',function () {oB = true;
					automove();
				})
				n = this.index;
			}
		}
	}


	//滑动事件需要的几个变量
	var DownLeft1 = 0;//定义按下去的Left值并将其初始化为0
	var DownX1 = 0;//定义按下去的X轴并将其初始化为0
	var DownY1 = 0;
	var DownTime1 = 0; //按下的时间节点
	var MoveTime1 = 0;  //move事件的时间节点
	Itarage = null;//定义一个变量用来存储将要运动到的位置
	//滑动事件
	oBanUl.ontouchstart = function(ev)
	{
		clearInterval(timerauto);
		if(oB == true)
		{
			oB = false;
			n = Math.abs(oBanUl.offsetLeft/oBanLi[0].offsetWidth);
			var touchs = ev.changedTouches[0];
			DownLeft1 = this.offsetLeft;
			DownX1 = touchs.pageX;
			DownY1 = touchs.pageY;//获取Y轴
			DownTime1 = Date.now();  // 获取时间节点

			oBanUl.ontouchmove = function (ev)
			{
				var touchs = ev.changedTouches[0];
				var Xcz1 = Math.abs(DownX1-touchs.pageX);
				var Ycz1 = Math.abs(DownY1-touchs.pageY);
				if(Xcz1>Ycz1)
				{
					this.style.left = DownLeft1+(touchs.pageX-DownX1)+'px';
				}

			}

			oBanUl.ontouchend = function (ev)
			{
				var touchs = ev.changedTouches[0];
				var Xcz1 = Math.abs(DownX1-touchs.pageX);
				var Ycz1 = Math.abs(DownY1-touchs.pageY);
				MoveTime1 = Date.now(); // 获取时间节点
				if(Xcz1>Ycz1&&MoveTime1-DownTime1>100)
				{
					if(DownX1-touchs.pageX>0)//向左滑动
					{
						if(n == 2)
						{
							Itarage = -2*oBanLi[0].offsetWidth;
						}else
						{
							Itarage = -(n+1)*oBanLi[0].offsetWidth;
						}
						startMoveTime(oBanUl,{left:Itarage},500,'Quad','easeOut',function(){oB = true;automove();})
					}else if(DownX1-touchs.pageX<0)//向右滑动
					{
						if(n == 0)
						{
							Itarage = 0;
						}
						else
						{
							Itarage = -(n-1)*oBanLi[0].offsetWidth;
						}
						startMoveTime(oBanUl,{left:Itarage},500,'Quad','easeOut',function(){oB = true;automove();})
					}
					for(var i=0;i<oYdDiv.length;i++)
					{
						oYdDiv[i].className = '';
					}
					var oNu =Math.abs(Itarage/oBanLi[0].offsetWidth);
					oYdDiv[oNu].className = 'active';

				}
				oBanUl.ontouchmove = null;
				oBanUl.ontouchend = null;

			}
		}

	}

	automove();
	//自动播放事件
	function automove()
	{
		timerauto = setInterval(function (){
			if(oB = true)
			{
				n = Math.abs(oBanUl.offsetLeft/oBanLi[0].offsetWidth);
				var Itarage = -(n+1)*oBanLi[0].offsetWidth;
				if(Itarage==-oBanLi[0].offsetWidth*3)
				{
					Itarage = 0;
				}
				for(var i=0;i<oYdDiv.length;i++)
				{
					oYdDiv[i].className = '';
				}
				var oNu =Math.abs(Itarage/oBanLi[0].offsetWidth);
				oYdDiv[oNu].className = 'active';
				startMoveTime(oBanUl,{left:Itarage},500,'Quad','easeOut',function(){oB = true})
			}
		},2500)
	}


}