<?php  
//En este archivo se crean todas las clases necesarias para trabajar con las consultas de una mejor manera, este archivo se incluye en donde es necesario

class Alumno{
	private $id = 0;
	private $apellido;
	private $nombre;
	private $edad;
	private $email;

	public function __construct($id, $apellido, $nombre, $edad, $email){
		$this->id = $id;
		$this->apellido = $apellido;
		$this->nombre = $nombre;
		$this->edad = $edad;
		$this->email = $email;
	}

	function set_id($id){
		$this->id = $id;
	}

	function get_id(){
		return $this->id;
	}

	function set_apellido($apellido){
		$this->apellido = $apellido;
	}

	function get_apellido(){
		return $this->apellido;
	}

	function set_nombre($nombre){
		$this->nombre = $nombre;
	}

	function get_nombre(){
		return $this->nombre;
	}

	function set_edad($edad){
		$this->edad = $edad;
	}

	function get_edad(){
		return $this->edad;
	}

	function set_email($email){
		$this->email = $email;
	}

	function get_email(){
		return $this->email;
	}
}

class Materia{
	private $id = 0;
	private $nombre;
	private $curso;
	private $carrera;

	public function __construct($id, $nombre, $curso, $carrera){
		$this->id = $id;
		$this->nombre = $nombre;
		$this->curso = $curso;
		$this->carrera = $carrera;
	}

	function set_id($id){
		$this->id = $id;
	}

	function get_id(){
		return $this->id;
	}

	function set_nombre($nombre){
		$this->nombre = $nombre;
	}

	function get_nombre(){
		return $this->nombre;
	}

	function set_curso($curso){
		$this->curso = $curso;
	}

	function get_curso(){
		return $this->curso;
	}

	function set_carrera($carrera){
		$this->carrera = $carrera;
	}

	function get_carrera(){
		return $this->carrera;
	}
}

class Inscripcion{
	private $id_alumno = 0;
	private $id_materia = 0;

	public function __construct($id_alumno, $id_materia){
		$this->id_alumno = $id_alumno;
		$this->id_materia = $id_materia;
	}

	function set_id_alumno($id_alumno){
		$this->id_alumno = $id_alumno;
	}

	function get_id_alumno(){
		return $this->id_alumno;
	}

	function set_id_materia($id_materia){
		$this->id_materia = $id_materia;
	}

	function get_id_materia(){
		return $this->id_materia;
	}
}
?>