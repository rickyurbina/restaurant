<?php

    $producto = $_GET["idBorrar"];
    $busca = mdlProductos::mdlBusca($producto, "productos");

    if (file_exists($busca["image"])) unlink($busca["image"]);
    
    $respuesta = mdlProductos::mdlBorrarProducto($_GET["idBorrar"],"productos");  

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
                window.location='index.php?page=productList'
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
                window.location='index.php?page=productList'
            }
        })
      </script>";
    }
    
?>