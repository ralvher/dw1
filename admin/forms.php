<?php

	$active1 = '';
	$active2 = '';
	$active3 = '';
	$active4 = '';
	$active5 = '';
/*-------------------------------------------------------------------------------------------------------------------------------------------*/
	if (isset($_POST['product-add'])) {
		//echo 'INSERTAR PRODUCTO';
		$active2 = 'active';

		$nombre = $_SESSION['nombre'];
		$nom = $_POST['pnombre'];
        $tipo = $_POST['ptipo'];
		$precio = $_POST['pprecio'];
        $imagen = $_FILES['pimagen']['name'];
        $stock = $_POST['pcantidad'];

        try {
			$db = new PDO("sqlite:./../agro.sqlite");
			$add = $db->exec("INSERT INTO productos(nombre, tipo, distribuidor, precio, stock, imagen) VALUES ('$nom', '$tipo', '$nombre', '$precio', '$stock','$imagen')");
		}
		catch (PDOException $e) {
			echo $e->getMessage();
			exit();
		}

		$target_path = "../img/";
		$target_path = $target_path . basename( $_FILES['pimagen']['name']);
		if ($add && (move_uploaded_file($_FILES['pimagen']['tmp_name'], $target_path))) {
			$add = true;
			//echo "La imagen ". basename( $_FILES['pimagen']['name']). " se ha guardado correctamente.";
		}
		else{
			$add = false;
		}

		if(!$add){
			$nochange=true;
		}
	}
/*-------------------------------------------------------------------------------------------------------------------------------------------*/
	elseif (isset($_POST['product-edit'])) {
		//echo 'MODIFICAR PRODUCTO';
		$active2 = 'active';
		$cnom = $_POST['cname'];
		$cprecio = $_POST['cprecio'];
		$cstock = $_POST['cstock'];
		$change = false;

		if($_POST['cstock']){
			try {
				$db = new PDO("sqlite:./../agro.sqlite");
				$change = $db->exec("UPDATE productos SET stock=$cstock WHERE nombre='$cnom'");

			}
			catch (PDOException $e) {
				echo $e->getMessage();
				exit();
			}

		}
		if ($_POST['cprecio']) {
			try {
				$db = new PDO("sqlite:./../agro.sqlite");
				$change = $db->exec("UPDATE productos SET precio=$cprecio WHERE nombre='$cnom'");

				if(!$change){
					$nochange=true;
				}
			}
			catch (PDOException $e) {
				echo $e->getMessage();
				exit();
			}
		}


	}

/*-------------------------------------------------------------------------------------------------------------------------------------------*/

	elseif (isset($_POST['product-delete'])) {
		//echo 'ELIMINAR PRODUCTO';
		$active2 = 'active';
		$del = $_POST['fdelete'];

		try {
				$db = new PDO("sqlite:./../agro.sqlite");
				$delete = $db->exec("DELETE FROM productos WHERE ref=$del ");

				if(!$delete){
					$nochange=true;
				}
			}
		catch (PDOException $e) {
			echo $e->getMessage();
			exit();
		}
	}
	/*-------------------------------------------------------------------------------------------------------------------------------------------*/

	elseif (isset($_POST['user-add'])) {
		//echo 'INSERTAR USUARIO';
		$active5 = 'active';

		$user = $_POST['auser'];
		$pw = $_POST['apass'];
		if($user != "admin" ){
			try {
				$db = new PDO("sqlite:./../agro.sqlite");
				$adduser = $db->exec("INSERT INTO admin(usuario, password) VALUES ('$user', '$pw')");
				if(!$adduser){
					$nochange=true;
				}
			}
			catch (PDOException $e) {
				echo $e->getMessage();
				exit();
			}
		}
	}

/*-------------------------------------------------------------------------------------------------------------------------------------------*/

	elseif (isset($_POST['user-delete'])) {
		//echo 'BORRAR USUARIO';
		$active5 = 'active';

		$deuser = $_POST['deluser'];

		if($deuser != 1){
			try {
					$db = new PDO("sqlite:./../agro.sqlite");
					$duser = $db->exec("DELETE FROM admin WHERE id=$deuser ");
					if(!$duser){
						$nochange=true;
					}
				}
			catch (PDOException $e) {
				echo $e->getMessage();
				exit();
			}
		}
	}

/*-------------------------------------------------------------------------------------------------------------------------------------------*/

	else {
		$active1 = 'active';
	}
?>
