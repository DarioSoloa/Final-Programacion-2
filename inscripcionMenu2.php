<!DOCTYPE html>
<html>
<head>
	<title>Inscripción a materia</title>
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
	<h1>Inscripcion a materia</h1>
	
	<?php 
	include("clases.php");
	include("conexionBD.php");
	$id1 = $_POST["id1"]; //Se recibe el id del alumno y se lo guarda en id1
	if (empty($id1) || $id1 == 0) { //Se comprueba que el id no este vacio ni sea 0
		header("Location: error.php"); //De ser asi se redirecciona una pagina de error con opciones
	}

	$sql = "SELECT id, nombre, curso, carrera FROM materia";
	$result = $conn->query($sql); //Se tran todas las materias de la BD
	$dir = array();
	$cont = 0;
	while($row = $result->fetch_assoc()){ //Se guardan las materias en un array
		$materia = new Materia($row["id"], $row["nombre"], $row["curso"], $row["carrera"]);
		$dir[$cont] = $materia;
		$cont++;
	}

	$sql2 = "SELECT * FROM alumno WHERE id='".$id1."'";
	$result2 = $conn->query($sql2);
	$row2 = $result2->fetch_assoc();
	$alumno = new Alumno($row2["id"], $row2["apellido"], $row2["nombre"], $row2["edad"], $row2["email"]);

	echo "<h2>Seleccione la materia en la que desea inscribir al alumno ".$alumno->get_apellido()." ".$alumno->get_nombre()."</h2>";
	
	$conn->close();
	?>
	<br>
	<div>
		<form method="post" action="inscripcionAlta.php">
		<table style="width: 100%">
			<thead>
				<tr>
					<th>SELECCION</th>
					<th>ID</th>
					<th>NOMBRE</th>
					<th>CURSO</th>
					<th>CARRERA</th>									
				</tr>
			</thead>
			<tbody>
				<?php for($i=0; $i < sizeof($dir); $i++) { //Se recorre el array de materias para mostrarlas
				?>
				<tr>
					<td><input type="radio" name="id2" value="<?php echo $dir[$i]->get_id(); ?>"></td> <!-- El usuario seleccionara UNA materia para inscribir al alumno seleccionado mediate esta casilla en la cual se guardara el id de la materia -->
					<td><?php echo $dir[$i]->get_id() ?></td>
					<td><?php echo $dir[$i]->get_nombre() ?></td>
					<td><?php echo $dir[$i]->get_curso(); ?></td>
					<td><?php echo $dir[$i]->get_carrera() ?></td>					
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<br>
		<input type="hidden" name="id1" value="<?php echo $id1; ?>"> <!-- Se crea un input invisible donde se guardara el id del alumno para ser enviado junto con el id de la materia -->
		<input type="submit" name="continuar" value="Inscribir">
		</form>
	</div>
	<br><br>
	<a href="inscripcionMenu.php">Volver a seleccion de alumno</a><br><br>
	<a href="menuPrincipal.php">Volver al menu principal</a>
</body>
</html>