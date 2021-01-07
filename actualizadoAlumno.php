<!DOCTYPE html>
<html>
<head>
	<title>Actaulizar alumno</title>
</head>
<body>
	<?php  
	include("clases.php");
	include("conexionBD.php");
	$nombresErr = $apellidoErr = $emailErr = $edadErr = ""; //Variables para guardar errores que seran mostrados posteriormente
	$nombres = $apellido = "nada"; //Variables para almacenar el nombre y el apellido para ser controlados posteriormente
	$alumnoN = new Alumno($_POST["id"], $apellido, $nombres, "nada", "nada"); //Se declara e instancia un objeto de tipo Alumno con valores "nada" y el id recibido para una condicion posterior

	if ($_SERVER["REQUEST_METHOD"] == "POST") {//Filtrado de los datos ingresados
  		if (empty($_POST["nombre"])) {   
  			$nombresErr = "Se requiere al menos un nombre";
  		} else {
    		$nombres = test_input($_POST["nombre"]);    		
    		if (!preg_match("/^[a-zA-Z ]*$/",$nombres)) { 
    			$nombresErr = "Solo se permiten letras y espacios vacios en Nombres"; 
    		}else{
          		$alumnoN->set_nombre($nombres); 
    		}
  		}
  		if (empty($_POST["email"])) { 
  			$emailErr = "Se requiere un e-mail";
  		} else if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        	$alumno->set_email(test_input($_POST["email"]));    		
  		} else {
        	$emailErr = "Formato de E-mail invalido";
        }	
  		if (empty($_POST["apellido"])) { 
  			$apellidoErr="Se requiere un apellido";
  		} else {   
  			$apellido = test_input($_POST["apellido"]);
  			if (!preg_match("/^[a-zA-Z ]*$/",$apellido)) { 
    			$apellidoErr = "Solo se permiten letras y espacios vacios en Apellido"; 
    		}else{
          		$alumnoN->set_apellido($apellido);
    		}
  		}
  		if (empty($_POST["edad"])) {
  			$edadErr="Se requiere una edad";
  		}else if(is_numeric($_POST["edad"])){
        	$alumno->set_edad(test_input($_POST["edad"]));
  		}else{
        	$edadErr = "Solo se permiten valores numéricos en edad";
      	}
	}

	function test_input($data) {
  		$data = trim($data);
  		$data = stripslashes($data);
  		$data = htmlspecialchars($data);
  		return $data;
	}

	//Si al final del filtrado el objeto alumno presenta algun/os atributo/s con valor "nada" se guarda el error en el estado de la operacion de no ser asi se efectua la modificacion
	if ($alumnoN->get_nombre() != "nada" && $alumnoN->get_apellido() != "nada" && $alumnoN->get_edad() != "nada" && $alumnoN->get_email() != "nada") {
		$sql2 = "UPDATE alumno SET apellido='".$alumnoN->get_apellido()."', nombre='".$alumnoN->get_nombre()."', edad='".$alumnoN->get_edad()."', email='".$alumnoN->get_email()."' WHERE id='".$alumnoN->get_id()."'";
		$conn->query($sql2);
		$connEstado="Datos actualizados correctamente";
	}else{
		$connEstado="Error al actualizar datos";
	}

	$conn->close();
	?>

	<h2><?php echo $connEstado ?></h2>
	<!-- Abajo se muestran los errores que ocurrieron durante el filtrado, si no hubo ninguno no se muestra nada ya que las variable quedaron vacias -->
	<p style="color:red;"><?php echo $nombresErr ?><br><?php echo $apellidoErr ?><br><?php echo $edadErr ?><br><?php echo $emailErr ?><br></p>
	<a href="editarAlumnoMenu.php">Modificar otro alumno</a><br><br>
	<a href="menuPrincipal.php">Volver al menu principal</a>
</body>
</html>