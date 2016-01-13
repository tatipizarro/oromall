$(document).on("ready",function () {
	var bndMenu = 0;
	
	$('#btnMenu').click(function(){
		$( "#menu" ).animate({
			   	'margin-left' : '0px'
			}, 500 
		);
		$('#btnMenu').hide();					
	});
	$('#btnHideMenu').click(function(){
		$( "#menu" ).animate({
		    	'margin-left' : '-180px'
			}, 500 , function(){
				$('#btnMenu').show();
			}
		);					
	});

	var pusher = new Pusher('f353ea98bb7d2ca19ebe');
	var canal = pusher.subscribe('canal_prueba');		
			
	// CLIENTE REAL TIME
	canal.bind('estado_espacio', function( response ) { 
		// console.log('Cliente ID '+response.idObj);
		console.log('Cliente Clase remove '+response.removeClass);
		console.log('Cliente Clase add '+response.addClass);

		$('#'+response.idObj).removeClass(response.removeClass).addClass(response.addClass);					

	});

	canal.bind('infoGeneral', function( response ) { 
		// console.log('INFO ID '+response.inf);					
		$('#infoGeneral').empty();
		$('#infoGeneral').html( response.inf );							
	});

	canal.bind('estado_nivel', function( response ) { 
		// console.log('INFO NIVEL '+response.nombre_nivel);					
		$('#porcNivel'+response.nombre_nivel).empty();
		$('#porcNivel'+response.nombre_nivel).html( response.infNivel );							
	});
	
	
	if ( $("#infoGeneral").length ) {
		updateInfo();
	}

	if ( $("#historial").length ) {
		$.ajax({ 
			async: true,
			url: '../config/app.php',
		    data: {	id_usuario : $('#id_user').attr('id_user'), historial : 'historial' },
		    type: 'GET',
		  	success: function(response) {
		        $('#historial').html( response );				
		    }
		});
	}

	function updateInfo() {						
		$.post(							
			'../config/app.php', 
			{ 													
				socket : '1.1',
				inf : 'infoGeneral'							
			}, 
			function( response ){
				console.log('INf LOCALIDAD: '+ response );
				var html = '';				
				$('#infoGeneral').empty(); 
				for (var i = 0; i < response.inf[0].length; i++) {		
					html += "<div class='infoLoc'>"+
									"<div class='labelLoc'>"+
										"<i class='flaticon-garage23'></i>"+response.inf[0][i]+
										"<div style='float:right;'><i class='flaticon-stacked9'></i> "+response.inf[1][i]+"</div>"+
									"</div>"+
									"<div class='porcLoc'>"+											
							 		"<div>Disponibles: "+Math.round((response.inf[2][i][0]*response.inf[1][i])/100)+"</div><span class='verde'    style='width: "+(response.inf[2][i][0]+1)+"px;'><strong>"+response.inf[2][i][0]+"%</strong></span>"+
							 			"<div>Bloqueados: "+Math.round((response.inf[2][i][1]*response.inf[1][i])/100)+"</div><span class='amarillo' style='width: "+(response.inf[2][i][1]+1)+"px;'><strong>"+response.inf[2][i][1]+"%</strong></span>"+
							 			"<div>Ocupados: "+Math.round((response.inf[2][i][2]*response.inf[1][i])/100)+"</div><span class='rojo'     style='width: "+(response.inf[2][i][2]+1)+"px;'><strong>"+response.inf[2][i][2]+"%</strong></span>"+
							 		"</div>"+
								"</div>";					
				};
				$('#infoGeneral').html( html );					
			}, 
			'json'
		);
	}	

	function inf_nivel( idObj, id_localidad, id_nivel, nombre_nivel) {						
		$.post(							
			'../config/app.php', 
			{ 							
				socket_idn : '1.2',
				idObj : idObj,
				id_localidad : id_localidad,
				id_nivel : id_nivel,
				nombre_nivel : nombre_nivel												
			}, 
			function( response ){
				console.log('INf NIVEL: '+ response );
				$('#porcNivel'+response.nombre_nivel).empty();
				$('#porcNivel'+response.nombre_nivel).html( response.infNivel );							
			}, 
			'json'
		);
	}

	function estado_espacio(idEspacioActual, removeClass, addClass){
		$.post(
			'../config/app.php', 
			{ 
				idObj : idEspacioActual,
				removeClass : removeClass, 
				addClass : addClass,
				socket_id : pusher.connection.socket_id 
			}, 
			function( response ) {
				$('#'+idEspacioActual).removeClass( removeClass ).addClass( addClass );									
			}, 
			'json'
		);
	}			

	var idEspacioActual = '';
	var id_usuario = '';
	
	$('input').click(function() { 
		// alert($(this).attr('data'));

		$(this).attr('id-usuario', $('#id_user').attr('id_user'));

		var fecha = new Date();					
		var month = fecha.getMonth()+1;
		var day = fecha.getDate();
		var output = fecha.getFullYear() + '-' +
    	((''+month).length<2 ? '0' : '') + month + '-' +
    	((''+day).length<2 ? '0' : '') + day;
		var hora = fecha.getHours();
		var minuto = fecha.getMinutes();
		var segundo = fecha.getSeconds();
			
		$('.nLocalidad').text($(this).attr('nLocalidad'));
		$('.nNivel').text($(this).attr('nnivel'));
		$('.spacio').text($(this).attr('spacio'));
		$('.placa').text($(this).attr('placa'));
		$('.fecha').text(output);
		$('.hora').text(hora+':'+minuto+':'+segundo);
		$('.estado').text($(this).attr('estado'));
		
		// VALIDANDO CLICK SOBRE UN ESPACIO
		if ( $(this).attr('data-type') == "espacio" ) {

			idEspacioActual = $(this).attr('id');
			// alert($(this).attr('estado'));

			if ( $(this).attr('estado') == 'Ocupado') {							
				$('#asignar').attr('value', 'Liberar');							
			}else{
				$('#asignar').attr('value', 'Asignar');							
			}
			if ( $(this).attr('estado') == 'Disponible') {
				
				estado_espacio( idEspacioActual, 'verde', 'amarillo');
				cambiarEstado( idEspacioActual, 2, 'Bloqueado');
				inf_nivel( idEspacioActual, $(this).attr('id-localidad'), $(this).attr('id-nivel'), $(this).attr('nnivel'));
				updateInfo();					
			} 

			if ( $(this).attr('estado') == 'Bloqueado') {
				$('.hora_estado').text("Llegada"); // Llegada / Salida	
			}else if ( $(this).attr('estado') == 'Ocupado') {
				$('.hora_estado').text("Salida"); // Llegada / Salida
			}
			
			$('#parking').hide();
    		$('#ticket').fadeToggle();
		}					
		
		// VALIDANDO CLICK SOBRE EL BOTON ASIGNAR
		if ( $(this).attr('data-type') == "asignarEspacio" ) {
			
			// var placa = $('input[name=placa]').val().toUpperCase();						

			$('.placa').text( $('input[name=placa]').val().toUpperCase() );
			$('#'+idEspacioActual).attr('placa', $('input[name=placa]').val().toUpperCase() );

			var hora_estado = "";
			// alert('HORA ESTADO: '+$('.hora_estado').text());
			if ( $('.hora_estado').text() == 'Llegada') {
				hora_estado = "1"; // Llegada / Salida	
			}else if ( $('.hora_estado').text() == 'Salida') {
				hora_estado = "2"; // Llegada / Salida
			}						

			if ( $('#asignar').attr('Value') == 'Asignar') { 
				// alert('Asignando Espacio');
				$('#placa').show();
				$('#asignar').attr('Value', 'Liberar');
				$('#'+idEspacioActual).removeClass('amarillo').addClass('rojo');

				estado_espacio( idEspacioActual, 'amarillo', 'rojo');
				cambiarEstado( idEspacioActual, 3, 'Ocupado');
				inf_nivel( idEspacioActual, $('#'+idEspacioActual).attr('id-localidad'), $('#'+idEspacioActual).attr('id-nivel'), $('#'+idEspacioActual).attr('nnivel'));
				updateInfo();
				verificarPlaca( $('input[name=placa]').val().toUpperCase(), hora_estado );
				
			}else{
				// alert('Liberando Espacio');	
				$('#placa').hide();
				$('#asignar').attr('Value', 'Asignar');							
				$('#'+idEspacioActual).removeClass('rojo').addClass('verde');

				estado_espacio( idEspacioActual, 'rojo', 'verde');
				cambiarEstado( idEspacioActual, 1, 'Disponible');
				inf_nivel( idEspacioActual, $('#'+idEspacioActual).attr('id-localidad'), $('#'+idEspacioActual).attr('id-nivel'), $('#'+idEspacioActual).attr('nnivel'));
				updateInfo();
				salida( $('input[name=placa]').val().toUpperCase() );	
			}			

			$('#parking').fadeToggle();
    		$('#ticket').hide();					
		}					

		if ( $(this).attr('data-type') == "cancelarEspacio" ) {
			// cambiar estado a Bloqueado a Disponible en la BD	
			if ( $('#'+idEspacioActual).attr('estado') == 'Bloqueado') {	

				estado_espacio( idEspacioActual, 'amarillo', 'verde');				
				cambiarEstado( idEspacioActual, 1, 'Disponible' );
				inf_nivel( idEspacioActual, $('#'+idEspacioActual).attr('id-localidad'), $('#'+idEspacioActual).attr('id-nivel'), $('#'+idEspacioActual).attr('nnivel'));
				updateInfo();
				$('#'+idEspacioActual).removeClass('amarillo').addClass('verde');
			}

			$('#parking').fadeToggle();
    		$('#ticket').hide();						
		}

		
		if ( $(this).attr('data') == "ver_localidad" ) {
		 	// alert("ver_localidad");
		// 	// $('.localidad').hide();
		// 	// $('#localidad'+$(this).attr('data-id')).fadeToggle();						
		// 	$('#localidad'+$(this).attr('data-id')).show();
		}

		if ( $(this).attr('data') == "ver_nivel" ) {			
			$('.puestos').slideUp();			
			$('#puestos'+$(this).attr('data-id')).slideDown();					
		}					
	});

	function verificarPlaca(placa, hora_estado) {
		// Se verifica la placa y se crea el historial
		if ( placa != '' ) {
			// Variables para crear el historial
			var id_usuario = $('#id_user').attr('id_user');
			var id_localidad = $('#'+idEspacioActual).attr('id-localidad');
			var id_nivel = $('#'+idEspacioActual).attr('id-nivel');
			var espacio_nombre = $('#'+idEspacioActual).attr('spacio');
			var espacio_estado = $('#'+idEspacioActual).attr('id-estado');
			var fecha = $('.fecha').text();
			var hora = $('.hora').text();					

			// Se envia la placa para obtener el id
			// Y se envian las variables para CREAR el HISTORIAL
			// alert('N° Placa: '+placa);
			var id_historial = '';
			var data = {
					placa: 			placa,
					id_usuario: 	id_usuario,
					id_localidad: 	id_localidad,
					id_nivel: 		id_nivel,
					espacio_nombre: espacio_nombre,
					espacio_estado: espacio_estado,
					fecha_llegada: 	fecha,
					hora_llegada: 	hora								
				};

			$.ajax({ 
				async: false,
				url: '../config/app.php',
			    data: data,
			    type: 'GET',
			  	success: function(response) {						        
			        id_historial = $.trim(response);
			        console.log("ID HISTORIAL: "+id_historial);										
					$('#'+idEspacioActual).attr('id-historial', id_historial);
			    }
			});						
		}			
	}

	function salida( placa ){
		if ( placa != '' ) {
			var id_historial = $('#'+idEspacioActual).attr('id-historial');
			var fecha_salida = $('.fecha').text();
			var hora_salida = $('.hora').text();
			// fecha y hora llegada
			ajax(
				false,
				'../config/app.php', 
				{								
					id_historial : id_historial,								
					fecha_salida : fecha_salida,
					hora_salida  : hora_salida								
				},							
				'GET'
			);
		}
	} 

	function cambiarEstado(idObj, idEstado, estado) {					
		// Cambiar de estado al objeto
		console.log('Cambiando '+idObj+' estado '+estado);
		$('#'+idObj).attr('id-estado', idEstado);
		$('#'+idObj).attr('estado', estado);						
		ajax( false, 
			'../config/app.php', 
			{ 
				estado:     $('#'+idObj).attr('id-estado'),
				id_espacio: $('#'+idObj).attr('id-espacio') 
			}, 
			'post'
		);
	}
		
	$('#btnVerNivel').click( function(){					
		$('.puestos').slideDown();
	});

	function showForm(){
		$('#ticket').slideDown();
		$('#placa').focus();
	}

	function hideForm(){
		$('#ticket').slideUp();
	}

	$('#closeSesionesBtn').click(function(){
		// alert("Saliendo del sistema..");
	    document.location = "../config/cerrarSesion.php";
	});

	function ajax(async, url, data, type){
		$.ajax({ 
			async: async,
			url: url,
		    data: data,
		    type: type,
		  	success: function(response) {
		        // alert('Response AJAX'+response);
		        return response;
		    }
		});
	}	
});