function uploadconfirm(path){
 	document.getElementById('uploadform').action=path;
 	document.getElementById('uploadform').submit();
 //	alert(path);
}
function submitYouFrom(path){
	if(confirm('你确定上传吗？')){
		var src = document.getElementById('up').src;

		$.post(path , { flag:1 ,urlpath:src} , function (data){ },"json");

	}
	else{
		$.post(path , { flag:0 ,urlpath:del} , function (data){ },"json");
	}
}