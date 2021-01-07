<!DOCTYPE html>
<html>
<head>
	<title>Modificar alumno</title>
</head>
<body>
	<?php  
	include("clases.php");
	include("conexionBD.php");
	$id = $_GET["id"]; //Se obtiene el id del alumno capturado en el archivo anterior
	$sql= "SELECT * FROM alumno WHERE id='".$id."'";
	$result = $conn->query($sql); //Se efectua la consulta a la BD con el id del alumno seleccionado
	$row = $result->fetch_assoc();
	$alumno = new Alumno($row["id"], $row["apellido"], $row["nombre"], $row["edad"], $row["email"]); //Se crea e instancia un objeto de tipo Alumno con los valores obtenidos de la consulta

	$conn->close();
	?>
	<h2>Ingrese los nuevos datos</h2>
	<!-- Se muestran cajas de texto editables con los datos del alumno para que puedan ser editadas -->
	<form method="post" action="actualizadoAlumno.php">
		<input type="hidden" name="id" value="<?php echo $alumno->get_id() ?>"> <!-- El id permanece oculto ya que no se debe editar y sera utilizado en el proximo archivo para efectuar la modificacion -->
		Nombre: <input type="text" name="nombre" value="<?php echo $alumno->get_nombre() ?>">
 		<br><br>
  		Apellido: <input type="text" name="apellido" value="<?php echo $alumno->get_apellido() ?>">
  		<br><br>
  		Edad: <input type="text" name="edad" value="<?php echo $alumno->get_edad() ?>">
  		<br><br>
  		E-mail: <input type="text" name="email" value="<?php echo $alumno->get_email() ?>">
  		<br><br>
  		<input type="submit" name="submit" value="Actualizar">
  		<br><br>
	</form>
	<a href="editarAlumnoMenu.php">Volver a seleccionar</a><br><br>
	<a href="menuPrincipal.php">Volver al menu principal</a>
</body>
</html>