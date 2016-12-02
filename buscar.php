<?php
	$res = false;
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$busqueda = $_POST['buscar'];
		
		
		try {
			$db = new PDO("sqlite:./agro.sqlite");	
		}
		catch (PDOException $e) {
			echo $e->getMessage();
			exit();
		}
		$enc = false;

		$consulta = $db->query("SELECT * FROM productos WHERE nombre LIKE '%$busqueda%'");
		$rest = $consulta->fetch(PDO::FETCH_ASSOC);

		if($rest["tipo"] == 'Fruta' || $rest["tipo"] == 'Verdura' || $rest["tipo"] == 'Semillas'){
			$enc = true;
			$consulta = $db->query("SELECT * FROM productos WHERE nombre LIKE '%$busqueda%'");
		}
	}
?>

<?php
	include('./header.php');

?>
<div class="header col-xs-12 col-lg-12 col-sm-12 ">
	<div class="rastro col-xs-12 col-lg-12 col-sm-12">
		<ol class="row breadcrumb">
			<li><a href="index.php">e-Cosecha</a></li>
			<li class="active">Búsqueda</li>
		</ol>
	</div>
</div>
<div class="main col-xs-12 col-sm-12 col-lg-12">

	<form role="form" method="post">
		<input class="form-control" name="buscar" type="text" title="buscar producto" placeholder="buscar...">
	</form>

	<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST'){

			if($enc == false){
				echo '<p class="no">No se encontraron resultados</p>';
			}
			elseif($enc == true){

				foreach($consulta as $result){
				if($result['stock'] != '0'){
					echo '<div class = "bus col-xs-12 col-sm-12 col-lg-12 ">';
						if($result["tipo"] == 'Fruta' ){
							echo '<h4 class="busq"> Sección de frutas</h4>';
							echo '<p>'.$result["nombre"].'</p>';
							echo '<p>Distribuido por '.$result["distribuidor"].'</p>';
							echo '<a  class="vermas" href="frutas.php" alt="ir a frutas" title="saber más"> ver más</a>';
						}
						elseif($result["tipo"] == 'Verdura'){

							echo '<h4 class="busq"> Sección de verduras</h4>';
							echo '<p>'.$result["nombre"].'</p>';
							echo '<p>Distribuido por '.$result["distribuidor"].'</p>';
							echo '<a class="vermas" href="verduras.php" alt="ir a frutas" title="saber más">ver más</a>';
						}
						elseif($result["tipo"] == 'Semillas'){
							echo '<h4 class="busq"> Sección de semillas</h4>';
							echo '<p>'.$result["nombre"].'</p>';
							echo '<p>Distribuido por '.$result["distribuidor"].'</p>';
							echo '<a class="vermas" href="semillas.php" alt="ir a frutas" title="saber más"> ver más </a>';

						}
						echo '';
					echo '</div>';
				}
			}

			}
		}

	?>


</div>
<?php	
	include('./footer.php');
?>