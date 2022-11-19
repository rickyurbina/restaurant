<?php
Class productos {

    public static function ctrRegistra(){
        if(isset($_POST["registrar"])){

            //obtengo la informacion de la imagen seleccionada en el formulario
            $fname = $_FILES["image"]["name"];
            $source = $_FILES["image"]["tmp_name"];

            //verifico si se selecciono alguna imagen en el formulario,
            //si => genero un nombre para la imagen 
            //no => $target_path tendra un valor de ""            
            if ($fname == "" || is_null($fname)){
                $target_path = "";
            }
            else{
                //Se genera un nombre al azar haciendo md5 a la fecha actual
                $fechaActual = date('d-m-Y H:i:s');
                $v1 = md5($fechaActual);

                //creo la ruta y el nombre a donde se subirá la imagen
                $target_path = "uploads/products/".$v1.$fname;
            }
                                       
            $datos = array("claveProducto" => $_POST["claveProducto"],
                           "name" => $_POST["name"],
                           "brand" => $_POST["brand"],
                           "medida" => $_POST["medida"],
                           "eqType" => $_POST["eqType"],
                           "dayPrice" => $_POST["dayPrice"],
                           "weekPrice" => $_POST["weekPrice"],
                           "monthPrice" => $_POST["monthPrice"],
                           "features" => $_POST["features"],
                           "image" => $target_path);

             $ingresa = mdlProductos::mdlRegistraProducto($datos);

            if ($ingresa == "ok"){
                if (move_uploaded_file($source, $target_path)){
                    echo "<script>Swal.fire({
                        title: 'Registro Exitoso',
                        text: 'El producto se ha registrado',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                      }).then((result) => {
                        if (result.isConfirmed) {
                            window.location='index.php?page=productList'
                        }
                      })
                      </script>";
                }
                else{
                    echo "<script>Swal.fire({
                        title: 'No Image uploaded',
                        text: 'Este producto se registrara sin imagen',
                        icon: 'alert',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                      }).then((result) => {
                        if (result.isConfirmed) {
                            window.location='index.php?page=productList'
                        }
                      })
                      </script>";
                }          
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
                        window.location='index.php?page=productList'
                    }
                  })
                  </script>";
            }   
            
            
        }
    }


    public static function ctrActualiza(){
        if(isset($_POST["btnActualiza"])){
            
            //obtengo la informacion de la imagen seleccionada en el formulario
            $fname = $_FILES["image"]["name"];
            $source = $_FILES["image"]["tmp_name"]; 

            //Verifa si la imagen fue modificada en el formulario
            if ($fname == ""){
                $imagenInsertar = $_POST["oldImage"];
                $imageUpload = true;
            }
            else{
                
                //genero un nombre al azar haciendo md5 a la fecha actual
                $fechaActual = date('d-m-Y H:i:s');
                $v1 = md5($fechaActual);
                $imagenInsertar = $v1.$fname;
                
                //creo la ruta y el nombre a donde se subirá la imagen
                $imagenInsertar = "uploads/products/".$imagenInsertar;
                
                //Se sube imagen nueva si hay exito, se elimina del servidor la imagen anterior de este producto
                if (move_uploaded_file($source, $imagenInsertar)) {
                    $imageUpload = true;
                    if (file_exists($_POST["oldImage"])) unlink($_POST["oldImage"]);

                }
                else $imageUpload = false;
            }

            $datos = array( "idProducto" => $_POST["idProducto"],
                            "claveProducto" => $_POST["claveProducto"],
                            "name" => $_POST["name"],
                            "brand" => $_POST["brand"],
                            "eqType" => $_POST["eqType"],
                            "dayPrice" => $_POST["dayPrice"],
                            "weekPrice" => $_POST["weekPrice"],
                            "monthPrice" => $_POST["monthPrice"],
                            "features" => $_POST["features"],
                            "image" => $imagenInsertar);

            $actualiza = mdlProductos::mdlActualizaProducto($datos);

            if ($actualiza == "ok" && $imageUpload == true){

                    echo "<script>Swal.fire({
                        title: 'Registro Exitoso',
                        text: 'El producto se ha registrado',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                      }).then((result) => {
                        if (result.isConfirmed) {
                            window.location='index.php?page=productList'
                        }
                      })
                      </script>";
                    }
                elseif ($actualiza == "ok" && $imageUpload == false){

                    echo "<script>Swal.fire({
                        title: 'Warning',
                        text: 'Datos almacenados pero No se pudo subir la imagen del producto',
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                      })
                      </script>";
                    } 
                else{
                    echo "<script>Swal.fire({
                        title: 'Error!',
                        text: 'No se logró actualizar La información',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location='index.php?page=productList'
                        }
                    })
                    </script>";

                }
        }
    }


    #  Lista todos los usuarios disponibles en la tabla que recibe como parametro
    #------------------------------------------------------------------------------------------------
    public static function ctrListaProductos(){

		$respuesta = mdlProductos::mdlListaProducto("productos");

		foreach ($respuesta as $row => $item){
            // if ($item["tipoCliente"] == 1) $tipoCliente = '<td>Socio</td>';
            // if ($item["tipoCliente"] == 2) $tipoCliente = '<td>Estudiante</td>';
            // if ($item["tipoCliente"] == 3) $tipoCliente = '<td>Referido</td>';
            // $cumple = strftime("%d de %B", strtotime($item["fechaNacimiento"]));
            // $registro = strftime("%d de %B de %Y", strtotime($item["fechaRegistro"]));
            if ($item["status"]=="yard") $light = '<span class="status-icon bg-success"></span>';
            if ($item["status"]=="out") $light = '<span class="status-icon bg-danger"></span>';
            if ($item["status"]=="maintenance") $light = '<span class="status-icon bg-blue"></span>';
            if ($item["status"]=="reserved") $light = '<span class="status-icon bg-warning"></span>';

            echo '
            <tr>
                <td>'.$item["idProducto"].'</td>
                <td>'.$item["name"].'</td>
                <td>'.$item["brand"].'</td>
                <td>'.$item["eqType"].'</td>
                <td>'.$item["disponibilidad"].' '.$item["medida"].'</td>
                <td>
                    <div class="item-action dropdown">
                        <a href="javascript:void(0)" data-toggle="dropdown" class="icon" aria-expanded="false"><i class="fe fe-more-vertical fs-20 text-dark"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-172px, 22px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a href="index.php?page=productEdit&idEditar='.$item["idProducto"].'" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Edit </a>
                            <a href="index.php?page=entradaAdd&idEntrada='.$item["idProducto"].'" class="dropdown-item"><i class="dropdown-icon icon-login"></i> Entrada </a>
                            <a href="index.php?page=productList&idBorrar='.$item["idProducto"].'" class="dropdown-item"><i class="dropdown-icon fe fe-user-x"></i> Delete </a>
                        </div>
                    </div>
                </td>
            </tr>';
		}
	}

    public function ctrSelectProductos() {
        $respuesta = mdlProductos::mdlListaProducto("productos");

        foreach ($respuesta as $producto) {
            echo '
                <option value="' . $producto['idProducto'] . '" precio="' . $producto['precioPublico'] . '">' . $producto['nombre'] . '</option>
            ';
        }
    }


    	#BORRAR USUARIO
	#------------------------------------
	public static function ctrBorrarProducto(){
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


    #-------------------------------------
	#Lista todas los productos en un select
	#------------------------------------
	public static function ctlListProductos(){

		$respuesta = mdlProductos::mdlListProductos("productos");

		foreach ($respuesta as $row => $item){
			echo  '<option value="'.$item["idProducto"].'">'.$item["name"].'</option>';
		}
	}

    #   ---------------------------------------------------------------------------------------------
    #   Busca los propductos asociados a una ORDEN para editar dicha orden en entradasEdit.php
    #   ---------------------------------------------------------------------------------------------
    public static function ctlBuscaProdsJSON($orden){
        $productos = mdlProductos::mdlListProductosJSON($orden);
        return $productos;
    }

    #   ---------------------------------------------------------------------------------------------
    #   Busca los propductos asociados a una PEDIDO para editar dicha orden en salidasEdit.php
    #   ---------------------------------------------------------------------------------------------
    public static function ctlBuscaProdsSalidaJSON($orden){
        $productos = mdlProductos::mdlListProductosSalidaJSON($orden);
        return $productos;
    }


}//Class

?>
