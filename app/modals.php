<?php 

if (! function_exists('projeto_cadastro')) {
/**
 * Helper to grab the application name
 *
 * @return mixed
 */
function projeto_cadastro()
{
    $data = '<div class="panel panel-info"><div class="panel-heading"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4>Cadastro de Projeto</h4></div><div class="panel-body"><form id="projeto_cadastro" class="modal_form" data-parsley-validate=""><div class="row"><div class="col-md-6"><div class="form-group"><label for="fullname" class="control-label">Descrição:</label><input type="text" class="form-control" required="" data-parsley-trigger="change" name="descricao"></div><div class="form-group"><label for="fullname" class="control-label">Observações:</label><textarea id="message" rows="3" class="form-control" name="message" data-parsley-trigger="change" data-parsley-minlength="10" data-parsley-maxlength="100" data-parsley-validation-threshold="10" name="obs"></textarea></div><br><br><div class="form-group"><button type="submit" class="btn btn-primary">Gravar</button> <button data-dismiss="modal" aria-hidden="true" class="btn btn-danger">Cancelar</button></div></div><div class="col-md-6"><div class="form-group"><label class="control-label">Cliente:</label><select name="cliente" class="form-control"><option value="1">Paludo</option><option value="3">Cassol</option><option value="2">Vladimir</option></select></div><div class="form-group"><label class="control-label">Tipo:</label><select name="cliente" class="form-control"><option value="1">Paludo</option><option value="3">Cassol</option><option value="2">Vladimir</option></select></div><div class="form-group"><label class="control-label">Status:</label><select name="cliente" class="form-control"><option value="1">Paludo</option><option value="3">Cassol</option><option value="2">Vladimir</option></select></div></div></div> </form></div></div>';

    return $data;
}
}




 ?>