		// JavaScript Document
function individualRadioState(){//Alter individualRadio's state while button down
	document.getElementById("ir").checked = true;
	document.getElementById("hr").checked = false;
	document.getElementById("ir1").checked = true;
	document.getElementById("hr1").checked = false;
	comfirmUserType();
}
function hrRadioState(){//Alter hrRadio's state while button down
	document.getElementById("ir").checked = false;
	document.getElementById("hr").checked = true;
	document.getElementById("ir1").checked = false;
	document.getElementById("hr1").checked = true;
	comfirmUserType()
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
	document.getElementById("register_form").action = url;
}

function changeVerify(){//change verify
	var verify_img = $("#verify_div").find('img');
	var verify_url = verify_img.attr("src");
	var verify_label = $("#verify_div").find('label');
	
	var url = verify_url.split('?');
	//alert(url[0]);
	verify_url = url[0];
	verify_label.click(function(){
/*		if(verify_url.indexOf('?')>0){
			$(verify_img).attr("src",verify_url+'&random='+Math.random());
		}
		else{
			$(verify_img).attr("src",verify_url.replace(/\?.*$/,'')+'?'+Math.random());
		}*/
		$(verify_img).attr("src",verify_url+'?&random='+Math.random());
	});
}
function checkVerify(){
	var verify_value = document.getElementById("verify_ip").value;
	//alert(verify_value);
}
function checkRegInfo(){
	//check username is whether blank or not
	if(!document.getElementById("reg_username").value){
		document.getElementById("uidlabel").style.visibility = "visible";
	}
	else{
		document.getElementById("uidlabel").style.visibility = "hidden";
	}
	//check pwd is whether blank or not
	if(!document.getElementById("reg_password").value){
		document.getElementById("pwdlabel").style.visibility = "visible";
	}
	else{
		document.getElementById("pwdlabel").style.visibility = "hidden";
	}
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
function checktoReg(){//check whether all infomations are legal or not
	var uidlabel = document.getElementById("uidlabel");
	var pwdlabel = document.getElementById("pwdlabel");
	var compwdlabel = document.getElementById("compwdlabel");
}
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