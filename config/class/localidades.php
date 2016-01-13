<?php 
	
	Class Localidades{
		
		function __construct(){ }

		function crearLocalidad( $id_usuario, $id_localidad, $id_nivel, $alias ) {			
			echo "<div id='localidad".$id_localidad."' class='localidad'>";
			echo "
				<div id='info'>
					<span>".$alias."</span>
					<div clas='sim'>
						<strong><span class='dis'></span>Disponibles</strong>
						<strong><span class='blo'></span>Bloqueados</strong>
						<strong><span class='nod'></span>Ocupados</strong>
					</div>
				</div>";				
				for ($i=0; $i < count($id_nivel); $i++) { 
					$nombre_nivel = Niveles::getNombreNivel( $id_nivel[$i] );
					$alias_nivel = Niveles::getAlias( $id_nivel[$i] );					
					$n_puestos = Niveles::getNumPuestos( $id_nivel[$i] );					
					echo Niveles::cargarNivel( $id_usuario, $id_localidad, $alias, $id_nivel[$i], $nombre_nivel, $alias_nivel, $n_puestos );
				}
								
			echo "</div>";
		}

		function reporteLocalidad( $id_usuario, $id_localidad, $id_nivel, $alias ) {								
			// echo "<div id='localidad".$id_localidad."' class='localidad'>";
			// echo "
			// 	<div id='info'>					
			// 		<div clas='sim'>
			// 			<strong><span class='dis'></span>Disponibles</strong>
			// 			<strong><span class='blo'></span>Bloqueados</strong>
			// 			<strong><span class='nod'></span>Ocupados</strong>
			// 		</div>
			// 	</div>";				
				for ($i=0; $i < count($id_nivel); $i++) { 
					$nombre_nivel = Niveles::getNombreNivel( $id_nivel[$i] );
					$alias_nivel = Niveles::getAlias( $id_nivel[$i] );					
					$n_puestos = Niveles::getNumPuestos( $id_nivel[$i] );					
					echo Niveles::reporteNivel( $id_usuario, $id_localidad, $alias, $id_nivel[$i], $nombre_nivel, $alias_nivel, $n_puestos );
				}
			// echo "</div>";
		}

		function totalLocalidades() {			
			$total = 0;
			$res = mysql_query("SELECT * FROM localidades");			
			while ($id_localidad = mysql_fetch_array($res)) {
				$id_localidad["id_localidad"];
				$total++;
			}
			return $total;
		}

		function getId($alias){
			$res = mysql_query("SELECT * FROM localidades WHERE alias='".$alias."'");
			while ($id_localidad = mysql_fetch_array($res)) {
				return $id_localidad["id_localidad"];
			}
		}

		function getNombre($id_localidad){			
			$res = mysql_query("SELECT * FROM localidades WHERE id_localidad='".$id_localidad."'");
			while ($id_localidad = mysql_fetch_array($res)) {				
				return $id_localidad["nombre"];
			}
		}

		function getAlias($id_localidad){			
			$res = mysql_query("SELECT * FROM localidades WHERE id_localidad='".$id_localidad."'");
			while ($id_localidad = mysql_fetch_array($res)) {				
				return $id_localidad["alias"];
			}
		}

	}
 ?>