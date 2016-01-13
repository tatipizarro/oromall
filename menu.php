<div id="menu">
	<div id="btnMenu" class="flaticon-menu48"></div>
	<div id="btnHideMenu" class="flaticon-left224"></div>
	<?php if ( Sesiones::exist() ) {		
		echo "<ul>";
		echo "<li id='user' class='flaticon-users53'>".Sesiones::getValue('USER')."</li>";
		echo "<li id='' class='flaticon-transport122'><a href='".URL."parking/'>Parking</a></li>";
		echo "<li id='' class='flaticon-open207'><a href='".URL."history/'>Historial</a></li>";
		echo "<li id='' class='flaticon-restaurants2'><a href='".URL."report/'>Reporte</a></li>";
		echo "<button id='closeSesionesBtn' class='flaticon-arrow221'>Cerrar Sesión</button>";
		echo "<div id='id_user' id_user='".Sesiones::getValue('ID')."'>".Sesiones::getValue('ID')."</div>";
		echo "</ul>";			
	} ?>
</div>