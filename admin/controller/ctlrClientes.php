<?php
Class clientes {

    public static function ctrRegistra(){
        if(isset($_POST["email"])){

            // echo $_POST["nombres"]."<br>";
            // echo $_POST["apellidos"]."<br>";
            // echo $_POST["telefono"]."<br>";
            // echo $_POST["tipoCliente"]."<br>";
            // echo $_POST["fechaNacimiento"]."<br>";

            $original_date = $_POST["fechaNacimiento"];
            $timestamp = strtotime($original_date);
            $fechaNacimiento = date("Y-m-d", $timestamp);
            $fechaRegistro = date('Y-m-d');
        
            $datos = array("nombres" => $_POST["nombres"],
                           "apellidos" => $_POST["apellidos"],
                           "telefono" => $_POST["telefono"],
                           "email" => $_POST["email"],
                           "tipoCliente" => $_POST["tipoCliente"],
                           "fechaNacimiento" => $fechaNacimiento,
                           "fechaRegistro" => $fechaRegistro);

            $ingresa = mdlClientes::mdlRegistraCliente($datos);

            echo $ingresa;

            if ($ingresa == "ok"){

                    echo "<script>Swal.fire({
                        title: 'Registro Exitoso',
                        text: 'El nuevo usuario ha sio registrado',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                      }).then((result) => {
                        if (result.isConfirmed) {
                            window.location='index.php?page=clientList'
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
                        window.location='index.php?page=clientList'
                    }
                  })
                  </script>";
        }
            
            
        }
    }


    public static function ctrActualiza(){
        if(isset($_POST["btnActualiza"])){

            $original_date = $_POST["fechaNacimiento"];
            $timestamp = strtotime($original_date);
            $fechaNacimiento = date("Y-m-d", $timestamp);
        
            $datos = array("clientId" => $_POST["clientId"],
                           "nombres" => $_POST["nombres"],
                           "apellidos" => $_POST["apellidos"],
                           "telefono" => $_POST["telefono"],
                           "email" => $_POST["email"],
                           "tipoCliente" => $_POST["tipoCliente"],
                           "fechaNacimiento" => $fechaNacimiento);

            $actualiza = mdlClientes::mdlActualizaCliente($datos);

            if ($actualiza == "ok"){

                echo "<script>Swal.fire({
                    title: 'Actualizado!',
                    text: 'La información se actualizó correctamente',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location='index.php?page=clientList'
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
                        window.location='index.php?page=clientList'
                    }
                  })
                  </script>";

            }
            
        }
    }


    #  Lista todos los usuarios disponibles en la tabla que recibe como parametro
    #------------------------------------------------------------------------------------------------
    public static function ctrListaClientes(){

		$respuesta = mdlClientes::mdlListaCliente("clientes");

		foreach ($respuesta as $row => $item){
            if ($item["tipoCliente"] == 1) $tipoCliente = '<td>Publico en General</td>';
            if ($item["tipoCliente"] == 2) $tipoCliente = '<td>Mayorista</td>';
            if ($item["tipoCliente"] == 3) $tipoCliente = '<td>Preferente</td>';
            $cumple = strftime("%d de %B", strtotime($item["fechaNacimiento"]));
            $registro = strftime("%d de %B de %Y", strtotime($item["fechaRegistro"]));

            echo '
            <tr>
                <td>'.$item["nombres"].' '.$item["apellidos"].'</td>'
                .$tipoCliente.'
                <td>'.$item["telefono"].'</td>
                <td>'.$registro.'</td>
                <td>'.$cumple.'</td>
                <td>
                    <div class="item-action dropdown">
                        <a href="javascript:void(0)" data-toggle="dropdown" class="icon" aria-expanded="false"><i class="fe fe-more-vertical fs-20 text-dark"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-172px, 22px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a href="index.php?page=clientEdit&idEditar='.$item["idCliente"].'" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Editar </a>
                            <a href="index.php?page=clientList&idBorrar='.$item["idCliente"].'" class="dropdown-item"><i class="dropdown-icon fe fe-user-x"></i> Borrar </a>
                        </div>
                    </div>
                </td>
            </tr>';
		}
	}

    #-------------------------------------
	#Lista todas los clientes para un select
	#------------------------------------
	public static function ctlListClientes(){

		$respuesta = mdlClientes::mdlListClientes("clientes");

		foreach ($respuesta as $row => $item){
			echo  '<option value="'.$item["idCliente"].'">'.$item["nombres"].' '.$item["apellidos"].'</option>';
		}
	}
    #-------------------------------------------------------------------------
	# Lista clientes en un select para el registro de salidas, recibe un valor
    # si coincide con la marca retorna selected para la edicion de la entrada
	#------------------------------------------------------------------------
	public static function ctlListClientesSelected($valor){

		$respuesta = mdlClientes::mdlListClientes("clientes");

		foreach ($respuesta as $row => $item){
            if ($item["idCliente"] == $valor ) 
                echo  '<option value="'.$item["idCliente"].'" selected>'.$item["nombres"].' '.$item["apellidos"].' </option>';    
            else 
                echo  '<option value="'.$item["idCliente"].'">'.$item["nombres"].' '.$item["apellidos"].'</option>';
		}
	}


    	#BORRAR USUARIO
	#------------------------------------
	public static function ctrBorrarCliente(){
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
                    window.location="index.php?page=clientDel&idBorrar="+'.$_GET["idBorrar"].'
                }
              })
              </script>';
		}
	}

}//Class

?>
