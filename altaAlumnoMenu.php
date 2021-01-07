<!DOCTYPE html>
<html>
<head>
	<title>Alta de alumno</title>
</head>
<body>
	<h1>Alta de alumno</h1>
	<h2>Ingrese los datos del alumno</h2>
	<form method="post" action="altaAlumno.php">
		Nombres: <input type="text" name="nombres">
 		<br><br>
  		Apellido: <input type="text" name="apellido">
  		<br><br>
  		Edad: <input type="text" name="edad">
  		<br><br>
  		E-mail: <input type="text" name="email">
  		<br><br>
  		<input type="submit" name="submit" value="Cargar datos">
  		<br><br>
	</form>
	<a href="menuPrincipal.php">Volver al menu principal</a>
</body>
</html>