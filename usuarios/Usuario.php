<?php 

include_once("../core/DBAbstractModel.php");
class Usuario extends DBAbstractModel{
	public  $nombre;
	public $apellido;
	public $email;
	private $clave;
	protected $id;

	public function get($user_email=""){
		if($user_email != ''){
			$this->query="SELECT  
			id, nombre, apellido, email, clave 
			FROM usuarios 
			WHERE email='$user_email'";

		}
		$this->get_result_from_query();
		if(count($this->rows)== 1){
			foreach ($this->rows[0] as $propiedad => $valor) {
				$this->$propiedad=$valor;
			}
			$this->mensaje='Usuario encontrado';
		}else{
			$this->mensaje='usuario no encontrado';
		}
		
	}

	public function set($user_data=array()){
		if(array_key_exists('email', $user_data)){
			$this->get($user_data['email']);
			if($user_data['email'] != $this->email){
				foreach($user_data as $campo=>$valor){
					$$campo= $valor;
				}
				$this->query="INSERT INTO usuarios (nombre, apellido, email, clave) VALUES ('$nombre','$apellido', '$email', 'clave')";
				$this->execute_single_query();
				$this->mensaje='Usuario agregado correctamente';
			}else{
				$this->mensaje='El Usuario ya existe';
			}

			
		}else{
			$this->mensaje='No se ha agregado al usuario';
		}
	}


	public function edit($user_date=array()){
		foreach($user_data as $campo=>$valor){
			$$campo=$valor;
		}
		$this->query="UPDATE usuarios
		 SET nombre='$nombre', apellido='apellido'
		 WHERE email='$email'";

		 $this->execute_single_query();
		 $this->mensaje="Usuario modificado";



	}

	public function delete($user_email=''){
		$this->query="DELETE FROM usuarios 
		WHERE email ='$user_email'";

		$this->execute_single_query();
		$this->mensaje='Usuario Eliminado';
	}

	public function __construct(){
		$this->dbname='book_example';
	}


	public function __destruct(){
		unset($this);
	}

} 
	





?>