<?php 	
header("Access-Control-Allow-Methods: POST");

// get database connection
include_once 'database.php';
// instantiate victim object
include_once 'victim.php';
// instatiate functions
include_once 'functions.php';


// check if fields are correct else will be close
validateId();

$database = new Database();
$db = $database->getConnection();

// check if user is registered
if(alreadyRegistered($db)){
	detail(200,"Has iniciado sesion correctamente");
}else{
	detail(400,"El usuario no se encuentra registrado");
}


function alreadyRegistered($db){

	$alreadVictim = new Victim($db);
	$alreadVictim->get($_POST['id_victima']);

	return !empty($alreadVictim->idVictima);
}


function validateId(){
	if (!isTheseParametersAvailable(array('id_victima'))) {
		detail(400,"Faltan campos");
	}
}

?>