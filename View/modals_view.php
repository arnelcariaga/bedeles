<!-- Modal teacher sign -->
<div class="modal fade" id="modalSignTeacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Firmar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Inicio columna 1 -->
        <div class="col-12">
          <div id="signDiv" class="pt-3">
            
          </div>
        </div>
        <!-- Fin columna 1 -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal sugerir profesor -->
<div class="modal fade" id="modalTeacherSuggest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profesor a sugerir</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Inicio columna 1 -->
        <div class="col-12">
          <form class="p-4" id="formSuggestTeacher">
              <div class="form-group">
                <input type="text" class="form-control" id="suggestTeacherName" name="suggestTeacherName" placeholder="Nombre del profesor" required>
              </div>
              <button type="button" id="btnSaveSuggestTeacherName" name="btnSaveSuggestTeacherName" class="btn btn-success">Aceptar</button>
          </form>
        </div>
        <!-- Fin columna 1 -->

        <!-- Inicio columna 2 -->
        <div class="col-12">
          <div id="suggestSavedDiv">
            
          </div>
        </div>
        <!-- Fin columna 2 -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal sugerir horario -->
<div class="modal fade" id="modalScheduleSuggest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sugerir horario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Inicio columna 1 -->
        <div class="col-12">
          <form class="p-4" id="formSuggestSchedule">

            <div class="col-12 mb-3 bootstrap-timepicker timepicker">
              <label>Hora inicio</label>
              <div class="input-group">
                <input type="text" class="form-control" id="timepickerStart" name="timepickerStart" required>
                <div class="input-group-prepend">
                  <span class="input-group-text input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                </div>
                <div class="invalid-feedback">
                  Campo obligatorio.
                </div>
              </div>
            </div>

            <div class="col-12 mb-3 bootstrap-timepicker timepicker">
              <label>Hora final</label>
              <div class="input-group">
                <input type="text" class="form-control" id="timepickerend" name="timepickerend" required>
                <div class="input-group-prepend">
                  <span class="input-group-text input-group-addon"><i class="fa fa-clock-o" aria-hidden="true"></i></span>
                </div>
                <div class="invalid-feedback">
                  Campo obligatorio.
                </div>
              </div>
            </div>

            <div class="col-12">
              <button type="button" id="btnSaveSuggestSchedule" name="btnSaveSuggestSchedule" class="btn btn-success">Aceptar</button>
            </div> 

            </form>
        </div>
        <!-- Fin columna 1 -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal sugerir aula -->
<div class="modal fade" id="modalClassRoomSuggest" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sugerir aula</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Inicio columna 1 -->
        <div class="col-12">
          <form class="p-4" id="formSuggestClassRoom">

              <div class="form-group">
                <input type="text" class="form-control" id="suggestClassRoomName" name="suggestClassRoomName" placeholder="Aula" required>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" id="suggestEdificeName" name="suggestEdificeName" placeholder="Edificio" required>
              </div>

              <button type="button" id="btnSaveSuggestClassRoom" name="btnSaveSuggestClassRoom" class="btn btn-success">Aceptar</button>

          </form>
        </div>
        <!-- Fin columna 1 -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal retroalimentacion de profesor -->
<div class="modal fade" id="modalFeedbacksTeacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Retroalimentación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Inicio columna 1 -->
        <div class="col-12">
          <form class="p-4" id="formFeddbacksTeacher">

              <div class="form-group">
              <select class="custom-select" required id="feedbacksSelectTeacher" name="feedbacksSelectTeacher">
                <option value="">Seleccione</option>
                <?php
                      $sth_return_teacher_feedbacks = $model_class->get_feedbacks_teachers();
                      while ($row = $sth_return_teacher_feedbacks->fetch(PDO::FETCH_ASSOC)) { ?>
                    <option value="<?php echo $row['id']; ?>"><?php echo $row['descripcion']; ?></option>
                <?php } ?>
              </select>
              <div class="invalid-feedback">Campo obligatorio.</div>
            </div>

              <button type="button" id="btnSaveFeedbacksTeacher" name="btnSaveFeedbacksTeacher" class="btn btn-success">Aceptar</button>

          </form>
        </div>
        <!-- Fin columna 1 -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>