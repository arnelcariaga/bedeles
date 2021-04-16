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

    <div class="s003">
      <form id="formSearch" class="form" action="results_search.php" method="POST">
        <div class="inner-form">
          <div class="input-field first-wrap d-flex justify-content-center align-items-center">
            <div class="input-select">
              <select class="form-control border-0" name="searchTypeSelect" id="searchTypeSelect">
                <option value="Profesor" selected>Profesor</option>
                <option value="Seccion">Sección</option>
                <option value="Asignatura">Asignatura</option>
              </select>
            </div>
          </div>
          <div class="input-field second-wrap">
            <input id="search" name="search" type="text" placeholder="Apellido del profesor" />
          </div>
          <div class="input-field third-wrap">
            <button class="btn-search" type="button" id="btnSearch">
              <i class="fa fa-search" aria-hidden="true"></i>
            </button>
          </div>
        </div>
        </form>
      </div>
    

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
      <!-- Jquery Validate -->
  <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script>

      $(document).ready(function() {
    //Validar FORM si INPUTS requeridos estan vacios
      $("#formSuggestTeacher").validate({
          errorClass: "is-invalid",
          validClass: "is-valid",
          rules: {
              search: "required"
          },
          messages: {
              search: '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error!</strong> Campo obligatorio.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
          }
      })
    })

      //Capto valor al seleccionar una CATEGORIA
      $( "#searchTypeSelect" ).change(function() {

        var searchValueSelect = $( "#searchTypeSelect" ).val();

        if (searchValueSelect == "Profesor") {
          $("#search").attr("placeholder", "Apellido del profesor");
        }
        if (searchValueSelect == "Seccion") {
          $("#search").attr("placeholder", "Sección");
        }
        if (searchValueSelect == "Asignatura") {
          $("#search").attr("placeholder", "Asignatura");
        }
        
      });


      $('#search').keypress(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){

              //Para no enviar form al precionar ENTER
              event.preventDefault();

              var formValid = $("#formSearch").valid();
              //Comprobar si INPUT no esta vacio
              if (formValid) {
                //Entidad recintos
                var entity = 1;
               //Captop valor del INPUT buscar
                var searchValue = $( "#search" ).val();

               //Enviar FORM para enviar datos al controlador
               $( "#formSearch" ).submit();//Enviar FORM para enviar datos al controlador

               }//Comprobar si INPUT no esta vacio

            }
        });

      $( "#btnSearch" ).on( "click", function() {

          var formValid = $("#formSearch").valid();
              //Comprobar si INPUT no esta vacio
              if (formValid) {
                //Entidad recintos
                var entity = 1;
               //Captop valor del INPUT buscar
                var searchValue = $( "#search" ).val();

               //Enviar FORM para enviar datos al controlador
               $( "#formSearch" ).submit();//Enviar FORM para enviar datos al controlador

               }//Comprobar si INPUT no esta vacio

        });

    </script>
  </body>
</html>