<!DOCTYPE html>
<html>
<head>
	<title>Error</title>
</head>
<body>
	<!-- El usuario selecciono un alumno pero no selecciono ninguna materia -->
	<h2>Por favor seleccione una materia</h2>
	<?php 
	$id1 = $_GET["id1"]; //Se recupera el id del alumno seleccionado
	?>
	<form method="post" action="inscripcionMenu2.php"> <!-- Se ofrece volver a elegir una materia conservando el id del alumno seleccionado -->
		<input type="hidden" name="id1" value="<?php echo $id1; ?>">
		<input type="submit" name="volver" value="Volver a seleccionar materia">
	</form>
	<br><br>
	<a href="menuPrincipal.php">Volver al menu principal</a>
</body>
</html>