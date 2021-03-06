<div class="panel panel-info">
   <div class="panel-heading">
   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       <h4>Editar {{$historia->descricao}}</h4>
   </div>
   <div class="panel-body">
       <form id="historia_editar" data-parsley-validate="">
	     <input type="hidden" name="tipo_cadastro" value="historias">
       <input type="hidden" name="tipo" value="{{$tipo}}">
       <input type="hidden" name="id" value="{{$historia->id}}">
       	<div class="row">
       		<div class="col-md-12">
       			<div class="form-group">
                   <label for="fullname" class="control-label">Nome <i class="text-red">*</i> :</label>
                     <input type="text" class="form-control" required="" data-parsley-trigger="change" name="descricao" style='width:100%' value='{{$historia->descricao}}'>
                </div>

                <div class="form-group">
                   <label for="fullname" class="control-label">Observações:</label>
                      <textarea id="message" rows="3" class="form-control" data-parsley-trigger="keyup" name="obs" style='width:100%'>{{$historia->obs}}</textarea>
                </div>


                  <div class="form-group">
                   <label for="fullname" class="control-label">Sprint:</label>
                     <select class="form-control" required="" style='width:100%' name='sprint_id'>
                       @foreach($sprints as $sprint)
                        <option value="{{$sprint->id}}" <?php if($sprint->id == $historia->sprint_id) echo 'selected'; ?>>{{$sprint->descricao}}</option>
                       @endforeach
                     </select>
                </div>


                <br><br>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Atualizar</button>
                  <a href='#' id='voltar_modal' class="btn btn-danger voltar-table">Cancelar</a>
              </div>
       		</div>
       	</div> 
       </form>
   </div>
</div>