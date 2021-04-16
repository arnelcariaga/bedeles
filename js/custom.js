/*---------------------------view_teacher_to_sign_view---------------------------------------------------------*/

$(document).ready(function() {

    //Validar FORM si INPUTS requeridos estan vacios
      $("#formSuggestTeacher").validate({
          errorClass: "is-invalid",
          validClass: "is-valid",
          rules: {
              suggestTeacherName: "required"
          },
          messages: {
              suggestTeacherName: '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error!</strong> Campo obligatorio.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
          }
      })

      //Validar FORM si INPUTS requeridos estan vacios
      $("#formSuggestSchedule").validate({
          errorClass: "is-invalid",
          validClass: "is-valid",
          rules: {
              timepickerStart: "required",
              timepickerend: "required"
          },
          messages: {
              timepickerStart: '',
              timepickerend: ''
          }
      })

      //Validar FORM si INPUTS requeridos estan vacios
      $("#formSuggestClassRoom").validate({
          errorClass: "is-invalid",
          validClass: "is-valid",
          rules: {
              suggestClassRoomName: "required",
              suggestEdificeName: "required"
          },
          messages: {
              suggestClassRoomName: '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error!</strong> Campo obligatorio.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>',
              suggestEdificeName: '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error!</strong> Campo obligatorio.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
          }
      })

      //Validar FORM si INPUTS requeridos estan vacios
      $("#formFeddbacksTeacher").validate({
          errorClass: "is-invalid",
          validClass: "is-valid",
          rules: {
              feedbacksSelectTeacher: "required"
          },
          messages: {
              feedbacksSelectTeacher: ''
          }
      })

      $('#timepickerStart, #timepickerEnd').timepicker({
        icons: {
            up: 'fa fa-caret-up',
            down: 'fa fa-caret-down'
        },
        minuteStep: 5
      });

    })

function selectTeacherSign(item, idTeacher, day, date, time) {
    var teacherItem = item,
        teacherId = idTeacher,
        currDay = day,
        currDate = date,
        currTime = time;

    $.ajax({
      type: "POST",
      url: "sign.php",
      data:'teacherItem='+teacherItem+'&teacherId='+teacherId+'&currDay='+currDay+'&currDate='+currDate+'&currTime='+currTime,
      success: function(data){
        //Asignar valor desde sign.php al id del div signDiv
        $("#signDiv").html(data);
      }
      });

  }


  function sendSuggestTeacherFunc(item, idTeacher) {

   var teacherItem = item,
              teacherId = idTeacher,
              suggestTeacherName;
        $("#btnSaveSuggestTeacherName").on("click", function(){

          var getSuggestTeacherName = $("#suggestTeacherName").val();

          suggestTeacherName = getSuggestTeacherName;

          var formValid = $("#formSuggestTeacher").valid();
          //Comprobar si INPUT no esta vacio
              if (formValid) {
               
               $.ajax({
                type: "POST",
                url: "send_suggest_teacher.php",
                data:'teacherSuggestItem='+teacherItem+'&suggestTeacherName='+suggestTeacherName+'&teacherId='+teacherId,
                success: function(data){
                  //Asignar valor desde send_suggest_teacher.php al id del div signDiv
                  $("#suggestSavedDiv").html(data);
                  location.reload();
                }
                });

               }//Comprobar si INPUT no esta vacio

        })

        //Para ver profesores sugeridos anteriormente
        $.ajax({
                type: "POST",
                url: "send_suggest_teacher.php",
                data:'teacherSuggestItem='+teacherItem+'&suggestTeacherName='+suggestTeacherName+'&teacherId='+teacherId,
                success: function(data){
                  //Asignar valor desde send_suggest_teacher.php al id del div signDiv
                  $("#suggestSavedDiv").html(data);
                }
                });

  }


  function sendSuggestScheduleFunc(item, idTeacher) {

   var teacherItem = item,
              teacherId = idTeacher,
              startTime = "",
              endTime = "";

              var startTimeValue = $("#timepickerStart").val(),
                  endTimeValue = $("#timepickerend").val();

                  startTime = startTimeValue;
                  endTime = endTimeValue;

              $('#timepickerStart').timepicker().on('changeTime.timepicker', function(e) {
                startTime = e.time.value;
              });
              $('#timepickerend').timepicker().on('changeTime.timepicker', function(e) {
                endTime = e.time.value;
              });

        $("#btnSaveSuggestSchedule").on("click", function(){

          var formValid = $("#formSuggestSchedule").valid();
          //Comprobar si INPUT no esta vacio
              if (formValid) {
               
               $("#btnSaveSuggestSchedule").addClass("disabled");

               //Convertir hora12 a hora24 de hora inicio
               function convertStartTime(time) {

                var hrs = Number(time.match(/^(\d+)/)[1]);
                var mnts = Number(time.match(/:(\d+)/)[1]);
                var format = time.match(/\s(.*)$/)[1];
                if (format == "PM" && hrs < 12) hrs = hrs + 12;
                if (format == "AM" && hrs == 12) hrs = hrs - 12;
                var hours = hrs.toString();
                var minutes = mnts.toString();
                if (hrs < 10) hours = "0" + hours;
                if (mnts < 10) minutes = "0" + minutes;

                return hours + ":" + minutes;

                }

                //Convertir hora12 a hora24 de hora fin
               function convertEndTime(time) {

                var hrs = Number(time.match(/^(\d+)/)[1]);
                var mnts = Number(time.match(/:(\d+)/)[1]);
                var format = time.match(/\s(.*)$/)[1];
                if (format == "PM" && hrs < 12) hrs = hrs + 12;
                if (format == "AM" && hrs == 12) hrs = hrs - 12;
                var hours = hrs.toString();
                var minutes = mnts.toString();
                if (hrs < 10) hours = "0" + hours;
                if (mnts < 10) minutes = "0" + minutes;

                return hours + ":" + minutes;

                }

               $.ajax({
                type: "POST",
                url: "send_suggest_schedule.php",
                data:'teacherSuggestItem='+teacherItem+'&teacherId='+teacherId+'&startTime='+convertStartTime(startTime)+'&endTime='+convertEndTime(endTime),
                success: function(data){
                  //Asignar valor desde send_suggest_schedule.php al id del div signDiv
                  
                  if (data == "Horario sugerido.") {
                    alert("Horario sugerido.")
                    location.reload();
                  }

                }
                });

               }//Comprobar si INPUT no esta vacio

        })

  }


  function sendSuggestClassRoomFunc(item, idTeacher) {

   var teacherItem = item,
              teacherId = idTeacher;

        $("#btnSaveSuggestClassRoom").on("click", function(){

          var formValid = $("#formSuggestClassRoom").valid();
          //Comprobar si INPUT no esta vacio
              if (formValid) {

                $("#btnSaveSuggestClassRoom").addClass("disabled");

                var classRoomValue = $("#suggestClassRoomName").val();
                var edificeValue = $("#suggestEdificeName").val();

               $.ajax({
                type: "POST",
                url: "send_suggest_class_room.php",
                data:'teacherSuggestItem='+teacherItem+'&teacherId='+teacherId+'&suggestClassRoomName='+classRoomValue+'&suggestEdificeName='+edificeValue,
                success: function(data){
                  //Asignar valor desde send_suggest_class_room.php al id del div signDiv
                  
                  if (data == "Aula sugerido.") {
                    alert("Aula sugerido.")
                    location.reload();
                  }

                }
                });

               }//Comprobar si INPUT no esta vacio

        })

  }

  function sendFeedbacksTeacherFunc(item, idTeacher) {

   var teacherItem = item,
              teacherId = idTeacher;

        $("#btnSaveFeedbacksTeacher").on("click", function(){

          var formValid = $("#formFeddbacksTeacher").valid();
          //Comprobar si INPUT no esta vacio
              if (formValid) {

                $("#btnSaveFeedbacksTeacher").addClass("disabled");
                
                var feedbackValue = $("#feedbacksSelectTeacher").val();

               $.ajax({
                type: "POST",
                url: "send_feedback_teacher.php",
                data:'teacherSuggestItem='+teacherItem+'&teacherId='+teacherId+'&feedbacksSelectTeacher='+feedbackValue,
                success: function(data){
                  //Asignar valor desde send_feedback_teacher.php al id del div signDiv
                  
                  if (data == "Retroalimentación enviado.") {
                    alert("Retroalimentación enviado.")
                    location.reload();
                  }

                }
                });

               }//Comprobar si INPUT no esta vacio

        })

  }

/*-------------------------------view_teacher_to_sign_view---------------------------------------------------------*/