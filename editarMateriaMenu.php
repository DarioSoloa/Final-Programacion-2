<!DOCTYPE html>
<html>
<head>
	<title>Modificar materia</title>
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
	<h1>Modificar datos de una materia</h1>
	<h2>Seleccione la materia que desea modificar</h2>

	<?php
	include("clases.php");
	include("conexionBD.php");
	$sql = "SELECT id, nombre, curso, carrera FROM materia"; //Se ejecuta la consulta que trae todos las materias con sus datos
	$result = $conn->query($sql);
	$dir = array();
	$cont = 0;
	while($row = $result->fetch_assoc()){ //Se guarda en un array de objetos de tipo Materia todos las materias de la BD
		$materia = new Materia($row["id"], $row["nombre"], $row["curso"], $row["carrera"]);
		$dir[$cont] = $materia;
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
					<th>CURSO</th>
					<th>CARRERA</th>
					<th>ACCIONES</th>					
				</tr>
			</thead>
			<tbody>
				<?php for($i=0; $i < sizeof($dir); $i++) { //Se recorre el array de materias para mostrar todas las materias en una tabla
				?>
				<tr>
					<td><?php echo $dir[$i]->get_id() ?></td>
					<td><?php echo $dir[$i]->get_nombre() ?></td>
					<td><?php echo $dir[$i]->get_curso(); ?></td>
					<td><?php echo $dir[$i]->get_carrera() ?></td>
					<td><a href="editarMateria.php?id=<?php echo $dir[$i]->get_id() ?>">Editar</a></td> <!-- Al dar click en Editar se redirecciona al archivo en donde se va a editar la materia capturando y enviando el id de la materia seleccionada -->
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<br><br>
	<a href="menuPrincipal.php">Volver al menu principal</a>

</body>
</html>