<?php
    $respuesta = mdlSalidas::mdlBorrarEncSalidas($_GET["idBorrar"]);  

    if ($respuesta == "success"){
        echo "<script>
        Swal.fire({
            title: 'Borrado ". $respuesta ."',
            text: 'El registro ha sio borrado',
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
    else{
        echo "<script>
        Swal.fire({
            title: 'Error en ". $respuesta ."',
            text: 'No se ha borrado',
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location='index.php?page=salidaList'
            }
        })
      </script>";
    }
    
?>