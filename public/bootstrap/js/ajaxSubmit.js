//Login & Register
$(document).ready(function(){
 $('#action').click(function(e) {
		login();
		e.preventDefault();		
    });
 
});

function login () {
	hideshow('loading',1);
	error(0);
	
	$.ajax({
		type : "POST",
		url : "http://localhost/blog/public/check_database",
		data: {loginname : $('#loginname').val(), password : $('#password').val()},
		dataType : "json",
		success : function(data){
			if(parseInt(data.status)==1)
			{
				window.location="http://localhost/blog/public/Hello";
			}
			else if(parseInt(data.status)==0)
			{
				error(1,data.message);
			}
			
			hideshow('loading',0);
		}
	});	
}

function hideshow(el,act)
{
	if(act) $('#'+el).css('visibility','visible');
	else $('#'+el).css('visibility','hidden');
}

function error(act,txt)
{
	hideshow('error',act);
	if(txt) 
	{
		$('#error').addClass("alert alert-danger");
		$('#error').html(txt);
	}
}