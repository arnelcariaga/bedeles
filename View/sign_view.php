<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
  </head>
  <body>

<!-- Inicio contenedor -->
        <section class="container">
        <div id="containerSign">
                    <div id="signArea" class="mb-4">
                      <div class="sig signature-container">
                        <div class="typed"></div>
                        <canvas class="sign-pad border-bottom" id="sign-pad"></canvas>
                      </div>
                    </div>
                  <input type="hidden" name="teacherItem" id="teacherItem" value="<?php echo $_POST['teacherItem']; ?>">
                  <input type="hidden" name="teacherId" id="teacherId" value="<?php echo $_POST['teacherId']; ?>">

                    <button type="button" class="btn btn-success" id="btnSaveSign">Guardar firma</button>
                    <button type="button" class="btn btn-danger" id="btnClearSign">Limpiar</button>
    </div>
    </section>
<script src="js/numeric-1.2.6.min.js"></script>
  <script src="js/bezier.js"></script>
  <script src="js/jquery.signaturepad.js"></script> 
  <script src="js/html2canvas.js"></script>
    <script>
	$(document).ready(function(){

		$('#signArea').signaturePad({
					drawOnly:true,
					drawBezierCurves:true,
					lineTop:100000,
          touchable: true
				});

    var drawSignatures = function() {
        // The aspect ratio of this particular signature happens to be about 3x2
        var width = $(".signature-container").innerWidth() - 20;
        var height = width * (2/3);
        $("#sign-pad").attr("width", width);
        $("#sign-pad").attr("height", height);
      };
      $( window ).resize(function() {
        drawSignatures();
      });

    $("#btnSaveSign").click(function(e){

          var isSign = $("#signArea").signaturePad({
            errorMessageDraw: 'Por favor firme el documento.',
            touchable: true
          }).validateForm();

          if (isSign) {
            html2canvas([document.getElementById('sign-pad')], {
              onrendered: function (canvas) {

                var teacherItem = $("#teacherItem").val(),
                    teacherId = $("#teacherId").val(),
                    canvas_img_data = canvas.toDataURL('image/png'),
                    img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");

                //ajax call to save image inside folder
                $.ajax({
                  url: 'save_sign.php',
                  data: { 
                    teacherItem: teacherItem,
                    teacherId: teacherId,
                    img_data: img_data,
                    saveSign: true
                  },
                  type: 'post',
                  success: function (response) {
                     
                     if (response == "Registrado.") {
                        location.reload();
                     }

                  }
                });
              }
            });
          }
          
        });

    //Limpiar fimra
        $("#btnClearSign").click(function(e){
          $('#signArea').signaturePad({
            touchable: true
          }).clearCanvas();
        })
				
        });
</script>

  </body>
</html>