<?php


require_once "../ws/lib/nusoap.php";
require_once "../materiales.php";

$server = new soap_server();

//CONFIGURAR EL NAMESPACE
$server->configureWSDL("ws", "urn:finalprog");
$server->schemaTargetNamespace = "urn:finalprog";

//SETTEAR VARIABLE GLOBAL
if (!isset($HTTP_RAW_POST_DATA)) 
{
	$HTTP_RAW_POST_DATA = file_get_contents("php://input");
}


//DEFINIR LOS METODOS QUE VA A CONSUMIR EL CLIENTE

function CargarMateriales()
{
	return json_encode(Materiales::cargarMateriales());
}

function GuardarMaterial($nombre, $precio, $tipo)
{
	Materiales::insertarMateriales($nombre, $precio, $tipo);

}

function BorrarMaterial($id)
{
	Materiales::sacarMaterial($id);
}

function ModificarMaterial($nombre, $precio, $tipo, $id)
{
	Materiales::modificarMaterial($nombre, $precio, $tipo, $id);
}


//REGISTRAR LOS METODOS EN EL SERVIDOR
$server->register("CargarMateriales", array(), array("return"=>"xsd:string"), 
													"urn:finalprog", 
													"urn:finalprog#CargarMateriales",
													"rpc",
													"encoded",
													"Carga todos los materiales"
					);


$server->register("GuardarMaterial", array("nombre" => "xsd:string", "precio" => "xsd:float", "tipo" => "xsd:string"), 
									 array("return" => "xsd:string"), 
									 "urn:finalprog", 
									 "urn:finalprog#GuardarMaterial",
									 "rpc",
									 "encoded",
									 "Guarda el material en la BD"
					);


$server->register("BorrarMaterial", array("id"=>"xsd:int"), 
									array("return"=>"xsd:string"), 
									"urn:finalprog", 
									 "urn:finalprog#BorrarMaterial",
									 "rpc",
									 "encoded",
									 "Elimina el material en la BD"

	);

$server->register("ModificarMaterial", array("nombre" => "xsd:string", "precio" => "xsd:float", "tipo" => "xsd:string", "id"=>"xsd:int"),
									   array("return" => "xsd:string"), 
									   "urn:finalprog", 
									   "urn:finalprog#GuardarMaterial",
									   "rpc",
									   "encoded",
									   "Modifica el material en la BD"

	);




$server->service($HTTP_RAW_POST_DATA);














?>