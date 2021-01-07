<!DOCTYPE html>
<html>
<head>
	<title>Modificar materia</title>
</head>
<body>
	<?php  
	include("clases.php");
	include("conexionBD.php");
	$id = $_GET["id"];
	$sql= "SELECT * FROM materia WHERE id='".$id."'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$materia = new Materia($row["id"], $row["nombre"], $row["curso"], $row["carrera"]);

	$conn->close();
	?>
	<h2>Ingrese los nuevos datos</h2>
	<form method="post" action="actualizadoMateria.php">
		<input type="hidden" name="id" value="<?php echo $materia->get_id() ?>">
		Nombre: <input type="text" name="nombre" value="<?php echo $materia->get_nombre() ?>">
 		<br><br>
  		Curso: <input type="text" name="curso" value="<?php echo $materia->get_curso() ?>">
  		<br><br>
  		Carrera: <input type="text" name="carrera" value="<?php echo $materia->get_carrera() ?>">
  		<br><br>
  		<input type="submit" name="submit" value="Actualizar">
  		<br><br>
	</form>
	<a href="editarMateriaMenu.php">Volver a seleccionar</a><br><br>
	<a href="menuPrincipal.php">Volver al menu principal</a>
</body>
</html>