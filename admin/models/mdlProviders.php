<?php

require_once "conexion.php";

class mdlProviders {

    #       Agregar un cliente a la BD
    # ---------------------------------------------
    
    public static function mdlRegistraProveedor($datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO `proveedores` (`idProveedor`, `nombre`, `direccion`, `telefono`, `email`, `fechaRegistro`) 
        VALUES (NULL, :nombre, :direccion, :telefono, :email, :fechaRegistro);");


         $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
         $stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
         $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
         $stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
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
    
    public static function mdlActualizaProveedor($datos){

        $stmt = Conexion::conectar()->prepare("UPDATE `proveedores` SET `nombre`=:nombre,`direccion`=:direccion,`telefono`=:telefono,`email`=:email WHERE idProveedor = :proveedorId");
        

        $stmt -> bindParam(":proveedorId", $datos["proveedorId"], PDO::PARAM_INT);
        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
         
        if ($stmt -> execute()){
            return "ok";
        }
        else {
            return "error";
        }
    }

    	#LISTA CLIENTES
	#-------------------------------------

	public static function mdlListaProveedores($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
		return $stmt->fetchAll();

		//$stmt->close();

	}

    #----------------------------------------------------------------
	#  Lista el nombre de los proveedores registrados para un select
	#----------------------------------------------------------------

	public static function mdlListProveedores($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idProveedor, nombre FROM $tabla ORDER BY nombre ASC");
		$stmt->execute();
		return $stmt->fetchAll();

	}


    	#BUSCA UN CLIENTE
	#-------------------------------------

	public static function mdlBusca($proveedor, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE idProveedor = :id");

		$stmt->bindParam(":id", $proveedor, PDO::PARAM_INT);

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