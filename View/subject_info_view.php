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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
  </head>
  <body style="background: #e9ebee;">

  	<div>

<?php
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

//---------------------- <!-- Para sección info --> -----------------------------------
if ( isset($_POST['subjectCod']) ) {/*Condicional IF 0*/
	
	$entity = 1;
	$subject_cod = sed::decryption(($_POST['subjectCod']));
	$period = "2019/2";
	$axx = 0;

	$sth_return = $model_class->get_data_onclick_subject($entity, $subject_cod, $period, $day); 

	
	?>

	<ul class="list-group">
		<?php
		$print_subject_name = "";
		$print_career = "";
		while ( $result = $sth_return->fetch( PDO::FETCH_ASSOC ) ) {/*Bucle WHILE*/
			$axx++;
			$id_item_teacher = sed::encryption(($result["ITEM"]));
			?>

			<?php
				if ($result['MATERIA'] != $print_subject_name) {
					$print_subject_name = $result['MATERIA']; ?>
					
					<div class="mb-2 list-group-item flex-column align-items-start p-4" style="border-left: 8px solid #004085;">
		    <div class="w-100">
		    	<i class="fa fa-chevron-left fa-2x" aria-hidden="true" onclick="window.history.back();"></i>
		    	<span class="ml-4 h3">Asignatura: </span><span class="h3 text-center"><?php echo $result['MATERIA']; ?></span>
		    </div>
		  </div>

				<?php } ?>

			<span class="font-weight-bold text-secondary h5 mb-2">
				<?php
				if ($result['CARRERA'] != $print_career) {
					$print_career = $result['CARRERA'];
					echo $result['CARRERA'];
				}
				?>	
			</span>
			<form action="view_subject_to_sign.php" method="POST" id="formNamesSubject<?php echo $axx; ?>">
			<input type="hidden" name="teacherToSignItemId" value="<?php echo $id_item_teacher; ?>">
			<input type="hidden" name="subjectToSignId" value="<?php echo $subject_cod; ?>">
			<div class="col-12">
	            <div class="card mb-3 list-group-item-action" style="border-left: 8px solid #004085;" onclick="javascript:formNamesSubject<?php echo $axx; ?>.submit();">
	                <div class="card-body p-0 pt-4 pr-4 pl-4 pb-4">
	                    <div class="media">
	                        <div class="pr-2 border-right border-secondary">
	                            <h1><?php echo $result['SECCION']; ?></h1>
	                        </div>
	                        <div class="pl-2 media-body">
	                            <span class="h5"><?php echo $result['MATERIA']; ?></span> | <span><?php echo $result['CODIGO']; ?></span>
	                            <br>
	                            <span>Cuatrimestre:</span> <span class="font-weight-bold text-secondary"><?php echo $result['NIVEL']; ?> </span>
	                            |
	                            <span>Tanda:</span> <span class="font-weight-bold text-secondary"><?php echo $result['TANDA']; ?> </span>
	                            <br>
	                            <span>Profesor:</span> <span class="font-weight-bold text-secondary"><?php echo $result['PROFESOR']; ?> </span>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </form>
		<?php }/*Bucle WHILE*/ }/*Condicional IF 0*/ ?>
	</ul>
<!-- //------------------------- Para sección info ---------------------------------------- -->
		</div>

	<script src=".js/jquery-3.3.1.min.js"></script>
    <script src=".js/popper.min.js"></script>
    <script src=".js/bootstrap.min.js"></script>
	</body>