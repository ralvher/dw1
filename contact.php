
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
		  <li><a href="index.php">e-Cosecha</a></li>
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
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3036.595905565093!2d-3.7139572850074143!3d40.43994597936247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd42285b16c81d07%3A0xeea3756a041afde6!2sAv.+de+Filipinas%2C+3%2C+28003+Madrid!5e0!3m2!1ses!2ses!4v1480680394212" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</div>

<div class="main col-sm-12 col-xs-12 col-lg-12">
	<div class="info col-sm-4">
		<div>
			<h4>Informacion de contacto</h4>
			<i>telefono:</i><i> 91000000 </i>
			<i>email:</i><i> ecosecha@ecosecha.com</i>
		</div>
		<div class="red-cont">
			<h4>Redes Sociales</h4>
			<div class="facebook col-sm-4 col-xs-4 col-lg-4">
				<a href="http://www.facebook.com/e-Cosecha" title="facebook" target="_blank">
					<img class="img-responsive" src="./img/facebook.png" alt="facebook" >
				</a>
			</div>
			<div class="twitter col-sm-4 col-xs-4 col-lg-4">
				<a href="http://www.twitter.com/e-Cosecha" title="twitter" target="_blank">
					<img class="img-responsive" src="./img/twitter.png" alt="twitter" >
				</a>
			</div>
			<div class="google col-sm-4 col-xs-4 col-lg-4">
				<a href="http://www.googleplus.com/e-Cosecha" title="google plus" target="_blank">
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
