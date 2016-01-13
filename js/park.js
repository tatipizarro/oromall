$(document).on("ready",function (){
				var idEspacioActual = '';
				var id_usuario = '';
				$('input').click(function() { 

					$(this).attr('id-usuario', $('#id_user').attr('id_user'));

					var fecha = new Date();
					var dia = fecha.getDay() 
					var mes = fecha.getMonth();
					var ano = fecha.getFullYear(); 
					var hora = fecha.getHours();
					var minuto = fecha.getMinutes();
					var segundo = fecha.getSeconds();
					// alert(fecha);					
					$('.nLocalidades').text($(this).attr('nLocalidades'));
					$('.nNivel').text($(this).attr('nnivel'));
					$('.spacio').text($(this).attr('spacio'));
					$('.placa').text($(this).attr('placa'));
					$('.fecha').text(ano+'-'+mes+'-'+dia);
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
						if ( $(this).attr('estado') == 'Disponible'){
							$('#'+idEspacioActual).removeClass('verde').addClass('amarillo');
							cambiarEstado( idEspacioActual, 2, 'Bloqueado');
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
							$('#asignar').attr('Value', 'Liberar');
							$('#'+idEspacioActual).removeClass('amarillo').addClass('rojo');
							cambiarEstado( idEspacioActual, 3, 'Ocupado');
							
						}else{
							// alert('Liberando Espacio');						
							$('#asignar').attr('Value', 'Asignar');							
							$('#'+idEspacioActual).removeClass('rojo').addClass('verde');
							cambiarEstado( idEspacioActual, 1, 'Disponible');
							
						}

						verificarPlaca( $('input[name=placa]').val().toUpperCase(), hora_estado );

						$('#parking').fadeToggle();
                		$('#ticket').hide();					
					}					

					if ( $(this).attr('data-type') == "cancelarEspacio" ) {
						// cambiar estado a Bloqueado a Disponible en la BD	
						if ( $('#'+idEspacioActual).attr('estado') == 'Bloqueado') {								
							cambiarEstado( idEspacioActual, 1, 'Disponible' );
							$('#'+idEspacioActual).removeClass('amarillo').addClass('verde');
						}

						$('#parking').fadeToggle();
                		$('#ticket').hide();						
					}					
				});

				function verificarPlaca(placa, hora_estado) {
					// Se verifica la placa y se crea el historial
					if ( placa != '' ) {
						// Variables para crear el historial

						var id_usuario = $('#id_user').attr('id_user');

						var id_Localidades = $('#'+idEspacioActual).attr('id-Localidades');
						var id_nivel = $('#'+idEspacioActual).attr('id-nivel');
						var espacio_nombre = $('#'+idEspacioActual).attr('spacio');
						var espacio_estado = $('#'+idEspacioActual).attr('id-estado');
						var fecha = $('.fecha').text();
						var hora = $('.hora').text();					

						// Se envia la placa para obtener el id
						// Y se envian las variables para CREAR el HISTORIAL
						// alert('N° Placa: '+placa);
						
						ajax(
							false,
							'../config/app.php', 
							{
								placa: 			placa,
								id_usuario: 	id_usuario,
								id_Localidades: 	id_Localidades,
								id_nivel: 		id_nivel,
								espacio_nombre: espacio_nombre,
								espacio_estado: espacio_estado,
								fecha: 			fecha,
								hora: 			hora,
								hora_estado: 	hora_estado
							},							
							'GET'
						);						
					}else{
						alert("Ingrese placa");
					}					
				}

				function cambiarEstado(idObj, idEstado, estado) {					
					// Cambiar de estado al objeto
					console.log('Cambiando '+idObj+' estado '+estado);
					$('#'+idObj).attr('id-estado', idEstado);
					$('#'+idObj).attr('estado', estado);						
					ajax( false, 
						'<?php echo URL ?>config/app.php', 
						{ estado:     $('#'+idObj).attr('id-estado'),
						  id_espacio: $('#'+idObj).attr('id-espacio') }, 
						'post'
					);
				}
				
				$('#asignar').click( function(){
					// hideForm();					
				});
				$('#cancelar').click( function(){					
					// hideForm();
				});
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
				    document.location = "<?php echo URL; ?>config/cerrarSesion.php";
				});

				function ajax(async, url, data, type){
					$.ajax({ 
						async: async,
						url: url,
					    data: data,
					    type: type,
					  	success: function(response) {
					        // alert('Response AJAX'+response);
					        // return response;
					    }
					});
				}
			});