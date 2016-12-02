
<?php
    session_start();
    if(isset($_SESSION['logueado']) and $_SESSION['logueado']){
        $nombre = $_SESSION['nombre'];
		$log = true;
		
    }else{
        //Si el usuario no está logueado redireccionamos al login.
        header('Location: index.php');
        exit;
    }

	$active1 = 'active';
	$active2 = '';
	$active3 = '';
	$active4 = '';
	$active5 = '';
	$add = false;
	$change = false;
	$delete = false;
	$new = false;
	$adduser = false;
	$deuser = false;
	$nochange = false;
	$ver = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    	include('./forms.php');
    }
?>


<?php
	include('./header_log.php');
?>
	
	<div class=" col-sm-12  col-lg-12 col-xs-12 header">
		<h2> Panel de Administración</h2>    
	</div>
	
	
	<div class="main col-sm-12 col-lg-12 col-xs-12 ">
		<ul class="nav nav-tabs">
			<li class="<?php echo $active1; ?>" ><a href="#casa" title="inicio" data-toggle="tab">Inicio</a></li>
			<li class=" <?php echo $active2; ?> "><a href="#productos" title="productos" data-toggle="tab">Productos</a></li>
			<?php
				if($nombre == 'admin'){
					echo '<li class="'.$active4.'"><a href="#reservas" title="pedidos" data-toggle="tab">Reservas</a></li>';
					echo '<li class="'.$active5.'"><a href="#settings" data-toggle="tab">Settings</a></li>';
					}
			?>
		</ul>
	
		<div class="tab-content">

<!-- ===================================================================================================================== -->

			<div class="tab-pane <?php echo $active1; ?>" id="casa">
				<div class="welcome col-sm-12  col-lg-12 col-xs-12">
					<h4 class="welcome">Bienvenido/a <?php echo $nombre; ?> </h4>    
				
					<?php
						try{

							$db = new PDO("sqlite:./../agro.sqlite");							
							$consult = $db->query("SELECT * FROM admin WHERE usuario LIKE '$nombre'");
							$resultar = $consult->fetch(PDO::FETCH_ASSOC);

							echo '<img class="img-responsive img-thumbnail avatar" alt="foto de perfil" src="img/'.$resultar['avatar'].'">';
							
						}
						catch (PDOException $e) {
							echo $e->getMessage();
							exit();
						}
					if($nombre == 'admin'){
						try{
							$db = new PDO("sqlite:./../agro.sqlite");	
							$consulta = $db->query("SELECT * FROM contacto WHERE notificado LIKE 'FALSE'");
							$i = 0;
							foreach($consulta as $respuesta){
								$i++;

							}
							echo '<p> Tiene '.$i.' nuevo(s) mensaje(s)';
							
							echo '<p><a id="ver" title="ver mensajes">ver mensajes</a></p>';
							
							echo '<div class="mensajes col-sm-8 col-lg-8 col-xs-8" id="mostrar">';
							echo '</div>';
						}
						catch (PDOException $e) {
							echo $e->getMessage();
							exit();
						}
					}

					else{

						echo '<i> ¿Qué hay de nuevo?</i>';
					}
					?>
				</div>
			</div>

<!-- ===================================================================================================================== -->
			
			<div class="tab-pane <?php echo $active2; ?>" id="productos">
				<?php 
					if($add == true){
						echo '<div class="alert alert-warning fade in">
						<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
						<strong>Producto añadido correctamente</strong>
						</div>';
					}

					if($change==true){
						echo '<div class="alert alert-warning fade in">
						<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
						<strong>Producto modificado correctamente</strong>
						</div>';
					}

					if($delete==true){
						echo '<div class="alert alert-warning fade in">
						<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
						<strong>Producto eliminado correctamente</strong>
						</div>';
					}
					if($nochange == true){
						echo '<div class="alert alert-warning fade in">
						<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
						<strong>Se ha producido un error, vuelva intentarlo</strong>
						</div>';
					}
				?>
				<div class="add col-sm-12  col-lg-12  col-xs-12 ">
					<h4> Añadir Producto </h4>
					<form enctype="multipart/form-data" action="" name="fadd" method="POST" role="form">
						<div class="form-group">
							<label for="pnombre">Nombre</label>
							<input type="text" class="form-control" name="pnombre" placeholder="producto">
						</div>
						<div class="form-group">
							<label for="ptipo">Tipo </label>
							<select class="form-control" name="ptipo">
								<option></option>
								<option>Fruta</option>
								<option>Verdura</option>
								<option>Semillas</option>
							</select>
						</div>
						<div class="form-group">
							<label for="pprecio">Precio</label>
							<input type="text" class="form-control" name="pprecio" placeholder="precio">
						</div>
						<div class="form-group">
							<label for="pcantidad">Cantidad</label>
							<input type="numeric" class="form-control" name="pcantidad" placeholder="cantidad">
						</div>
						<div class="form-group">
							<label for="exampleInputFile">Imagen</label>
							<input type="file" name="pimagen">
							<p class="help-block"> Subir una imagen</p>
						</div>
					
						<input type="submit" id="ffadd" class="btn btn-success" name="product-add" value="Guardar" />
					</form>
					
				</div>
				
					
				<div class="cambiar col-sm-12  col-lg-12  col-xs-12 ">	
					<h4> Modificar Producto </h4>
						<form role="form" name="fchange" method="POST" id="change">
							<div class="form-group"  name="cccname">
								<label for="cname">Seleccione producto a modificar</label>
								<select class="form-control" name="cname">
					<?php 
								
						$nombre = $_SESSION['nombre'];
						try {
							$db = new PDO("sqlite:./../agro.sqlite");	
						}
						catch (PDOException $e) {
							echo $e->getMessage();
							exit();
						}
						if($nombre != 'admin'){
							$consulta = $db->query("SELECT * FROM productos WHERE distribuidor LIKE '$nombre'");
						}
						else{
							$consulta = $db->query("SELECT * FROM productos");
						}
						
						
						foreach($consulta as $result){
							
								echo '<option>'.$result["nombre"].'</option>';
								
							
						}						
					?> 
									</select>
								</div>
								<div class="form-group">
									<label for="cprecio">Precio</label>
									<input type="text" class="form-control" name="cprecio" placeholder="precio">
								</div>
								<div class="form-group">
									<label for="cstock">Stock</label>
									<input type="text" class="form-control" name="cstock" placeholder="stock">
								</div>
								<button type="submit" id="ffchange" class="btn btn-success" name="product-edit">Guardar</button>
							</form>
							
							
				</div>
			
				<div class="feliminar col-sm-12  col-lg-12  col-xs-12">
					<h4> Eliminar Producto </h4>
					<?php 
						$nombre = $_SESSION['nombre'];
						try {
							$db = new PDO("sqlite:./../agro.sqlite");	
						}
						catch (PDOException $e) {
							echo $e->getMessage();
							exit();
						}
						if($nombre != 'admin'){
							$consulta = $db->query("SELECT * FROM productos WHERE distribuidor LIKE '$nombre'");
						}
						else{
							$consulta = $db->query("SELECT * FROM productos");
						}
						echo '<div class="form-group"> <label for="cprecio">Seleccione producto a modificar</label>';
						echo '<form role="form" method="POST">';
						echo '<select multiple class="form-control" name="fdelete">';
						foreach($consulta as $result){
							
								echo '<option id="cproducto" value='.$result["ref"].'>'.$result["nombre"].'</option>';
								
							
						}
						echo '</select></div>';
					?> 
						<button type="submit" class="btn btn-success" name="product-delete">Eliminar</button>
					</form>			
				</div>
			</div>
			

<!-- ===================================================================================================================== -->

			<div class="tab-pane <?php echo $active3; ?>" id="news">
				<?php
					if($new == true){
						echo '<div class="alert alert-warning fade in">
						<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
						<strong>Noticia añadida correctamente</strong>
						</div>';
					}
					if($nochange == true){
						echo '<div class="alert alert-warning fade in">
						<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
						<strong>Se ha producido un error, vuelva intentarlo</strong>
						</div>';
					}
				?>
				<form enctype="multipart/form-data" name="news-add" method="POST" role="form">
					<div class="form-group">
						<label for="addnew">Titular</label>
						<input type="text" class="form-control" name="addnew" placeholder="titulo de la noticia">
					</div>
					<div class="form-group">
						<label for="newtxt">Texto</label>
						<textarea class="form-control" rows="3" name="text-new"></textarea>
					</div>
					<div class="form-group">
							<label for="exampleInputFile">Imagen</label>
							<input type="file" name="pimagen">
							<p class="help-block"> Subir una imagen</p>
					</div>
					<button type="submit" id="ffnew" class="btn btn-success" name="news-add">Guardar</button>
				</form>
			</div>

<!-- ===================================================================================================================== -->

			<div class="tab-pane <?php echo $active4; ?>" id="reservas">
				
				<div class="greservas col-sm-12 col-lg-12 col-xs-12">
					<?php 
						
						try {
							$db = new PDO("sqlite:./../agro.sqlite");	
						}
						catch (PDOException $e) {
							echo $e->getMessage();
							exit();
						}
						
						$consulta = $db->query("SELECT * FROM reservas");
						
						foreach($consulta as $result){
							echo '<div class="res col-xs-12 col-sm-12 col-lg-12">';
							echo '<h4> Reserva #'.$result["id"].'</h4>';
							echo '<p><b class="tit"> Nombre: </b><i>'.$result["nombre"].'</i></p>';
							echo '<p><b class="tit"> Telefono: </b><i>'.$result["telefono"].'</i></p>';	
							echo '<p><b class="tit"> Productos reservados: </b>';
							echo '<i>'.$result["productos"].'</i></p>';
							echo '</div>';
						}
						
					?> 
				</div>		
			</div>
			
<!-- ===================================================================================================================== -->

			<div class="tab-pane <?php echo $active5; ?>" id="settings">
				<?php
					if($adduser == true){
						echo '<div class="alert alert-warning fade in">
						<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
						<strong>Usuario añadido correctamente</strong>
						</div>';
					}
					if($deuser == true){
						echo '<div class="alert alert-warning fade in">
						<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
						<strong>Usuario eliminado correctamente</strong>
						</div>';
					}
					if($nochange == true){
						echo '<div class="alert alert-warning fade in">
						<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
						<strong>Se ha producido un error, vuelva intentarlo</strong>
						</div>';
					}
				?>
				<div class="adduser col-sm-12 col-lg-12 col-xs-12">
					<h4> Crear usuario</h4>
					<form class="form-inline" role="form" method="POST">
						<div class="form-group">
							<label class="sr-only" for="usuario">Usuario</label>
							<input type="text" name="auser"class="form-control" id="usuario" placeholder="Usuario">
						</div>
						<div class="form-group">
							<label class="sr-only" for="pass">Contraseña</label>
							<input type="password" name="apass" class="form-control" id="pass" placeholder="Contraseña">
						</div>
						<button type="submit" class="btn btn-success" name="user-add">Añadir</button>
					</form>
				</div>
				
				<div class="elimuser col-sm-12 col-lg-12 col-xs-12">
					<h4> Eliminar usuario</h4>
					
					<?php 
						
						try {
							$db = new PDO("sqlite:./../agro.sqlite");	
						}
						catch (PDOException $e) {
							echo $e->getMessage();
							exit();
						}
						
						$consulta = $db->query("SELECT * FROM admin");
						
						
						echo '<div class="form-group"> <label >Seleccione usuario a eliminar</label>';
						echo '<form role="form" method="POST">';
						echo '<select multiple class="form-control" name="deluser"';
						foreach($consulta as $result){
							if($result["nombre"] != 'admin')
								echo '<option value='.$result["id"].'>'.$result["usuario"].'</option>';
								
							
						}
						echo '</select></div>';
					?> 
						<button type="submit" class="btn btn-success" name="user-delete">Eliminar</button>
					</form>			
				
			</div>
		</div>
		
	</div>
</div>

<!-- ===================================================================================================================== -->

<?php 
	include('./footer.php'); 
?>