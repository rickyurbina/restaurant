<?php
    $respuesta = mdlEqType::mdlBorrarEqType($_GET["idBorrar"],"eqType");  

    if ($respuesta == "success"){
        echo "<script>
        Swal.fire({
            title: 'Borrado',
            text: 'Producto borrado',
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
                window.location='index.php?page=eqTypeList'
            }
        })
      </script>";
    }
    
?>