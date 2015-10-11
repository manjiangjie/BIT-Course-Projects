
function downloadclick(path){
	$.post(path , { } , function (data){ 
	if(data.status == 1)
			alert('下载成功');
	else
			alert('发布失败');
	 }, "json");
}

function interviewclick(path){
	$.post(path , { } , function (data){ 
	if(data.status == 1)
			alert('邀请成功');
	else
			alert('邀请失败');
	 }, "json");
}
function refuseclick(path){
	$.post(path , { } , function (data){ 
	if(data.status == 1)
			alert('拒绝成功');
	else
			alert('拒绝失败');
	 }, "json");
}
function collectclick(path){
	$.post(path , { } , function (data){  
	if(data.status == 1)
			alert('收藏成功');
	else
			alert('收藏失败');
	}, "json");
}


function jobopenclick(path){
	$.post(path , { } , function (data){  
	if(data.status == 1)
			alert('发布成功');
	else
			alert('发布失败');
	}, "json");
}

function jobclosenclick(path){
	$.post(path , { } , function (data){
	if(data.status == 1)
			alert('结束成功');
	else
			alert('结束失败');  
	}, "json");
}

function saveschool(path){
	var school = document.getElementById('school').value;
	var major = document.getElementById('major').value;
	var sty = document.getElementById('sty').value;
	var stm = document.getElementById('stm').value;
	var eny = document.getElementById('eny').value;
	var enm = document.getElementById('enm').value;
	var degree = document.getElementById('degree').value;


	 $.post(path , {school:school,major:major,sty:sty,stm:stm,eny:eny,enm:enm,degree:degree } , function (data){  }, "json");
	alert('保存成功');
}


function saveresume(path){
	var age = document.getElementById('age').value;
	var tel = document.getElementById('tel').value;
	var mail = document.getElementById('mail').value;
	var nation = document.getElementById('nation').value;
	var address = document.getElementById('address').value;
	var status = document.getElementById('status').value;

	 $.post(path , {age:age,tel:tel,mail:mail,nation:nation,address:address,status:status} , function (data){  }, "json");
	alert('保存成功');
}

function addwork(path){
	var company = document.getElementById('company').value;
	var industry = document.getElementById('industry').value;
	var job = document.getElementById('job').value;
	var workaddress = document.getElementById('workaddress').value;
	var wsy = document.getElementById('wsy').value;
	var wsm = document.getElementById('wsm').value;
	var wey = document.getElementById('wey').value;
	var wem = document.getElementById('wem').value;

	 $.post(path , {company:company,industry:industry,job:job,workaddress:workaddress,wsy:wsy,wsm:wsm,wey:wey,wem:wem} , function (data){  }, "json");
	alert('保存成功');
}