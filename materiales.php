<?php

include 'Conexion.php';

class Materiales
{
	
	private $_nombre;
	private $_precio;
	private $_tipo;

	function __construct($nombre, $precio, $tipo)
	{
		$this->_nombre = $nombre;
		$this->_precio = $precio;
		$this->_tipo = $tipo;	
	}


	public function GetNombre()
	{
		return $this->_nombre;
	}

	public function GetPrecio()
	{
		return $this->_precio;
	}

	public function GetTipo()
	{
		return $this->_tipo;
	}


	public function SetNombre($valor)
	{
		 $this->_nombre = $valor;
	}

	public function SetPrecio($valor)
	{
		 $this->_precio = $valor;
	}

	public function SetTipo($valor)
	{
		 $this->_tipo = $valor;
	}


	public static function cargarMateriales()
	{	
		$rows = null;

		$objPDO = new AccesoPDO();
 		$conexion = $objPDO->getConexion();
 		$sql = "select id, nombre, precio, tipo from materiales";

 		$statementPDO = $conexion->prepare($sql);
 		$statementPDO->execute();

 		while ($resultado = $statementPDO->fetch()) 
 		{
 			$rows[]= $resultado;
 		}

 		return $rows;
	}


	public static function insertarMateriales($nombre, $precio, $tipo)
	{	

		$PDO = new AccesoPDO();
		$conexion = $PDO->getConexion();

		$sql = "INSERT INTO materiales (nombre, precio, tipo) values (:unNombre, :unPrecio, :unTipo)";

		$statementPDO = $conexion->prepare($sql);
		$statementPDO->bindParam(':unNombre', $nombre);
		$statementPDO->bindParam(':unPrecio', $precio);
		$statementPDO->bindParam(':unTipo', $tipo);

		if (!$statementPDO) 
		{
			return "Error al crear el registro";	
		}
		else
		{
			$statementPDO->execute();
			return "Registro creado con exito";
		}

	}


	public static function traerMaterial($id)
	{
		$rows = null;

		$PDO = new AccesoPDO();
		$conexion = $PDO->getConexion();

		$sql = "select * from materiales where id = :id";
	
		$statementPDO = $conexion->prepare($sql);

		$statementPDO->bindParam(':id', $id);

		$statementPDO->execute();

 		while ($resultado = $statementPDO->fetch()) 
 		{
 			$rows[]= $resultado;
 		} 

 		return $rows;
		
	}


	public static function sacarMaterial($id)
	{
		$material = array();

		//$material = Consultas::traerMaterial($id);

		$PDO = new AccesoPDO();
		$conexion = $PDO->getConexion();
		$sql = "delete from materiales where id = :id";
		$statementPDO = $conexion->prepare($sql);
		$statementPDO->bindParam(":id", $id);

		if (!$statementPDO) 
		{
			return "Se produjo un error al sacar la Patente. Avise a su Administrador";
		}
		else
		{			
			$statementPDO->execute();
			
		}
	}




		public static function modificarMaterial($nombre, $precio, $tipo, $id)
	{	
		
		$PDO = new AccesoPDO();
		$conexion = $PDO->getConexion();

		$sql = "update materiales set nombre=:nombre, precio=:precio, tipo=:tipo where id =:id";

		$statementPDO = $conexion->prepare($sql);
		$statementPDO->bindParam(':nombre', $nombre);
		$statementPDO->bindParam(':precio', $precio);
		$statementPDO->bindParam(':tipo', $tipo);
		$statementPDO->bindParam(':id', $id);

		if (!$statementPDO) 
		{
			return "Error al modificar el registro";	
		}
		else
		{
			$statementPDO->execute();
			return "Registro modificado con exito";
		}

	}



}















?>