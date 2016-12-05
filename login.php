<?php

require_once 'ws/lib/nusoap.php';

$usuario = $_POST["usuario"];
$cookie = $_POST["sicookie"];


$clave = $_POST["clave"];
$encontrado = 0;
$perfil ="";
$nombre="";


$archivo = fopen('usuarios.txt', 'r');

	while (!feof($archivo)) 
	{
		$fila = fgets($archivo);
		$matrizUsuarios[] = explode('-', $fila);
	}

 
 foreach ($matrizUsuarios as $i) 
 {
 	if ($i[0] == $usuario && $i[1] == $clave) 
 	{
 		setcookie('nombre', $i[0], time()+3600);
 		$encontrado = 1;
 		$nombre = $i[0];
 		break;
 	}
 }


if ($encontrado != 1) 
{
	echo "Usuario no encontrado";
}
else
	{
		$nombre=explode('@', $nombre);

		//LE PASO LA RUTA DEL WSDL DEL METODO DEFINIDO EN EL SERVIDOR
		$cliente = new nusoap_client("http://localhost:8080/ABM_WebService_NUSOAP/ws/index.php?wsdl"); 
		$materiales = $cliente->call("CargarMateriales");
		$materiales = json_decode($materiales);


		echo $nombre[0]."!";

		echo "<br><br><table class='table table-responsive' align='center'";
		echo "<tr>
				<td align='center' class='ingresoTH' style='color:white'>Nombre</td>
				<td align='center' class='ingresoTH' style='color:white'>Precio</td>
				<td align='center' class='ingresoTH' style='color:white'>Tipo de material</td>
				<td align='center' class='ingresoTH' style='color:white'><input type='button' class='btn btn-success form-control' id='alta' value='Ingresar Material' onClick='ingresarMaterial()'></td>
				<td class='ingresoTH'></td>
			</tr>";
		foreach ((array)$materiales as $material) 
		{
			echo "<tr>";
				echo "<td align='center'>".$material->nombre."</td>";
				echo "<td align='center'>".$material->precio."</td>";
				echo "<td align='center'>".$material->tipo."</td>";
				echo "<td align='center'> <input type='button' value='BORRAR' class='btn btn-danger' onClick='sacarMaterial(".$material->id.")'></td>";
				echo "<td align='center'> <input type='button' value='MODIFICAR' class='btn btn-warning' onClick='modificarMaterial(".$material->id.")'></td>";
			echo "</tr>";
		}

		 

	}





?>