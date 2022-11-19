<?php   
      $datos = array( 
        "id" => $_GET["id"],
        "stat" => $_GET["status"]);
        echo "<br><br>";
    var_dump($datos);


    $cambia = mdlProductos::mdlStatusProducto($datos, "productos");

    if ($cambia == "success"){
        echo "<script>
        Swal.fire({
            title: 'Status cambió',
            text: 'Se actualizó el status del producto',
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
        echo "<script>
        Swal.fire({
            title: 'Error',
            text: 'El status del producto no se actualió',
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