<!DOCTYPE html>
<html>
<head>
	<title>Inscripcion a materia</title>
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
	<h2>Seleccione el alumno que desea inscribir</h2>
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
		<form method="post" action="inscripcionMenu2.php">
		<table style="width: 100%">
			<thead>
				<tr>
					<th>SELECCION</th>
					<th>ID</th>
					<th>NOMBRE</th>
					<th>APELLIDO</th>
					<th>EDAD</th>
					<th>E-MAIL</th>										
				</tr>
			</thead>
			<tbody>
				<?php for($i=0; $i < sizeof($dir); $i++) { //Se recorre el array de alumnos para mostrar todos los alumnos en una tabla
				?>
				<tr>
					<td><input type="radio" name="id1" value="<?php echo $dir[$i]->get_id(); ?>"></td> <!-- El usuario seleccionara UN alumno para inscribir mediate esta casilla en la cual se guardara el id del alumno -->
					<td><?php echo $dir[$i]->get_id() ?></td>
					<td><?php echo $dir[$i]->get_nombre() ?></td>
					<td><?php echo $dir[$i]->get_apellido(); ?></td>
					<td><?php echo $dir[$i]->get_edad() ?></td>
					<td><?php echo $dir[$i]->get_email() ?></td>					
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<br>
		<input type="submit" name="continuar" value="Continuar ->">
		</form>
	</div>
	<br><br>
	<a href="menuPrincipal.php">Volver al menu principal</a>
</body>
</html>