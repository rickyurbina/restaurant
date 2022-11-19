<div class="page-header">
	<h4 class="page-title">Lista de categorías</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Types Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">Types List</li>
	</ol>
</div>
	

<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Categorías</h3>

		</div>
		<div class="table-responsive">
			
			<table class="table card-table table-bordered table-hover table-vcenter mb-0 text-nowrap">
				<tbody style="text-align: center;">
					<tr>
						<th style="width:70%">Nombre</th>
						<th>Options</th>
					</tr>

					<?php
						 $lista = new equipmentType();
						 $lista -> ctrListaEqType();
						 $lista -> ctrBorrarEqType();
					?>

					<tr style="text-align: center;">
					<th class="w-2">Nombre</th>
						<th>Options</th>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>