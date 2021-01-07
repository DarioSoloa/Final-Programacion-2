<!DOCTYPE html>
<html>
<head>
	<title>Actualizar materia</title>
</head>
<body>
	<?php  
	include("clases.php");
	include("conexionBD.php");
	$nombreErr = $cursoErr = $carreraErr = ""; //Variables para guardar errores que seran mostrados posteriormente
	$materiaN = new Materia($_POST["id"], "nada", "nada", "nada"); //Se declara e instancia un objeto de tipo Materia con valores "nada" y el id recibido para una condicion posterior

	if ($_SERVER["REQUEST_METHOD"] == "POST") { //Filtrado de los datos ingresados
  		if (empty($_POST["nombre"])) {   
  			$nombreErr = "Se requiere el nombre de la materia";
  		} else {
          	$materiaN->set_nombre(test_input($_POST["nombre"]));
  		}
  		if (empty($_POST["curso"])) { 
  			$cursoErr = "Se requiere el nombre del curso";
  		} else {
        	$materiaN->set_curso(test_input($_POST["curso"]));    		
  		} 
  		if (empty($_POST["carrera"])) {
  			$carreraErr="Se requiere el nombre de la carrera";
  		}else{
        	$materiaN->set_carrera(test_input($_POST["carrera"]));
  		}
	}

	function test_input($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
	}

	//Si al final del filtrado el objeto materia presenta algun/os atributo/s con valor "nada" se guarda el error en el estado de la operacion de no ser asi se efectua la modificacion
	if ($materiaN->get_nombre() != "nada" && $materiaN->get_curso() != "nada" && $materiaN->get_carrera() != "nada") {
		$sql2 = "UPDATE materia SET nombre='".$materiaN->get_nombre()."', curso='".$materiaN->get_curso()."', carrera='".$materiaN->get_carrera()."' WHERE id='".$materiaN->get_id()."'";
		$conn->query($sql2);
		$connEstado="Datos actualizados correctamente";
	}else{
		$connEstado="Error al actualizar datos";
	}

	$conn->close();
	?>

	<h2><?php echo $connEstado ?></h2>
	<!-- Abajo se muestran los errores que ocurrieron durante el filtrado, si no hubo ninguno no se muestra nada ya que las variable quedaron vacias -->
	<p style="color:red;"><?php echo $nombreErr ?><br><?php echo $cursoErr ?><br><?php echo $carreraErr ?><br></p>
	<a href="editarMateriaMenu.php">Modificar otra materia</a><br><br>
	<a href="menuPrincipal.php">Volver al menu principal</a>
</body>
</html>