
<?php
	include('./header.php');
     $result = false;
     $noresult = false;
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
        $nombre = $_POST['fnombre'];
        $email = $_POST['femail'];
		$telefono = $_POST['ftelefono'];
        $texto= $_POST['ftexto'];
	
		try {
			$db = new PDO("sqlite:./agro.sqlite");
		}
		catch (PDOException $e) {
			echo $e->getMessage();
			exit();
		}
		
		try {
			$insert = "INSERT INTO contacto(nombre, email, telefono, comentario) VALUES (:nombre, :email, :telefono, :texto)";
			//$result = $db->exec("INSERT INTO contacto(nombre, email, telefono, comentario) VALUES ('$nombre', '$email', '$telefono', '$texto')");
			$stmt = $db->prepare($insert);

			$stmt->bindParam(':nombre', $nombre);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':telefono', $telefono);
			$stmt->bindParam(':texto', $texto);

			// Se realiza el INSERT
			$result=$stmt->execute();

			if(!$result){
				$noresult = true;
			}
		}
		catch (PDOException $e) {
			echo $e->getMessage();
			exit();
		}
    }
?>
<div class="header col-xs-12 col-lg-12 col-sm-12 ">
	<div class="rastro col-xs-12 col-lg-12 col-sm-12">
		<ol class="row breadcrumb">
		  <li><a href="index.php">Tenerife Agro</a></li>
		  <li class="active">Contacto</li>
		</ol>
	</div>

	<div class="aviso col-xs-12 col-lg-12 col-sm-12">
<?php
 if ($result==true){

 	echo '<div class="alert alert-warning fade in">
		<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
		<strong>Mensaje enviado correctamente!</strong>
	</div>';
 }
  if ($noresult==true){

 	echo '<div class="alert alert-warning fade in">
		<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
		<strong>Se ha producido un error, vuelva a intentarlo</strong>
	</div>';
 }
?>
	</div>

	<div class="row-offcanvas row-offcanvas-right">
	    <div class="col-sm-12 col-xs-12 col-lg-12">
			<div>
				<!--<div class="map jumbotron">-->
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14027.698326967024!2d-16.320641439122884!3d28.481817833954203!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xc41cdba537612d1%3A0xd2b94248483a7c7f!2sEscuela+T%C3%A9cnica+Superior+de+Ingenier%C3%ADa+Inform%C3%A1tica+de+la+Universidad+de+la+Laguna!5e0!3m2!1ses!2ses!4v1400519155367" scrolling="auto" name="mapa de localizacion" width="100%" height="auto" frameborder="0" style="border:1"></iframe>
				<!--</div>-->
			</div>
		</div>
	</div> 
</div>

<div class="main col-sm-12 col-xs-12 col-lg-12">
	<div class="info col-sm-4">
		<div>
			<h4>Informacion de contacto</h4>
			<i>telefono:</i><i> 922000000 </i>
			<i>email:</i><i> tfagro@tf.net</i>
		</div>
		<div class="red-cont">
			<h4>Redes Sociales</h4>
			<div class="facebook col-sm-4 col-xs-4 col-lg-4">
				<a href="http://www.facebook.com/TenerifeAgro" title="facebook" target="_blank">
					<img class="img-responsive" src="./img/facebook.png" alt="facebook" >
				</a>
			</div>
			<div class="twitter col-sm-4 col-xs-4 col-lg-4">
				<a href="http://www.twitter.com/TenerifeAgro" title="twitter" target="_blank">
					<img class="img-responsive" src="./img/twitter.png" alt="twitter" >
				</a>
			</div>
			<div class="google col-sm-4 col-xs-4 col-lg-4">
				<a href="http://www.googleplus.com/TenerifeAgro" title="google plus" target="_blank">
					<img class="img-responsive" src="./img/google.png" alt="google" >
				</a>
			</div>
		</div>
		
	</div>
	<div class="cont col-sm-8">
		<h4>Contacta con nosotros</h4>
		<form role="form" action="contact.php" method="POST">
			<div class="form-group">
				<label>Nombre <i class="obligatorio">obligatorio</i></label>
				<input type="text" class="form-control" name="fnombre" placeholder="Introduzca su nombre"  title="Nombre" required>
			</div>
			<div class="form-group">
				<label>Email <i class="obligatorio">obligatorio</i></label>
				<input type="email" class="form-control" name="femail" placeholder="Introduzca su email" title="email" required>
			</div>
			<div class="form-group">
				<label>Teléfono <i class="obligatorio">obligatorio</i> </label>
				<input type="TEL" class="form-control" name="ftelefono" placeholder="Introduzca su teléfono" title="telefono" required>
			</div>
			<div class="form-group">
				<label>Mensaje <i class="obligatorio">obligatorio</i> </label>
				<textarea class="form-control" name="ftexto" rows="3"  title="mensaje" required></textarea>
			</div>
			<button type="submit" class="btn btn-default" title="Enviar">Enviar</button>
		</form>

	</div>
</div>
	

<?php	
	include('./footer.php');
?>