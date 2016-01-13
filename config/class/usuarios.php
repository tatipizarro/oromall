<?php 
	require_once('sesiones.php');
	
	class Usuarios{

		public function __construct(){}

		public function login(){
						
			if( isset($_GET["user"]) && !empty($_GET["user"]) && isset($_GET["pass"]) && !empty($_GET["pass"]) ) { 
							
				$res = mysql_query("SELECT * FROM usuarios WHERE usuario='".$_GET["user"]."' AND pass='".$_GET["pass"]."'");
				
				if ( $user = mysql_fetch_array($res)) {
					// echo var_dump($user);
					echo "Hola usuario ".$user["nombres"].$user["id_usuario"];					
					Sesiones::init();					
					Sesiones::setValue("USER", $user["nombres"]);
					Sesiones::setValue("ID", $user["id_usuario"]);
					header('Location: '.URL.'parking');
				} else {					
					header('Location: '.URL.'?e=1');
				}				
			}			
		}	
	}	
 ?>