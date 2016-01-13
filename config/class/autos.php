<?php 
	class Autos{
		public function __construct(){}

		public function getId(){
			if( isset($_GET["placa"]) && !empty($_GET["placa"]) ) { }
		}

		public function crearAuto( $id_auto, $placa, $marca, $modelo, $clase, $tipo, $color, $ano, $chasis, $motor) {			
			mysql_query("INSERT INTO autos VALUES (id_auto, '".$placa."','".$marca."','".$modelo."','".$clase."','".$tipo."','".$color."','".$ano."','".$chasis."','".$motor."')");
		}

		public function verificarPlaca($placa){	
			$res = "";
			$placas = query(1,"autos","WHERE placa='".$placa."'");		
			if (mysql_num_rows($placas) > 0) {
				while ( $placa = mysql_fetch_array($placas)) {
					$res = $placa["id_auto"];
				}
			}else{
				$res = 0;
			}			
			return $res;
		}

		function getNombre($id_auto){			
			$res = mysql_query("SELECT * FROM autos WHERE id_auto='".$id_auto."'");
			while ($id_auto = mysql_fetch_array($res)) {				
				return $id_auto["placa"];
			}
		}
	}
 ?>