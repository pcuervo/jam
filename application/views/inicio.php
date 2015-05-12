<div class="main">

	<div class="width">
		<?php
			// Mostrar error en caso de búsqueda
			// de trámite o servicio inválida
			if($error == '1')
				echo '<p>No se encontró el trámite o servicio que estabas buscando</p>';
		?>
		<div class="main-busqueda full columna large-4">
			<h2 class="text-center">Buscar trámite o servicio</h2>

			<form class="main-search hero clearfix" action="#">
				<input type="text" class="span xmall-10">
				<button type="submit" class="span xmall-2"><i class="fa fa-search"></i></button>
			</form>

			<h3 class="text-center">O también puedes buscar por:</h3>

			<a href="#" class="block text-center boton solid full margin-bottom">Dependencia</a>
			<a href="#" class="block text-center boton solid full margin-bottom">Delegación</a>
			<a href="#" class="block text-center boton solid full margin-bottom">Categorías de trámites</a>
			<a href="#" class="block text-center boton solid full margin-bottom">Categorías de servicios</a>
		</div> <!-- /.main-busqueda -->

		<div class="main-resultados columna large-8">
			<div class="columna medium-6 text-center">
				<h3>Trámites</h3>
				<?php 
				foreach ($tramites_mas_buscados as $key => $value) {
					$tramite = $value->nombre_ts;
					$idTS = $value->id_tramite_servicio;
					$urlTramite = base_url().'index.php/inicio/muestraTramiteServicio/'.$idTS;
					echo '<p><a href="'.$urlTramite.'" target="_blank">'.$tramite.'</a></p>';
				} // end foreach
				?>
			</div>
			<div class="columna medium-6 text-center">
				<h3>Servicios</h3>
				<?php 
				foreach ($servicios_mas_buscados as $key => $value) {
					$tramite = $value->nombre_ts;
					$idTS = $value->id_tramite_servicio;
					$urlTramite = base_url().'index.php/inicio/muestraTramiteServicio/'.$idTS;
					echo '<p><a href="'.$urlTramite.'">'.$tramite.'</a></p>';
				} // end foreach
				?>
			</div>
		</div>

	</div><!-- width -->

</div><!-- main -->