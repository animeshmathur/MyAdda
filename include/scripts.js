// JavaScript Document
function checkLoginFields()
{
	if(document.loginform.my_id.value=="")
	{
		alert("Please enter Login ID!");
		return false;
	}
	if(document.loginform.my_pwd.value=="")
	{
		alert("Please enter password!");
		return false;
	}
	return true;
}

function checkRegFields()
{
	if(document.regform.user_id.value==""||uid_status==0)
	{
		alert("Please choose your User ID!");
		return false;
	}
	if(document.regform.user_pwd.value=="")
	{
		alert("Please enter password!");
		return false;
	}
	if(document.regform.rpwd.value=="")
	{
		alert("Please re-enter password!");
		return false;
	}
	if(document.regform.uname.value=="")
	{
		alert("Please enter your full name!");
		return false;
	}
	if(document.regform.bday.value=="-1"||document.regform.bmonth.value=="-1"||document.regform.byear.value=="-1"||(document.regform.bmonth.value=="2"&&document.regform.bday.value>="30"))
	{
		alert("Please select date of birth properly!");
		return false;
	}
	if(document.regform.ucity.value=="-1")
	{
		alert("Please select your city!");
		return false;
	}
	if(document.regform.umail.value=="")
	{
		alert("Please enter your email!");
		return false;
	}
	if(document.regform.user_pwd.value!=document.regform.rpwd.value)
	{
		alert("Passwords do not match!");
		return false;
	}
	return true;
}

