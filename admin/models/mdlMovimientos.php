<?php
class mdlMovimientos {

    # ---------------------------------------------
    #        Agregar una entrada de inventario 
    # ---------------------------------------------
    
    public static function mdlRegistraEntrada($datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO `entradas` (`id`,`idProducto`, `lote`, `cantidad`, `medida`, `idProveedor`, `costo`, `fecha`) 
        VALUES (NULL, :idProducto, :lote, :cantidad, :medida, :idProveedor, :costo, :fechaMovimiento);");
        
         $stmt -> bindParam(":idProducto", $datos["idProducto"], PDO::PARAM_INT);
         $stmt -> bindParam(":lote", $datos["lote"], PDO::PARAM_STR);
         $stmt -> bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
         $stmt -> bindParam(":medida", $datos["medida"], PDO::PARAM_STR);
         $stmt -> bindParam(":idProveedor", $datos["idProveedor"], PDO::PARAM_INT);
         $stmt -> bindParam(":costo", $datos["costo"], PDO::PARAM_STR);
         $stmt -> bindParam(":fechaMovimiento", $datos["fechaMovimiento"], PDO::PARAM_STR);

         $stmt2 = Conexion::conectar()->prepare("UPDATE productos SET disponibilidad = (SELECT SUM(`cantidad`) FROM `entradas` WHERE `idProducto`= :idProducto) WHERE idProducto = :idProducto");
         $stmt2 -> bindParam(":idProducto", $datos["idProducto"], PDO::PARAM_INT);
         
        if ($stmt -> execute()){
            if($stmt2 -> execute())
                return "ok";
        }
        else {
            return "error";
        }
    }

    # ------------------------------------------------------------------------------------------
    #  Registra el encabezado de una orden en la tabla de entradasEnc
    # ------------------------------------------------------------------------------------------

    public static function mdlRegistraOrden($datos_orden){

        $stmt = Conexion::conectar()->prepare("INSERT INTO `entradasEnc` ( `factura`, `idProveedor`, `concepto`, `fecha`, `totalFactura`) 
        VALUES ( :factura, :idProveedor, :concepto, :fechaMovimiento, :totalPedidoBD);");

         $stmt -> bindParam(":factura", $datos_orden["factura"], PDO::PARAM_INT);         
         $stmt -> bindParam(":idProveedor", $datos_orden["idProveedor"], PDO::PARAM_INT);
         $stmt -> bindParam(":concepto", $datos_orden["concepto"], PDO::PARAM_STR);
         $stmt -> bindParam(":totalPedidoBD", $datos_orden["totalPedidoBD"], PDO::PARAM_INT);
         $stmt -> bindParam(":fechaMovimiento", $datos_orden["fechaMovimiento"], PDO::PARAM_STR);
        //  $stmt2 = Conexion::conectar()->prepare("UPDATE productos SET disponibilidad = (SELECT SUM(`cantidad`) FROM `entradas` WHERE `idProducto`= :idProducto) WHERE idProducto = :idProducto");
        //  $stmt2 -> bindParam(":idProducto", $datos["idProducto"], PDO::PARAM_INT);
         
        if ($stmt -> execute()){
                return "ok";
        }
        else {
            return "error_orden";
        }
    }


    # ------------------------------------------------------------------------------------------
    #  Actualiza el encabezado de una orden en la tabla de entradasEnc
    # ------------------------------------------------------------------------------------------

    public static function mdlActualizaOrden($datos_orden){

        $stmt = Conexion::conectar()->prepare("UPDATE `entradasEnc` SET `idProveedor` = :idProveedor,  `concepto`= :concepto,  `fecha` = :fechaMovimiento WHERE `orden` = :orden;");

         $stmt -> bindParam(":orden", $datos_orden["orden"], PDO::PARAM_INT);         
         $stmt -> bindParam(":idProveedor", $datos_orden["idProveedor"], PDO::PARAM_INT);
         $stmt -> bindParam(":concepto", $datos_orden["concepto"], PDO::PARAM_STR);
         $stmt -> bindParam(":fechaMovimiento", $datos_orden["fechaMovimiento"], PDO::PARAM_STR);
        //  $stmt2 = Conexion::conectar()->prepare("UPDATE productos SET disponibilidad = (SELECT SUM(`cantidad`) FROM `entradas` WHERE `idProducto`= :idProducto) WHERE idProducto = :idProducto");
        //  $stmt2 -> bindParam(":idProducto", $datos["idProducto"], PDO::PARAM_INT);
         
        if ($stmt -> execute()){
                return "ok";
        }
        else {
            return "error_orden";
        }
    }

    # ------------------------------------------------------------------------------------------
    #  Registra los productos de una orden indivudualmente en la tabla de entradas 
    # ------------------------------------------------------------------------------------------

    public static function mdlRegistraProdsOrden($datos_prods){

        $stmt = Conexion::conectar()->prepare("INSERT INTO `entradas` (`id`,`idProducto`, `cantidad`, `disponible`, `medida`, `costo`, `factura`) 
        VALUES (NULL, :idProducto, :cantidad, :disponible, :medida, :costo, :factura);");
        
         $stmt -> bindParam(":idProducto", $datos_prods["idProducto"], PDO::PARAM_INT);
         $stmt -> bindParam(":cantidad", $datos_prods["cantidad"], PDO::PARAM_INT);
         $stmt -> bindParam(":disponible", $datos_prods["disponible"], PDO::PARAM_INT);
         $stmt -> bindParam(":medida", $datos_prods["medida"], PDO::PARAM_STR);
         $stmt -> bindParam(":costo", $datos_prods["costo"], PDO::PARAM_STR);
         $stmt -> bindParam(":factura", $datos_prods["factura"], PDO::PARAM_INT);

         $stmt2 = Conexion::conectar()->prepare("UPDATE productos SET `disponibilidad` = `disponibilidad` + :cantidad, `costoPromedio` = (SELECT AVG(`costo`) FROM `entradas` WHERE `idProducto` = :idProducto) WHERE idProducto = :idProducto");
         $stmt2 -> bindParam(":idProducto", $datos_prods["idProducto"], PDO::PARAM_INT);
         $stmt2 -> bindParam(":cantidad", $datos_prods["cantidad"], PDO::PARAM_INT);
         
        if ($stmt -> execute()){
            if($stmt2 -> execute())
                return "ok";
        }
        else {
            return "error_prods";
        }
    }

    # ------------------------------------------------------------------------------------------
    # Elimina todos los productos relacionados con una orden 
    # ------------------------------------------------------------------------------------------
    public static function mdlEliminaProds($orden){
        $stmt = Conexion::conectar()->prepare("DELETE FROM entradas WHERE `orden` = $orden;");
        if($stmt->execute()){
            return "ok";
        }
        else{
            return "error";
        }

    }
    # ---------------------------------------------
    #        Actualizar una entrada de inventario 
    # ---------------------------------------------

    public static function mdlActualizaEntrada($datos){

        $stmt = Conexion::conectar()->prepare("UPDATE `entradas` SET `lote`= :lote, `cantidad`= :cantidad, `idProveedor`= :idProveedor , `fecha`= :fechaMovimiento , `costo`= :costo WHERE `id` = :id");
        
        $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt -> bindParam(":lote", $datos["lote"], PDO::PARAM_STR);
         $stmt -> bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
         //$stmt -> bindParam(":medida", $datos["medida"], PDO::PARAM_STR);
         $stmt -> bindParam(":costo", $datos["costo"], PDO::PARAM_STR);
         $stmt -> bindParam(":fechaMovimiento", $datos["fechaMovimiento"], PDO::PARAM_STR);
         $stmt -> bindParam(":idProveedor", $datos["idProveedor"], PDO::PARAM_INT);
         
        if ($stmt -> execute()){
            return "ok";
        }
        else {
            return "error";
        }
    }

    #-------------------------------------
    # Busca una entrada para edicion
	#-------------------------------------

	public static function mdlBuscaEntrada($entrada, $tabla){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE factura = :id");

		$stmt->bindParam(":id", $entrada, PDO::PARAM_INT);

		$stmt -> execute();
		return $stmt -> fetch();

		//$stmt->close();
	}

    # ------------------------------------
    # Busca el ultimo id registrado en la tabla de  Entradas o Salidas para la numeracion 
    # de las ordenes de entrada y salida
	#-------------------------------------
    
	public static function mdlSiguienteRegistro($tabla, $campo){

        $stmt = Conexion::conectar()->prepare("SELECT MAX($campo) as siguiente FROM $tabla");

        $stmt->execute();

       #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
       return $stmt->fetch();

       //$stmt->close();

   }

    # ------------------------------------
    	#Lista Entradas
	#-------------------------------------

	public static function mdlListaEntradas($tabla){

		 $stmt = Conexion::conectar()->prepare("SELECT e.*, v.nombre as proveedor
                                                FROM entradasEnc AS e
                                                INNER JOIN proveedores AS v
                                                ON e.idProveedor = v.idProveedor");

        //$stmt = Conexion::conectar()->prepare("SELECT * from $tabla order by orden");
		$stmt->execute();

		#fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
		return $stmt->fetchAll();

		//$stmt->close();

	}

    #-------------------------------------
    # Borrar Entrada de inventario
	#-------------------------------------
	public static function mdlBorrarEntrada($datosModel,$tabla){
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt -> bindPARAM(":id",$datosModel, PDO::PARAM_INT);
		if ($stmt->execute()){
			return "success";
		} else {
			return "error";
		}
		//$stmt -> close();
	}

    #-------------------------------------
    # Borrar Entrada de inventario
	#-------------------------------------
	public static function mdlBorrarEnc_Entradas($datosModel){
		$stmt = Conexion::conectar()->prepare("DELETE FROM entradasEnc WHERE orden = :id");
		$stmt -> bindPARAM(":id",$datosModel, PDO::PARAM_INT);

        $stmt2 = Conexion::conectar()->prepare("DELETE FROM entradas WHERE orden = :id");
        $stmt2 -> bindPARAM(":id",$datosModel, PDO::PARAM_INT);

		if ($stmt->execute() && $stmt2->execute()){
			return "success";
		} else {
			return "error";
		}
	}

    #----------------------------------------------------------------
	#  Lista todos los proveedores registrados 
	#----------------------------------------------------------------

	public static function mdlListProveedores($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT idProveedor, nombre FROM $tabla ORDER BY nombre ASC");
		$stmt->execute();
		return $stmt->fetchAll();

	}


} //class

?>
