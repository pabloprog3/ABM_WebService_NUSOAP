function volverIndice () 
{
	
	$.ajax({
		type:"post",
		url:"deslogearUsuario.php",	
		success: function () 
				{
					$('#msg').html('Usuario deslogeado exitosamente. Se ha borrado la cookie');
					window.location = "index.php";
				}

		});
}

function CargarComprador () 
{
	$('#correo').val("comp@comp.com");
	$('#clave').val("123");
}

function CargarVendedor () 
{
	$('#correo').val("vend@vend.com");
	$('#clave').val("321");
}

function CargarAdmin () 
{
	$('#correo').val("admin@admin.com");
	$('#clave').val("321");
}

function ingresar() 
{

	var correo = $('#correo').val();
	var pass = $('#clave').val();

	if ( $('#correo').val() == "" || $('#clave').val() == "" ) 
	{
	 	$('#mensajeError').html('Correo o Contraseña incorrectos. Por favor, intente nuevamente');
	}

	 else
	{
	 	var usuario = $('#correo').val();
	 	var clave = $('#clave').val();
	 	var sicookie='s';

	 	var respuesta="";

	 	$.ajax({
		type:"post",
		url:"login.php",
		data:{usuario:usuario, clave:clave, sicookie:sicookie},	
		success: function (resp) 
				{
					respuesta = resp.split('!');

					if (resp == "Usuario no encontrado")
						$('#msg').html("Usuario no se encuentra en el archivo de texto");
					else
					{
						$('#formularioLogin').hide();
						$('#footter').html("<input type='button' class='btn btn-danger btn-block' value='Deslogearse' onClick='volverIndice()' id='deslogin'>");
						$('#msg').html("Nombre del usuario: " + respuesta[0]); //traigo el nombre del usuario
						$('#msg').append(respuesta[1]); //traigo la tabla
						
					}
				},
		error: function  () {
			alert("error");
		}

		});

		

	}
	 
}

function CargarTabla () 
{
	var queHacer="cargarTabla";

	$.ajax({
		type:"post",
		url:"cliente.php",
		data:{queHago:queHacer},	
		success: function (resp) 
				{
				    
				    $('#msg').html(resp);					
				},
		error: function  () {
			alert("error");
		}

		});
}




function ingresarMaterial () 
{
	//$('#login').remove('div');
	$('#login').load("vistas/altaDeMaterial.html");
}

function guardarMaterial()
{
	var nombre = $('#nombre').val();
	var precio = $('#precio').val();
	var tipo= $("input[name='tipo']:checked").val();
	var queHacer="alta";

	$.ajax({
		type:"post",
		url:"cliente.php",
		data:{queHago:queHacer, nombre:nombre, precio:precio, tipo:tipo},	
		success: function (resp) 
				{
					
					$('#msg').hide();
					CargarTabla();

				},
		error: function  () {
			alert("error");
		}

		});

}



function sacarMaterial (idMaterial)
{


	$.ajax({
		type:"post",
		url:"cliente.php",
		data:{queHago:"borrar", id:idMaterial},	
		success: function (resp) 
				{
					CargarTabla();
				},
		error: function  () {
			alert("error");
		}

		});
}

function modificarMaterial (idMaterial)
{
	var queHacer = "modificar";

	$.ajax({
		type:"post",
		url:"cliente.php",
		data:{queHago:queHacer, id:idMaterial},
		dataType: "json",
		beforeSend: function () {
			
				$('#login').load("vistas/altaDeMaterial.html");	
			                    	
		},	
		success: function (data) 
				{
										 					
					 $('#nombre').val(data[0].nombre);
					 $('#precio').val(data[0].precio);

					 $('#nombre').attr('disabled',true);

					 if(data[0].tipo == 'liquido')
					 	$('#liquido').attr('checked', true);

					 
					 if(data[0].tipo == 'solido')
					 	$('#solido').attr('checked', true);


					 $('#ingresar').attr('value', 'Guardar Cambios');
					 $('#ingresar').attr('onClick', 'modificarBD(' + idMaterial + ')');
					 			
				},

			error: function (data) {
				console.info(data);
			}
		});
}


function modificarBD (idMaterial) 
{
	var nombre = $('#nombre').val();
	var precio = $('#precio').val();
	var tipo= $("input[name='tipo']:checked").val();
	var queHacer="modificarBD";

	$.ajax({
		type:"post",
		url:"cliente.php",
		data:{queHago:queHacer, nombre:nombre, precio:precio, tipo:tipo, id:idMaterial},	
		success: function (resp) 
				{	
					CargarTabla();				
					$('#login').hide();				

				},
		error: function  () {
			alert("error");
		}

		});

}


