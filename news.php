
<?php
	include('./header.php');
?>
<div class="header col-xs-12 col-lg-12 col-sm-12 ">
	<div class="rastro col-xs-12 col-lg-12 col-sm-12">
		<ol class="row breadcrumb">
		  <li><a href="index.php" title="Página de inicio">Tenerife Agro</a></li>
		  <li class="active">Noticias</li>
		</ol>
	</div>
</div>

<div class=" main col-xs-12 col-sm-12 col-lg-12">
<?php
	
	try {
		$db = new PDO("sqlite:./agro.sqlite");	
	}
	catch (PDOException $e) {
		echo $e->getMessage();
		exit();
	}

	$consulta = $db->query("SELECT * FROM noticia ORDER BY fecha DESC, hora DESC");
	//$result = $consulta->fetch(PDO::FETCH_ASSOC);
	
	//var_dump( );
	
	foreach($consulta as $result){
		echo '<div class="noticia">';
			echo '<h3>'.$result["titular"].'</h3>';
			echo '<img class="img-responsive img-news" title="'.$result["titular"].'" alt ="'.$result["titular"].'" src="img/news/'.$result["imagen"].'"/>';
			echo '<div> <p>'.$result["noticia"].'</p>';
			echo '<p class =" fnew"> <b>Tenerife</b> | '.$result["fecha"].' '.$result["hora"].'</p></div>';
		echo '</div>';
	}	
	
	
?>
</div>
<?php	
	include('./footer.php');
?>