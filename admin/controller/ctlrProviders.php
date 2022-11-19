<?php
Class providers {

    public static function ctrRegistra(){
        if(isset($_POST["email"])){

            // echo $_POST["nombres"]."<br>";
            // echo $_POST["apellidos"]."<br>";
            // echo $_POST["telefono"]."<br>";
            // echo $_POST["tipoCliente"]."<br>";
            // echo $_POST["fechaNacimiento"]."<br>";

            // $original_date = $_POST["fechaNacimiento"];
            // $timestamp = strtotime($original_date);
            // $fechaNacimiento = date("Y-m-d", $timestamp);
            $fechaRegistro = date('Y-m-d');
        
            $datos = array("nombre" => $_POST["nombre"],
                           "direccion" => $_POST["direccion"],
                           "telefono" => $_POST["telefono"],
                           "email" => $_POST["email"],
                           "fechaRegistro" => $fechaRegistro);

            $ingresa = mdlProviders::mdlRegistraProveedor($datos);

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
                            window.location='index.php?page=proveedorList'
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
                        window.location='index.php?page=proveedorList'
                    }
                  })
                  </script>";
        }
            
            
        }
    }


    public static function ctrActualiza(){
        if(isset($_POST["btnActualiza"])){

            // $original_date = $_POST["fechaNacimiento"];
            // $timestamp = strtotime($original_date);
            // $fechaNacimiento = date("Y-m-d", $timestamp);
        
            $datos = array("proveedorId" => $_POST["proveedorId"],
                           "nombre" => $_POST["nombre"],
                           "direccion" => $_POST["direccion"],
                           "telefono" => $_POST["telefono"],
                           "email" => $_POST["email"]);

            $actualiza = mdlProviders::mdlActualizaProveedor($datos);

            if ($actualiza == "ok"){

                echo "<script>Swal.fire({
                    title: 'Actualizado!',
                    text: 'La información se actualizó correctamente',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location='index.php?page=proveedorList'
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
                        window.location='index.php?page=proveedorList'
                    }
                  })
                  </script>";

            }
            
        }
    }


    #  Lista todos los usuarios disponibles en la tabla que recibe como parametro
    #------------------------------------------------------------------------------------------------
    public static function ctrListaProveedores(){

		$respuesta = mdlProviders::mdlListaProveedores("proveedores");

		foreach ($respuesta as $row => $item){
            $registro = strftime("%d de %B de %Y", strtotime($item["fechaRegistro"]));

            echo '
            <tr>
                <td>'.$item["nombre"].'</td>
                <td>'.$item["direccion"].'</td>                 
                <td>'.$item["telefono"].'</td>
                <td>'.$registro.'</td>
                <td>
                    <div class="item-action dropdown">
                        <a href="javascript:void(0)" data-toggle="dropdown" class="icon" aria-expanded="false"><i class="fe fe-more-vertical fs-20 text-dark"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-172px, 22px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a href="index.php?page=proveedorEdit&idEditar='.$item["idProveedor"].'" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Editar </a>
                            <a href="index.php?page=proveedorList&idBorrar='.$item["idProveedor"].'" class="dropdown-item"><i class="dropdown-icon fe fe-user-x"></i> Borrar </a>
                        </div>
                    </div>
                </td>
            </tr>';
		}
	}


    #-------------------------------------
	#Lista todas los proveedores en un select
	#------------------------------------
	public static function ctlListProveedores(){

		$respuesta = mdlProviders::mdlListProveedores("proveedores");

		foreach ($respuesta as $row => $item){
			echo  '<option value="'.$item["idProveedor"].'">'.$item["nombre"].'</option>';
		}
	}


    	#BORRAR PROVEEDOR
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
                    window.location="index.php?page=productDel&idBorrar="+'.$_GET["idBorrar"].'
                }
              })
              </script>';
		}
	}

}//Class

?>
