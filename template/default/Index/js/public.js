function yh_tab (a,b){//产品选项卡
	var oDiv2=document.getElementById(a);
	var oA=oDiv2.children;
	var oDiv3=document.getElementById(b);
	oDiv3.children[0].style.display = 'block';
	var oUl2=oDiv3.children;

	for (var i = 0; i < oA.length; i++) {
		oA[i].index=i;
		oA[i].onmouseover=function(){
			for (var j = 0; j < oUl2.length; j++) {
				oUl2[j].style.display="none";
			};
			oUl2[this.index].style.display="block";
		};
	};
}

function InterlacedColor(a,b,c){//隔行变色
	var oUl=document.getElementById(a);
	var oLi=oUl.getElementsByTagName(b);

	for (var i = 0; i < oLi.length; i++) {
		oLi[i].index=i;
		if (oLi[i].index%2==1) 
		{
			oLi[i].style.backgroundColor=c;
		} 
		else{
			oLi[i].style.backgroundColor="";
		};
	};
}

function yh_DisplayWindow (a,b,c){ //产品 列表/橱窗 切换
	var oBtn=document.getElementById(a);
	var oAa=oBtn.children;
	var oA=document.getElementById(b);
	var oB=document.getElementById(c);
	oAa[0].onclick=function ()
	{
		oB.style.display='none';
		oA.style.display='block';
	};
	oAa[1].onclick=function ()
	{
		oA.style.display='none';
		oB.style.display='block';
	};
}

function yh_ClassOpen(a,b,c){ //分类展开
	var oUl=document.getElementById(a);
	var oSpan=oUl.getElementsByTagName(b);
	var oU=oUl.getElementsByTagName(c);
	for (var i = 0; i < oU.length; i++) {
		oSpan[i].parentNode.parentNode.index=i;
		oSpan[i].parentNode.parentNode.onclick=function()
		{
			for (var j = 0; j < oU.length; j++) {
				oU[j].style.display='none';
			};
			oU[this.index].style.display='block';
		}
	};
}

function yh_input (a,b,c){ //输入框提示
	var oTab=document.getElementById(a);
	var oSpan2=oTab.getElementsByTagName(b);
	var All = oTab.getElementsByTagName('*');
	var Arr2 = [];
	for(var i=0; i<All.length;i++) {
		if(All[i].className == c) {
			Arr2.push(All[i]);
		}
	}
	for (var i = 0; i < Arr2.length; i++) {
		Arr2[i].index=i;
		Arr2[i].onclick=function () {
			for (var j = 0; j < oSpan2.length; j++) {
				oSpan2[j].style.display='block';
				Arr2[j].style.border='1px solid #dedede';
			};
			oSpan2[this.index].style.display='none';
			this.style.border='1px solid rgb(241,202,126)';
			for (var o = 0; o < Arr2.length; o++) {
				if (Arr2[o].value=="") 
				{
					
				}
				else
				{
					oSpan2[o].style.display='none';
				};
			};
				
		};

		oSpan2[i].onclick=function  () {
			for (var k = 0; k < oSpan2.length; k++) {
				oSpan2[k].index=k;
				oSpan2[k].style.display='block';
				Arr2[k].style.border='1px solid #dedede';
			};
			this.style.display='none';
			Arr2[this.index].style.border='1px solid rgb(241,202,126)';
			for (var o = 0; o < Arr2.length; o++) {
				if (Arr2[o].value=="") 
				{
					
				}
				else
				{
					oSpan2[o].style.display='none';
				};
			};
				
		};
	};

	Arr2[3].onclick=function  () {
		for (var y = 0; y < oSpan2.length; y++) {
				oSpan2[y].style.display='block';
				Arr2[y].style.border='1px solid #dedede';
			};
		for (var o = 0; o < oSpan2.length; o++) {
			if (Arr2[o].value=="") 
			{
				
			}
			else
			{
				oSpan2[o].style.display='none';
			};
		};
	}
}

/*
图片自适应
*/
 
function reset_pic(obj, size,bl) {
    size = size.split(',');
    var dW = size[0];
    var dH = size[1];
    var img = new Image();
    img.src = obj.src;
    if(img.width/img.height >= dW/dH) {
        if(img.width > dW) {
            obj.width = dW;
            obj.height = img.height*dW/img.width;
        }else {
            obj.width = img.width;
            obj.height = img.height > dH ? img.height*img.width/dW : img.height;
        }
    }else {
        if(img.height > dH) {
            obj.height = dH;
            obj.width = img.width*dH/img.height;
        }else {
            obj.height = img.height;
            obj.width = img.width > dW ? img.height*img.width/dH : img.width;
        }
    }
 
     if(obj.currentStyle)
    {
      //return obj.currentStyle[name];
      obj.style.marginTop = (dH-parseInt(obj.currentStyle['height']))/2+'px';
    }
    else
    {
      obj.style.marginTop = (dH-obj.height)/2+'px';
    }
  if(bl)
  {
    obj.style.marginLeft = 0;
  }else
  {
    if(obj.currentStyle)
    {
      //return obj.currentStyle[name];
      obj.style.marginLeft = (dW-parseInt(obj.currentStyle['width']))/2+'px';
    }
    else
    {
      obj.style.marginLeft = (dW-obj.width)/2+'px';
    }
  }
 
}