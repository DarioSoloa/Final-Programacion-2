<!DOCTYPE html>
<html>
<head>
	<title>Listado de datos</title>
</head>
<body>
	<h1>Listado de alumnos y materias</h1>
	<a href="menuPrincipal.php">Volver al menu principal</a>
	<br><br>
	<?php
	include("clases.php");
	include("conexionBD.php");	

	$sql1 = "SELECT * FROM alumno";
	$result1 = $conn->query($sql1);
	$dir1 = array();

	$cont = 0;
	while($row = $result1->fetch_assoc()){ 
		$alumno = new Alumno($row["id"], $row["apellido"], $row["nombre"], $row["edad"], $row["email"]);
		$dir1[$cont] = $alumno;
		$cont++;
	}

	$sql2 = "SELECT * FROM materia";
	$result2 = $conn->query($sql2);
	$dir2 = array();

	$cont = 0;
	while($row = $result2->fetch_assoc()){ 
		$materia = new Materia($row["id"], $row["nombre"], $row["curso"], $row["carrera"]);
		$dir2[$cont] = $materia;
		$cont++;
	}

	$sql3 = "SELECT * FROM inscripcion";
	$result3 = $conn->query($sql3);
	$dir3 = array();

	$cont = 0;
	while($row = $result3->fetch_assoc()){ 
		$inscripcion = new Inscripcion($row["id_Alumno"], $row["id_Materia"]);
		$dir3[$cont] = $inscripcion;
		$cont++;
	}


	echo "<h2>Materias</h2>";
	for($i=0; $i < sizeof($dir2); $i++){
		echo "<br>";
		echo "<b>Id: ".$dir2[$i]->get_id()."</b>  <b>|| Nombre:</b> ". $dir2[$i]->get_nombre()."  <b>|| Curso:</b> ". $dir2[$i]->get_curso()."  <b>|| Carrera:</b> ". $dir2[$i]->get_carrera();
		echo "<br>";
	}

	echo "<br><br>";

	echo "<h2>Alumnos</h2>";
	for($i=0; $i < sizeof($dir1); $i++){
		echo "<br><br>";
		echo "<b>Id: ".$dir1[$i]->get_id()."</b>  <b>|| Nombres:</b> ". $dir1[$i]->get_nombre()." <b>|| Apellido:</b> ". $dir1[$i]->get_apellido()." <b>|| Edad:</b> ". $dir1[$i]->get_edad()." años || <b>E-mail: </b>". $dir1[$i]->get_email();
		echo "<br><br>";
		echo "<u>Materias en las que esta inscripto/a:</u> ";
		for($j=0; $j < sizeof($dir3); $j++){
			if ($dir3[$j]->get_id_alumno() == $dir1[$i]->get_id()) {
				$idM = $dir3[$j]->get_id_materia();
				for ($k=0; $k < sizeof($dir2); $k++) { 
					if ($dir2[$k]->get_id() == $idM) {
						echo $dir2[$k]->get_nombre()." || ";
					}
				}
				
			}
		}
		echo "<br><br>";
	}
?>
</body>
</html>
