<?php
Class brands {


    #-------------------------------------
	#Lista todas las marcas en un select para el registro de productos
	#------------------------------------
	public static function ctlListBrands(){

		$respuesta = mdlBrands::mdlListBrands("brands");

		foreach ($respuesta as $row => $item){
			echo  '<option value="'.$item["nombre"].'">'.$item["nombre"].'</option>';
		}
	}

    #-------------------------------------------------------------------------
	#Lista las marcas en un select para el registro de productos, recibe un valor
    # si coincide con la marca retorna selected para la edicion del producto
	#------------------------------------------------------------------------
	public static function ctlListBrandsSelected($valor){

		$respuesta = mdlBrands::mdlListBrands("brands");

		foreach ($respuesta as $row => $item){
            if ($item["nombre"] == $valor ) 
                echo  '<option value="'.$item["nombre"].'" selected>'.$item["nombre"].' </option>';    
            else 
                echo  '<option value="'.$item["nombre"].'">'.$item["nombre"].'</option>';
		}
	}

    public static function ctrRegistra(){
        if(isset($_POST["nombre"])){

            // echo $_POST["nombres"]."<br>";
            // echo $_POST["apellidos"]."<br>";
            // echo $_POST["telefono"]."<br>";
            // echo $_POST["tipoCliente"]."<br>";
            // echo $_POST["fechaNacimiento"]."<br>";

            // $original_date = $_POST["fechaNacimiento"];
            // $timestamp = strtotime($original_date);
            // $fechaNacimiento = date("Y-m-d", $timestamp);
            // $fechaRegistro = date('Y-m-d');
        
            $datos = array("nombre" => $_POST["nombre"]);

            $ingresa = mdlBrands::mdlRegistraBrand($datos);

            echo $ingresa;

            if ($ingresa == "ok"){

                    echo "<script>Swal.fire({
                        title: 'Registro Exitoso',
                        text: 'La nueva marca ha sio registrada',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                      }).then((result) => {
                        if (result.isConfirmed) {
                            window.location='index.php?page=brandList'
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
                        window.location='index.php?page=brandList'
                    }
                  })
                  </script>";
        }
            
            
        }
    }


    public static function ctrActualiza(){
        if(isset($_POST["btnActualiza"])){
        
            $datos = array("nombre" => $_POST["nombre"], "brandId" => $_POST["brandId"]);

            $actualiza = mdlBrands::mdlActualizaBrand($datos);

            if ($actualiza == "ok"){

                echo "<script>Swal.fire({
                    title: 'Actualizado!',
                    text: 'La marca se actualizó correctamente',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location='index.php?page=brandList'
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
                        window.location='index.php?page=brandList'
                    }
                  })
                  </script>";

            }
            
        }
    }


    #  Lista todos los usuarios disponibles en la tabla que recibe como parametro
    #------------------------------------------------------------------------------------------------
    public static function ctrListaBrands(){

		$respuesta = mdlBrands::mdlListaBrands("brands");

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
                            <a href="index.php?page=brandEdit&idEditar='.$item["id"].'" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Editar </a>
                            <a href="index.php?page=brandList&idBorrar='.$item["id"].'" class="dropdown-item"><i class="dropdown-icon fe fe-user-x"></i> Borrar </a>
                        </div>
                    </div>
                </td>
            </tr>';
		}
	}


    	#BORRAR USUARIO
	#------------------------------------
	public static function ctrBorrarBrand(){
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
                    window.location="index.php?page=brandDel&idBorrar="+'.$_GET["idBorrar"].'
                }
              })
              </script>';
		}
	}

}//Class

?>
