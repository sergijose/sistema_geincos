<aside class="main-sidebar">

	<section class="sidebar">

		<ul class="sidebar-menu">

			<?php
			if ($_SESSION["perfil"] =="Administrador") {



				echo '<li class="active">

				<a href="inicio">

					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>

			</li>

			<li>

				<a href="usuarios">

					<i class="fa fa-user"></i>
					<span>Usuarios</span>

				</a>

			</li>
			
			<li>

				<a href="empleados">

					<i class="fa fa-users"></i>
					<span>Empleados</span>

				</a>

			</li>'
			
			
			
			;
			}

			if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial") {

				echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-list-ul"></i>

					<span>Categorias</span>

					<span class="pull-right-container">

						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">

					<li>

						<a href="categorias">

							<i class="fa fa-circle-o"></i>
							<span>Administrar Categorias</span>

						</a>

					</li>

					<li>

						<a href="marcas">

							<i class="fa fa-circle-o"></i>
							<span>Administrar Marcas</span>

						</a>

					</li>

					<li>

						<a href="modelo">

							<i class="fa fa-circle-o"></i>
							<span>Administrar Modelo</span>

						</a>

					</li>

				</ul>

			</li>
			<li>
						
			<a href="proveedores">
				<i class="fa fa-th"></i>
				<span>Proveedores</span>
			</a>
			</li>
			

			<li>

				<a href="productos">

					<i class="fa fa-product-hunt"></i>
					<span>Productos</span>

				</a>

			</li>
			<li>

				<a href="productos-lotes">

					<i class="fa fa-product-hunt"></i>
					<span>Productos Generales</span>

				</a>

			</li>
			
			<li>

				<a href="ubicacion-productos">

					<i class="fa fa-map-marker"></i>
					<span>Ubicacion de Productos</span>

				</a>

			</li>';
			}

			if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Visitante"  || $_SESSION["perfil"] == "Especial") {
				echo '<li class="treeview">

				<a href="#">

					<i class="fa fa-leanpub"></i>

					<span>Prestamos</span>

					<span class="pull-right-container">

						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">


					
					<li>

						<a href="prestamos">

							<i class="fa fa-circle-o"></i>
							<span>Administrar prestamo</span>

						</a>

					</li>
					';

					if ($_SESSION["perfil"] == "Administrador"  || $_SESSION["perfil"] == "Especial") {	
					echo '<li>

						<a href="crear-prestamo">

							<i class="fa fa-circle-o"></i>
							<span>Crear prestamo</span>

						</a>

					</li>

				
					<li>

						<a href="reportes">

							<i class="fa fa-circle-o"></i>
							<span>Reporte de prestamo</span>

						</a>

					</li>';
				}

				echo '</ul>

			</li>
			
			<li class="treeview">
						<a href="#">
							<i class="fa fa-usd"></i>							
							<span>Pedidos</span>							
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">						
                            <li>
								<a href="crear-pedido">									
									<i class="fa fa-plus"></i>
									<span>Crear Pedido</span>
								</a>
							</li>
							<li>
								<a href="pedidos">									
									<i class="fa fa-file-o"></i>
									<span>Listar pedidos</span>
								</a>
							</li>
						</ul>
					</li>';
					if($_SESSION["perfil"] == "Administrador"|| $_SESSION["perfil"] == "Especial"){
						echo '<li class="treeview">
								<a href="#">
									<i class="fa fa-shopping-cart"></i>
									<span>Compras</span>
									<span class="pull-right-container">
										<i class="fa fa-angle-left pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">							
									<li>
										<a href="crear-compra">										
											<i class="fa fa-plus"></i>
											<span>Nueva Compra</span>
									   </a>
									</li>
									<li>
										<a href="compras">									
											<i class="fa fa-file-o"></i>
											<span>Listado de Compras</span>
										</a>
									</li>
	
								</ul>
							</li>';
					}
					
					
			
			
			
			
			
			
			
			
			
			
			}
			?>

		</ul>

	</section>

</aside>