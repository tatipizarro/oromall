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

		<div class="bar"><h1>HISTORIAL</h1></div>

		<div id="main">

			<div id="historial"></div>
			
		</div>		
	</body>	
</html>