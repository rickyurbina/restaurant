<?php
Class socios {

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
                           "tipoSocio" => $_POST["tipoSocio"],
                           "fechaNacimiento" => $fechaNacimiento,
                           "password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
                           "fechaRegistro" => $fechaRegistro);

            $ingresa = mdlSocios::mdlRegistraSocio($datos);

            echo $ingresa;

            if ($ingresa == "ok"){

                    echo "<script>Swal.fire({
                        title: 'Registro Exitoso',
                        text: 'El nuevo socio ha sio registrado',
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                      }).then((result) => {
                        if (result.isConfirmed) {
                            window.location='index.php?page=socioList'
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
                        window.location='index.php?page=socioList'
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
        
            $datos = array("socioId" => $_POST["socioId"],
                           "nombres" => $_POST["nombres"],
                           "apellidos" => $_POST["apellidos"],
                           "telefono" => $_POST["telefono"],
                           "email" => $_POST["email"],
                           "password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
                           "tipoSocio" => $_POST["tipoSocio"],
                           "fechaNacimiento" => $fechaNacimiento);

            $actualiza = mdlSocios::mdlActualizaSocio($datos);

            if ($actualiza == "ok"){

                echo "<script>Swal.fire({
                    title: 'Actualizado!',
                    text: 'La información se actualizó correctamente',
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ok'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location='index.php?page=socioList'
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
                        window.location='index.php?page=socioList'
                    }
                  })
                  </script>";

            }
            
        }
    }


    #  Lista todos los usuarios disponibles en la tabla que recibe como parametro
    #------------------------------------------------------------------------------------------------
    public static function ctrListaSocios(){

		$respuesta = mdlSocios::mdlListaSocio("socios");

		foreach ($respuesta as $row => $item){
            if ($item["tipoSocio"] == 1) $tipoSocio = '<td>Socio</td>';
            if ($item["tipoSocio"] == 2) $tipoSocio = '<td>Estudiante</td>';
            if ($item["tipoSocio"] == 3) $tipoSocio = '<td>Referido</td>';
            $cumple = strftime("%d de %B", strtotime($item["fechaNacimiento"]));
            $registro = strftime("%d de %B de %Y", strtotime($item["fechaRegistro"]));

            echo '
            <tr>
                <td>'.$item["nombres"].' '.$item["apellidos"].'</td>'
                .$tipoSocio.'
                <td>'.$item["telefono"].'</td>
                <td>'.$registro.'</td>
                <td>'.$cumple.'</td>
                <td>
                    <div class="item-action dropdown">
                        <a href="javascript:void(0)" data-toggle="dropdown" class="icon" aria-expanded="false"><i class="fe fe-more-vertical fs-20 text-dark"></i></a>
                        <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end" style="position: absolute; transform: translate3d(-172px, 22px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <a href="index.php?page=socioEdit&idEditar='.$item["idSocio"].'" class="dropdown-item"><i class="dropdown-icon fe fe-edit-2"></i> Editar </a>
                            <a href="index.php?page=socioList&idBorrar='.$item["idSocio"].'" class="dropdown-item"><i class="dropdown-icon fe fe-user-x"></i> Borrar </a>
                        </div>
                    </div>
                </td>
            </tr>';
		}
	}


    	#BORRAR SOCIO
	#------------------------------------
	public static function ctrBorrarSocio(){
		if (isset($_GET['idBorrar'])){
            echo '<script>  
            Swal.fire({
                title: "¿Está seguro?",
                text: "¡Esto no se podrá recuperar!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "¡Si, borrar!"
              }).then((result) => {
                if (result.isConfirmed) {
                    window.location="index.php?page=socioDel&idBorrar="+'.$_GET["idBorrar"].'
                }
              })
              </script>';
		}
	}

    public function ctrActualizarAsistencia() {
        if (isset($_GET['socio'])) {
            $idSocio = $_GET['socio'];
            
            $respuesta = mdlSocios::mdlActualizarAsistencia($idSocio);

            if ($respuesta === "success") {
                echo '<script>  
                Swal.fire({
                    title: "Actualizar asistencia",
                    text: "La asistencia fue borrada exitosamente",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Aceptar"
                  }).then((result) => {
                  
                        window.location.href = "index.php?page=socioList";
                    
                  })
                  </script>';
            } else {
                echo '<script>  
                Swal.fire({
                    title: "Actualizar asistencia",
                    text: "La asistencia no se pudo actualizar",
                    icon: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Aceptar"
                  }).then((result) => {
                  
                        window.location.href = "index.php?page=socioList";
                    
                  })
                  </script>';
            }
        }
    }

    public function ctrRegistrarMensualidad() {
        if (isset($_GET['socio'])) {
            $idSocio = $_GET['socio'];

            $respuesta = mdlSocios::mdlRegistrarMensualidad($idSocio);

            if ($respuesta === "success") {
                echo '<script>  
                Swal.fire({
                    title: "Registrar mensualidad",
                    text: "La mensualidad fue registrada exitosamente",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Aceptar"
                  }).then((result) => {
                  
                        window.location.href = "index.php?page=socioList";
                    
                  })
                  </script>';
            } else {
                echo '<script>  
                Swal.fire({
                    title: "Registrar mensualidad",
                    text: "La mensualidad no se pudo registrar",
                    icon: "error",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Aceptar"
                  }).then((result) => {
                  
                        window.location.href = "index.php?page=socioList";
                    
                  })
                  </script>';
            }
        }
    }

    public function ctrSelectSocios() {
        $respuesta = mdlSocios::mdlListaSocio("socios");

        foreach($respuesta as $socio) {
            echo '<option value="' . $socio['idSocio'] . '">' . $socio['nombres'] . ' ' . $socio['apellidos'] . '</option>';
        }
    }

}//Class

?>
