<?php
date_default_timezone_set('America/Santo_Domingo');//Lugar de donde quiero la hora y fecha
require 'Model/model.php';
require 'Controller/encript.php';
$model_class = new model_class();
$days = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
	  $current_day = $days[date('w')];
	  $day = '';
	  if ($current_day == "Lunes") {
	    $day = 1;
	  }if ($current_day == "Martes") {
	    $day = 2;
	  }if ($current_day == "Miércoles") {
	    $day = 3;
	  }if ($current_day == "Jueves") {
	    $day = 4;
	  }if ($current_day == "Viernes") {
	    $day = 5;
	  }if ($current_day == "Sábado") {
	    $day = 6;
	  }if ($current_day == "Domingo") {
	    $day = 7;
	  }
if ( isset($_POST['search']) && isset($_POST['searchTypeSelect']) ) {/*Condicional IF 0*/
	//---------------------- <!-- Para profesor --> -----------------------------------
	$search_type_select = $_POST['searchTypeSelect'];
	if ($search_type_select == "Profesor") {/*Condicional IF 1*/
	$entity = 1;
	$last_name = $_POST['search'];
	$period = "2019/2";
	$axx = 0;
	$sth_return = $model_class->get_teacher_data($entity, $last_name, $period, $day); ?>
	<ul class="list-group">
		<?php while ( $result = $sth_return->fetch( PDO::FETCH_ASSOC ) ) {/*Bucle WHILE*/
			$id_teacher = sed::encryption(($result["ID"]));
			$axx++;
			?>
			<form class="ml-3" action="teacher_info.php" method="POST" id="formNamesTeacher<?php echo $axx; ?>">
				<input type="hidden" name="teacherCod" value="<?php echo $id_teacher; ?>">
				<input type="hidden" name="teacherColor" value="#8e732e">
				<li class="p-0 list-group-item list-group-item-action d-flex justify-content-between align-items-center btn-list-name-teacher" style="border-left: 8px solid #8e732e;" onclick="javascript:formNamesTeacher<?php echo $axx; ?>.submit();">
				  <div class="flex-column align-items-start p-3">
				    <div class="d-flex w-100 justify-content-center">
				      <h5 class="mb-1"><?php echo $result["APELLIDOS"].", ".$result["NOMBRES"]; ?></h5>
				    </div>
				  </div>
				  <span class="mr-2"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
				</li>
			</form>
	</ul>
			<!-- //------------------------- Para profesor ---------------------------------------- -->
		<?php }/*Bucle WHILE*/ }/*Condicional IF 1*/ }/*Condicional IF 0*/ ?>
<?php
if ( isset($_POST['search']) && isset($_POST['searchTypeSelect']) ) {/*Condicional IF 0*/
	//---------------------- <!-- Para sección --> -----------------------------------
	$search_type_select = $_POST['searchTypeSelect'];
	if ($search_type_select == "Seccion") {/*Condicional IF 1*/
	$entity = 1;
	$section = $_POST['search'];
	$period = "2019/2";
	$axx = 0;
	$sth_return = $model_class->get_section_data($entity, $section, $period, $day); ?>
	<ul class="mt-3 list-group">
		<?php while ( $result = $sth_return->fetch( PDO::FETCH_ASSOC ) ) {/*Bucle WHILE*/
			$id_section = sed::encryption(($result["ID"]));
			$axx++;
			?>
			<form action="section_info.php" method="POST" id="formNamesSection<?php echo $axx; ?>">
				<input type="hidden" name="sectionCod" value="<?php echo $id_section; ?>">
			<div class="col-12">
	            <div class="card mb-3 list-group-item-action" style="border-left: 8px solid #8e732e;" onclick="javascript:formNamesSection<?php echo $axx; ?>.submit();">
	                <div class="card-body p-0 pt-4 pr-4 pl-4 pb-4">
	                    <div class="media">
	                        <div class="pr-2 border-right border-secondary">
	                            <h1><?php echo $result['SECCION']; ?></h1>
	                        </div>
	                        <div class="pl-2 media-body">
	                            <h5><?php echo $result['CARRERA']; ?></h5>
	                            <span>Cuatrimestre:</span> <span class="text-bold-400"><?php echo $result['NIVEL']; ?> </span>
	                            |
	                            <span>Tanda:</span> <span class="text-bold-400"><?php echo $result['TANDA']; ?> </span>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </form>
	</ul>
	    <!-- //------------------------- Para sección ---------------------------------------- -->
		<?php }/*Bucle WHILE*/ }/*Condicional IF 1*/ }/*Condicional IF 0*/ ?>
<?php
if ( isset($_POST['search']) && isset($_POST['searchTypeSelect']) ) {/*Condicional IF 0*/
//---------------------- <!-- Para asignatura --> -----------------------------------	
	$search_type_select = $_POST['searchTypeSelect'];
	if ($search_type_select == "Asignatura") {/*Condicional IF 1*/
	$entity = 1;
	$subject = $_POST['search'];
	$period = "2019/2";
	$axx = 0;
	$sth_return = $model_class->get_subject_data($entity, $subject, $period, $day); ?>
	<ul class="list-group">
		<?php while ( $result = $sth_return->fetch( PDO::FETCH_ASSOC ) ) {/*Bucle WHILE*/
			$id_subject = sed::encryption(($result["ID"]));
			$axx++;
			?>
			<form class="ml-3" action="subject_info.php" method="POST" id="formNamesSubject<?php echo $axx; ?>">
				<input type="hidden" name="subjectCod" value="<?php echo $id_subject; ?>">
			<div class="mb-2">
				<li class="p-0 list-group-item list-group-item-action d-flex justify-content-between align-items-center btn-list-name-teacher" style="border-left: 8px solid #8e732e;" onclick="javascript:formNamesSubject<?php echo $axx; ?>.submit();">
				  <div class="flex-column align-items-start p-3">
				    <div class="w-100">
				      <h5 class="mb-1"><?php echo $result["CARRERA"]; ?></h5>
				      <span>Código: </span> <span class="font-weight-bold"><?php echo $result["CODIGO"]; ?></span>
				      <br>
				      <span>Crédito: </span> <span class="font-weight-bold"><?php echo $result["CREDITO"]; ?></span>
				    </div>
				  </div>
				  <span class="mr-2"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
				</li>
			</div>
		</form>
	</ul>
		<!-- //------------------------- Para asignatura ---------------------------------------- -->
		<?php }/*Bucle WHILE*/ }/*Condicional IF 1*/ }/*Condicional IF 0*/ ?>
<?php
if ( isset($_POST['saveSign']) && isset($_POST['img_data']) && isset($_POST['teacherItem'])) {/*Condicional IF 0*/
	//---------------------- <!-- Para firmas --> -----------------------------------
	$save_sign = $_POST['saveSign'];

	if ($save_sign) {
	$techer_item = $_POST['teacherItem'];
	$techer_id = $_POST['teacherId'];
	$days = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
	  $current_day = $days[date('w')];
	  $day = '';
	  if ($current_day == "Lunes") {
	    $day = 1;
	  }if ($current_day == "Martes") {
	    $day = 2;
	  }if ($current_day == "Miércoles") {
	    $day = 3;
	  }if ($current_day == "Jueves") {
	    $day = 4;
	  }if ($current_day == "Viernes") {
	    $day = 5;
	  }if ($current_day == "Sábado") {
	    $day = 6;
	  }if ($current_day == "Domingo") {
	    $day = 7;
	  }
	  $date = date('Y-m-d');
	  $time = date('h:i A');
	$imagedata = base64_decode($_POST['img_data']);
	$filename = md5(date("dmYhisA"));
	//Location to where you want to created sign image
	$file_route = './doc_signs/'.$filename.'.png';
	file_put_contents($file_route,$imagedata);
	$img = imagecreatefrompng($file_route); //or whatever loading function you need
	$colors = explode(',', '255,255,255');
	$remove = imagecolorallocate($img, $colors[0], $colors[1], $colors[2]);
	imagecolortransparent($img, $remove);
	imagepng($img, 'doc_signs'.'/'.$filename.'.png');
	$sth_return_teacher_info = $model_class->set_teacher_info($techer_item, $techer_id, $day, $date, $time, $file_route);

	if ($sth_return_teacher_info) {
		echo "Ya existe.";
	}else{
		echo "Registrado.";
	}

	}
//------------------------- Para firmas ----------------------------------------
}
?>
<?php
if ( isset($_POST['teacherSuggestItem']) && isset($_POST['teacherId']) && isset($_POST['suggestTeacherName']) ) {/*Condicional IF 0*/
	//---------------------- <!-- Para guardar sugerencia de profesor --> -----------------------------------
	
	$teacher_suggest_item = $_POST['teacherSuggestItem'];
	$user_id = 16;

	if (isset($_POST['suggestTeacherName'])) {

			$add_suggest_teacher = $_POST['suggestTeacherName'];

			if ($add_suggest_teacher !== "undefined") {
				
			$sth_return_added_suggest_teacher = $model_class->set_suggest_teacher($teacher_suggest_item, $add_suggest_teacher, $user_id);

			$is_sth_return_added_suggest_teacher = json_encode($sth_return_added_suggest_teacher);

			if ($is_sth_return_added_suggest_teacher) {
				echo '<script> alert("Profesor sugerido."); </script>';
			}

		}

	}else{
		echo "Error";
	}
		$sth_return_select_suggests_teachers = $model_class->get_suggests_teachers($teacher_suggest_item);

		$header = "";

		while ( $result = $sth_return_select_suggests_teachers->fetch( PDO::FETCH_ASSOC ) ) { 

			if ($result > 0) { ?>
				<div class="card mb-1">
				<?php
				if ($header == "") {
					$title_header = "Sugeridos";
					$header = $title_header; ?>
					<div class="card-header">
					    <?php echo $header; ?>
					</div>
				<?php } ?>
			  <ul class="list-group list-group-flush">
			    <li class="list-group-item"><?php echo $result['nombreProfesor']; ?></li>
			  </ul>
			</div>
			<?php } ?>

		<?php }
//------------------------- Para guardar sugerencia de profesor ----------------------------------------
}
?>
<?php
if ( isset($_POST['teacherSuggestItem']) && isset($_POST['teacherId']) && isset($_POST['startTime']) && isset($_POST['endTime']) ) {/*Condicional IF 0*/
	//---------------------- <!-- Para guardar sugerencia de horario --> -----------------------------------
	
	$teacher_suggest_item = $_POST['teacherSuggestItem'];
	$user_id = 16;
	$schedule_start_suggest = $_POST['startTime'];
	$schedule_end_suggest = $_POST['endTime'];

	$sth_return_added_suggest_schedule = $model_class->set_suggest_schedule($teacher_suggest_item, $user_id, $schedule_start_suggest, $schedule_end_suggest);

	if ($sth_return_added_suggest_schedule) {
		echo "Horario sugerido.";
	}

//------------------------- Para guardar sugerencia de horario ----------------------------------------
}
?>
<?php
if ( isset($_POST['teacherSuggestItem']) && isset($_POST['teacherId']) && isset($_POST['suggestClassRoomName']) && isset($_POST['suggestEdificeName']) ) {/*Condicional IF 0*/
	//---------------------- <!-- Para guardar sugerencia de aula --> -----------------------------------
	
	$teacher_suggest_item = $_POST['teacherSuggestItem'];
	$user_id = 16;
	$class_room_start_suggest = $_POST['suggestClassRoomName'];
	$edifice_end_suggest = $_POST['suggestEdificeName'];

	$sth_return_added_suggest_schedule = $model_class->set_suggest_class_room($teacher_suggest_item, $user_id, $class_room_start_suggest, $edifice_end_suggest);

	if ($sth_return_added_suggest_schedule) {
		echo "Aula sugerido.";
	}

//------------------------- Para guardar sugerencia de aula ----------------------------------------
}
?>
<?php
if ( isset($_POST['teacherSuggestItem']) && isset($_POST['teacherId']) && isset($_POST['feedbacksSelectTeacher']) ) {/*Condicional IF 0*/
	//---------------------- <!-- Para guardar feedback de profesores --> -----------------------------------
	
	$teacher_suggest_item = $_POST['teacherSuggestItem'];
	$techer_id = $_POST['teacherId'];
	$feedbacks_select_teacher = $_POST['feedbacksSelectTeacher'];
	$user_id = 16;

	$sth_return_added_feedback_teacher = $model_class->set_feedback_teacher($teacher_suggest_item, $techer_id, $day, $feedbacks_select_teacher, $user_id);

	if ($sth_return_added_feedback_teacher) {
		echo "Retroalimentación enviado.";
	}

//------------------------- Para guardar feedback de profesores ----------------------------------------
}
?>