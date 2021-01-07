<!DOCTYPE html>
<html>
<head>
	<title>Alta de alumno</title>
</head>
<body>
	<?php  
	include("clases.php");
	include("conexionBD.php");
	$nombresErr = $apellidoErr = $emailErr = $edadErr = ""; //Variables para guardar errores que seran mostrados posteriormente
	$nombres = $apellido = "nada"; //Variables para almacenar el nombre y el apellido para ser controlados posteriormente
	$alumno = new Alumno(0, $apellido, $nombres, "nada", "nada"); //Se declara e instancia un objeto de tipo Alumno con valores "nada" para una condicion posterior

	if ($_SERVER["REQUEST_METHOD"] == "POST") { //Filtrado de los datos ingresados
  		if (empty($_POST["nombres"])) {   
  			$nombresErr = "Se requiere al menos un nombre";
  		} else {
    		$nombres = test_input($_POST["nombres"]);    		
    		if (!preg_match("/^[a-zA-Z ]*$/",$nombres)) { 
    			$nombresErr = "Solo se permiten letras y espacios vacios en Nombres"; 
    		}else{
          		$alumno->set_nombre($nombres); 
    		}
  		}
  		if (empty($_POST["email"])) { 
  			$emailErr = "Se requiere un e-mail";
  		} else if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
        	$alumno->set_email(test_input($_POST["email"]));    		
  		} else{
        $emailErr = "Formato de E-mail invalido";
      }  		
  		if (empty($_POST["apellido"])) { 
  			$apellidoErr="Se requiere un apellido";
  		} else {   
  			$apellido = test_input($_POST["apellido"]);
  			if (!preg_match("/^[a-zA-Z ]*$/",$apellido)) { 
    			$apellidoErr = "Solo se permiten letras y espacios vacios en Apellido"; 
    		}else{
          		$alumno->set_apellido($apellido);
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

  //Si al final del filtrado el objeto alumno presenta algun/os atributo/s con valor "nada" se guarda el error en el estado de la operacion de no ser asi se efectua el alta
	if ($alumno->get_nombre() != "nada" && $alumno->get_apellido() != "nada" && $alumno->get_edad() != "nada" && $alumno->get_email() != "nada") {
		$sql = "INSERT INTO alumno(apellido,nombre,edad,email) VALUES ('".$alumno->get_apellido()."', '".$alumno->get_nombre()."', ".$alumno->get_edad().", '".$alumno->get_email()."')";
		$result = $conn->query($sql);
		$connEstado="Datos cargados correctamente";
	}else{
		$connEstado="Error al cargar datos";
	}

	$conn->close();
	?>

	<h2><?php echo $connEstado ?></h2>
  <!-- Abajo se muestran los errores que ocurrieron durante el filtrado, si no hubo ninguno no se muestra nada ya que las variable quedaron vacias -->
	<p style="color:red;"><?php echo $nombresErr ?><br><?php echo $apellidoErr ?><br><?php echo $edadErr ?><br><?php echo $emailErr ?><br></p>
	<a href="altaAlumnoMenu.php">Cargar un nuevo alumno</a><br><br>
	<a href="menuPrincipal.php">Volver al menu principal</a>
</body>
</html>