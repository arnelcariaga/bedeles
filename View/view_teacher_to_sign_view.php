<?php
date_default_timezone_set('America/Santo_Domingo');//Lugar de donde quiero la hora y fecha
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="colorlib.com">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <link href="css/main.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-timepicker.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
  </head>
  <body style="background: #e9ebee;">

  	<div class="mb-2 list-group-item flex-column align-items-start p-4" style="border-left: 8px solid #004085;">
		    <div class="w-100">
		    	<i class="fa fa-chevron-left fa-2x" aria-hidden="true" onclick="window.history.back();"></i>
		    	<span class="ml-5 h3 text-center">Control de asistencia</span>
		    </div>
		  </div>

  	<div class="container-fluid">
<?php
require 'Model/model.php';
require 'Controller/encript.php';
$model_class = new model_class();

if ($_POST['teacherToSignItemId']) {/*Condicional IF 0*/

  $teacher_to_sign_item_id = sed::decryption(($_POST['teacherToSignItemId']));
  $teacher_to_sign_id = $_POST['teacherToSignId'];

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

  $return_teacher_items = $model_class->get_teacher_items($teacher_to_sign_item_id, $day);

  while ( $result = $return_teacher_items->fetch( PDO::FETCH_ASSOC ) ) {/*Bucle WHILE*/ ?>
  <div class="row">
        <div class="col-12">
          <div class="card shadow">
          <div class="card-body p-4 text-center">
            <h5 class="card-title display-3"><i class="fa fa-clock-o text-secondary"></i> <?php echo $time; ?></h5>
            <p class="card-text h4 text-secondary"><?php echo $result['DIA']; ?></p>
            <p class="card-text h2"><i class="fa fa-user text-secondary"></i> <?php echo $result['PROFESOR']; ?></p>
            <p class="card-text h2"><i class="fa fa-book text-secondary"></i> <?php echo $result['MATERIA']; ?></p>
            <span class="card-text h2"><i class="fa fa-calendar-check-o text-secondary" aria-hidden="true"></i></span> <span class="card-text h2"><?php echo $result['HORAI']; ?></span> | <span class="card-text h2"><?php echo $result['HORAF']; ?></span>
          </div>
          <div class="card-body text-center">
            <?php
            $sth_return_teacher_info = $model_class->is_teacher_register_sign($teacher_to_sign_id);

              if ($sth_return_teacher_info) { ?>
                <div class="btn-group">
                <div class="dropdown">
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalFeedbacksTeacher" onclick="sendFeedbacksTeacherFunc('<?php echo $result['ITEM']; ?>', '<?php echo $teacher_to_sign_id; ?>');">
                    <span class="h2">Estado</span>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php
                      $sth_return_teacher_feedbacks = $model_class->get_feedbacks_teachers();
                      while ($row = $sth_return_teacher_feedbacks->fetch(PDO::FETCH_ASSOC)) { ?>
                    <a class="dropdown-item h4" href="#"><?php echo $row['descripcion']; ?></a>
                    <?php } ?>
                  </div>
                </div>
              <?php }else{ ?>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalSignTeacher" onclick="selectTeacherSign('<?php echo $result['ITEM']; ?>', '<?php echo $teacher_to_sign_id; ?>');"><span class="h2">Firmar</span></button>
             <?php } ?>
            
            &nbsp;  &nbsp;  
            <button type="button" class="btn btn-danger" onclick="window.history.back();"><span class="h2">Cancelar</span></button>
            </div>
          </div>
        </div>
        </div>
      </div>

      <div class="row mt-2">
        <div class="col-12">
          <div class="card">
             <div class="card-header">
              <span class="h3">Opciones de sugerencias</span>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item text-primary list-group-item-action h4" data-toggle="modal" data-target="#modalTeacherSuggest" onclick="sendSuggestTeacherFunc('<?php echo $result['ITEM']; ?>', '<?php echo $teacher_to_sign_id; ?>');"><i class="fa fa-lightbulb-o text-secondary" aria-hidden="true"></i> Profesor</li>
              <li class="list-group-item text-primary list-group-item-action h4" data-toggle="modal" data-target="#modalScheduleSuggest" onclick="sendSuggestScheduleFunc('<?php echo $result['ITEM']; ?>', '<?php echo $teacher_to_sign_id; ?>');"><i class="fa fa-calendar text-secondary" aria-hidden="true"></i> Horario</li>
              <li class="list-group-item text-primary list-group-item-action h4" data-toggle="modal" data-target="#modalClassRoomSuggest" onclick="sendSuggestClassRoomFunc('<?php echo $result['ITEM']; ?>', '<?php echo $teacher_to_sign_id; ?>');"><i class="fa fa-building-o text-secondary" aria-hidden="true"></i> Aula</li>
            </ul>
          </div>
        </div>
      </div>

<?php include 'modals_view.php'; ?>
<?php }/*Bucle WHILE*/ }/*Condicional IF 0*/ ?>	
	</div>

	<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-timepicker.min.js"></script>
     <!-- Jquery Validate -->
  <script type="text/javascript" src="js/jquery.validate.min.js"></script>
  <script type="text/javascript"></script>
    <script src="js/custom.js"></script>
	</body>
  </html>