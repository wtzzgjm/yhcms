/*
作者:YinHuang
主要功能:移动触屏端的滑动组件
时间:2014.9
*/
function sliding() //定义一个函数库
{
	//定义初始化变量
	var DownY = 0; //按下Y轴
	var DownX = 0;  //按下X轴
	var DownTop = 0; //按下Top值
	var DownTime = 0; //按下的时间节点
	var MoveTime = 0;  //move事件的时间节点
	var EndTime = 0;  //end事件的时间节点
	var timeMove = 0; //time 的差值
	var YMove = 0; // Y轴改变的值
	var speend = 0; // 速度
	var timer1 = null; //定时器
	var oBoxBody = 0;  //body  box  差值

	//定义页面dom元素
	var oBox = document.getElementById('box');
	var oBody = document.getElementsByTagName('body')[0];

	//取消浏览器的默认滚动事件
	document.ontouchmove = function(ev){
		ev.preventDefault();
	};


	/*
	滑动组件由此开始
	分: start move end 3种事件;
	*/
	oBox.ontouchstart = function(ev)//start 事件
	{
		var touchs = ev.changedTouches[0]; //获取EV对象
		DownY = touchs.pageY;     //获取start的Y轴
		DownX = touchs.pageX;     //获取start的X轴
		DownTop = oBox.offsetTop;  //获取对象的 top值
		DownTime = Date.now();  // 获取时间节点

		//move事件
		oBox.ontouchmove = function(ev)
		{
			var touchs = ev.changedTouches[0]; //获取EV对象
			MoveTime = Date.now(); // 获取时间节点

			if(Math.abs(touchs.pageY-DownY)>Math.abs(touchs.pageX-DownX)&&MoveTime-DownTime>60)//判定条件 移动超过60毫秒并且Y轴移动大于X轴移动
			{
				this.style.top = DownTop+(touchs.pageY-DownY)+'px';//将对象的 top值与手滑动的改变的值相对等
			}
		}

		//end 事件
		document.ontouchend = function (ev)
		{
			var touchs = ev.changedTouches[0]; //获取EV对象
			EndTime = Date.now(); // 获取时间节点
			timeMove = EndTime - DownTime; // 时间差值
			YMove = DownY - touchs.pageY // Y轴差值
			speed = (YMove/timeMove)*30;
			oBoxBody = oBox.offsetHeight - oBody.offsetHeight;

			if(oBox.offsetTop>=0)
			{
				speed = 0;
				startMoveTime(oBox,{top:0},300,'Cubic','easeOut');
			}else if(oBox.offsetTop<=-oBoxBody)
			{
					speed = 0;
					startMoveTime(oBox,{top:-oBoxBody},300,'Cubic','easeOut')
			}
			else
			{
				timer1 = setInterval(function () {
					if(speed>0)
					{
						if(speed<=1)
						{
							speed = 0;
						}else
						{
							speed-=1;
						}
					}else if(speed<0)
					{
						if(speed>=-1)
						{
							speed = 0;
						}else
						{
							speed+=1;
						}
					}

					if(oBox.offsetTop>0)
					{
						speed = 0;
						clearInterval(timer1);
						startMoveTime(oBox,{top:0},300,'Cubic','easeOut');
					}else if(oBox.offsetTop<-oBoxBody)
					{
						speed = 0;
						clearInterval(timer1);
						startMoveTime(oBox,{top:-oBoxBody},300,'Cubic','easeOut');
					}

					if(speed == 0)
					{
						speed = 0;
						clearInterval(timer1);

					}else
					{
						oBox.style.top = oBox.offsetTop-speed+'px';
					}

				},30)
			}
			oBox.ontouchmove = null;
			oBox.ontouchend = null;

		}

	}
}