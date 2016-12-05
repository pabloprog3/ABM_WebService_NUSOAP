<form method="post">

	<div class="form-group"  style="width:250px">
		<h2>Final de Programacion 3</h2>
		
		<p id="mensajeError"></p>
		<br>
		<input type="text" class="form-control" name="correo" id="correo" placeholder="Correo Electrónico">
		<br>
		<input type="password" class="form-control" name="clave" id="clave" placeholder="Clave">
		<br>
		<input type="checkbox" class="checkbox-inline" name="recordarme" id="recordarme" checked>Recordarme
		<br><br>
		<input  type="button" class="btn btn-primary" name="comp" id="comp" value="Comprador" onclick="CargarComprador()">
		<input  type="button" class="btn btn-primary" name="admin" id="admin" value="Administrador" onclick="CargarAdmin()">
		<input  type="button" class="btn btn-primary" name="vend" id="vend" value="Vendedor" onclick="CargarVendedor()">
		<br><br>
		<input type="button" class="btn btn-primary btn-block" name="Ingresar" id="Ingresar" value="Ingresar" onclick="ingresar()">
		<br>
		
	</div>

</form>