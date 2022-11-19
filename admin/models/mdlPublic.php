<?php

require_once "conexion.php";

class mdlPublic {

    #BUSCA UN SOCIO
	#-------------------------------------

	public function mdlSearchBox(){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM socios");

		$stmt -> execute();

		return $stmt -> fetchAll(PDO::FETCH_ASSOC);

	}

	public function mdlLiveSearch($nombres){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM socios WHERE nombres LIKE :nombres OR idSocio LIKE :nombres OR apellidos LIKE :nombres");
		
		$stmt -> execute(["nombres" => "%" . $nombres . "%"]);

		return $stmt -> fetchAll(PDO::FETCH_ASSOC);

	}


}// Class

?>