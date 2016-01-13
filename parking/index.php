<?php 	
	require_once('../config/config.php');	
	require_once('../config/app.php');
	require_once('../config/conex.php');
	require_once('../config/class/sesiones.php');
	require_once('../config/class/Localidades.php');
	require_once('../config/class/niveles.php');
	require_once('../config/class/espacios.php');
	require_once('../config/class/historiales.php');
			
	Sesiones::init();
	if ( empty($_SESSION['ID']) ) {		
		header('Location: '.URL.'?e=2');				
	}		
 ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>OroMall</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    	<link rel="shortcut icon" type="image/x-icon" href="../auto.ico">
    	<link type="text/css" rel="stylesheet" href="../css/style.css" >
    	<link type="text/css" rel="stylesheet"  href="../fonts/flaticon/flaticon.css"> 
    	<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
    	<script type="text/javascript" src="../js/app.js"></script>
		<script src="http://js.pusher.com/3.0/pusher.min.js"></script>
	</head>
	<body>
		
		<?php include('../menu.php'); ?>

		<div class="bar"><h1>PARKING</h1></div>

		<div id="main">

			<div id='ticket'>
				<div class='ticketBar'><h2><i class='flaticon-cinema44'></i>OroMall</h2></div>
				<div class='label'>Localidades: <span class='nLocalidad'></span></div>
				<div class='label'>Nivel:     <span class='nNivel'></span></div>
				<div class='label'>Espacio:   <span class='spacio'></span></div>
				<div class='label'>Placa:     <span class='placa'></span></div>
				<div class='label'>Fecha:     <span class='fecha'></span></div>
				<div class='label'>Hora:      <span class='hora'></span></div>
				<div class='label'>Estado:    <span class='estado'></span></div>
				<div class='label'>Momento:   <span class='hora_estado'></span></div>
				<input type='text'   id='placa' name='placa' placeholder='Ingrese Placa' required/>
				<input type='button' id='asignar'  class='button' name='Submit'   value='Asignar' data-type='asignarEspacio'/>
				<input type='button' id='cancelar' class='button' name='cancelar' value='Cancelar' data-type='cancelarEspacio'/>
			</div>
			
			<div id="parking">
				<center>
					<div id="infoGeneral"></div>
				</center>
				<?php 
					Conexion::conectar();
					for ($i=0; $i < Localidades::totalLocalidades(); $i++) { 					
						//Localidadeses
						$nombreLocalidades = trim(Localidades::getNombre($i+1));
						$alias = trim(Localidades::getAlias($i+1));	

						//Niveles - Array con niveles
						$id_niveles = Niveles::getIdNiveles( Localidades::getId($alias) );					
						$total_niveles = Niveles::getTotalNiveles( Localidades::getId($alias) );
												
						// Crear Localidades
						Localidades::crearLocalidad( Sesiones::getValue('ID'), ($i+1), $id_niveles, $alias);
					}
					Conexion::desconectar();				
				?>	
			</div>	
		</div>
	</body>	
</html>
