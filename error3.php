<!DOCTYPE html>
<html>
<head>
	<title>Error</title>
</head>
<body>
	<?php 
	include("clases.php");
	include("conexionBD.php");
	$id1 = $_GET["id1"]; //Se recupera el id del alumno seleccionado
	$id2 = $_GET["id2"];
	$sql = "SELECT * FROM alumno WHERE id='".$id1."'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$alumno = new Alumno($row["id"], $row["apellido"], $row["nombre"], $row["edad"], $row["email"]);
	$sql2 = "SELECT * FROM materia WHERE id='".$id2."'";
	$result2 = $conn->query($sql2);
	$row2 = $result2->fetch_assoc();
	$materia = new Materia($row2["id"], $row2["nombre"], $row2["curso"], $row2["carrera"]);
	echo "<h2>El alumno ".$alumno->get_apellido()." ".$alumno->get_nombre()." ya se encuentra inscripto en la materia ".$materia->get_nombre()." de la carrera ".$materia->get_carrera()."</h2>";
	$conn->close();
	?>
	<form method="post" action="inscripcionMenu2.php"> <!-- Se ofrece volver a seleccionar una materia conservando el id del alumno seleccionado -->
		<input type="hidden" name="id1" value="<?php echo $id1; ?>">
		<input type="submit" name="volver" value="Volver a seleccionar materia">
	</form>
	<br><br>
	<a href="inscripcionMenu.php">Volver a seleccionar un alumno</a>	
	<br><br>
	<a href="menuPrincipal.php">Volver al menu principal</a>
</body>
</html>