//javascript:;
function layer()
{
	var oClassMenu = document.getElementById('classMenu');
	var oClassMenuUl = oClassMenu.getElementsByTagName('ul')[0];

	var oBTrue = true;
	oClassMenu.onclick = function (ev)
	{
		if(oBTrue == true)
		{
			ev.cancelBubble = true;
			oClassMenuUl.style.display = 'block';
			oBTrue = false;
		}else
		{
			oClassMenuUl.style.display = 'none';
			oBTrue = true;
	}
		}
		
	document.onclick = function ()
	{
		oClassMenuUl.style.display = 'none';
	}


	var oSy = document.getElementById('sy');
	var oClassclass = document.getElementById('classclass');
	var oFh = document.getElementById('fh');
	//oSy.style.display = 'none';
	oClassclass.onclick = function ()
	{
		//oSy.style.display = 'block';
		startMoveTime(oSy, {left:0},300,'Cubic','easeOut');
	}

	oFh.onclick = function ()
	{
		startMoveTime(oSy, {left:oSy.offsetWidth},300,'Cubic','easeOut');
	}


}