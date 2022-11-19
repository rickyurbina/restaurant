<?php

require_once "conexion.php";

class mdlClientes {

    #       Agregar un cliente a la BD
    # ---------------------------------------------
    
    public static function mdlRegistraCliente($datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO `clientes` (`idCliente`, `nombres`, `apellidos`, `telefono`, `email`, `tipoCliente`, `fechaNacimiento`, `fechaRegistro`) 
        VALUES (NULL, :nombres, :apellidos, :telefono, :email, :tipoCliente, :fechaNacimiento, :fechaRegistro);");


         $stmt -> bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
         $stmt -> bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
         $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
         $stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
         $stmt -> bindParam(":tipoCliente", $datos["tipoCliente"], PDO::PARAM_STR);
         $stmt -> bindParam(":fechaNacimiento", $datos["fechaNacimiento"], PDO::PARAM_STR);
         $stmt -> bindParam(":fechaRegistro", $datos["fechaRegistro"], PDO::PARAM_STR);
         
        if ($stmt -> execute()){
            return "ok";
        }
        else {
            return "error";
        }
    }


	#       Actualiza la informacion de un cliente a la BD
    # ----------------------------------------------------------
    
    public static function mdlActualizaCliente($datos){

        $stmt = Conexion::conectar()->prepare("UPDATE `clientes` SET `nombres`=:nombres, `apellidos`=:apellidos,
		`telefono`=:telefono, `email`=:email, `tipoCliente`=:tipoCliente, `fechaNacimiento`=:fechaNacimiento WHERE idCliente = :clientId;");

        $stmt -> bindParam(":clientId", $datos["clientId"], PDO::PARAM_INT);
        $stmt -> bindParam(":nombres", $datos["nombres"], PDO::PARAM_STR);
        $stmt -> bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt -> bindParam(":tipoCliente", $datos["tipoCliente"], PDO::PARAM_STR);
        $stmt -> bindParam(":fechaNacimiento", $datos["fechaNacimiento"], PDO::PARAM_STR);
         
        if ($stmt -> execute()){
            return "ok";
        }
        else {
            return "error";
        }
    }

    	#LISTA CLIENTES
	#-------------------------------------

	public static function mdlListaCliente($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
		return $stmt->fetchAll();

		//$stmt->close();

	}

    #----------------------------------------------------------------
	#  Lista el nombre de los clientes registrados para un select
	#----------------------------------------------------------------

	public static function mdlListClientes($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idCliente, nombres, apellidos FROM $tabla ORDER BY idCliente ASC");
		$stmt->execute();
		return $stmt->fetchAll();

	}


    	#BUSCA UN CLIENTE
	#-------------------------------------

	public static function mdlBusca($usuario, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idCliente = :id");

		$stmt->bindParam(":id", $usuario, PDO::PARAM_INT);

		$stmt -> execute();
		return $stmt -> fetch();

		//$stmt->close();
	}


    	#BORRAR CLIENTE
	#-------------------------------------
	public static function mdlBorrarCliente($datosModel,$tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE idCliente = :id");
		$stmt -> bindPARAM(":id",$datosModel, PDO::PARAM_INT);
		if ($stmt->execute()){
			return "success";
		} else {
			return "error";
		}
		//$stmt -> close();
	}


}// Class

?>