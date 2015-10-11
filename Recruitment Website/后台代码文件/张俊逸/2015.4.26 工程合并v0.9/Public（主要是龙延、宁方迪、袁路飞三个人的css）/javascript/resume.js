
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