$(document).ready(function maj(){
		$.get("./file.txt", function(data, status){	
		setInterval(function(){ D(); }, 3000);	 
    });
});	
function D(){
		var data = $("#v :input").serializeArray();
		$.get($("#v").attr("action"),data,function(info){ $("#n").html(info);});
		};	