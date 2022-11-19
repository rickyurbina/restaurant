<?php
    $respuesta = mdlSocios::mdlBorrarSocio($_GET["idBorrar"],"socios");  

    if ($respuesta == "success"){
        echo "<script>
        Swal.fire({
            title: 'Borrado',
            text: 'El socio ha sio borrado',
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
                window.location='index.php?page=socioList'
            }
        })
      </script>";
    }
    
?>