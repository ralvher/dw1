<?php
	include('./header.php');
?>

<div class="header col-sm-12 col-xs-12 col-lg-12">
	<div class="row row-offcanvas row-offcanvas-right">
	    <div class="col-sm-12 col-xs-12 col-lg-12">
			
				<div class="cabecera jumbotron">
					<img class="img-responsive" src="./img/logo_1.gif" alt="Logotipo Tenerife Agro">
					<p class="logo">Las mejores ofertas en productos <br> Lider en el mercado</p>
				</div>
			
		</div>
	</div> 
</div>   

<div class="main col-xs-12 col-sm-12 col-lg-12"> 

	<div class="info-in col-xs-12 col-sm-8 col-lg-8">
		<div class="conocenos">
			<h4 class="titles">Conócenos</h4>
			<p>
				Somos uno de los mayores mercados agrícolas en Tenerife con más de 100 puestos de venta distribuidos en toda la isla. Fundado en 1.980, en el Barrio de San Juan, y desde entonces ofrecemos al curtido campesino la posibilidad de comerciar sus productos agrícolas sin la intervención de intermediarios. 
			</p>
			<p> 
				En los diferentes puestos se ponen a la venta los productos naturales de la zona: frutas, verduras, pescados, así como otros productos de elaboración artesanal: repostería, queso, miel, vino. que perpetúan la tradición artesana de Tenerife.
			</p>
		</div>
	</div>
	<div class="imag-sug col-xs-12 col-sm-4 col-lg-4">
		<h4 class="titles">Productos</h4>
 <?php

 	try {
		$db = new PDO("sqlite:./agro.sqlite");	
	}
	catch (PDOException $e) {
		echo $e->getMessage();
		exit();
	}

	$consult = $db->query("SELECT MAX(ref) AS ref FROM productos");
	$resultado = $consult->fetch(PDO::FETCH_ASSOC);
	$max = $resultado['ref'];

	$i = 0;
	
	$j = rand(1, $max);
	while($i < 4){	
		if($j==0)
			$j++;

		$producto = $j;
		$consulta = $db->query("SELECT * FROM productos WHERE ref LIKE '$producto'");
		$result = $consulta->fetch(PDO::FETCH_ASSOC);
		
		if($result['ref']==$j){
	
			echo '<div class="spot col-xs-6 col-sm-6 col-lg-6">';
			echo '<p><i class="prices">  '.$result['precio'].' €/kg</i></p>';
			echo '<img class="img-thumbnail img-responsive img-sug" src="./img/';
			echo $result['imagen'];
			echo ' " alt="'.$result['nombre'];
			echo '">';
			echo '</div>';
			
			
			$i++;
		}

		$j = ($j + 1)%($max);
	}
	

	echo '<div>';
		echo '<a class="btn btn-default btn-sm price col-sm-12 col-xs-12 col-lg-12" title="ver más" href="mercadillo.php" target="blank_" role="button"> Ver más </a>';
	echo '</div>';
?>

	</div>

	<div class="titulares-index col-xs-12  col-sm-12 col-lg-12">
		<h4 class="titles"> Noticias recientes </h4>
		<?php

		 	try {
				$db = new PDO("sqlite:./agro.sqlite");	
			}
			catch (PDOException $e) {
				echo $e->getMessage();
				exit();
			}
			$i = 0;
			
			$consult = $db->query("SELECT * FROM noticia ORDER BY fecha DESC");
					
			foreach($consult as $result) {
				$text = "";	
				if($i < 3){
					$text = substr($result["noticia"],0,175);
					echo '<div class="info-new col-xs-12 col-lg-12 col-sm-12">';
					echo '<h5 class="tit-ind"><a href="news.php" title="leer más">'.$result["titular"].'</a></h5>';
					echo '<img class="img-responsive img-thumbnail im-ind" title="Foto noticia" alt="'.$result["titular"].'" src="img/news/'.$result["imagen"].'"/>';
					echo '<div> <p>'.$text.'...</p>';
					echo '</div></div>';				
					
					$i++;
				}
				else{
					break;
				}
			}
			
			
		?>
		

	</div> 
</div> 
<?php			
	include('./footer.php');
?>
