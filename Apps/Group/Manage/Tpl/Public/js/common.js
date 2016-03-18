//删除左右两端的空格
function trim(str){ 
    return str.replace(/(^\s*)|(\s*$)/g, "");
}
//转跳网址
function goUrl(url) {
    if (!url) {
        return false;
    }
    location.href  = url;
}
//添加
function add(url) {
    if (!url) {
        return false;
    }
    location.href  = url;
}

//删除
function del(url) {
    if (!url) {
        alert('请选择删除项！');
        return false;
    }
    if (window.confirm('确实要永久删除选择项吗？')){
        location.href  = url;
    }
    
}
//批量删除
function delAll(){
    //if 没有被选中的checkbox
    if (!getCheckboxNum()){
        alert('请选择项！');
        return false;
    }
    if (window.confirm('确实要永久删除选择项吗？')){
        document.getElementById("form_do").submit(); 
    }
      

}
//批量确认通用
function doConfirmBatch(url, str){
    //if 没有被选中的checkbox
    if (!getCheckboxNum()){
        alert('请选择项！');
        return false;
    }
    if (window.confirm(str)){
        var form_do = document.getElementById("form_do"); 
        form_do.action = url;
        form_do.submit(); 
    }
}

//批量通用(无确认)
function doGoBatch(url, str){
    //if 没有被选中的checkbox
    if (!getCheckboxNum()){
        alert('请选择项！');
        return false;
    }
    var form_do = document.getElementById("form_do"); 
    form_do.action = url;
    form_do.submit();
}

//全部确认通用
function doConfirmAll(url, str){
    if (window.confirm(str)){
        var form_do = document.getElementById("form_do"); 
        form_do.action = url;
        form_do.submit(); 
    }
}

//直接提交
function doGoSubmit(url, formid){
    if (formid.length == 0) {
        alert('formid empty！');
        return false;
    }
    var form_do = document.getElementById(formid); 
    form_do.action = url;
    form_do.submit();       

}
//批量通过审核
function checkPass(id){
    var keyValue;
    if (id)
    {
        keyValue = id;
    }else {
        keyValue = getCheckValues();
    }

    if (!keyValue){
        alert('请选择审核项！');
        return false;
    }

    if (window.confirm('确实要通过选择项吗？')){
        location.href =  trim(SELF)+"&a=checkPass&id="+keyValue;
        //ThinkAjax.send(URL+"/foreverdelete/","id="+keyValue+'&ajax=1',doDelete);
    }
}
//批量取消审核
function forbid(id){
    var keyValue;
    if (id)
    {
        keyValue = id;
    }else {
        keyValue = getCheckValues();
    }

    if (!keyValue){
        alert('请选择审核项！');
        return false;
    }

    if (window.confirm('确实要取消选择项吗？')){
        location.href =  trim(SELF)+"&a=forbid&id="+keyValue;
        //ThinkAjax.send(URL+"/foreverdelete/","id="+keyValue+'&ajax=1',doDelete);
    }
}

//获取Checkbox被选择个数
function getCheckboxNum(){
   var checkbox = document.getElementsByName("key[]");
   var j = 0; // 用户选中的选项个数
   for(var i=0;i<checkbox.length;i++){
      if(checkbox[i].checked){
          j++;
      }
   }
   return j;

}
//设置Checkbox状态
function setCheckbox(flag){
    flag = flag? true : false;
    var checkbox = document.getElementsByName("key[]");
    for(var i=0;i<checkbox.length;i++){
        if (!checkbox[i].disabled) {        
            checkbox[i].checked = flag;
        }
    }

}

function getCheckValues(){
	var obj = document.getElementsByName('key');
	var result ='';
	var j= 0;
	for (var i=0;i<obj.length;i++){
            if (obj[i].checked===true){
//                selectRowIndex[j] = i+1;
                result += obj[i].value+",";
                j++;
            }
	}
	return result.substring(0, result.length-1);
}


$(function(){
    //选中列表行变色
    $(".list tr").mouseover(function(){
        $(this).addClass("currow");
    }).mouseout(function(){
        $(this).removeClass("currow");
    });
    //全选/取消
    $("#check").click(function(){
        if($(this).attr("checked")=="checked"){
            setCheckbox(true);
        }else{
            setCheckbox(false);
        }

    });
});
