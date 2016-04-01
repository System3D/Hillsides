function getProjetoCadastro(){
	$('#loader').removeClass('hidden'); 
	$.ajax({
	    url: urlbaseGeral+"/cadastro/projeto",
	    type: 'POST',
	    dataType: 'html',
	  })
	  .done(function(response) {
	  	drawModal(response);
	  });
	$('#loader').addClass('hidden'); 
}

function getClienteCadastro(){
	$('#loader').removeClass('hidden'); 
	$.ajax({
	    url: urlbaseGeral+"/cadastro/cliente",
	    type: 'POST',
	    dataType: 'html',
	  })
	  .done(function(response) {
	  	drawModal(response);
	  });
	$('#loader').addClass('hidden'); 
}

function drawModal(data, widtth, no){
	if((data != modal_history.last() || modal_history.last() == false) && no != true){
		modal_history.push(data);
	  	modal_width.push(widtth);
	}
	var wideth =  widtth != undefined ? widtth : '60%';
	$('#modal-content').parent('.modal-dialog').css('width', wideth);
	$('#modal-content').html(data);
	startPlugins();
  	$('#modal').modal("show");
}

 $(document).ready(function(){

 	$(document).on('click', '#voltar_modal', function(event) {
 		event.preventDefault();
 		if(window.modal_history.befLast() != false){
 			$('#modal-content').parent('.modal-dialog').css('width', window.modal_width.befLast());
 			$('#modal-content').html(window.modal_history.befLast());
 			window.modal_history.pop();
 			window.modal_width.pop();
	 		if($(event.target).hasClass('voltar-table')){
	 			$('#modalTable').DataTable({
	            responsive: true,
	            "iDisplayLength": 25,
	        });
 		}
 		}else{
 			window.modal_history = [false];
        	window.modal_width = ['60%'];
        	$('#modal').modal("hide");
 		}	
 	});

 	$(document).on('submit', '.modal_form', function(event) {
 		$('#modal_loader').removeClass('hidden');
 		window.modal_history.pop();
 		window.modal_width.pop();
 		window.modal_history.pop();
 		window.modal_width.pop();
 		var values = $(this).serializeAndEncode();
 		event.preventDefault();
 		$.ajax({
	    url: urlbaseGeral+"/cadastro/store",
	    data: {dados: values},
	    type: 'POST',
	    dataType: 'html',
	  })
	  .done(function(rp) {
	    var rex = rp.split('%');
	  	r =  rex[1];
	  	var res = r.split("&");
        flashMessage(res[0], res[1]);
	  	if(res[2] == 'E'){
  		$.ajax({
		    url: urlbaseGeral+"/equipes/info",
		    type: 'POST',
		    data: {id:res[3]},
		    dataType: 'html',
		  })
		  .done(function(response) {
		  	drawModal(response, '40%');
		  });
	  	}else if(res[2] == 'S'){
        	$.ajax({
		    url: urlbaseGeral+"/projetos/sprints",
		    type: 'POST',
		    data: {id:res[3]},
		    dataType: 'html',
		  })
		  .done(function(response) {
		  	drawModal(response, '60%');
		  	 $('#modalTable').DataTable({
	            responsive: true,
	            "iDisplayLength": 25,
	        });
		  });
    	}else if(res[2] == 'H'){
    			$.ajax({
		        url: urlbaseGeral+"/projetos/historias",
		        type: 'POST',
		        data: {id:res[4], tipo:res[3]},
		        dataType: 'html',
		      })
		      .done(function(response) {
		        drawModal(response,'60%');
		           $('#modalTable').DataTable({
		            responsive: true,
		            "iDisplayLength": 25,
		        });
             });
    	}else if(res[2] == 'D'){
    			$.ajax({
		        url: urlbaseGeral+"/projetos/disciplinas",
		        type: 'POST',
		        data: {id:res[3]},
		        dataType: 'html',
		      })
		      .done(function(response) {
		        drawModal(response,'60%');
		           $('#modalTable').DataTable({
		            responsive: true,
		            "iDisplayLength": 25,
		        });
             });
    	}else if(res[2] == 'ET'){
    			$.ajax({
		        url: urlbaseGeral+"/projetos/etapas",
		        type: 'POST',
		        data: {id:res[3]},
		        dataType: 'html',
		      })
		      .done(function(response) {
		        drawModal(response,'60%');
		           $('#modalTable').DataTable({
		            responsive: true,
		            "iDisplayLength": 25,
		        });
             });
    	}else{
	  		$('#modal').modal("hide");
	  	}
	  
        if(res[2]){
        	if(res[2] == 'C'){
        		$('#clientesTable').DataTable().ajax.reload();
        	}else if(res[2] == 'E'){
        		$('#equipesTable').DataTable().ajax.reload();
        	}
        }
        $('#modal_loader').addClass('hidden');
	  });
 	});
 });

function startPlugins(){
	   $('.datePicker').datepicker({
        format: "dd/mm/yyyy",
        language: "pt-BR",
        autoclose: true,
        todayHighlight: true,
        todayBtn: "linked",
        showOnFocus: true,
        immediateUpdates: true,
    });
}