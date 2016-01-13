<?php 
	Class Historiales{

		public function __construct(){}

		public function crearHistorial($id_usuario, $id_auto, $id_localidad, $id_nivel, $espacio_nombre, $espacio_estado, $fecha_llegada, $hora_llegada){

			mysql_query("INSERT INTO historial VALUES ( id_historial,'".$id_usuario."','".$id_auto."','".$id_localidad."','".$id_nivel."','".$espacio_nombre."','".$espacio_estado."','".$fecha_llegada."','".$hora_llegada."','','')");

		}

		public function salida($id_historial, $fecha_salida, $hora_salida){

			// mysql_query("INSERT INTO historial VALUES ( id_historial,'".$id_usuario."','".$id_auto."','".$id_localidad."','".$id_nivel."','".$espacio_nombre."','".$espacio_estado."','".$fecha_llegada."','".$hora_llegada."','','')");
			mysql_query("UPDATE historial SET fecha_salida='".$fecha_salida."', hora_salida='".$hora_salida."' WHERE id_historial='".$id_historial."'");
		}

		public function getId($id_usuario, $id_auto, $id_localidad, $id_nivel, $espacio_nombre, $fecha_llegada, $hora_llegada) {
			$res = mysql_query("SELECT * FROM historial WHERE id_usuario='".$id_usuario."' AND id_auto='".$id_auto."' AND id_localidad='".$id_localidad."' AND id_nivel='".$id_nivel."' AND espacio_nombre='".$espacio_nombre."' AND fecha_llegada='".$fecha_llegada."' AND hora_llegada='".$hora_llegada."'");
			while ($id = mysql_fetch_array($res)) {
				return $id["id_historial"];
			}
		}

		public function historial($id_usuario) {
			$res = mysql_query("SELECT * FROM historial WHERE id_usuario='".$id_usuario."' ORDER BY fecha_llegada DESC");			
			while ($his = mysql_fetch_array($res)) {

				echo "
				<div id='detalle'>
					<div class='flaticon-identification8'>Placa: ".Autos::getNombre( $his["id_auto"] )."</div>
					<div class='info'>					 	
					 	<div class='flaticon-building98'>Localidad: ".Localidades::getNombre( $his["id_localidad"] )."</div>
					 	<div class='flaticon-boxes2'>Nivel: ".Niveles::getNombreNivel( $his["id_nivel"] )."</div>
					 	<div class='flaticon-parking12'>Espacio: ".$his["espacio_nombre"]."</div>
					</div>
				 	<div class='llegada'>
				 		<div>LLegada</div>
				 		<div class='flaticon-calendar92'>".$his["fecha_llegada"]."</div>
				 		<div class='flaticon-time44'>".$his["hora_llegada"]."</div>
				 	</div>
				 	<div class='salida'>
				 		<div>Salida</div>
				 		<div class='flaticon-calendar92'>".$his["fecha_salida"]."</div>
				 		<div class='flaticon-time44'>".$his["hora_salida"]."</div>
				 	</div>
				</div>";				
			}
		}		
	}
 ?>