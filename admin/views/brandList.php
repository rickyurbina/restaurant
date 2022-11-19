<div class="page-header">
	<h4 class="page-title">Lista de marcas</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Products Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">Brand List</li>
	</ol>
</div>
	

<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Marcas</h3>

		</div>
		<div class="table-responsive">
			
			<table class="table card-table table-bordered table-hover table-vcenter mb-0 text-nowrap">
				<tbody style="text-align: center;">
					<tr>
						<th style="width:70%">Name</th>
						<th>Options</th>
					</tr>

					<?php
						 $lista = new brands();
						 $lista -> ctrListaBrands();
						 $lista -> ctrBorrarBrand();
					?>

					<tr style="text-align: center;">
					<th class="w-2">Name</th>
						<th>Options</th>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>