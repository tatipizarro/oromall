<?php 
	
	class Conexion{

		public function __construct(){}

		public function conectar() {		
			mysql_connect(DB_HOST,DB_USER,DB_PASS) or die ("Error " . mysql_error());
			mysql_select_db(DB_NAME);
			// echo "Conexion Establecida";
		}

	  	public function desconectar() {
			mysql_close();
		}

		public function query($op, $tabla, $consulta){
			// conectar();
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
			// desconectar();	
		}

		public function jsonQuery($op, $tabla, $consulta){
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
	}	
 ?>