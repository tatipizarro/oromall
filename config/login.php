<?php 
	// echo "Login PHP"; 

	require_once('config.php');
	require_once('conex.php');
	require_once('class/usuarios.php');

	Conexion::conectar();
	Usuarios::login();
	Conexion::desconectar();

?>