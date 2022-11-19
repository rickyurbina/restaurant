<?php
    $respuesta = mdlMovimientos::mdlBorrarEnc_Entradas($_GET["idBorrar"]);  

    if ($respuesta == "success"){
        echo "<script>
        Swal.fire({
            title: 'Borrado',
            text: 'El registro ha sio borrado',
            icon: 'error',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location='index.php?page=entradasList'
            }
        })
      </script>";
    }
    else{
        echo "<script>
        Swal.fire({
            title: 'Error',
            text: 'No se ha borrado',
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Ok'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location='index.php?page=entradasList'
            }
        })
      </script>";
    }
    
?>