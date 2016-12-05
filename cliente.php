<?php

include 'ws/lib/nusoap.php';
include 'materiales.php';

$queHacer = $_POST['queHago'];


switch ($queHacer) 
{

	case "cargarTabla":
		$cliente = new nusoap_client("http://localhost:8080/ABM_WebService_NUSOAP/ws/index.php?wsdl"); 
		$materiales = $cliente->call("CargarMateriales");
		$materiales = json_decode($materiales);

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
	


			break;


	case 'alta':
		$nombre=$_POST['nombre'];
		$precio=(float)$_POST['precio'];
		$tipo=$_POST['tipo'];


		$cliente = new nusoap_client("http://localhost:8080/ABM_WebService_NUSOAP/ws/index.php?wsdl"); 
		$cliente->call("GuardarMaterial", array('nombre'=>$nombre, 'precio'=>$precio,'tipo'=>$tipo));

	break;


	case "borrar":
		$id = (int) $_POST['id'];

		$cliente = new nusoap_client("http://localhost:8080/ABM_WebService_NUSOAP/ws/index.php?wsdl"); 
		$cliente->call("BorrarMaterial", array('id'=>$id));


	break;

	case "modificar":

				$id=(int) $_POST['id'];
				$dato = Materiales::traerMaterial($id);
				
				$objJson=json_encode($dato);

				echo $objJson;

	break;

	case "modificarBD":
		 
				$id= (int) $_POST['id'];
				$nombre=$_POST['nombre'];
				$precio= (float) $_POST['precio'];
				$tipo=$_POST['tipo'];

				$cliente = new nusoap_client("http://localhost:8080/ABM_WebService_NUSOAP/ws/index.php?wsdl"); 
				$cliente->call("ModificarMaterial", array('nombre'=>$nombre, 'precio'=>$precio, 'tipo'=>$tipo, 'id'=>$id));

				//Materiales::modificarmaterial($nombre, $precio, $tipo, $id);


		break;
}







?>