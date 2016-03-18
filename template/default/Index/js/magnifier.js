function magnifier (id){

	var oMag = document.getElementById(id);
	var oImg = oMag.getElementsByTagName('img')[0];
	var time = null;

	var oMagBorder = (oMag.offsetHeight-oMag.clientHeight) / 2;
 
	var oSpaceLeft = oImg.offsetLeft - oMag.offsetLeft - oMagBorder;
	var oSpaceRight = oMag.clientWidth - oSpaceLeft - oImg.offsetWidth;
	var oSpaceTop = oImg.offsetTop - oMag.offsetTop - oMagBorder;
	var oSpaceBottom = oMag.clientHeight - oSpaceTop - oImg.offsetHeight;

	oMag.style.position = "relative";
	oMag.style.display = "block";
	oMag.style.float = "left";

	oMag.onmouseover=function(){

		clearTimeout(time)
		var oDiv = oMag.getElementsByTagName('div');

		if (oDiv.length != 2) {

			var oDiv = document.createElement("div");
			oDiv.className = 'small_box';
			oDiv.style.position = "absolute";
			oDiv.style.left = 0;
			oDiv.style.top = 0;
			oDiv.style.width = oMag.offsetWidth/2.5 + 'px';
			oDiv.style.height = oMag.offsetHeight/2.5 + 'px';
			oDiv.style.filter = "alpha(opacity=60)";
			oDiv.style.background = "#fff";
			oDiv.style.opacity = 0.6;
			oMag.appendChild(oDiv);

			var oDiv2 = document.createElement("div");
			oDiv2.className = 'big_box';
			oDiv2.style.position = "absolute";
			oDiv2.style.left = oMag.offsetWidth + 10 + 'px';
			oDiv2.style.top = oSpaceTop+'px';
			oDiv2.style.width = oImg.offsetWidth + 'px';
			oDiv2.style.height = oImg.offsetHeight + 'px';
			oDiv2.style.zIndex = 99;
			oDiv2.style.overflow = "hidden";

			var oImg2 = document.createElement("img");
			oImg2.src = oImg.src
			oImg2.style.width = oImg.offsetWidth*oImg.offsetWidth/oDiv.offsetWidth + 'px';
			oImg2.style.height = oImg.offsetHeight*oImg.offsetHeight/oDiv.offsetHeight + 'px';
			oImg2.style.position = "absolute"; 
			oImg2.style.left = 0; 
			oImg2.style.top = 0;

			oDiv2.appendChild(oImg2);
			oMag.appendChild(oDiv2);
		};
	}

	oMag.onmouseout=function(){
		time = setTimeout(function(){
			var oDDiv = oMag.getElementsByTagName('div')[0];
			var oDDiv2 = oMag.getElementsByTagName('div')[1];
			oMag.removeChild(oDDiv)
			oMag.removeChild(oDDiv2)
		},100)
	}
	
	oMag.onmousemove=function(ev){

		var oEvent = ev || event;
		var oLeft = oEvent.clientX;
		var oTop = oEvent.clientY + document.body.scrollTop;
		var oImg2 = oMag.getElementsByTagName('img')[1];

		var oDiv = oMag.getElementsByTagName('div')[0];
		var oDiv2 = oMag.getElementsByTagName('div')[1];

		oDiv.style.left = oLeft - oMag.offsetLeft - oDiv.offsetWidth/2 + 'px';
		oDiv.style.top = oTop - oMag.offsetTop - oDiv.offsetHeight/2 + 'px';
		if (oDiv.offsetLeft < oSpaceLeft) {
			oDiv.style.left = oSpaceLeft + 'px';
		};
		if (oDiv.offsetLeft > oMag.clientWidth - oSpaceRight - oDiv.offsetWidth) {
			oDiv.style.left = oMag.clientWidth - oSpaceRight - oDiv.offsetWidth + 'px';
		};
		if (oDiv.offsetTop < oSpaceTop) {
			oDiv.style.top =  oSpaceTop + 'px';
		};
		if (oDiv.offsetTop > oMag.clientHeight- oSpaceBottom - oDiv.offsetHeight) {
			oDiv.style.top = oMag.clientHeight- oSpaceBottom - oDiv.offsetHeight + 'px';
		};

		oImg2.style.left = - oDiv.offsetLeft/oImg.offsetWidth * oImg2.offsetWidth + oSpaceLeft * (oImg.offsetHeight/oDiv.offsetHeight) + 'px';
		oImg2.style.top = - oDiv.offsetTop/oImg.offsetHeight * oImg2.offsetHeight + oSpaceTop * (oImg.offsetHeight/oDiv.offsetHeight) + 'px';
	}
}