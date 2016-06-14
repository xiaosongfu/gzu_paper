function to_next(){
	$result = $("#audit").val();
	if($result == "pass"){
		$("#aduitfailbox").hide();
		$("#longitude").show();
		$("#latitude").show();
	}else{
		$("#longitude").hide();
		$("#latitude").hide();
		$("#aduitfailbox").show();
	}
}