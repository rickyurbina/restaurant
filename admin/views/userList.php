<div class="page-header">
	<h4 class="page-title">Users List</h4>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="#">Users Admin</a></li>
		<li class="breadcrumb-item active" aria-current="page">Users List</li>
	</ol>
</div>
	

<div class="col-md-12">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">Usuarios con acceso al sistema</h3>

		</div>
		<div class="table-responsive">
			<!-- <table class="table card-table table-vcenter text-nowrap">
				<thead>
					<tr>
						<th>Project Name</th>
						<th>Date</th>
						<th>Status</th>
						<th>Price</th>
						<th></th>
					</tr>
				</thead>
				<tbody>

					<tr>
						<td><a href="store.html" class="text-inherit">Untrammelled prevents </a></td>
						<td>28 May 2019</td>
						<td><span class="status-icon bg-success"></span> Completed</td>
						<td>$56,908</td>
						<td class="text-right">
							<a class="icon" href="javascript:void(0)"></a>
							<a href="javascript:void(0)" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>

							<a class="icon" href="javascript:void(0)"></a>
							<a href="javascript:void(0)" class="btn btn-green btn-sm"><i class="fa fa-link"></i> Update</a>

							<a class="icon" href="javascript:void(0)"></a>
							<a href="javascript:void(0)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
						</td>
					</tr>
					<tr>
						<td><a href="store.html" class="text-inherit">Untrammelled prevents</a></td>
						<td>12 June 2019</td>
						<td><span class="status-icon bg-danger"></span> On going</td>
						<td>$45,087</td>
						<td class="text-right">
							<a class="icon" href="javascript:void(0)"></a>
							<a href="javascript:void(0)" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>

							<a class="icon" href="javascript:void(0)"></a>
							<a href="javascript:void(0)" class="btn btn-green btn-sm"><i class="fa fa-link"></i> Update</a>

							<a class="icon" href="javascript:void(0)"></a>
							<a href="javascript:void(0)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
						</td>
					</tr>
					<tr>
						<td><a href="store.html" class="text-inherit">Untrammelled prevents</a></td>
						<td>12 July 2019</td>
						<td><span class="status-icon bg-warning"></span> Pending</td>
						<td>$60,123</td>
						<td class="text-right">
							<a class="icon" href="javascript:void(0)"></a>
							<a href="javascript:void(0)" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>

							<a class="icon" href="javascript:void(0)"></a>
							<a href="javascript:void(0)" class="btn btn-green btn-sm"><i class="fa fa-link"></i> Update</a>

							<a class="icon" href="javascript:void(0)"></a>
							<a href="javascript:void(0)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
						</td>
					</tr>
					<tr>
						<td><a href="store.html" class="text-inherit">Untrammelled prevents</a></td>
						<td>14 June 2019</td>
						<td><span class="status-icon bg-warning"></span> Pending</td>
						<td>$70,435</td>
						<td class="text-right">
							<a class="icon" href="javascript:void(0)"></a>
							<a href="javascript:void(0)" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>

							<a class="icon" href="javascript:void(0)"></a>
							<a href="javascript:void(0)" class="btn btn-green btn-sm"><i class="fa fa-link"></i> Update</a>

							<a class="icon" href="javascript:void(0)"></a>
							<a href="javascript:void(0)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
						</td>
					</tr>
					<tr>
						<td><a href="store.html" class="text-inherit">Untrammelled prevents</a></td>
						<td>25 June 2019</td>
						<td><span class="status-icon bg-success"></span> Completed</td>
						<td>$15,987</td>
						<td class="text-right">
							<a class="icon" href="javascript:void(0)"></a>
							<a href="javascript:void(0)" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>

							<a class="icon" href="javascript:void(0)"></a>
							<a href="javascript:void(0)" class="btn btn-green btn-sm"><i class="fa fa-link"></i> Update</a>

							<a class="icon" href="javascript:void(0)"></a>
							<a href="javascript:void(0)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
						</td>
					</tr>
				</tbody>
			</table> -->
			<table class="table card-table table-bordered table-hover table-vcenter mb-0 text-nowrap">
				<tbody style="text-align: center;">
					<tr>
						<th class="w-1">Name</th>
						<th>Rol</th>
						<th>Email</th>
						<th>Status</th>
						<th>Last Login</th>
						<th>Registro</th>
						<th>Options</th>
					</tr>

					<?php
						 $lista = new usuarios();
						 $lista -> ctrListaUsuarios();
						 $lista -> ctrBorrarUsuario();
					?>

					<tr style="text-align: center;">
					<th class="w-1">Name</th>
						<th>Rol</th>
						<th>Email</th>
						<th>Status</th>
						<th>Last Login</th>
						<th>Registro</th>
						<th>Options</th>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>