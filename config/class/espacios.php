<?php 
		
	class Espacios{
				
		public function __construct(){
      		
  		} 

  		public function crearEspacios( $id_localidad, $alias, $id_nivel, $n_puestos){  			
  			mysql_query("DELETE FROM espacios WHERE id_localidad='".$id_localidad."' AND id_nivel='".$id_nivel."'");
			for ($j=0; $j < $n_puestos; $j++) { 
				mysql_query("INSERT INTO espacios VALUES (id_espacio,'".$id_localidad."','".$id_nivel."','1','','".($j+1)."')");
			}						
  		}
		
		public function cargarEspacios( $id_usuario, $id_localidad, $alias, $id_nivel, $nombre_nivel ,$n_puestos){		
			$res = mysql_query("SELECT * FROM espacios WHERE id_localidad='".$id_localidad."' AND id_nivel='".$id_nivel."'");
			// Falta cargar las placas
			$placa = "";			
			echo "<center><div id='puestos".$nombre_nivel."' class='puestos'>";
			while ( $espacio = mysql_fetch_array($res) ) {
				if ( $espacio["id_estado"] == 1) {					
					echo "<input type='button' id='".trim($nombre_nivel).'-'.$espacio["numero"]."' value='".$espacio["numero"]."' spacio='".$espacio["numero"]."' data-type='espacio' id-usuario='' id-espacio='".$espacio["id_espacio"]."' id-localidad='".$id_localidad."' nLocalidad='".$alias."' id-nivel='".$id_nivel."' nNivel='".trim($nombre_nivel)."' placa='".$placa."' id-historial='' id-estado='1' estado='Disponible' class='space button espacio verde'/>";
				}
				if ( $espacio["id_estado"] == 2) {					
					echo "<input type='button' id='".trim($nombre_nivel).'-'.$espacio["numero"]."' value='".$espacio["numero"]."' spacio='".$espacio["numero"]."' data-type='espacio' id-usuario='' id-espacio='".$espacio["id_espacio"]."' id-localidad='".$id_localidad."' nLocalidad='".$alias."' id-nivel='".$id_nivel."' nNivel='".trim($nombre_nivel)."' placa='".$placa."' id-historial='' id-estado='2' estado='Bloqueado' class='space button espacio amarillo'/>";
				}
				if ( $espacio["id_estado"] == 3) {					
					echo "<input type='button' id='".trim($nombre_nivel).'-'.$espacio["numero"]."' value='".$espacio["numero"]."' spacio='".$espacio["numero"]."' data-type='espacio' id-usuario='' id-espacio='".$espacio["id_espacio"]."' id-localidad='".$id_localidad."' nLocalidad='".$alias."' id-nivel='".$id_nivel."' nNivel='".trim($nombre_nivel)."' placa='".$placa."' id-historial='' id-estado='3' estado='Ocupado' class='space button espacio rojo'/>";
				}
			}
			echo "</div></center>";			
		}

		public function reporteEspacios( $id_usuario, $id_localidad, $alias, $id_nivel, $nombre_nivel ,$n_puestos){		
			$res = mysql_query("SELECT * FROM espacios WHERE id_localidad='".$id_localidad."' AND id_nivel='".$id_nivel."'");			
			$placa = "";
			echo "<center>";			
			while ( $espacio = mysql_fetch_array($res) ) {
				if ( $espacio["id_estado"] == 1) {					
					echo "<input type='button' id='".trim($nombre_nivel).'-'.$espacio["numero"]."' value='".$espacio["numero"]."' spacio='".$espacio["numero"]."' id-espacio='".$espacio["id_espacio"]."' id-localidad='".$id_localidad."' nLocalidad='".$alias."' id-nivel='".$id_nivel."' nNivel='".trim($nombre_nivel)."' placa='".$placa."' id-historial='' id-estado='1' estado='Disponible' class='space button espacio verde'/>";
				}
				if ( $espacio["id_estado"] == 2) {					
					echo "<input type='button' id='".trim($nombre_nivel).'-'.$espacio["numero"]."' value='".$espacio["numero"]."' spacio='".$espacio["numero"]."' id-espacio='".$espacio["id_espacio"]."' id-localidad='".$id_localidad."' nLocalidad='".$alias."' id-nivel='".$id_nivel."' nNivel='".trim($nombre_nivel)."' placa='".$placa."' id-historial='' id-estado='2' estado='Bloqueado' class='space button espacio amarillo'/>";
				}
				if ( $espacio["id_estado"] == 3) {					
					echo "<input type='button' id='".trim($nombre_nivel).'-'.$espacio["numero"]."' value='".$espacio["numero"]."' spacio='".$espacio["numero"]."' id-espacio='".$espacio["id_espacio"]."' id-localidad='".$id_localidad."' nLocalidad='".$alias."' id-nivel='".$id_nivel."' nNivel='".trim($nombre_nivel)."' placa='".$placa."' id-historial='' id-estado='3' estado='Ocupado' class='space button espacio rojo'/>";
				}
			}
			echo "</center>";			
		}

		public function cambiarEstado( $id_espacio, $estado){
			$consulta = query('3', 'espacios', "SET id_estado='".$estado."' WHERE id_espacio='".$id_espacio."'");			
		}

		public function totalEspacios($id_localidad, $id_nivel){
			$total = 0;			
			$res = mysql_query("SELECT * FROM espacios WHERE id_localidad='".$id_localidad."' AND id_nivel='".$id_nivel."'");
			while ( $espacio = mysql_fetch_array($res) ) {				
				$total++;
			}
			return $total;	
		}

		public function getDisponibles($id_localidad, $id_nivel){ 
			$dis = 0;
			$res = mysql_query("SELECT * FROM espacios WHERE id_estado='1' AND id_localidad='".$id_localidad."' AND id_nivel='".$id_nivel."'");			
			while ( $espacio = mysql_fetch_array($res) ) {
				$dis++;
			}
			return $dis;			
		}

		public function getBloqueados($id_localidad, $id_nivel){
			$blo = 0;			
			$res = mysql_query("SELECT * FROM espacios WHERE id_estado='2' AND id_localidad='".$id_localidad."' AND id_nivel='".$id_nivel."'");
			while ( $espacio = mysql_fetch_array($res) ) {
				$blo++;
			}
			return $blo;
		}

		public function getOcupados($id_localidad, $id_nivel){
			$ocu = 0;
			$res = mysql_query("SELECT * FROM espacios WHERE id_estado='3' AND id_localidad='".$id_localidad."' AND id_nivel='".$id_nivel."'");			
			while ( $espacio = mysql_fetch_array($res) ) {
				$ocu++;
			}
			return $ocu;
		}

		public function porcNivel($id_localidad, $id_nivel, $nombre_nivel){			
			$total = 0;			
			$res = mysql_query("SELECT * FROM espacios WHERE id_localidad='".$id_localidad."' AND id_nivel='".$id_nivel."'");
			while ( $espacio = mysql_fetch_array($res) ) {				
				$total++;
			}

			$dis = 0;
			$resDis = mysql_query("SELECT * FROM espacios WHERE id_estado='1' AND id_localidad='".$id_localidad."' AND id_nivel='".$id_nivel."'");			
			while ( $espacio = mysql_fetch_array($resDis) ) {
				$dis++;
			}
		
			$blo = 0;			
			$resBlo = mysql_query("SELECT * FROM espacios WHERE id_estado='2' AND id_localidad='".$id_localidad."' AND id_nivel='".$id_nivel."'");
			while ( $espacio = mysql_fetch_array($resBlo) ) {
				$blo++;
			}

			$ocu = 0;
			$resOcu = mysql_query("SELECT * FROM espacios WHERE id_estado='3' AND id_localidad='".$id_localidad."' AND id_nivel='".$id_nivel."'");			
			while ( $espacio = mysql_fetch_array($resOcu) ) {
				$ocu++;
			}
	
			$porDis = round( ( $dis * 100 / $total ) , 0);
			$porBlo = round( ( $blo * 100 / $total ) , 0);
			$porOcu = round( ( $ocu * 100 / $total ) , 0);
			
			$nivel ="<span class='verde'    style='width: ".($porDis+1)."px;'><strong>".$porDis."%</strong></span>
					<span class='amarillo' style='width: ".($porBlo+1)."px;'><strong>".$porBlo."%</strong></span>
					<span class='rojo'     style='width: ".($porOcu+1)."px;'><strong>".$porOcu."%</strong></span>";

			return $nivel;
		}
	}
 ?>