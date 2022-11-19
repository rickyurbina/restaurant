<?php
Class equipmentType {


    #-------------------------------------
	#Lista todos los eqTypes en un select para el registro de productos
	#------------------------------------
	public static function ctlListEqTypes(){

		$respuesta = mdlEqType::mdlListEqTypes("eqType");

		foreach ($respuesta as $row => $item){
			echo  '<option value="'.$item["nombre"].'">'.$item["nombre"].'</option>';
		}
	}

    #--------------------------------------------------------------------------
	#Lista todos los eqTypes en un select para el edicion de productos
    # recibe un valor y retorna selected si el valor coincide con la busqueda
	#-------------------------------------------------------------------------
    public static function ctlListEqTypesSelected($valor){

		$respuesta = mdlEqType::mdlListEqTypes("eqType");

		foreach ($respuesta as $row => $item){
            if ($item["nombre"] == $valor ) 
                echo  '<option value="'.$item["nombre"].'" selected>'.$item["nombre"].' </option>';    
            else 
                echo  '<option value="'.$item["nombre"].'">'.$item["nombre"].'</option>';
		}
	}

    public static function ctrRegistra(){
        if(isset($_POST["nombre"])){
        
            $datos = array("nombre" => $_POST["nombre"]);

            $ingresa = mdlEqType::mdlRegistraEqType($datos);


            if ($ingresa == "ok"){

                    echo "<script>Swal.fire({
                        title: 'Registro Exitoso',
                        text: 'La nueva marca ha sio registrada',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                      }).then((result) => {
                        if (result.isConfirmed) {
                            window.location='index.php?page=eqTypeList'
                        }
                      })
                      </script>";
            }
            else{

                echo "<script>Swal.fire({
                    title: 'Error',
                    text: 'No se pudo guardar la información',
                    icon: 'danger',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        window.location='index.php?page=eqTypeList'
                    }
                  })
                  </script>";
        }
            
            
        }
    }


    public static function ctrActualiza(){
        if(isset($_POST["btnActualiza"])){
        
            $datos = array("nombre" => $_POST["nombre"], "equipmentId" => $_POST["equipmentId"]);

            $actualiza = mdlEqType::mdlActualizaEqType($datos);

            if ($actualiza == "ok"){

                echo "<script>Swal.fire({
                    title: 'Actualizado!',
                    text: 'La marca se actualizó correctamente',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location='index.php?page=eqTypeList'
                    }
                    })
                    </script>";
            }else{
                echo "<script>Swal.fire({
                    title: 'Error!',
                    text: 'No se logró actualizar La información',
                    icon: 'error',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        window.location='index.php?page=eqTypeList'
                    }
                  })
                  </script>";

            }
            
        }
    }


    #  Lista todos los usuarios disponibles en la tabla que recibe como parametro
    #------------------------------------------------------------------------------------------------
    public static function ctrListaEqType(){

		$respuesta = mdlEqType::mdlListaEqType("eqType");

		foreach ($respuesta as $row => $item){
            // if ($item["tipoCliente"] == 1) $tipoCliente = '<td>Socio</td>';
            // if ($item["tipoCliente"] == 2) $tipoCliente = '<td>Estudiante</td>';
            // if ($item["tipoCliente"] == 3) $tipoCliente = '<td>Referido</td>';
            // $cumple = strftime("%d de %B", strtotime($item["fechaNacimiento"]));
            // $registro = strftime("%d de %B de %Y", strtotime($item["fechaRegistro"]));

            echo '
            <tr>
                <td>'.$item["nombre"].'</td>
                <td>
                    <div class="item-action dropdown">
                        <a href="javascript:void(0)" data-toggle="dropdown" class="icon" aria-expanded="false"><i class="fe fe-more-vertical fs-20 text-dark"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-172px, 22px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a href="index.php?page=eqTypeEdit&idEditar='.$item["id"].'" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Editar </a>
                            <a href="index.php?page=eqTypeList&idBorrar='.$item["id"].'" class="dropdown-item"><i class="dropdown-icon fe fe-user-x"></i> Borrar </a>
                        </div>
                    </div>
                </td>
            </tr>';
		}
	}


    	#BORRAR USUARIO
	#------------------------------------
	public static function ctrBorrarEqType(){
		if (isset($_GET['idBorrar'])){
            echo '<script>  
            Swal.fire({
                title: "Esta seguro?",
                text: "Esto no se podrá recuperar!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, borrar!"
              }).then((result) => {
                if (result.isConfirmed) {
                    window.location="index.php?page=eqTypeDel&idBorrar="+'.$_GET["idBorrar"].'
                }
              })
              </script>';
		}
	}

}//Class

?>
