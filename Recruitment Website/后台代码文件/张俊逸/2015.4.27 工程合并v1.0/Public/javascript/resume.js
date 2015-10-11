
function downloadclick(path){
	$.post(path , { } , function (data){  }, "json");
	alert('下载成功');
}

function interviewclick(path){
	$.post(path , { } , function (data){  }, "json");
	alert('邀请成功');
}
function refuseclick(path){
	$.post(path , { } , function (data){  }, "json");
	alert('拒绝成功');
}
function collectclick(path){
	$.post(path , { } , function (data){  }, "json");
	alert('收藏成功');
}


function jobopenclick(path){
	$.post(path , { } , function (data){  }, "json");
	alert('重新发布成功');
}

function jobclosenclick(path){
	$.post(path , { } , function (data){  }, "json");
	alert('已结束该工作');
}