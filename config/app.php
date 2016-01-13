<?php
	require_once('config.php');	
	require_once('conex.php');
	require_once('class/espacios.php');
	require_once('class/autos.php');
	require_once('class/historiales.php');
	require_once('class/localidades.php');
	require_once('class/niveles.php');

	require_once('../lib/Pusher.php');
	

		
	$pusher = PusherInstance::get_pusher();
	// ------------------------------------------------------  REAL TIME
	if( isset($_POST['socket_id']) && !empty($_POST['socket_id']) ) {		
		$pusher->trigger(
			'canal_prueba',
			'estado_espacio',
			array(
				'idObj' => $_POST['idObj'], 
				'addClass' => $_POST['addClass'], 
				'removeClass' => $_POST['removeClass'], 
				'socket_id' => $_POST['socket_id']),
			$_POST['socket_id']
		);
		echo json_encode(array('idObj' => $_POST['idObj'], 'addClass' => $_POST['addClass'], 'removeClass' => $_POST['removeClass']));
	}	
	// ------------------------------------------------------  REAL TIME
	// Cuadro estadistico por localidad	
	if ( isset($_POST['socket']) && !empty($_POST['socket']) ) {	
		$infoGeneral = infoGeneral();		
		$pusher->trigger(
			'canal_prueba',
			'infoGeneral',
			array(
				'inf' => $infoGeneral, 				
				'socket' => $_POST['socket']),
			$_POST['socket']
		);
		echo json_encode(array('inf' => $infoGeneral ));
	}

	function infoGeneral(){		
		$n_puestos = 0;
		$porDis = 0;
		$porBlo = 0;
		$porOcu = 0;
		$infoGeneral = "";
		$app = array();
		$garitas = array();
		$puestos = array();
		$inf = array();
		Conexion::conectar();		
		for ($i=0; $i < Localidades::totalLocalidades(); $i++) { 
			$alias = trim(Localidades::getAlias($i+1));

			array_push($garitas, $alias);

			$id_localidad = Localidades::getId($alias);
			$id_niveles = Niveles::getIdNiveles( Localidades::getId($alias) );
			$total_niveles = Niveles::getTotalNiveles( Localidades::getId($alias) );

			for ($j=0; $j < $total_niveles; $j++) { 
				$n_puestos += Niveles::getNumPuestos( $id_niveles[$j] );							
			}			

			array_push($puestos, $n_puestos);

			for ($k=0; $k < $total_niveles; $k++) { 
				$porDis += round( ( Espacios::getDisponibles( ($i+1), $id_niveles[$k])*100 ) / $n_puestos , 0);
				$porBlo += round( ( Espacios::getBloqueados(  ($i+1), $id_niveles[$k])*100 ) / $n_puestos , 0);
				$porOcu += round( ( Espacios::getOcupados(    ($i+1), $id_niveles[$k])*100 ) / $n_puestos , 0);				
			}
			$total = array($porDis, $porBlo, $porOcu);

			array_push($inf, $total);

			// $infoGeneral = $infoGeneral."<div class='infoLoc'>
			// 		<div class='labelLoc'><i class='flaticon-garage23'></i>".$alias." <div style='float:right;'><i class='flaticon-stacked9'></i> ".$n_puestos."</div></div>
			// 		<div class='porcLoc'>
			// 			<div>Disponibles: ".round(($porDis*$n_puestos)/100)."</div><span class='verde'    style='width: ".($porDis+1)."px;'><strong>".$porDis."%</strong></span>
			// 			<div>Bloqueados: ".round(($porBlo*$n_puestos)/100)."</div><span class='amarillo' style='width: ".($porBlo+1)."px;'><strong>".$porBlo."%</strong></span>
			// 			<div>Ocupados: ".round(($porOcu*$n_puestos)/100)."</div><span class='rojo'     style='width: ".($porOcu+1)."px;'><strong>".$porOcu."%</strong></span>
			// 		</div>
			// 	</div>";

			$n_puestos = 0;
			$porDis = 0;
			$porBlo = 0;
			$porOcu = 0;
		}
		Conexion::desconectar();
		array_push($app, $garitas);
		array_push($app, $puestos);
		array_push($app, $inf);
		return $app;
	}	
	// --------------------------------

	// Cuadro estadistico por nivel
	if( isset($_POST['socket_idn']) && !empty($_POST['socket_idn']) ) {
		Conexion::conectar();
		$infNivel = Espacios::porcNivel( $_POST['id_localidad'], $_POST['id_nivel'], $_POST['nombre_nivel']);
		Conexion::desconectar();	
		$pusher->trigger(
			'canal_prueba',
			'estado_nivel',
			array(
				'nombre_nivel' => $_POST['nombre_nivel'], 
				'infNivel' => $infNivel, 
				'socket_idn' => $_POST['socket_idn']),
			$_POST['socket_idn']
		);
		echo json_encode(array( 'nombre_nivel' => $_POST['nombre_nivel'], 'infNivel' => $infNivel ));
	}
	// --------------------------------	
	// Cambiar estado de Espacio
    if( isset($_POST['estado']) && !empty($_POST['estado']) ) {
    	if( isset($_POST['id_espacio']) && !empty($_POST['id_espacio']) ) {
    		Espacios::cambiarEstado( $_POST['id_espacio'], $_POST['estado']);    					
		}else{
			echo "No se recibio id_espacio ";
		}	   
	}
	
	// Verificar placa
	if( isset($_GET["placa"]) && !empty($_GET["placa"]) ) {	

		$id_auto = Autos::verificarPlaca($_GET["placa"]);
		if ( $id_auto > 0) {
			// Guardar historial
			Historiales::crearHistorial($_GET["id_usuario"], $id_auto, $_GET["id_localidad"], $_GET["id_nivel"], $_GET["espacio_nombre"], $_GET["espacio_estado"], $_GET["fecha_llegada"], $_GET["hora_llegada"]);
			echo Historiales::getId($_GET["id_usuario"], $id_auto, $_GET["id_localidad"], $_GET["id_nivel"], $_GET["espacio_nombre"], $_GET["fecha_llegada"], $_GET["hora_llegada"]);
		}else{
			// Guardar placa
			Autos::crearAuto( '', $_GET["placa"], '', '', '', '', '', '', '', '');
			$id_auto = Autos::verificarPlaca($_GET["placa"]);
			// Guardar historial
			Historiales::crearHistorial($_GET["id_usuario"], $id_auto, $_GET["id_localidad"], $_GET["id_nivel"], $_GET["espacio_nombre"], $_GET["espacio_estado"], $_GET["fecha_llegada"], $_GET["hora_llegada"]);
			echo Historiales::getId($_GET["id_usuario"], $id_auto, $_GET["id_localidad"], $_GET["id_nivel"], $_GET["espacio_nombre"], $_GET["fecha_llegada"], $_GET["hora_llegada"]);
		}		
	}
	// Guardar fecha y hora de salida
	if( isset($_GET["id_historial"]) && !empty($_GET["id_historial"]) ) {	
		Conexion::conectar();
		Historiales::salida( $_GET["id_historial"], $_GET["fecha_salida"], $_GET["hora_salida"]);
		Conexion::desconectar();
	}

	// Mostrar Historial
	if( isset($_GET["historial"]) && !empty($_GET["historial"]) ) {	
		Conexion::conectar();
		Historiales::historial( $_GET["id_usuario"] );
		Conexion::desconectar();
	}

	// Mostrar Reporte
	// if( isset($_GET["reporte"]) && !empty($_GET["reporte"]) ) {	
	// 	Conexion::conectar();
	// 	Niveles::cargarReporteNivel( $_GET["id_usuario"] );
	// 	Conexion::desconectar();
	// }
	
	function conectar() {		
		mysql_connect(DB_HOST,DB_USER,DB_PASS) or die ("Error " . mysql_error());
		mysql_select_db(DB_NAME);
	}

  	function desconectar() {
		mysql_close();
	}

	function query($op, $tabla, $consulta){
		conectar();
		if ($op == 1 ) {
			$query = "SELECT * FROM ".$tabla." ".$consulta;
		}
		if ($op == 2 ) {
			$query = "INSERT INTO ".$tabla." ".$consulta;
		}
		if ($op == 3 ) {
			$query = "UPDATE ".$tabla." ".$consulta;
		}
		if ($op == 4 ) {
			$query = "DELETE FROM ".$tabla." ".$consulta;
		}	
		$resultado = mysql_query($query);
		return $resultado;		
		desconectar();	
	}

	function jsonQuery($op, $tabla, $consulta){
		$con = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die ("Sin conexion " . mysql_error());
		mysql_select_db(DB_NAME);
		mysql_query("SET NAMES utf8");
		if ($op == 1 ) {
			$query = "SELECT * FROM ".$tabla." ".$consulta;
		}
		if ($op == 2 ) {
			$query = "INSERT INTO ".$tabla." ".$consulta;
		}
		if ($op == 3 ) {
			$query = "UPDATE ".$tabla." ".$consulta;
		}
		if ($op == 4 ) {
			$query = "DELETE FROM ".$tabla." ".$consulta;
		}		
		// echo $query;
		$noticias = array();
		$result = mysql_query( $query, $con );
		while ( $row = mysql_fetch_assoc( $result ) ) {
			$noticias[] = $row;
		}

		$json_string = json_encode($noticias);
		$file = 'noticias.json';
		file_put_contents('noticias.json', $json_string);

		return json_encode( $noticias, true );		
		mysql_close( $con );	
	}

	function llenarArray(){
		$garitas_a = array();
		$niveles_a = array();
		$puestos_a = array();
		$arrayG = array();
		$arrayN = array();
		$arrayP = array();
		$garitas = query(1,"localidades","");
		while ( $garita  = mysql_fetch_array($garitas) ) {
			array_push($garitas_a, $garita["alias"]);
			// array_push($garitas_a, $garita["alias"]." : ".$garita["nombre"]);
			// echo $garita["alias"]." : ".$garita["nombre"]."<br>";
			$niveles = query(1,"niveles","WHERE id_localidad=".$garita["id_localidad"]."");
			while ( $nivel  = mysql_fetch_array($niveles) ) {
				// echo $nivel["nombre"]." : ".$nivel["n_puesto"]."<br>";
				if ($garita["id_localidad"] == $nivel["id_localidad"]) {
					array_push($niveles_a, $nivel["nombre"]);
					array_push($puestos_a, $nivel["n_puestos"]);
				}			
			}
			array_push($arrayN, $niveles_a);
			array_push($arrayP, $puestos_a);
			$niveles_a = array();
			$puestos_a = array();			
		}	
		array_push($arrayG, $garitas_a);		
		$parking = array();
		array_push($parking, $arrayG);
		array_push($parking, $arrayN);
		array_push($parking, $arrayP);
		return $parking;
	}

	function imprimirArray($parking){
		echo "------------------------- IMPRIMIENDO ARRAY -------------------------<br />";
		for($i=0;$i<count($parking);$i++) {
			for($j=0;$j<count($parking[$i]);$j++) {
				for($k=0;$k<count($parking[$i][$j]);$k++) {
					echo "Posicion: ".$i."-".$j."-".$k."-".$parking[$i][$j][$k].'<br />';
				}
			}
		}
		echo "---------------------------------------------------------------------<br />";
	}

	$park = array(
		// Garitas 
		array( 
			array("GARITA A", "GARITA B", "GARITA C")  //[0][0][0]			
		), 
		// Niveles
		array( 
			array("AS1", "AS2", "AP1", "AP2", "AP3"), //[1][0][.....]
			array("BP1", "BP2", "BP3", "BP4"),        //[1][1][....]
			array("CPE")                              //[1][2][.]
			// Otros niveles			
		),
		 // Nro Puestos 
		array( 
			array("80", "80", "100", "100", "100"),   //[2][0][.....]			      
			array("100", "120", "120", "120"),        //[2][1][....] 
			array("80")                               //[2][2][0]
			// Mas puestos por nivel
		)		
	);
	
	// imprimirArray( llenarArray() );
 ?>