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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
  </head>
  <body style="background: #e9ebee;">

  	<div>

<?php
require 'Model/model.php';
require 'Controller/encript.php';
$model_class = new model_class();

//---------------------- <!-- Para profesor info --> -----------------------------------
if ( isset($_POST['teacherCod']) ) {/*Condicional IF 0*/
	
	$entity = 1;
	$teacher_cod = sed::decryption(($_POST['teacherCod']));
	$period = "2019/2";
	$axx = 0;
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

	$sth_return = $model_class->get_data_onclick_teacher($entity, $teacher_cod, $period, $day);
	$print_subject = '';
	?>
	<ul class=" list-group">
		<?php while ( $result = $sth_return->fetch( PDO::FETCH_ASSOC ) ) {/*Bucle WHILE*/
			$axx++;
			$id_item_teacher = sed::encryption(($result["ITEM"]));
			?>

			<?php
				if ($result['PROFESOR'] != $print_subject) {
					$print_subject = $result['PROFESOR']; ?>
					
					<div class="mb-2 list-group-item flex-column align-items-start p-4" style="border-left: 8px solid #004085;">
		    <div class="w-100">
		    	<i class="fa fa-chevron-left fa-2x" aria-hidden="true" onclick="window.history.back();"></i>
		    	<span class="ml-5 h3 text-center"><?php echo $result['PROFESOR']; ?></span>
		    </div>
		  </div>

				<?php } ?>

			<form action="view_teacher_to_sign.php" method="POST" id="formNamesTeacher<?php echo $axx; ?>">
			<input type="hidden" name="teacherToSignItemId" value="<?php echo $id_item_teacher; ?>">
			<input type="hidden" name="teacherToSignId" value="<?php echo $teacher_cod; ?>">
			<div class="col-12" onclick="javascript:formNamesTeacher<?php echo $axx; ?>.submit();">
	            <div class="card mb-3 list-group-item-action" style="border-left: 8px solid #004085;" onclick="teacherToSignFunc();">
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
	                            <span>Carrera:</span> <span class="font-weight-bold text-secondary"><?php echo $result['CARRERA']; ?> </span>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </form>
		<?php }/*Bucle WHILE*/ }/*Condicional IF 0*/ ?>
	</ul>
	<?php include 'modals.php';?>
<!-- //------------------------- Para profesor info ---------------------------------------- -->
		</div>

	<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/numeric-1.2.6.min.js"></script>
	<script src="js/bezier.js"></script>
	<script src="js/jquery.signaturepad.js"></script> 
	<script src="js/html2canvas.js"></script>

    <script type="text/javascript">
    	function teacherToSignFunc() {

			location.href = "view_teacher_to_sign.php";

	}
    </script>
	</body>