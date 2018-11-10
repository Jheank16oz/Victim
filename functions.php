<?php 	

function isTheseParametersAvailable($params){

	//traversing through all the parameters 
	foreach($params as $param){
		//if the paramter is not available
		if(!isset($_POST[$param])){		
			//return false 
			return false; 
		}
	}
	//return true if every param is available 
	return true; 
}



function detail($errorCode, $message){

	http_response_code($errorCode);
	echo json_encode(array("detail" =>$message));

	exit();
}


?>