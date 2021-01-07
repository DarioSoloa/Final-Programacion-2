<!DOCTYPE html>
<html>
<head>
	<title>Inscripcion alta</title>
</head>
<body>
	<?php  
	include("clases.php");
	include("conexionBD.php");
	$id1 = $_POST["id1"]; //Se recibe el id del alumno
	$id2 = $_POST["id2"]; //Se recibe el id de la materia
	
	if (empty($id2) || $id2 == 0) { //Se comprueba si el id de la materia esta vacio o es igual a 0
		header("Location: error2.php?id1=" .$_POST['id1']); //De ser asi se redirecciona a una pagina de error con opciones y tambien se envia el id del alumno
	}else{
	$sql1 = "SELECT * FROM inscripcion";
	$result1 = $conn->query($sql1); //Se traen de la BD todas las inscripciones
	$dir1 = array();
	$cont1 = 0;
	$estado = false; //Boolean inicializado en falso que se utilizara como condicion si el alunmo esta o no inscripto en la materia seleccionada
	while($row1 = $result1->fetch_assoc()){ //Se guardan en un array todas las inscripciones
		$inscripcion1 = new Inscripcion($row1["id_Alumno"], $row1["id_Materia"]);
		$dir1[$cont1] = $inscripcion1;
		$cont1++;
	}

	for($i=0; $i < sizeof($dir1); $i++){ //Se recorre el array de inscripciones...
		if ($dir1[$i]->get_id_alumno() == $id1 && $dir1[$i]->get_id_materia() == $id2) { //...preguntando si el alumno esta inscripto en la materia seleccionada
			$estado = true; //De ser asi el boolean pasa a verdadero			
		}
	}

	if ($estado == true) {
		header("Location: error3.php?id1=".$_POST['id1']." & id2=".$_POST['id2']); //Si el boolean es verdadero se redirecciona a una pagina de error con opciones y tambien se envia el id del alumno
	}else{
		$sql2 = "INSERT INTO inscripcion(id_Alumno, id_Materia) VALUES ('".$id1."', '".$id2."')";
		$result = $conn->query($sql2); //Si es falso entonces se ejecuta el alta de inscripcion
	}
	}	
	$conn->close();
	?>
	<h2>Inscripcion completada</h2>
	<form method="post" action="inscripcionMenu2.php"> <!-- Se da la opcion de inscribir al mismo alumno en otra materia regresando al menu anterior junto con el id del alumno -->
		<input type="hidden" name="id1" value="<?php echo $id1; ?>">
		<input type="submit" name="volver" value="Seleccionar otra materia">
	</form>
	<br><br>
	<a href="inscripcionMenu.php">Volver a seleccionar un alumno</a>	
	<br><br>
	<a href="menuPrincipal.php">Volver al menu principal</a>
</body>
</html>