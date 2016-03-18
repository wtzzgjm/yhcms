function publick()
{
	var oBody = document.getElementsByTagName('body');
	oBody[0].style.height = document.documentElement.clientHeight+'px';
	var oBox = document.getElementById('box');

	var oBtit = document.getElementById('btit');
	var oStit = document.getElementById('stit');
	var oAbCont = document.getElementById('aboutcont')


	//banner
	var oBan = document.getElementById('ban');
	if(oBan)
	{
		oBan.style.height = oBan.offsetWidth+'px';
		if(oBan.offsetHeight>(document.documentElement.clientHeight*0.45))
		{
			oBan.style.height = (document.documentElement.clientHeight*0.45)+'px';
		}
		var oBanLi = oBan.getElementsByTagName('li');
		for (var i = 0; i < oBanLi.length; i++) {
			oBanLi[i].style.width = oBan.offsetWidth+'px';
		}
	}
	
	
	//menu 菜单
	var oMenu = document.getElementById('menu');
	if(oMenu)
	{
		var oMenuArr = ['#74cdd5','#65c59f','#01a4b5','#029a67','#008c9b','#008558'];
		var oMenuArr2 = ['1.png','2.png','3.png','4.png','5.png','6.png']
		var oMenuLi = oMenu.getElementsByTagName('li');
		var oMenuSpan = oMenu.getElementsByTagName('span');
		for(var i=0;i<oMenuLi.length;i++)
		{
			oMenuLi[i].style.height = oMenu.offsetHeight/3.4+'px';
			oMenuLi[i].style.background = oMenuArr[i];
			oMenuSpan[i].style.background = 'url('+Pu+'/images/'+oMenuArr2[i]+') no-repeat center';
			oMenuSpan[i].style.backgroundSize = '22%';
		}	
	}


	//footer 的 高度 
	var oFoo = document.getElementById('footer');
	if(oMenu)
	{
		oFoo.style.height = (oBox.offsetHeight-oBan.offsetHeight)-oBox.offsetHeight*0.45+'px';
	}else
	{
		oFoo.style.height = ((oBox.offsetHeight-oBtit.offsetHeight)-oStit.offsetHeight)-oAbCont.offsetHeight+'px';
		//alert(oBtit.offsetHeight);
	}

}