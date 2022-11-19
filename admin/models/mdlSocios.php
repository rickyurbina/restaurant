<?php

require_once "conexion.php";

class mdlSocios {

    #       Agregar un Socio a la BD
    # ---------------------------------------------
    
    public static function mdlRegistraSocio($datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO `socios` (`idSocio`, `nombres`, `apellidos`, `telefono`, `email`, `password`, `tipoSocio`, `fechaNacimiento`, `fechaRegistro`) 
        VALUES (NULL, :nombres, :apellidos, :telefono, :email, :password, :tipoSocio, :fechaNacimiento, :fechaRegistro);");


         $stmt -> bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
         $stmt -> bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
         $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
         $stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
         $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
         $stmt -> bindParam(":tipoSocio", $datos["tipoSocio"], PDO::PARAM_STR);
         $stmt -> bindParam(":fechaNacimiento", $datos["fechaNacimiento"], PDO::PARAM_STR);
         $stmt -> bindParam(":fechaRegistro", $datos["fechaRegistro"], PDO::PARAM_STR);
         
        if ($stmt -> execute()){
            return "ok";
        }
        else {
            return "error";
        }
    }


	#       Actualiza la informacion de un Socio a la BD
    # ----------------------------------------------------------
    
    public static function mdlActualizaSocio($datos){

        $stmt = Conexion::conectar()->prepare("UPDATE `socios` SET `nombres`=:nombres, `apellidos`=:apellidos,
		`telefono`=:telefono, `email`=:email, `password`=:password, `tipoSocio`=:tipoSocio, `fechaNacimiento`=:fechaNacimiento WHERE idSocio = :socioId;");

        $stmt -> bindParam(":socioId", $datos["socioId"], PDO::PARAM_INT);
        $stmt -> bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt -> bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt -> bindParam(":tipoSocio", $datos["tipoSocio"], PDO::PARAM_STR);
        $stmt -> bindParam(":fechaNacimiento", $datos["fechaNacimiento"], PDO::PARAM_STR);
         
        if ($stmt -> execute()){
            return "ok";
        }
        else {
            return "error";
        }
    }

    	#LISTA Socios
	#-------------------------------------

	public static function mdlListaSocio($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
		return $stmt->fetchAll();

		//$stmt->close();

	}


    	#BUSCA UN Socio
	#-------------------------------------

	public static function mdlBusca($usuario, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idSocio = :id");

		$stmt->bindParam(":id", $usuario, PDO::PARAM_INT);

		$stmt -> execute();
		return $stmt -> fetch();

		//$stmt->close();
	}


    	#BORRAR Socio
	#-------------------------------------
	public static function mdlBorrarSocio($datosModel,$tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idSocio = :id");
		$stmt -> bindPARAM(":id",$datosModel, PDO::PARAM_INT);
		if ($stmt->execute()){
			return "success";
		} else {
			return "error";
		}
		//$stmt -> close();
	}

    public static function mdlActualizarAsistencia($idSocio) {

        $statement = Conexion::conectar() -> prepare("INSERT INTO asistencia VALUES (NULL, :idSocio, now());");

        $statement -> bindParam(":idSocio", $idSocio, PDO::PARAM_INT);

        if ($statement -> execute()) {
            return "success";
        } else {
            return "error";
        }
    }

    public static function mdlRegistrarMensualidad($idSocio) {
        $statement = Conexion::conectar() -> prepare("UPDATE socios SET fechaUltimoPago = now() WHERE idSocio = :idSocio;");

        $statement -> bindParam(":idSocio", $idSocio, PDO::PARAM_INT);

        if ($statement -> execute()) {
            return "success";
        } else {
            return "error";
        }
    }

    public static function mdlUltimoSocio() {
        $statement = Conexion::conectar() -> prepare("SELECT * FROM socios ORDER BY idSocio DESC");

        $statement -> execute();

        return $statement -> fetchAll();
    }

}// Class

?>