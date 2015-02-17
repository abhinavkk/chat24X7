$(document).ready(function(){
	$("#submit").click(function(e) {
	e.preventDefault();
	var d={
		 comment : $(".file").val(),
	     submit: "submit",
	};
	$.ajax({
		url:"/post",
		type:"POST",
		data: {det: d},
		datatype: 'JSON',
		success: function(ret) {

			console.log(ret.id);
			var str = '<div><strong>' + ret['username'] + ':</strong>' + d['comment'] + '<br/><span id="info">'+'<span id="a'+ret.id+'">0'+'</span>'+'<button onclick="vote('+ret.id+')"'+'>LIKE</button></span><span id="user">' + ret['time'] + '</span></div><hr id="print"><br/>';
			$("#check").after(str);
			$(".file").val("");
			},
		error : function() {
			console.log("J");
		}
		});
	}
	);
})