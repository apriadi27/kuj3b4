function ajax(ajaxRequest){
	try{
		var ajaxRequest = new XMLHttpRequest;
	}
	catch(e){
		try{
			var ajaxRequest = new ActiveXObject('Microsoft.XMLHTTP');
		}
		catch(e){
			try{
				var ajaxRequest = new ActiveXObject("Msxm12.XMLHTTP");
			}
			catch(e){
				alert("Your browser is not supported by ajax");
			}
		}
	}
	return ajaxRequest;
}
