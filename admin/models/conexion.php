<?php

class Conexion{

	public static function conectar(){
// conexion local -------------------------------
		$bd = "restaurant";
		$servername = "localhost";
		$username = "root";
		$password = "12345678";

// conexion Server ------------------------------
		// $bd = "rickurbi_verdin";
		// $servername = "mysql1007.mochahost.com";
		// $username = "rickurbi_verdin";
		// $password = "K-_B+LJv?D[-";

		try {
		    $conn = new PDO("mysql:host=$servername;dbname=$bd", $username, $password);
		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec("set names utf8");
			// echo '<script>alert("Connection Seccess !");</script>';
		    }
		catch(PDOException $e)
		    {
		    echo '<script>alert("Connection failed: '.$e->getMessage().'");</script>';

		    }
		return $conn;

	}

}