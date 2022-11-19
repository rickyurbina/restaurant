
	<ul class="side-menu">

		<!-- Home -->
			<li class="slide <?php if ($pagina == 'inicio') echo 'is-expanded'; ?>">
				<a class="side-menu__item <?php if ($pagina == 'inicio') echo 'active'; ?>" 
				href="index.php?page=inicio"><i class="side-menu__icon fa fa-home"></i><span class="side-menu__label">Home</span></a>
			</li>

		<!-- Compras 
			<li class="slide <?php if ($pagina == 'entradas' || $pagina == 'entradasList' ) echo 'is-expanded'; ?>">
				<a class="side-menu__item 
					<?php //if ($pagina == 'entradas' || $pagina == 'entradasList' ) 
							//echo 'active'; ?>" data-toggle="slide" href="#">
							<i class="side-menu__icon fa fa-money"></i>
							<span class="side-menu__label">Compras</span>
							<i class="angle fa fa-angle-right"></i>
				</a>
				<ul class="slide-menu">
					<li><a class="slide-item 
						<?php //if ($pagina == 'entradas') 
								//echo 'active'; ?>" href="index.php?page=entradas">Registrar</a>
					</li>
					<li><a class="slide-item 
						<?php //if ($pagina == 'entradasList') 
								//echo 'active'; ?>" href="index.php?page=entradasList">Lista</a>
					</li>

				</ul>
			</li>-->


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
			</li>

	</ul>

