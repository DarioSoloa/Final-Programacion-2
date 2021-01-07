<!DOCTYPE html>
<html>
<head>
	<title>Alta de materia</title>
</head>
<body>
	<?php  
	include("clases.php");
	include("conexionBD.php");
	$nombreErr = $cursoErr = $carreraErr = ""; //Variables para guardar errores que seran mostrados posteriormente
	$materia = new Materia(0, "nada", "nada", "nada");//Se declara e instancia un objeto de tipo Materia con valores "nada" para una condicion posterior

	if ($_SERVER["REQUEST_METHOD"] == "POST") { //Filtrado de datos ingresados
  		if (empty($_POST["nombre"])) {   
  			$nombreErr = "Se requiere el nombre de la materia";
  		} else {
          	$materia->set_nombre(test_input($_POST["nombre"]));
  		}
  		if (empty($_POST["curso"])) { 
  			$cursoErr = "Se requiere el nombre del curso";
  		} else {
        	$materia->set_curso(test_input($_POST["curso"]));    		
  		} 
  		if (empty($_POST["carrera"])) {
  			$carreraErr="Se requiere el nombre de la carrera";
  		}else{
        	$materia->set_carrera(test_input($_POST["carrera"]));
  		}
	}

	function test_input($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
	}

	//Si al final del filtrado el objeto materia presenta algun/os atributo/s con valor "nada" se guarda el error en el estado de la operacion de no ser asi se efectua el alta
	if ($materia->get_nombre() != "nada" && $materia->get_curso() != "nada" && $materia->get_carrera() != "nada") {
		$sql = "INSERT INTO materia(nombre,curso,carrera) VALUES ('".$materia->get_nombre()."', '".$materia->get_curso()."', '".$materia->get_carrera()."')";
		$result = $conn->query($sql);
		$connEstado="Datos cargados correctamente";
	}else{
		$connEstado="Error al cargar datos";
	}

	$conn->close();
	?>

	<h2><?php echo $connEstado ?></h2>
	<!-- Abajo se muestran los errores que ocurrieron durante el filtrado, si no hubo ninguno no se muestra nada ya que las variable quedaron vacias -->
	<p style="color:red;"><?php echo $nombreErr ?><br><?php echo $cursoErr ?><br><?php echo $carreraErr ?><br></p>
	<a href="altaMateriaMenu.php">Cargar una nueva materia</a><br><br>
	<a href="menuPrincipal.php">Volver al menu principal</a>
</body>
</html>