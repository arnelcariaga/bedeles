<?php
require 'conn.php';
/**
 * Clase Modelo
 */
class model_class{

	//Funcion para obtener datos de PROFESOR
	private $entity;
	private $last_name;
	private $period;
	private $day;
	public function get_teacher_data($entity, $last_name, $period, $day){

		$conn = new Conexion();
		$return_conn = $conn->return_conn();
	
		$this->entity = $entity;
		$this->last_name = $last_name;
		$this->period = $period;
		$this->day = $day;

		$sth = $return_conn->prepare( "exec usp_consulta_profesor_entidad ?, ?, ?, ?" );
		$sth->bindParam( 1, $this->entity );
		$sth->bindParam( 2, $this->last_name );
		$sth->bindParam( 3, $this->period );
		$sth->bindParam( 4, $this->day );
		$sth->execute();

		return $sth;
	}

	//Funcion para obtener datos de SECCION
	private $section;
	public function get_section_data($entity, $section, $period, $day){

		$conn = new Conexion();
		$return_conn = $conn->return_conn();
	
		$this->entity = $entity;
		$this->section = $section;
		$this->period = $period;
		$this->day = $day;

		$sth = $return_conn->prepare( "exec usp_consulta_seccion_entidad ?, ?, ?, ?" );
		$sth->bindParam( 1, $this->entity );
		$sth->bindParam( 2, $this->section );
		$sth->bindParam( 3, $this->period );
		$sth->bindParam( 4, $this->day );
		$sth->execute();

		return $sth;
	}

	//Funcion para obtener datos de ASIGNATURAS
	private $subject;
	public function get_subject_data($entity, $subject, $period, $day){

		$conn = new Conexion();
		$return_conn = $conn->return_conn();
	
		$this->entity = $entity;
		$this->subject = $subject;
		$this->period = $period;
		$this->day = $day;

		$sth = $return_conn->prepare( "exec usp_consulta_asignatura_entidad ?, ?, ?, ?" );
		$sth->bindParam( 1, $this->entity );
		$sth->bindParam( 2, $this->subject );
		$sth->bindParam( 3, $this->period );
		$sth->bindParam( 4, $this->day );
		$sth->execute();

		return $sth;
	}

	//Funcion para obtener datos de PROFESOR al hacer click en uno de ellos
	private $teacher_cod;
	public function get_data_onclick_teacher($entity, $teacher_cod, $period, $day){

		$conn = new Conexion();
		$return_conn = $conn->return_conn();
	
		$this->entity = $entity;
		$this->teacher_cod = $teacher_cod;
		$this->period = $period;
		$this->day = $day;

		$sth = $return_conn->prepare( "exec usp_consulta_seccion_profesor_entidad ?, ?, ?, ?" );
		$sth->bindParam( 1, $this->entity );
		$sth->bindParam( 2, $this->teacher_cod );
		$sth->bindParam( 3, $this->period );
		$sth->bindParam( 4, $this->day );
		$sth->execute();

		return $sth;
	}

	//Funcion para obtener datos de SECCION al hacer click en uno de ellas
	private $section_cod;
	public function get_data_onclick_section($entity, $section_cod, $period, $day){

		$conn = new Conexion();
		$return_conn = $conn->return_conn();
	
		$this->entity = $entity;
		$this->section_cod = $section_cod;
		$this->period = $period;
		$this->day = $day;

		$sth = $return_conn->prepare( "exec usp_consulta_seccion_codigo_entidad ?, ?, ?, ?" );
		$sth->bindParam( 1, $this->entity );
		$sth->bindParam( 2, $this->section_cod );
		$sth->bindParam( 3, $this->period );
		$sth->bindParam( 4, $this->day );
		$sth->execute();

		return $sth;
	}

	//Funcion para obtener datos de ASIGNATURAS al hacer click en uno de ellas
	private $subject_cod;
	public function get_data_onclick_subject($entity, $subject_cod, $period, $day){

		$conn = new Conexion();
		$return_conn = $conn->return_conn();
	
		$this->entity = $entity;
		$this->subject_cod = $subject_cod;
		$this->period = $period;
		$this->day = $day;

		$sth = $return_conn->prepare( "exec usp_consulta_asignatura_codigo_entidad ?, ?, ?, ?" );
		$sth->bindParam( 1, $this->entity );
		$sth->bindParam( 2, $this->subject_cod );
		$sth->bindParam( 3, $this->period );
		$sth->bindParam( 4, $this->day );
		$sth->execute();

		return $sth;
	}

	//Funcion para obtener ITEMS de PROFESOR
	private $item;
	public function get_teacher_items($item, $day){

		$conn = new Conexion();
		$return_conn = $conn->return_conn();
	
		$this->item = $item;
		$this->day = $day;

		$sth = $return_conn->prepare( "exec usp_consulta_item ?, ?" );
		$sth->bindParam( 1, $this->item );
		$sth->bindParam( 2, $this->day );
		$sth->execute();

		return $sth;
	}

	//Funcion para obtener informacion de PROFESOR al hacer click en uno de sus ITEMS
	private $item_register_sign;
	private $teacher_cod_register_sign;
	private $day_register_sign;
	private $date;
	private $time;
	private $url_sign;
	public function set_teacher_info($item_register_sign, $teacher_cod_register_sign, $day_register_sign, $date, $time, $url_sign){

		$conn = new Conexion();
		$return_conn = $conn->return_conn();
	
		$this->item_register_sign = $item_register_sign;
		$this->teacher_cod_register_sign = $teacher_cod_register_sign;
		$this->day_register_sign = $day_register_sign;
		$this->date = $date;
		$this->time = $time;
		$this->url_sign = $url_sign;

		$return_conn->query("INSERT INTO tbl_co_profesor_asistencia (ofe_codigo, pro_codigo, dia, fecha, hora, firma) VALUES ('".$this->item_register_sign."', '".$this->teacher_cod_register_sign."', '".$this->day_register_sign."', '".$this->date."', '".$this->time."', '".$this->url_sign."') ");

			return false;
		
	}

	//Funcion para verificar si PROFESOR firmo
	public function is_teacher_register_sign($teacher_cod_register_sign){

		$conn = new Conexion();
		$return_conn = $conn->return_conn();

		$this->teacher_cod_register_sign = $teacher_cod_register_sign;

		$stmt_select_teacher = $return_conn->query(" SELECT * FROM tbl_co_profesor_asistencia WHERE pro_codigo = '".$this->teacher_cod_register_sign."' ");

		$row_count = $stmt_select_teacher->rowCount();

		if ($row_count < 0) {
			
			return true;

		}else{

			return false;
		}

	}

	//Funcion para guardar sugerencia de profesor
	private $teacher_name;
	private $user_id;
	public function set_suggest_teacher($item, $teacher_name, $user_id){

		$conn = new Conexion();
		$return_conn = $conn->return_conn();

		$this->item = $item;
		$this->teacher_name = $teacher_name;
		$this->user_id = $user_id;

		$stmt_add_suggest_teacher = $return_conn->query(" INSERT INTO tbl_co_oferta_academica_profesor_sugerido (ofe_codigo, nombreProfesor, usu_codigo) VALUES ( '".$this->item."', '".$this->teacher_name."', '".$this->user_id."' ) ");

		return true;

	}


	//Funcion para obtener profesores sugeridos anteriormente
	public function get_suggests_teachers($item){

		$conn = new Conexion();
		$return_conn = $conn->return_conn();

		$this->item = $item;

		$stmt_select_suggest_teacher = $return_conn->query(" SELECT * FROM tbl_co_oferta_academica_profesor_sugerido WHERE ofe_codigo = '".$this->item."' ");

		return $stmt_select_suggest_teacher;
	}


	//Funcion para guardar sugerencia de horario
	private $startTime;
	private $endTime;
	public function set_suggest_schedule($item, $user_id, $startTime, $endTime){

		$conn = new Conexion();
		$return_conn = $conn->return_conn();

		$this->item = $item;
		$this->user_id = $user_id;
		$this->startTime = $startTime;
		$this->endTime = $endTime;

		$stmt_add_suggest_schedule = $return_conn->query(" INSERT INTO tbl_co_oferta_academica_horario_sugerido (ofe_codigo, usu_codigo, horaI, horaF) VALUES ( '".$this->item."', '".$this->user_id."', '".$this->startTime."', '".$this->endTime."' ) ");

		if ($stmt_add_suggest_schedule) {
			return true;
		}else{
			return false;
		}

	}


	//Funcion para guardar sugerencia de aula
	private $edifice;
	private $class_rrom;
	public function set_suggest_class_room($item, $user_id, $class_rrom, $edifice){

		$conn = new Conexion();
		$return_conn = $conn->return_conn();

		$this->item = $item;
		$this->user_id = $user_id;
		$this->edifice = $edifice;
		$this->class_rrom = $class_rrom;

		$stmt_add_suggest_class_room = $return_conn->query(" INSERT INTO tbl_co_oferta_academica_eaula_sugerida (ofe_codigo, usu_codigo, edificio, aula) VALUES ( '".$this->item."', '".$this->user_id."', '".$this->edifice."', '".$this->class_rrom."' ) ");

		if ($stmt_add_suggest_class_room) {
			return true;
		}else{
			return false;
		}

	}


	//Funcion para obtener retroalimentacion de profesores
	public function get_feedbacks_teachers(){

		$conn = new Conexion();
		$return_conn = $conn->return_conn();

		$stmt_select_feedbacks_teacher = $return_conn->query(" SELECT * FROM tbl_co_oferta_academica_retroalimentacion ");

		return $stmt_select_feedbacks_teacher;
	}


	//Funcion para guardar retroalimentación de profesor
	private $feedback;
	public function set_feedback_teacher($item, $teacher_cod, $day, $feedback, $user_id){

		$conn = new Conexion();
		$return_conn = $conn->return_conn();

		$this->item = $item;
		$this->teacher_cod = $teacher_cod;
		$this->day = $day;
		$this->feedback = $feedback;
		$this->user_id = $user_id;

		$stmt_add_feedback_teacher = $return_conn->query(" INSERT INTO tbl_co_oferta_academica_retroalimentacion_add (ofe_codigo, pro_codigo, dia, feedback, usu_codigo) VALUES ( '".$this->item."', '".$this->teacher_cod."', '".$this->day."', '".$this->feedback."', '".$this->user_id."' ) ");

		if ($stmt_add_feedback_teacher) {
			return true;
		}else{
			return false;
		}

	}
	


}

?>