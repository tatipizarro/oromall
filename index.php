<?php 	
	$e = "";
	if (isset($_GET["e"]) && !empty($_GET["e"])) {
		$e = $_GET["e"];		
	}	
 ?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>OroMall</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    	<link type="text/css" rel="stylesheet" href="css/style.css" >
    	<link type="text/css" rel="stylesheet"  href="fonts/flaticon/flaticon.css"> 
    	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	</head>
	<body style="background-color:#0070C0">		
		<div id="main">						
	        <div id="formWrapper">            
	            <div class="formWrapper">	                
	                <center>
	                <img src="img/oro_mall230x63.png" >
	                </center>
	                <form name="signIn" action="config/login.php" method="get">
	                	<input type="text" name="user" placeholder="Usuario" required>						
						<input type="password" name="pass" placeholder="Contraseña" required>
						<input type="submit" name="enviar" value="Iniciar Sesión" >	                    
	                </form>
	                <?php if ( $e == 1) {
		        		echo "<div class='error'>Usuario o Contraseña no existen</div>";
		        	} ?>  
		        	<?php if ( $e == 2) {
		        		echo "<div class='error'>Debes iniciar sesión para ingresar</div>";
		        	} ?>
		        	<?php 
		        	$dm_usergent = array(
					    'PIE4' => 'compatible; MSIE 4.01; Windows CE; PPC; 240x320',
					    'PIE4_Smartphone' => 'compatible; MSIE 4.01; Windows CE; Smartphone;',
					    'PIE6' => 'compatible; MSIE 6.0; Windows CE;',
					    'Minimo' => 'Minimo',
					    'OperaMini' => 'Opera Mini',
					    'AvantGo' => 'AvantGo',
					  	'Huawei' => 'Huawei',
					    'Plucker' => 'Plucker',
					  	'iPhone' => 'iPhone',
					   	'iPad' => 'iPad',
					  	'iPod' => 'iPod',
					    'NetFront' => 'NetFront',
					  	'Lg' => 'Lg',
					  	'Samsung' => 'Samsung',
					    'Android' => 'Android',
					    'SonyEricsson' => 'SonyEricsson',
					    'Nokia' => 'Nokia',
					    'Motorola' => 'mot-',
					    'BlackBerry' => 'BlackBerry',
					    'WindowsMobile' => 'Windows CE',
					    'PPC' => 'PPC',
					    'PDA' => 'PDA',
					    'Smartphone' => 'Smartphone',
					    'Palm' => 'Palm'
					);
					function obtenerNavegador($useragents, $useragent){
					    foreach($useragents as $nav=>$ua){
					    	if(strstr($useragent, $ua)!=false){
					        	return $nav;
					      	}
					  	}
					    return 'Desconocido';
					}					
					$navegador= obtenerNavegador($dm_usergent,$_SERVER['HTTP_USER_AGENT']);
					if($navegador!='Desconocido'){					   
					    echo "<div class='download'><a href='download/' class='flaticon-download8'>Descargar App</a><div>";
					}else{					   
						echo "<div class='download'><a href='download/' class='flaticon-download8'>Descargar App</a><div>";
					}
		        	 ?>
	            </div>	               
	        </div>	            
		</div>
	</body>
</html>