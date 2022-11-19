<div class="page-header">
  <h4 class="page-title">Lista de ventas</h4>
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Admin</a></li>
    <li class="breadcrumb-item active" aria-current="page">Lista de ventas</li>
  </ol>
</div>

<div class="col">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Lista de ventas</h3>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table id="tablaVentas" class="hover table-bordered border-top-0 border-bottom-0" style="text-align: center;">
          <thead>
            <tr>
              <th>Cliente</th>
              <th>Productos</th>
              <th>Total</th>
              <th>Fecha</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $controllerVentas = new VentasController();
              $controllerVentas -> ctrListarVentas();
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>Cliente</th>
              <th>Productos</th>
              <th>Total</th>
              <th>Fecha</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

