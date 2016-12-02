
<?php 
	
	try {
		$db = new PDO("sqlite:./../agro.sqlite");	
	}
		catch (PDOException $e) {
		echo $e->getMessage();
		exit();
	}

		$consulta = $db->query("SELECT * FROM contacto");

		foreach($consulta as $result){
			if($result["notificado"] == 'FALSE'){
				$cam = $result["id"];
				$change = $db->exec("UPDATE contacto SET notificado='TRUE' WHERE id='$cam'");
				echo '<div class="res col-xs-12 col-sm-12 col-lg-12">';
				echo '<p><b class="tit"> Nombre: </b><i>'.$result["nombre"].'</i></p>';
				echo '<p><b class="tit"> Email: </b><i>'.$result["email"].'</i></p>';
				echo '<p><b class="tit"> Telefono: </b><i>'.$result["telefono"].'</i></p>';	
				echo '<p><b class="tit"> Comentario </b></p>';
				echo '<p><i>'.$result["comentario"].'</i></p>';
				echo '</div>';
			}
		}
		
	
?> 
	