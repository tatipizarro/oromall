<?php 
	// require('espacios.php');

	class Niveles{

		function __construct(){ }

		public function cargarNivel( $id_usuario, $id_localidad, $alias, $id_nivel, $nombre_nivel, $alias_nivel, $n_puestos) { 
			
			echo "<div id='".$nombre_nivel."' class='nivel'>";
				echo "<div id='infoNivel".$nombre_nivel."' class='infoNivel'>";
					echo "<div id='labelNivel".$nombre_nivel."' class='labelNivel'>".$alias_nivel."</div>";								
					echo "<div id='porcNivel".$nombre_nivel."' class='porcNivel'>".Espacios::porcNivel($id_localidad, $id_nivel, $nombre_nivel)."</div>";
					echo "<input id='btnVerNivel".$nombre_nivel."' class='btnVerNivel' type='button' data='ver_nivel' data-id='".$nombre_nivel."' value='VER' />";
				echo "</div>";				
				Espacios::cargarEspacios( $id_usuario, $id_localidad, $alias, $id_nivel, $nombre_nivel ,$n_puestos);
			echo "</div>";
		}

		public function reporteNivel( $id_usuario, $id_localidad, $alias, $id_nivel, $nombre_nivel, $alias_nivel, $n_puestos) { 
						
			echo "<div id='infoNivel".$nombre_nivel."' class='infoNivel'>";
				echo "<div id='labelNivel".$nombre_nivel."' class='labelNivel'>".$alias_nivel."</div>";								
				echo "<div id='porcNivel".$nombre_nivel."' class='porcNivel'>".Espacios::porcNivel($id_localidad, $id_nivel, $nombre_nivel)."</div>";					
				echo "<div class='total'>Total de Autos estacionados: ".Espacios::getOcupados($id_localidad, $id_nivel)."</div>";
			echo "</div>";				
			Espacios::reporteEspacios( $id_usuario, $id_localidad, $alias, $id_nivel, $nombre_nivel ,$n_puestos);			
		}

		public function getId( $nombre ){
			$res = mysql_query("SELECT * FROM niveles WHERE nombre='".$nombre."'");
			while ($nivel = mysql_fetch_array($res)) {
				return $nivel["id_nivel"];
			}
		}

		public function getNombreNivel( $id) {
			$res = mysql_query("SELECT * FROM niveles WHERE id_nivel='".$id."'");
			while ($nivel = mysql_fetch_array($res)) {
				return $nivel["nombre"];
			}
		}

		public function getAlias( $id) {
			$res = mysql_query("SELECT * FROM niveles WHERE id_nivel='".$id."'");
			while ($nivel = mysql_fetch_array($res)) {
				return $nivel["alias"];
			}
		}

		public function getNumPuestos( $id ){
			$res = mysql_query("SELECT * FROM niveles WHERE id_nivel='".$id."'");
			while ($nivel = mysql_fetch_array($res)) {
				return $nivel["n_puestos"];
			}
		}

		public function getIdNiveles( $id_localidad ){
			$id_niveles = array();
			$res = mysql_query("SELECT * FROM niveles WHERE id_localidad='".$id_localidad."'");
			while ($nivel = mysql_fetch_array($res)) {
				$id_niveles[] = $nivel["id_nivel"];
			}
			return $id_niveles;
		}

		public function getTotalNiveles( $id_localidad ){
			$total = 0;
			$res = mysql_query("SELECT * FROM niveles WHERE id_localidad='".$id_localidad."'");
			while ($nivel = mysql_fetch_array($res)) {
				$total++;
			}
			return $total;
		}

	}
 ?>