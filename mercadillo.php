
<?php
	include('./header.php');
?>
<div class="header col-sm-12 col-xs-12 col-lg-12">
	<div class="rastro col-xs-12 col-lg-12 col-sm-12">
		<ol class="row breadcrumb">
		  <li><a href="index.php"  title="Página de inicio">e-Cosecha</a></li>
		  <li class="active">Mercadillo Virtual</li>
		</ol> 
	</div>
</div>

<div class="main col-sm-12 col-xs-12 col-lg-12">
	<div class="merca-menu col-xs-12 col-lg-12 col-sm-12">
		<ul class="pagination pag col-sm-12"> 
			<li class="active"><a href="mercadillo.php"  title="Home Mercadillo Virtual"> Home <span class="sr-only">(current)</span></a></li>
			<li><a href="verduras.php"  title="Verduras" >Verduras <span class="sr-only">(current)</span></a></li>
			<li><a href="frutas.php"  title="Frutas" >Frutas <span class="sr-only">(current)</span></a></li>
			<li><a href="semillas.php"  title="Semillas">Semillas<span class="sr-only">(current)</span></a></li>  
		</ul>
	</div>

	<div class="main col-sm-12 col-xs-12 col-lg-12">
		<img class="img-responsive merca" src="img/agri.jpg" alt="Productos agricolas">
		<p class ="mercatext"> 
			En nuestro mercadillo virtual, podrás encontrar diversas variedades de frutas, verduras, y semillas de los diferentes agricultores de la isla.
		</p>
		<p> 
			Para poder hacerte con ellos sólo tienes que ojear en la o las secciones que prefieras los productos que te interesan, y mientras ve anotando las referencias de cada uno. 
		</p>
		<p> 
			Una vez que te hayas decidido sólo tienes que rellenar un pequeño formulario, que encontrarás al<a href="reservas.php" target="_blank" title="Ir a formulario de reservas"> hacer click aquí</a>. Y así lo que quieras estará reservado para ti. Y cuando esté listo, nos pondremos en contecto con usted, y podrá venir a recogerlo.
		</p>
	</div>
</div>

<?php	
	include('./footer.php');
?>