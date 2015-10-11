
$(function () {
	$( '#send-btn').click(function(){
	    //alert(handleUrl);
		var username = $( 'input[name=username]' );
		var content = $( 'textarea[name=content]' );

		if(username.val() == ''){
			alert('username not null');
			username.focus();
			return ;
		}

		if(content.val() == ''){
			alert('content not null');
			content.focus();
			return ;
		}

		$.post(handleUrl, {username : username.val(), content : content.val()},function (data) {
			if(data.status){
				//$("#label1").innerHTML='asdasd';
				//document.getElementById("label1").value='啊三大谁';
				//document.getElementById("label1").innerHTML="需显示的内容 ";
				alert('发布成功');
			}else{
				alert('发布失败');
			}

		}, 'json');
	})

});

