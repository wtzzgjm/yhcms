function change_code(obj){
	$("#code").attr("src",verifyUrl+'#'+Math.random());
	return false;
}
//登录验证  1为空   2为错误
var validate={username:1,password:1,code:1}
$(function(){
	$("#login").submit(function(){

		//验证用户名
		$("input[name='username']").trigger("blur");
		//验证密码
		$("input[name='password']").trigger("blur");
		//验证验证码
		//$("input[name='code']").trigger("blur");
		var code = $("input[name='code']");
		if($.trim(code.val())==''){
			code.parent().find("span").remove().end().append("<span class='error'>验证码不能为空</span>");
			return false;
		}else{
			code.parent().find("span").remove();
		}
		if(validate.username==0 && validate.password==0){
			return true;
		}
		return false;
	});
});
$(function(){
	//验证用户名
	$("input[name='username']").blur(function(){
		var username = $("input[name='username']");
		if($.trim(username.val())==''){
			username.parent().find("span").remove().end().append("<span class='error'>用户名不能为空</span>");
			return ;
		}
		$.post(CONTROL_U,{username:$.trim(username.val())},function(stat){
			if(stat==1){
				validate.username=0;
				username.parent().find("span").remove();
			}else{
				username.parent().find("span").remove().end().append("<span class='error'>用户不存在</span>");
			}

		});
	});
	//验证密码
	$("input[name='password']").blur(function(){
		var password = $("input[name='password']");
		var username=$("input[name='username']");
		if($.trim(username.val())==''){
			return;
		}
		if(password.val()==''){
			password.parent().find("span").remove().end().append("<span class='error'>密码不能为空</span>");
			return ;
		}
		$.post(CONTROL_P,{password:password.val(),username:$.trim(username.val())},function(stat){
			if(stat==1){
				validate.password=0;
				password.parent().find("span").remove();
			}else{
				password.parent().find("span").remove().end().append("<span class='error'>密码错误</span>");
			}

		});
	});
});

