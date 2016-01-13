<?php 
	require_once('config.php');
	require_once('class/sesiones.php');
	Sesiones::init();	
	Sesiones::unsetValues();	
    Sesiones::destroy();
	// setcookie(session_name(),'',0,'/');	
    header('Location: '.URL);    
 ?>