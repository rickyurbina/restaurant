<br>
<div class="col-md-12 col-lg-12">
	<div class="card">
		<div class="card-header">
			<div class="card-title">Ventas</div>

		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table id="example2" class="hover table-bordered border-top-0 border-bottom-0" style="text-align: center;">
					<thead>
						<td>Orden</td>
						<td>Cliente</td>
						<td>Fecha</td>
						<td>Monto</td>
						<td>Estado</td>
						<td>opciones</td>
					</thead>
					<tbody>
						<?php
							$lista = new Salidas();
							$lista -> ctrListaSalidas();
							$lista -> ctrBorrarSalida();
						?>
						
					</tbody>
					<tfoot>
						<tr>
							<td>Orden</td>
							<td>Cliente</td>
							<td>Fecha</td>
							<td>Monto</td>
							<td>Estado</td>
							<td>opciones</td>
						</tr>
					</tfoot>
				</table>

			</div>
		</div>
	</div>
</div>