<?php 
	//En este archivo se crea la conexion con la base de datos, se incluye en donde es necesario

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "ejercicio5-7_prog2";
	$connEstado = "";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
    	die("Conexion fallida: " . $conn->connect_error);
	} 
?>