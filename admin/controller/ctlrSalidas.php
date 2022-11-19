<?php
Class Salidas {

    public static function ctlRegistraPedido(){
      if(isset($_POST["regPedido"])){
        
        $prods = json_decode($_POST["pedidoBD"], true);
        
        $original_date = $_POST["fechaMovimiento"];
        $timestamp = strtotime($original_date);
        $fechaMovimiento = date("Y-m-d", $timestamp);

        $datos_pedido = array ("idCliente" => $_POST["idCliente"],
                                "pedido" => $_POST["pedidoNum"],
                                "concepto" => $_POST["concepto"],
                                "tipoPago" => $_POST["tipoPago"],
                                "totalPedido" => $_POST["totalPedidoBD"],
                                "valorDescuento" => $_POST["valorDescuento"],
                                "pedidoNeto" => $_POST["pedidoNeto"],
                                "fechaMovimiento" => $fechaMovimiento);
        
        $ingresa = mdlSalidas::mdlRegistraPedido($datos_pedido);

        //por cada producto en la pedido registro en la tabla de salidas
        foreach ($prods as $row => $item){
          $datos_prods = array( "idProducto" => $item["idProducto"],
                                "cantidad" => $item["cantidad"],
                                "medida" => $item["medida"],                                
                                "idCliente" => $_POST["idCliente"],
                                "precio" => $item["precio"],
                                "pedido" => $_POST["pedidoNum"]);
          // Mandar llamar el metodo del modelo que inserta los datos en la tabla 
          $ingresa = mdlSalidas::mdlRegistraProdsPedido($datos_prods);
          // monitorear si hay error al insertar los datos y mostrar mensaje
        }

        if ($ingresa != 'error'){
          echo "<script>Swal.fire({
            title: 'Registro Exitoso',
            text: 'El nuevo usuario ha sio registrado',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
          }).then((result) => {
            if (result.isConfirmed) {
                window.location='index.php?page=salidasList'
            }
          })
          </script>";
        }
        else if($ingresa == 'error_pedido'){
          echo "<script>Swal.fire({
            title: 'Error en Pedido',
            text: 'No se pudo guardar la información de la Pedido',
            icon: 'danger',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
          }).then((result) => {
            if (result.isConfirmed) {
                window.location='index.php?page=salidasList'
            }
          })
          </script>";
        }
        else if($ingresa == 'error_prods'){
          echo "<script>Swal.fire({
            title: 'Error en Productos',
            text: 'No se pudo guardar la información de los Productos',
            icon: 'danger',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
          }).then((result) => {
            if (result.isConfirmed) {
                window.location='index.php?page=salidasList'
            }
          })
          </script>";
        }
        
      }
    }

    #--------------------------------------------------------------------------------------------------------
    # Actualiza los datos de pedidoEnc y borra los datos de productos en salidas para despues volver a insertarlos
    #--------------------------------------------------------------------------------------------------------
    public static function ctlEditaSalida(){
      if(isset($_POST["updtPedido"])){
        
        $prods = json_decode($_POST["pedidoBD"], true);
        
        $original_date = $_POST["fechaMovimiento"];
        $timestamp = strtotime($original_date);
        $fechaMovimiento = date("Y-m-d", $timestamp);

        $datos_pedido = array ("idCliente" => $_POST["idCliente"],
                                "pedido" => $_POST["pedidoNum"],
                                "concepto" => $_POST["concepto"],
                                "totalPedidoBD" => $_POST["totalPedidoBD"],
                                "fechaMovimiento" => $fechaMovimiento);
        
        $ingresa = mdlSalidas::mdlActualizaPedido($datos_pedido);
        if ($ingresa != 'error'){
          $updtProds = mdlSalidas::mdlEliminaProds($_POST['pedidoNum']);
          if ($updtProds != "error"){
            // por cada producto en la pedido registro en la tabla de salidas
            foreach ($prods as $row => $item){
              $datos_prods = array( "idProducto" => $item["idProducto"],
                                    "cantidad" => $item["cantidad"],
                                    "medida" => $item["medida"],
                                    "lote" => $item["lote"],
                                    "idCliente" => $_POST["idCliente"],
                                    "precio" => $item["precio"],
                                    "pedido" => $_POST["pedidoNum"]);
              // Mandar llamar el metodo del modelo que inserta los datos en la tabla 
              $ingresa = mdlSalidas::mdlRegistraProdsPedido($datos_prods);
              // monitorear si hay error al insertar los datos y mostrar mensaje
            }
          }
        }

        if ($ingresa != 'error'){
          echo "<script>Swal.fire({
            title: 'Registro Exitoso',
            text: 'El nuevo usuario ha sio registrado',
            icon: 'success',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
          }).then((result) => {
            if (result.isConfirmed) {
                window.location='index.php?page=salidasList'
            }
          })
          </script>";
        }
        else if($ingresa == 'error_pedido'){
          echo "<script>Swal.fire({
            title: 'Error en Pedido',
            text: 'No se pudo guardar la información de la Pedido',
            icon: 'danger',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
          }).then((result) => {
            if (result.isConfirmed) {
                window.location='index.php?page=salidasList'
            }
          })
          </script>";
        }
        else if($ingresa == 'error_prods'){
          echo "<script>Swal.fire({
            title: 'Error en Productos',
            text: 'No se pudo guardar la información de los Productos',
            icon: 'danger',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
          }).then((result) => {
            if (result.isConfirmed) {
                window.location='index.php?page=salidasList'
            }
          })
          </script>";
        }
        
      }
    }



    public static function ctrRegistraEntrada(){
        if(isset($_POST["nombre"])){

            $original_date = $_POST["fechaMovimiento"];
            $timestamp = strtotime($original_date);
            $fechaMovimiento = date("Y-m-d", $timestamp);
            //$fechaMovimiento = date('Y-m-d');
        
            $datos = array("idProducto" => $_POST["idProducto"],
                           "lote" => $_POST["lote"],
                           "cantidad" => $_POST["cantidad"],
                           "medida" => $_POST["medida"],
                           "costo" => $_POST["costo"],
                           "idProveedor" => $_POST["idProveedor"],
                           "fechaMovimiento" => $fechaMovimiento);

            $ingresa = mdlSalidas::mdlRegistraEntrada($datos);

            //echo $ingresa;

            if ($ingresa != "error"){

                    echo "<script>Swal.fire({
                        title: 'Registro Exitoso',
                        text: 'El nuevo usuario ha sio registrado ".$ingresa."',
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


    #  Lista todas las salidas de producto
    #------------------------------------------------------------------------------------------------
    public static function ctrListaSalidas(){

      $respuesta = mdlSalidas::mdlListaSalidas("salidasEnc");
  
      foreach ($respuesta as $row => $item){
              $registro = strftime("%d de %B de %Y", strtotime($item["fecha"]));
              $cancelado = '';
              $opcion = '<a href="index.php?page=salidasList&idBorrar='.$item["pedido"].'" class="dropdown-item"><i class="dropdown-icon pe-7s-junk"></i> Cancelar </a>';
              if ($item["status"]=='C') 
              {
                $cancelado = '<button type="button" class="btn btn-icon btn-primary">X</button>';
                $opcion = '';
              }
              
              else $cancelado = '<button type="button" class="btn btn-icon btn-green"><i class="fa fa-check" aria-hidden="true"></i></button>';

              echo '
              <tr>
                  <td>'.$item["pedido"].'</td>
                  <td>'.$item["nombres"].'</td>
                  <td>'.$registro.'</td>
                  <td>'.$item["totalNeto"].'</td>
                  <td>'.$cancelado.'</td>
                  <td>
                      <div class="item-action dropdown">
                          <a href="javascript:void(0)" data-toggle="dropdown" class="icon" aria-expanded="false"><i class="fe fe-more-vertical fs-20 text-dark"></i></a>
                          <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-172px, 22px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a href="index.php?page=salidasEdit&idSalida='.$item["pedido"].'" class="dropdown-item"><i class="dropdown-icon icon icon-list"></i> Detalle </a>  
                            '.$opcion.'
                          </div>
                      </div>
                  </td>
              </tr>';
      }
    }


    #------------------------------------------------------------------
    # Edita la informacion de una Entrada
    #------------------------------------------------------------------
    public static function ctrActualizaEntrada(){
      if(isset($_POST["btnActualiza"])){

          $original_date = $_POST["fechaMovimiento"];
          $timestamp = strtotime($original_date);
          $fechaMovimiento = date("Y-m-d", $timestamp);
      
          $datos = array("id" => $_POST["id"],
                         "lote" => $_POST["lote"],
                         "cantidad" => $_POST["cantidad"],
                         "costo" => $_POST["costo"],
                         "fechaMovimiento" => $fechaMovimiento,
                         "idProveedor" => $_POST["idProveedor"]);

          $actualiza = mdlSalidas::mdlActualizaEntrada($datos);

          if ($actualiza == "ok"){

              echo "<script>Swal.fire({
                  title: 'Actualizado!',
                  text: 'La información se actualizó correctamente',
                  icon: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Ok'
                  }).then((result) => {
                  if (result.isConfirmed) {
                      window.location='index.php?page=salidasList'
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
                      window.location='index.php?page=salidasList'
                  }
                })
                </script>";

          }
          
      }
  }

  #------------------------------------
    # Borrar Salida
	#------------------------------------
	public static function ctrBorrarSalida(){
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
                    window.location="index.php?page=salidaDel&idBorrar="+'.$_GET["idBorrar"].'
                }
              })
              </script>';
		}
	}

  #-------------------------------------------------------------------------
	# Lista proveedores en un select para el registro de salidas, recibe un valor
  # si coincide con la marca retorna selected para la edicion de la entrada
	#------------------------------------------------------------------------
	public static function ctlListProveedoresSelected($valor){

		$respuesta = mdlSalidas::mdlListProveedores("proveedores");

		foreach ($respuesta as $row => $item){
            if ($item["idProveedor"] == $valor ) 
                echo  '<option value="'.$item["idProveedor"].'" selected>'.$item["nombre"].' </option>';    
            else 
                echo  '<option value="'.$item["idProveedor"].'">'.$item["nombre"].'</option>';
		}
	}

}

?>