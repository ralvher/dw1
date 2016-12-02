<?php session_start();
	include('./header.php');	
  	
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		
        $nombre = $_POST['usuario'];
        $pass = $_POST['pass'];
		
		try {
			$db = new PDO("sqlite:./../agro.sqlite");	
		}
		catch (PDOException $e) {
			echo $e->getMessage();
			exit();
		}

		$consulta = $db->query("SELECT * FROM admin WHERE usuario LIKE '$nombre'");
		$result = $consulta->fetch(PDO::FETCH_ASSOC);
		
        //Creamos una variable para verificar si el usuario con ese nombre y contraseña existe.
        $usuario_encontrado = false;
        
		//Si encuentra al usuario con ese nombre y contraseña sete la variable $usuario_encontrado a true y rompe el bucle para no seguir buscando.
		if($result['password'] == $pass){
			$usuario_encontrado = true;
			//break;
		}
        
        //Verifica si dentro del bucle se ha encontrado el usuario.
        if($usuario_encontrado){
            $_SESSION['logueado'] = true;
            $_SESSION['nombre'] = $nombre;
            header('Location: usuario.php');
			$log = true;
            exit;
        }else{
            $error_login = true;
        }
    }
    else{

    	$_SESSION['logueado'] = false;
    }
?>

<div class="rastro col-xs-12 col-lg-12 col-sm-12">
	<ol class="row breadcrumb">
	  <li><a href="./../index.php" title="Página de inicio">Tenerife Agro</a></li>
	  <li class="active">administrador</li>
	</ol>
</div>

<?php 
		if( $_SESSION['logueado'] == true){
			header('Location: usuario.php');
            exit;
		}
		else{
			echo '<div class=" col-sm-8  col-lg-8 col-xs-12 col-sm-offset-2 main">';
				echo '<p class="logo"><img class="img-responsive" alt="logo Tenerife Agro"src="./img/leaf.png"></p>';
				if(isset($error_login)):
					echo '<p class="aviso"> El usuario o la contraseña son incorrectos </p>';
				endif;
				echo '<form class=" form-signin" role="form" method="POST" action="index.php">';
					echo '<input type="text" class="mf form-control" name="usuario" placeholder="usuario" title="usuario" required autofocus>';
					echo '<br>';
					echo '<input type="password" class="mf form-control" name="pass" placeholder="Contraseña" title="contraseña" required>';
					echo '<br>';
					echo '<button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>';
				echo '</form>';
			echo'</div>';
		}
?>
<?php	
	include('./footer.php');
?>