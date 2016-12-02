<?php
	include('./header.php');

?>
<div class="header col-xs-12 col-lg-12 col-sm-12 ">
	<div class="rastro col-xs-12 col-lg-12 col-sm-12">
		<ol class="row breadcrumb">
			<li><a href="index.php">Tenerife Agro</a></li>
			<li class="active">Mapa Web</li>
		</ol>
	</div>
</div>

<div class="main col-xs-12 col-sm-12 col-lg-12">
	<h1 class"titulo"> Mapa Web</h1>
	
	<ul class ="map-w mw">
		<li >
			<a href="index.php" title="Ir a inicio"><i class ="map-w">Tenerife Agro</i></a>
			<ul>
				<li class ="map-w mw">
					<a href="news.php" title="Ir a noticias">Noticias</a>
				</li>
				<li class ="map-w">
					<a href="contact.php" title="Ir a contacto">Contacto</a>
				</li>
				<li class ="map-w">
					<a href="mercadillo.php" title="Ir a mercadillo">Mercadillo Virtual </a>
					<ul class ="map-w">
						<li class ="map-w mw">
							<a href="reservas.php" title="Ir a reservas">Reservas</a>
						</li>
						<li class ="map-w">
							<a href="verduras.php" title="Ir a sección verduras">Verduras</a>
						</li>
						<li class ="map-w">
							<a href="frutas.php" title="Ir a sección frutas">Frutas</a>
						</li>
						<li class ="map-w">
							<a href="semillas.php" title="Ir a sección semillas">Semillas</a>
						</li>
					</ul>
				</li>
				<li class ="map-w">
					<a href="mapa-web.php" title="Ir a mapa web">Mapa Web</a>
				</li>
				<li class ="map-w">
					<a href="buscar.php" title="Ir a búsqueda">Búsqueda</a>
				</li>
			</ul>
		</li>
		
	</ul>

</div>

<?php	
	include('./footer.php');
?>