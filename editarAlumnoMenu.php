<!DOCTYPE html>
<html>
<head>
	<title>Modificar alumno</title>
</head>
<style type="text/css">
	table, th, td{
		border: 1px solid black;
		border-collapse: collapse;
	}
	th, td{
		padding: 10px;
		text-align: center;
	}
</style>
<body>
	<h1>Modificar datos de un alumno</h1>
	<h2>Seleccione el alumno que desea modificar</h2>

	<?php
	include("clases.php");
	include("conexionBD.php");
	$sql = "SELECT id, apellido, nombre, edad, email FROM alumno";
	$result = $conn->query($sql); //Se ejecuta la consulta que trae todos los alumnos con sus datos
	$dir = array();
	$cont = 0;
	while($row = $result->fetch_assoc()){ //Se guarda en un array de objetos de tipo Alumno todos los alumnos de la BD
		$alumno = new Alumno($row["id"], $row["apellido"], $row["nombre"], $row["edad"], $row["email"]);
		$dir[$cont] = $alumno;
		$cont++;
	}
	
	$conn->close();  
	?>

	<br>
	<div>
		<table style="width: 100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>NOMBRE</th>
					<th>APELLIDO</th>
					<th>EDAD</th>
					<th>E-MAIL</th>
					<th>ACCIONES</th>					
				</tr>
			</thead>
			<tbody>
				<?php for($i=0; $i < sizeof($dir); $i++) { //Se recorre el array de alumnos para mostrar todos los alumnos en una tabla
				?>
				<tr>
					<td><?php echo $dir[$i]->get_id() ?></td>
					<td><?php echo $dir[$i]->get_nombre() ?></td>
					<td><?php echo $dir[$i]->get_apellido(); ?></td>
					<td><?php echo $dir[$i]->get_edad() ?></td>
					<td><?php echo $dir[$i]->get_email() ?></td>
					<td><a href="editarAlumno.php?id=<?php echo $dir[$i]->get_id() ?>">Editar</a></td> <!-- Al dar click en Editar se redirecciona al archivo en donde se va a editar el alumno capturando y enviando el id del alumno seleccionado -->
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<br><br>
	<a href="menuPrincipal.php">Volver al menu principal</a>

</body>
</html>