<?php

class VentasController {
  public function ctrAgregarVenta() {
    if (isset($_POST['lista'])) {
      // print_r($_POST);

      if (!$_POST['lista']) {
        echo 
        '<script>  
          Swal.fire({
              title: "Error al registrar la venta",
              text: "Seleccione al menos un producto para vender",
              icon: "error",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Aceptar"
            });
          </script>';
        return;
      }

      if ($_POST['selectCliente']) {
        $datosController = array(
          "idCliente" => $_POST['selectCliente'],
          "productos" => $_POST['lista'],
          "total" => $_POST['totalInput']
        );

        $respuesta = VentasModel::mdlAgregarVenta($datosController);

        if ($respuesta === 'success') {
          echo '<script>  
          Swal.fire({
              title: "Venta registrada",
              text: "Venta registrada exitosamente",
              icon: "success",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Aceptar"
            });
          </script>';
        } else {
          echo '<script>  
          Swal.fire({
              title: "Error al registrar la venta",
              text: "Inténtelo de nuevo más tarde",
              icon: "error",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Aceptar"
            });
          </script>';
        }

      } else if ($this -> ctrValidarCliente($_POST)) {
        $idCliente = $this -> ctrRegistrarCliente($_POST);
        if ($idCliente !== -1) {
          $datosController = array(
            "idCliente" => $idCliente,
            "productos" => $_POST['lista'],
            "total" => $_POST['totalInput']
          );
         $respuesta = VentasModel::mdlAgregarVenta($datosController);
          
         if ($respuesta === 'success') {
          echo '<script>  
          Swal.fire({
              title: "Venta registrada",
              text: "Venta registrada exitosamente",
              icon: "success",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Aceptar"
            });
          </script>';
        } else {
          echo '<script>  
          Swal.fire({
              title: "Error al registrar la venta",
              text: "Inténtelo de nuevo más tarde",
              icon: "error",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Aceptar"
            });
          </script>';
        }
        }
      } else {
        echo 
        '<script>  
          Swal.fire({
              title: "Error al registrar la venta",
              text: "Seleccione un cliente o registre uno",
              icon: "error",
              showCancelButton: false,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Aceptar"
            });
          </script>';
      }
    }
  }

  private function ctrValidarCliente($campos) {
    $camposValidos = 0;

    if ($campos['nombresCliente']) {
      $camposValidos++;
    }

    if ($campos['apellidosCliente']) {
      $camposValidos++;
    }

    if ($campos['telefonoCliente']) {
      $camposValidos++;
    }

    if ($campos['correoCliente']) {
      $camposValidos++;
    }

    if ($campos['fechaCliente']) {
      $camposValidos++;
    }

    return $camposValidos === 5;
  }

  private function ctrRegistrarCliente($datos) {
    $datosCliente = array(
      "nombres" => $datos['nombresCliente'],
      "apellidos" => $datos['apellidosCliente'],
      "telefono" => $datos['telefonoCliente'],
      "email" => $datos['correoCliente'],
      "fechaNacimiento" => $datos['fechaCliente'],
      "tipoSocio" => $datos['tipoCliente'],
      "fechaRegistro" => date('Y-m-d')
    );

    $respuesta = mdlSocios::mdlRegistraSocio($datosCliente);

    if ($respuesta === "ok") {
      return mdlSocios::mdlUltimoSocio()[0]['idSocio'];
    } else {
      return -1;
    }
  }

  public function ctrListarVentas() {
    $respuesta = VentasModel::mdlListarVentas();

    foreach ($respuesta as $venta) {
      $cliente = mdlSocios::mdlBusca($venta['idCliente'], "socios");

      echo 
      '<tr>
        <td>' . $cliente['nombres'] . ' ' . $cliente['apellidos'] . '</td>
        <td>' . $this -> generarProductos($venta['productos']) . '</td>
        <td>$' . $venta['total'] . '</td>
        <td>' . $venta['fecha'] . '</td>
      </tr>';
    }
  }

  private function generarProductos($productos) {
    $productos = json_decode($productos, true);

    $string = '';

    foreach ($productos as $producto) {
      $string .= $producto['nombreProducto'] . ' x '. $producto['cantidad'];
    }
    return $string;
  } 
}
