// JavaScript Document
function individualRadioState(){//Alter individualRadio's state while button down
	document.getElementById("ir").checked = true;
	document.getElementById("hr").checked = false;
	document.getElementById("ir1").checked = true;
	document.getElementById("hr1").checked = false;
}
function hrRadioState(){//Alter hrRadio's state while button down
	document.getElementById("ir").checked = false;
	document.getElementById("hr").checked = true;
	document.getElementById("ir1").checked = false;
	document.getElementById("hr1").checked = true;
}
//favorite
function joinFavorite(siteUrl,siteName){
	try{
		if(document.all){//如果支持则用external方式加入收藏夹
			window.external.addFavorite(siteUrl,siteName);
		}
		else if(window.sidebar){//如果支持window.sidebar，则用下列方式加入收藏夹  
			window.sidebar.addPanel(siteName, siteUrl,''); 
		}
	}catch(e){
		alert("加入收藏夹失败，请使用Ctrl+D快捷键进行添加操作!");
	}
}
//register
function comfirmUserType(){
	var ir = document.getElementById("ir").checked;
	var hr = document.getElementById("hr").checked;
	var url;
	if(ir){
		url = url1;
	}
	else{
		url = url2;
	}
	return url;
}

function changeVerify(){//change verify
	var verify_img = $("#verify_div").find('img');
	var verify_url = verify_img.attr("src");
	var verify_label = $("#verify_div").find('label');
	
	var url = verify_url.split('?');
	//alert(url[0]);
	verify_url = url[0];
//	verify_label.click(function(){
///*		if(verify_url.indexOf('?')>0){
//			$(verify_img).attr("src",verify_url+'&random='+Math.random());
//		}
//		else{
//			$(verify_img).attr("src",verify_url.replace(/\?.*$/,'')+'?'+Math.random());
//		}*/
//		$(verify_img).attr("src",verify_url+'?&random='+Math.random());
//	});
//	verify_img.click(function(){
///*		if(verify_url.indexOf('?')>0){
//			$(verify_img).attr("src",verify_url+'&random='+Math.random());
//		}
//		else{
//			$(verify_img).attr("src",verify_url.replace(/\?.*$/,'')+'?'+Math.random());
//		}*/
//		$(verify_img).attr("src",verify_url+'?&random='+Math.random());
//	});
	$(verify_img).attr("src",verify_url+'?&random='+Math.random());
}

function checkRegUsername(){
	//check username is whether blank or not
	if(!document.getElementById("reg_username").value){
		document.getElementById("uidlabel").style.visibility = "visible";
	}
	else{
		document.getElementById("uidlabel").style.visibility = "hidden";
		var uid_split = document.getElementById("reg_username").value.split("@");
	   var uid_split1 = uid_split[1].split(".");
	  if(uid_split1[1]){
	  		document.getElementById("uidlabel1").style.visibility = "hidden";			
	  }
	    else{
		    document.getElementById("uidlabel1").style.visibility = "visible";
		//$('#uidlabel1').attr(visibility,"visiblle");
	    }
	}
	
}
function checkRegpassword(){
		//check pwd is whether blank or not
	if(!document.getElementById("reg_password").value){
		document.getElementById("pwdlabel").style.visibility = "visible";
	}
	else{
		document.getElementById("pwdlabel").style.visibility = "hidden";
	}
	checkRegCompassword();
}
function checkRegCompassword(){
	//check pwd is the same as comfirm_pwd or not
	var pwd = document.getElementById("reg_password").value;
	var comfirm_pwd = document.getElementById("reg_password_comfirm").value;
	if(pwd != comfirm_pwd){
		document.getElementById("compwdlabel").style.visibility = "visible";
	}
	else{
		document.getElementById("compwdlabel").style.visibility = "hidden";
	}
}
function checkRegVerify(){//check verify is whether full or not 
	if(!document.getElementById("verify_ip").value){
		document.getElementById("verifylabel").style.visibility = "visible";
	}
	else{
		document.getElementById("verifylabel").style.visibility = "hidden";
	}
}

function clearRegInfo(){
	document.getElementById("compwdlabel").style.visibility = "hidden";
	document.getElementById("pwdlabel").style.visibility = "hidden";
	document.getElementById("uidlabel").style.visibility = "hidden";
	document.getElementById("verifylabel").style.visibility = "hidden";
	//document.getElementById("reglabel").style.visibility = "hidden";
	document.getElementById("uidlabel1").style.visibility = "hidden";
	document.getElementById("reg_username").value = "";
	document.getElementById("reg_password").value = "";
	document.getElementById("reg_password_comfirm").value = "";
	document.getElementById("verify_ip").value = "";
	document.getElementById('pwd_Weak').className="pwd pwd_c"; 
    document.getElementById('pwd_Medium').className="pwd pwd_c pwd_f"; 
    document.getElementById('pwd_Strong').className="pwd pwd_c pwd_c_r"; 
    document.getElementById('pwd_Medium').innerHTML="无";
}
//AJAX
$(function(){
		$('#reg_submit').click(function(){//regster_form
			var username = $('input[name = reg_username]');
			var password = $('input[name = reg_password]');
			var confirm_password = $('input[name = reg_password_comfirm]');
			var verify_ip = $('input[name = verify_ip]');
			if(!username.val() || !password.val() || !confirm_password.val() || !verify_ip.val()){
				document.getElementById("reglabel").style.visibility = "visible";
				//$('#reglabel').attr(visibility,"visible");
			}
			else{
				var uid_split = username.val().split("@");
				var uid_split1 = uid_split[1].split(".");
				if(uid_split1[1]){
					var url = comfirmUserType();
					
						//alert(url);
						//alert(username.val());
					$.post(url,{"reg_username" : username.val(),"reg_password" : password.val(),"verify_ip" : verify_ip.val()},function($result){
							if($result.status == "注册成功"){
								alert("注册成功，验证邮件已发出");
							}
							else if($result.status == "注册失败"){
								alert("注册失败");
								changeVerify();
							}
							else if($result.status == "验证码错误"){
								alert("验证码错误");
								changeVerify();
							}
							else if($result.status == "邮箱名称已经存在"){
								alert("邮箱名称已经存在");
								changeVerify();
							}
						},'json');
				}
				else{
					document.getElementById("uidlabel1").style.visibility = "visible";
					//$('#uidlabel1').attr(visibility,"visiblle");
				}
			}
			
		});
		$('#find_submit').click(function(){
			var fusername = $('input[name = find_username]');
			var fverify = $('input[name = fverify_ip]');
			if(!fusername.val() || ! fverify.val()){
				document.getElementById("findlabel").style.visibility = "visible";
			}
			else{
				var uid_split = fusername.val().split("@");
				var uid_split1 = uid_split[1].split(".");
				if(uid_split1[1]){
					$.post(findurl,{"email" : fusername.val(),"verify" : fverify.val()},function($result){
						//alert($result.status);
						if($result.status == "验证码错误"){
							alert("验证码错误");
							fchangeVerify();
						}
						else if($result.status == "邮箱未注册"){
							alert("邮箱未注册");
							fchangeVerify();
						}
						else if($result.status == "发送成功"){
							alert("邮件成功发送");
						}
						else if($result.status == "发送失败"){
							alert("邮件发送失败");
							fchangeVerify();
						}
					},'json');
				}
				else{
					document.getElementById("fuidlabel1").style.visibility = "visible";
				}
			}
		});
});
/////////////////////////////////////////////////////////////////password strength
function CheckIntensity(pwd){ 
  var Mcolor,Wcolor,Scolor,Color_Html; 
  var m=0; 
  var Modes=0; 
  for(i=0; i<pwd.length; i++){ 
    var charType=0; 
    var t=pwd.charCodeAt(i); 
    if(t>=48 && t <=57){charType=1;} 
    else if(t>=65 && t <=90){charType=2;} 
    else if(t>=97 && t <=122){charType=4;} 
    else{charType=4;} 
    Modes |= charType; 
  } 
  for(i=0;i<4;i++){ 
  if(Modes & 1){m++;} 
      Modes>>>=1; 
  } 
  if(pwd.length<=4){m=1;} 
  if(pwd.length<=0){m=0;} 
  switch(m){ 
    case 1 : 
      Wcolor="pwd pwd_Weak_c"; 
      Mcolor="pwd pwd_c"; 
      Scolor="pwd pwd_c pwd_c_r"; 
      Color_Html="弱"; 
    break; 
    case 2 : 
      Wcolor="pwd pwd_Medium_c"; 
      Mcolor="pwd pwd_Medium_c"; 
      Scolor="pwd pwd_c pwd_c_r"; 
      Color_Html="中"; 
    break; 
    case 3 : 
      Wcolor="pwd pwd_Strong_c"; 
      Mcolor="pwd pwd_Strong_c"; 
      Scolor="pwd pwd_Strong_c pwd_Strong_c_r"; 
      Color_Html="强"; 
    break; 
    default : 
      Wcolor="pwd pwd_c"; 
      Mcolor="pwd pwd_c pwd_f"; 
      Scolor="pwd pwd_c pwd_c_r"; 
      Color_Html="无"; 
    break; 
  } 
  document.getElementById('pwd_Weak').className=Wcolor; 
  document.getElementById('pwd_Medium').className=Mcolor; 
  document.getElementById('pwd_Strong').className=Scolor; 
  document.getElementById('pwd_Medium').innerHTML=Color_Html; 
}
////////////////////////////////////////////////////////////////find passwrod
function checkFindUsername(){
	//check username is whether blank or not
	if(!document.getElementById("find_username").value){
		document.getElementById("fuidlabel").style.visibility = "visible";
	}
	else{
		document.getElementById("fuidlabel").style.visibility = "hidden";
		var uid_split = document.getElementById("find_username").value.split("@");
	   var uid_split1 = uid_split[1].split(".");
	  if(uid_split1[1]){
	  		document.getElementById("fuidlabel1").style.visibility = "hidden";			
	  }
	    else{
		    document.getElementById("fuidlabel1").style.visibility = "visible";
		//$('#uidlabel1').attr(visibility,"visiblle");
	    }
	}
	
}
function checkFindVerify(){//check verify is whether full or not 
	if(!document.getElementById("fverify_ip").value){
		document.getElementById("fverifylabel").style.visibility = "visible";
	}
	else{
		document.getElementById("fverifylabel").style.visibility = "hidden";
	}
}
function clearFindInfo(){
	document.getElementById("fuidlabel").style.visibility = "hidden";
	document.getElementById("fverifylabel").style.visibility = "hidden";
	//document.getElementById("findlabel").style.visibility = "hidden";
	document.getElementById("fuidlabel1").style.visibility = "hidden";
	document.getElementById("find_username").value = "";
	document.getElementById("fverify_ip").value = "";
}
function fchangeVerify(){//change verify
	var verify_img = $("#fverify_div").find('img');
	var verify_url = verify_img.attr("src");
	var verify_label = $("#fverify_div").find('label');
	
	var url = verify_url.split('?');
	//alert(url[0]);
	verify_url = url[0];
	$(verify_img).attr("src",verify_url+'?&random='+Math.random());
}