<?php

class AccesoPDO
{
	
	public function getConexion()
	{
		$user ="root";     
		$pass ="";     
		$host ="localhost";       
		$db ="final";       

		$conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

		return $conn;	
	}




}//fin de la clase



?>