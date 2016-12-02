<?php
	include('./header.php');
     $res = false;
     $nores = false;
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
        $nombre = $_POST['fnombre'];
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
			$insert = "INSERT INTO reservas(nombre, telefono, productos) VALUES (:nombre, :telefono, :texto)";
			//$result = $db->exec("INSERT INTO contacto(nombre, email, telefono, comentario) VALUES ('$nombre', '$email', '$telefono', '$texto')");
			$stmt = $db->prepare($insert);

			$stmt->bindParam(':nombre', $nombre);
			$stmt->bindParam(':telefono', $telefono);
			$stmt->bindParam(':texto', $texto);

			// Se realiza el INSERT
			$res=$stmt->execute();

			if(!$res){
				$nores = true;
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
			<li class="active">Reserva de productos</li>
		</ol>
	</div>
	<h1>Reserva de productos</h1>

<?php
 if ($res==true){

 	echo '<div class="alert alert-warning fade in">
		<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
		<strong>Mensaje enviado correctamente!</strong>
	</div>';
 }
  if ($nores==true){

 	echo '<div class="alert alert-warning fade in">
		<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
		<strong>Se ha producido un error, vuelva a intentarlo</strong>
	</div>';
 }
?>
</div>

<div class="main col-xs-12 col-sm-12 col-lg-12">
	
		<form role="form" action="reservas.php" method="POST">
			<div class="form-group">
				<label>Nombre y Apellidos<i class="obligatorio"> obligatorio</i></label>
				<input type="text" class="form-control" name="fnombre" placeholder="Introduzca su nombre"  title="Nombre" required>
			</div>
			<div class="form-group">
				<label>Teléfono <i class="obligatorio">obligatorio</i> </label>
				<input type="TEL" class="form-control" name="ftelefono" placeholder="Introduzca su teléfono" title="telefono" required>
			</div>
			<div class="form-group">
				<label>Productos<i class="obligatorio"> obligatorio</i> </label>
				<textarea class="form-control" name="ftexto" rows="3"  title="mensaje" required></textarea>
			</div>
			<button type="submit" class="btn btn-default" title="Enviar">Enviar</button>
		</form>	
</div>
<?php	
	include('./footer.php');
?>