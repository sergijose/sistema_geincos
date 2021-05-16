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

				<a href="productos">

					<i class="fa fa-product-hunt"></i>
					<span>Productos</span>

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

					</li>';

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

			</li>';
			}
			?>

		</ul>

	</section>

</aside>