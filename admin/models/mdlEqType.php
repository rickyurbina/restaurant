<?php

require_once "conexion.php";

class mdlEqType {

	#----------------------------------------------------------------
	#  Lista todos las EqTypes registradas en la tabla 'eqType'
	#----------------------------------------------------------------

	public static function mdlListEqTypes($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT nombre FROM $tabla ORDER BY nombre ASC");
		$stmt->execute();
		return $stmt->fetchAll();

	}


    #       Agregar una marca ala tabla Brands
    # ---------------------------------------------
    
    public static function mdlRegistraEqType($datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO `eqType` (`id`, `nombre`) VALUES (NULL, :nombre);");

         $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
         
        if ($stmt -> execute()){
            return "ok";
        }
        else {
            return "error";
        }
    }


	#       Actualiza la informacion de un usuario a la BD
    # ----------------------------------------------------------
    
    public static function mdlActualizaEqType($datos){

        $stmt = Conexion::conectar()->prepare("UPDATE `eqType` SET `nombre`=:nombre WHERE id = :equipmentId;");

		$stmt -> bindParam(":equipmentId", $datos["equipmentId"], PDO::PARAM_INT);
        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
         
        if ($stmt -> execute()){
            return "ok";
        }
        else {
            return "error";
        }
    }

    	#LISTA USUARIOS
	#-------------------------------------

	public static function mdlListaEqType($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
		return $stmt->fetchAll();

		//$stmt->close();

	}


    	#BUSCA UN USUARIO
	#-------------------------------------

	public static function mdlBusca($usuario, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $usuario, PDO::PARAM_INT);

		$stmt -> execute();
		return $stmt -> fetch();

		//$stmt->close();
	}

 
    	#BORRAR USUARIO
	#-------------------------------------
	public static function mdlBorrarEqType($datosModel,$tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
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