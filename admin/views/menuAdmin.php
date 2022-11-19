	<ul class="side-menu">

		<!-- Home -->
			<li class="slide <?php if ($pagina == 'inicioAdmin') echo 'is-expanded'; ?>">
				<a class="side-menu__item <?php if ($pagina == 'inicioAdmin') echo 'active'; ?>" 
				href="index.php?page=inicioAdmin"><i class="side-menu__icon fa fa-home"></i><span class="side-menu__label">Home</span></a>
			</li>

		<!-- Compras -->
			<li class="slide <?php if ($pagina == 'entradas' || $pagina == 'entradasList' ) echo 'is-expanded'; ?>">
				<a class="side-menu__item 
					<?php if ($pagina == 'entradas' || $pagina == 'entradasList' ) 
							echo 'active'; ?>" data-toggle="slide" href="#">
							<i class="side-menu__icon fa fa-money"></i>
							<span class="side-menu__label">Compras</span>
							<i class="angle fa fa-angle-right"></i>
				</a>
				<ul class="slide-menu">
					<li><a class="slide-item 
						<?php if ($pagina == 'entradas') 
								echo 'active'; ?>" href="index.php?page=entradas">Registrar</a>
					</li>
					<li><a class="slide-item 
						<?php if ($pagina == 'entradasList') 
								echo 'active'; ?>" href="index.php?page=entradasList">Lista</a>
					</li>

				</ul>
			</li>


		<!-- Ventas -->
			<li class="slide <?php if ($pagina == 'salidas' || $pagina == 'salidasList' ) echo 'is-expanded'; ?>">
				<a class="side-menu__item 
					<?php if ($pagina == 'salidas' || $pagina == 'salidasList' ) 
							echo 'active'; ?>" data-toggle="slide" href="#">
							<i class="side-menu__icon fa fa-money"></i>
							<span class="side-menu__label">Ventas</span>
							<i class="angle fa fa-angle-right"></i>
				</a>
				<ul class="slide-menu">
					<li><a class="slide-item 
						<?php if ($pagina == 'salidas') 
								echo 'active'; ?>" href="index.php?page=salidas">Registrar</a>
					</li>
					<li><a class="slide-item 
						<?php if ($pagina == 'salidasList') 
								echo 'active'; ?>" href="index.php?page=salidasList">Lista</a>
					</li>

				</ul>
			</li><br><br><h3>Catalogos</h3>


		<!-- Usuarios -->
			<li class="slide <?php if ($pagina == 'userAdd' || $pagina == 'userList' ) echo 'is-expanded'; ?>">
				<a class="side-menu__item 
					<?php if ($pagina == 'userAdd' || $pagina == 'userList' ) 
							echo 'active'; ?>" data-toggle="slide" href="#">
							<i class="side-menu__icon icon icon-people"></i>
							<span class="side-menu__label">Usuarios</span>
							<i class="angle fa fa-angle-right"></i>
				</a>
				<ul class="slide-menu">
					<li><a class="slide-item 
						<?php if ($pagina == 'userAdd') 
								echo 'active'; ?>" href="index.php?page=userAdd">Agregar</a>
					</li>
					<li><a class="slide-item 
						<?php if ($pagina == 'userList') 
								echo 'active'; ?>" href="index.php?page=userList">Lista</a>
					</li>

				</ul>
			</li>

		<!-- Clientes -->
			<li class="slide <?php if ($pagina == 'clientAdd' || $pagina == 'clientList' ) echo 'is-expanded'; ?>">
				<a class="side-menu__item 
					<?php if ($pagina == 'clientAdd' || $pagina == 'clientList' ) 
							echo 'active'; ?>" data-toggle="slide" href="#">
							<i class="side-menu__icon icon icon-people"></i>
							<span class="side-menu__label">Clientes</span>
							<i class="angle fa fa-angle-right"></i>
				</a>
				<ul class="slide-menu">
					<li><a class="slide-item 
						<?php if ($pagina == 'socioAdd') 
								echo 'active'; ?>" href="index.php?page=clientAdd">Agregar</a>
					</li>
					<li><a class="slide-item 
						<?php if ($pagina == 'socioList') 
								echo 'active'; ?>" href="index.php?page=clientList">Lista</a>
					</li>

				</ul>
			</li>

		<!-- Proveedores -->
			<li class="slide <?php if ($pagina == 'proveedorAdd' || $pagina == 'proveedorList' ) echo 'is-expanded'; ?>">
				<a class="side-menu__item 
					<?php if ($pagina == 'proveedorAdd' || $pagina == 'proveedorList' ) 
							echo 'active'; ?>" data-toggle="slide" href="#">
							<i class="side-menu__icon icon icon-people"></i>
							<span class="side-menu__label">Proveedores</span>
							<i class="angle fa fa-angle-right"></i>
				</a>
				<ul class="slide-menu">
					<li><a class="slide-item 
						<?php if ($pagina == 'proveedorAdd') 
								echo 'active'; ?>" href="index.php?page=proveedorAdd">Agregar</a>
					</li>
					<li><a class="slide-item 
						<?php if ($pagina == 'proveedorList') 
								echo 'active'; ?>" href="index.php?page=proveedorList">Lista</a>
					</li>

				</ul>
			</li>
			
		<!-- Productos -->
			<li class="slide <?php if ($pagina == 'productAdd' || $pagina == 'productList' ) echo 'is-expanded'; ?>">
				<a class="side-menu__item 
					<?php if ($pagina == 'productAdd' || $pagina == 'productList' ) 
							echo 'active'; ?>" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-cubes"></i>
							<span class="side-menu__label">Productos</span><i class="angle fa fa-angle-right"></i></a>
				<ul class="slide-menu">
					<li><a class="slide-item <?php if ($pagina == 'productAdd') echo 'active'; ?>" 
						href="index.php?page=productAdd"><i class="side-menu__icon fa fa-plus-circle"></i>Agregar</a>
					</li>
					<li><a class="slide-item <?php if ($pagina == 'productList') echo 'active'; ?>" 
						href="index.php?page=productList"><i class="side-menu__icon fa fa-list-ul"></i>Lista</a>
					</li>

				</ul>
			</li>

		<!-- Marcas -->
			<li class="slide <?php if ($pagina == 'brandAdd' || $pagina == 'brandList' ) echo 'is-expanded'; ?>">
				<a class="side-menu__item 
					<?php if ($pagina == 'brandAdd' || $pagina == 'brandList' ) 
							echo 'active'; ?>" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-star"></i>
							<span class="side-menu__label">Marcas</span><i class="angle fa fa-angle-right"></i></a>
				<ul class="slide-menu">
					<li><a class="slide-item <?php if ($pagina == 'brandAdd') echo 'active'; ?>" 
						href="index.php?page=brandAdd"><i class="side-menu__icon fa fa-plus-circle"></i>Agregar</a>
					</li>
					<li><a class="slide-item <?php if ($pagina == 'brandList') echo 'active'; ?>" 
						href="index.php?page=brandList"><i class="side-menu__icon fa fa-list-ul"></i>Lista</a>
					</li>

				</ul>
			</li>

		<!-- Categorias -->
			<li class="slide <?php if ($pagina == 'eqTypeAdd' || $pagina == 'eqTypeList' ) echo 'is-expanded'; ?>">
				<a class="side-menu__item 
					<?php if ($pagina == 'eqTypeAdd' || $pagina == 'eqTypeList' ) 
							echo 'active'; ?>" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-train"></i>
							<span class="side-menu__label">Categorías</span><i class="angle fa fa-angle-right"></i></a>
				<ul class="slide-menu">
					<li><a class="slide-item <?php if ($pagina == 'eqTypeAdd') echo 'active'; ?>" 
						href="index.php?page=eqTypeAdd"><i class="side-menu__icon fa fa-plus-circle"></i>Agregar</a>
					</li>
					<li><a class="slide-item <?php if ($pagina == 'eqTypeList') echo 'active'; ?>" 
						href="index.php?page=eqTypeList"><i class="side-menu__icon fa fa-list-ul"></i>Lista</a>
					</li>

				</ul>
			</li><hr>

	</ul>