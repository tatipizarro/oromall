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

		<div class="bar"><h1>REPORTE</h1></div>

		<div id="main">
			<!-- <center>
				<div id="infoGeneral"></div>
			</center> -->
			<!-- <center> -->
			<div id="reporte">			
				<?php
					$n_puestos = 0;
					$porDis = 0;
					$porBlo = 0;
					$porOcu = 0;
					$infoGeneral = "";
					Conexion::conectar();

					for ($i=0; $i < Localidades::totalLocalidades(); $i++) { 
						$alias = trim(Localidades::getAlias($i+1));	
						$id_localidad = Localidades::getId($alias);
						$id_niveles = Niveles::getIdNiveles( Localidades::getId($alias) );
						$total_niveles = Niveles::getTotalNiveles( Localidades::getId($alias) );
						for ($j=0; $j < $total_niveles; $j++) { 
							$n_puestos += Niveles::getNumPuestos( $id_niveles[$j] );							
						}			
						for ($k=0; $k < $total_niveles; $k++) { 
							$porDis += round( ( Espacios::getDisponibles( ($i+1), $id_niveles[$k])*100 ) / $n_puestos , 0);
							$porBlo += round( ( Espacios::getBloqueados(  ($i+1), $id_niveles[$k])*100 ) / $n_puestos , 0);
							$porOcu += round( ( Espacios::getOcupados(    ($i+1), $id_niveles[$k])*100 ) / $n_puestos , 0);
							
						}
						echo "<div class='infoLoc'>
								<div class='labelLoc'><i class='flaticon-garage23'></i>".$alias." <div style='float:right;'><i class='flaticon-stacked9'></i> ".$n_puestos."</div></div>
								<div class='porcLoc'>
									<div>Disponibles: ".round(($porDis*$n_puestos)/100)."</div><span class='verde'    style='width: ".($porDis+1)."px;'><strong>".$porDis."%</strong></span>
									<div>Bloqueados: ".round(($porBlo*$n_puestos)/100)."</div><span class='amarillo' style='width: ".($porBlo+1)."px;'><strong>".$porBlo."%</strong></span>
									<div>Ocupados: ".round(($porOcu*$n_puestos)/100)."</div><span class='rojo'     style='width: ".($porOcu+1)."px;'><strong>".$porOcu."%</strong></span>
								</div>";
							Localidades::reporteLocalidad( Sesiones::getValue('ID'), ($i+1), $id_niveles, $alias);	
						echo "</div>";

						$n_puestos = 0;
						$porDis = 0;
						$porBlo = 0;
						$porOcu = 0;					
					}
					// echo $infoGeneral;
					// Conexion::desconectar();
					// Conexion::conectar();
					// for ($i=0; $i < Localidades::totalLocalidades(); $i++) { 					
					// 	//Localidadeses
					// 	$nombreLocalidades = trim(Localidades::getNombre($i+1));
					// 	$alias = trim(Localidades::getAlias($i+1));	

					// 	//Niveles - Array con niveles
					// 	$id_niveles = Niveles::getIdNiveles( Localidades::getId($alias) );					
					// 	$total_niveles = Niveles::getTotalNiveles( Localidades::getId($alias) );
												
					// 	// Crear Localidades
						
					// }				
					Conexion::desconectar();	
				?>
			</div>
			<!-- </center> -->	
		</div>		
	</body>	
</html>