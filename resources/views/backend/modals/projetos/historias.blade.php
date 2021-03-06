<div class="panel panel-success">
   <div class="panel-heading">
   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
       <h4>Agrupamentos de {{$obj->descricao}}</h4>
   </div>
   <div class="panel-body">
	   <div class="row">
	   		<div class="col-md-12">
	   			<div class="table-responsive">
	   			<table class="table table-striped table-bordered dt-responsive nowrap table-hover" cellspacing="0" width="100%" id="modalTable">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Observações</th>
							<th>Sprint</th>
							<th>Criado</th>
							<th></th>
						</tr>
					</thead>
					@if(isset($historias->first()->id))
						@foreach($historias as $historia)
							<tr>
							<td>{{$historia->descricao}}</td>
							<td>{{$historia->obs}}</td>
							<td>{{$historia->sprint->descricao}}</td>
							<td>{{date('d/m/Y',strtotime($historia->created_at))}}</td>
							<td style="text-align:center">
								<a href="#" class="btn btn-primary btn-xs" data-id='{{$historia->id}}' data-toggle="tooltip" data-html="true" id='editar-historia' data-tipo='{{$tipo}}' title='Editar'>
									<i class="fa fa-pencil"></i>
								</a>
								<a href="#" class="btn btn-danger btn-xs" data-id='{{$historia->id}}' data-toggle="tooltip" data-tipo='{{$tipo}}' data-html="true" id='excluir-historia' title='Excluir'>
									<i class="fa fa-trash"></i>
								</a>
							</td>
							</tr>
						@endforeach
					@endif
				</table>
				</div>
				<a href="#" style='margin:15px' data-id='{{$obj->id}}' data-tipo='{{$tipo}}' data-force='{{$force}}' class="btn btn-primary criar-historia">Novo Agrupamento</a>
				<a href='#' id='voltar_modal' class="btn btn-warning pull-right voltar-table" style='margin:15px'>Voltar</a>
	   		</div>
	   </div>
   </div>
</div>