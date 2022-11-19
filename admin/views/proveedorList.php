<div class="page-header">
	<h4 class="page-title">Provider List</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Provider Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">Provider List</li>
	</ol>
</div>

<div class="col-md-12 col-lg-12">
	<div class="card">
		<div class="card-header">
			<div class="card-title">Proveedores Registrados</div>

		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="example2" class="hover table-bordered border-top-0 border-bottom-0" style="text-align: center;">
					<thead>
						<td>Nombre</td>
						<td>Dirección</td>
						<td>Teléfono</td>
						<td>Fecha Registro</td>
						<td>Opciones</td>
					</thead>
					<tbody>
						<?php
							$lista = new providers();
							$lista -> ctrListaProveedores();
							$lista -> ctrBorrarCliente();
						?>
						
					</tbody>
					<tfoot>
						<tr>
							<td>Nombre</td>
							<td>Dirección</td>
							<td>Teléfono</td>
							<td>Fecha Registro</td>
							<td>Opciones</td>
						</tr>
					</tfoot>
				</table>

			</div>
		</div>
	</div>
</div>