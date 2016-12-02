<?php
	include('./header.php');
?>
<div class="header col-sm-12 col-xs-12 col-lg-12">
	<div class="rastro col-xs-12 col-lg-12 col-sm-12">
		<ol class="row breadcrumb">
		  <li><a href="index.php" title="Página de inicio" >e-Cosecha</a></li>
		  <li><a href="mercadillo.php" title=" Ir a Mercadillo Virtual" >Mercadillo Virtual</a></li>
		  <li class="active">Verduras</li>
		</ol> 
	</div>
</div>
<div class="header col-sm-12 col-xs-12 col-lg-12">
	<div class="merca-menu col-xs-12 col-lg-12 col-sm-12">
		<div class="col-sm-7 col-lg-7 col-xs-12">
			<ul class="pagination pag"> 
				<li><a href="mercadillo.php"  title="Home Mercadillo Virtual"> Home <span class="sr-only">(current)</span></a></li>
				<li class="active"><a href="verduras.php"  title=" Estás en Verduras" >Verduras <span class="sr-only">(current)</span></a></li>
				<li><a href="frutas.php"  title="Ir a Frutas" >Frutas <span class="sr-only">(current)</span></a></li>
				<li><a href="semillas.php"  title="Ir a Semillas">Semillas<span class="sr-only">(current)</span></a></li>  
			</ul>
		</div>

		<div class="orden col-sm-4 col-lg-4 col-xs-12">
			<form role="form" method="POST" name="clasV" action="verduras.php" >
	  			<div class="form-group">
					<select class="form-control" name="ordenarV" onChange="clasV.submit();">
						<option>Ordenar por ... </option>
						<option value="1" title="Nombre A-Z">Nombre A-Z</option>
						<option value="2" title="Nombre Z-A">Nombre Z-A</option>
						<option value="3" title="Más barato a caro">Precio: de más barato a más caro</option>
						<option value="4" title="NMás caro a barato">Precio: de más caro a más barato</option>
					</select>		
				</div>
			</form>
		</div>
	</div>

<?php
	
	try {
		$db = new PDO("sqlite:./agro.sqlite");	
	}
	catch (PDOException $e) {
		echo $e->getMessage();
		exit();
	}

	if(isset($_POST['ordenarV'])){
		if($_POST['ordenarV'] == '1'){		
			$consulta = $db->query("SELECT * FROM productos WHERE tipo LIKE '%Ver%' ORDER BY nombre ASC");
		}
		elseif($_POST['ordenarV'] == '2'){		
			$consulta = $db->query("SELECT * FROM productos WHERE tipo LIKE '%VEr%' ORDER BY nombre DESC");
		}
		elseif($_POST['ordenarV'] == '3'){		
			$consulta = $db->query("SELECT * FROM productos WHERE tipo LIKE '%ver%' ORDER BY precio ASC");
		}
		elseif($_POST['ordenarV'] == '4'){		
			$consulta = $db->query("SELECT * FROM productos WHERE tipo LIKE '%ver%' ORDER BY precio DESC");
		}
	}
	else{
		$consulta = $db->query("SELECT * FROM productos WHERE tipo LIKE '%ver%'");
	}
	
	echo "<div class=' main col-sm-12 col-xs-12 col-lg-12'>";	
	foreach($consulta as $result){
		if($result['stock'] != '0'){
			echo '<div class="mostrar col-xs-12 col-sm-12 col-lg-12">';
			echo '<div class="col-lg-3 col-sm-3 col-xs-12"><img src="./img/'.$result["imagen"].'" class="img-thumbnail img-responsive" alt="Imagen de '.$result["nombre"].'" ></div>';
			echo '<div class=" info col-lg-9 col-sm-9 col-xs-12"> <h4 id="tnom">'.$result["nombre"].'</h4>';
			echo "<p><b>Ref.:</b> 00".$result["ref"]." </p>";
			echo "<p><b>Distribuidor:</b> ".$result["distribuidor"]."</p>";	
			echo "<p><b>Precio:</b> ".$result["precio"]." €/kg</p></div>";
			echo '</div>';
		}
	}	
	echo "</div>";
	
	
?>
</div>
<?php	
	include('./footer.php');
?>