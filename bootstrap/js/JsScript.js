var txt1="";

function Validate()
{
	var valu = $('input:radio[name=choice]:checked').val();
	if(valu == undefined)
	{
		$("#choiceError").css("display","block");
		return false;
	}
	else
	{
		$("#choiceError").css("display","none");
	}	
}

function GetData()
{
	 txt1 = $("#FileContent").val();
}


function Copy(evt)
{
        var txt2 = $("#AddData").val();
	var txt = txt1 + txt2;
	$("#FileContent").val(txt);
}


