<?php 	
header("Access-Control-Allow-Methods: POST");

// get database connection
include_once 'database.php';
// instantiate victim object
include_once 'victim.php';
// instatiate functions
include_once 'functions.php';


// check if fields are correct else will be close
validateFields();

$database = new Database();
$db = $database->getConnection();

// check if user is registered
if(alreadyRegistered($db)){
	detail(400,"El Usuario ya se encuentra registrado");
	exit();
}

$victim = new Victim($db);
$victim->idVictima = $_POST['id_victima'];
$victim->primerNombreV = $_POST['primer_nombre_v'];
$victim->segundoNombreV = $_POST['segundo_nombre_v'];
$victim->primerApellidoV = $_POST['primer_apellido_v'];
$victim->segundoApellidoV = $_POST['segundo_apellido_v'];
$victim->direccionV = $_POST['direccion_v'];
$victim->telefonoV = $_POST['telefono_v'];
$victim->emailV = $_POST['email_v'];



if($victim->create()){
	detail(200,"Usuario registrado correctamente");
}
else{
	detail(500, "Error inesperado");
}

function validateFields(){
	if (!isTheseParametersAvailable(array('id_victima', 'primer_nombre_v', 'segundo_nombre_v', 'primer_apellido_v', 'segundo_apellido_v', 'direccion_v', 'telefono_v', 'email_v'))) {
		detail(400,"Faltan campos");
	}

	if (!is_numeric($_POST['telefono_v'])) {
		detail(400,"Numero de telefono no valido");
	}
}

function alreadyRegistered($db){

	$alreadVictim = new Victim($db);
	$alreadVictim->get($_POST['id_victima']);

	return !empty($alreadVictim->idVictima);
}


?>