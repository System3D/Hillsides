<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Projeto as proj;
use App\Estagio as estag;
use App\Status_Projeto as stp;
use App\Estagio_Default as esdef;
use App\Status_tarefa as stt;
use App\Tipo_Tarefa as ttf;
use App\Status_Projeto_Default as spd;
use App\Status_Tarefa_Default as sfd;
use App\Tipo_Tarefa_Default as trd;
use App\Setting as sets;
use Kanban;

class SettingsController extends Controller
{
    public function gravarEstagio(request $request){
      if(!isAllowed('config-geral')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
    	$value = ucfirst($request['value']);
    	$last = esdef::orderBy('ordem', 'desc')->first();
    	$data = array(
    		'descricao'    => $value,
    		'locatario_id' => access()->user()->locatario_id,
    		'ordem'        => !empty($last->ordem) ? ($last->ordem + 1) : 1
		);
		$check = esdef::where('descricao', $value)->first();
		if(!empty($check->id)){
			$response['msg'] = 'Este nome ja esta sendo usado';
			$response['status'] = 'error';
			return $response;
		}
		$new = esdef::create($data);
		if($new){
			$response['status'] = 'success';
			$response['msg'] = 'Estágio Adicionado com Sucesso';
			$response['id']  = $new->id;
			$response['desc'] = $new->descricao;
		}else{
			$response['msg'] = 'Erro ao Adicionar Estágio';
			$response['status'] = 'error';
		}
		return $response;
    }

    public function deleteEstagio(request $request){
      if(!isAllowed('config-geral')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
    	$dados = $request->all();
    	$id = $dados['id'];
    	$newO = esdef::find($id);
      $new = $newO->delete();
    	if($new){
			$response['status'] = 'success';
			$response['msg'] = 'Estágio Deletado com Sucesso';
		}else{
			$response['msg'] = 'Erro ao Deletar Estágio';
			$response['status'] = 'error';
		}
		return $response;
    }

     public function gravarStp(request $request){
      if(!isAllowed('config-geral')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
     	$value = ucfirst($request['value']);
    	$data = array(
    		'descricao'    => $value,
    		'locatario_id' => access()->user()->locatario_id
		);
		$check = spd::where('descricao', $value)->first();
		if(!empty($check->id)){
			$response['msg'] = 'Este nome ja esta sendo usado';
			$response['status'] = 'error';
			return $response;
		}
		$new = spd::create($data);
		if($new){
			$response['status'] = 'success';
			$response['msg'] = 'Status Adicionado com Sucesso';
			$response['id']  = $new->id;
			$response['desc'] = $new->descricao;
		}else{
			$response['msg'] = 'Erro ao Adicionar Status';
			$response['status'] = 'error';
		}
		return $response;
     }

     public function deleteStp(request $request){
      if(!isAllowed('config-geral')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
    	$dados = $request->all();
    	$id = $dados['id'];
    	$new = spd::find($id)->delete();
    	if($new){
			$response['status'] = 'success';
			$response['msg'] = 'Status Deletado com Sucesso';
		}else{
			$response['msg'] = 'Erro ao Deletar Status';
			$response['status'] = 'error';
		}
		return $response;
    }

    public function gravarSfp(request $request){
      if(!isAllowed('config-geral')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
     	$value = ucfirst($request['value']);
    	$data = array(
    		'descricao'    => $value,
    		'locatario_id' => access()->user()->locatario_id
		);
		$check = sfd::where('descricao', $value)->first();
		if(!empty($check->id)){
			$response['msg'] = 'Este nome ja esta sendo usado';
			$response['status'] = 'error';
			return $response;
		}
		$new = sfd::create($data);
		if($new){
			$response['status'] = 'success';
			$response['msg'] = 'Status Adicionado com Sucesso';
			$response['id']  = $new->id;
			$response['desc'] = $new->descricao;
		}else{
			$response['msg'] = 'Erro ao Adicionar Status';
			$response['status'] = 'error';
		}
		return $response;
     }

     public function deleteSfp(request $request){
      if(!isAllowed('config-geral')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
    	$dados = $request->all();
    	$id = $dados['id'];
    	$new = sfd::find($id)->delete();
    	if($new){
			$response['status'] = 'success';
			$response['msg'] = 'Status Deletado com Sucesso';
		}else{
			$response['msg'] = 'Erro ao Deletar Status';
			$response['status'] = 'error';
		}
		return $response;
    }

    public function gravarTrp(request $request){
      if(!isAllowed('config-geral')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
     	$value = ucfirst($request['value']);
    	$data = array(
    		'descricao'    => $value,
    		'locatario_id' => access()->user()->locatario_id,
    		'cor'          => '#FFFFFF',
    		'icone'        => 'default.png'
		);
		$check = trd::where('descricao', $value)->first();
		if(!empty($check->id)){
			$response['msg'] = 'Este nome ja esta sendo usado';
			$response['status'] = 'error';
			return $response;
		}
		$new = trd::create($data);
		if($new){
			$response['status'] = 'success';
			$response['msg'] = 'Tipo Adicionado com Sucesso';
			$response['id']  = $new->id;
			$response['desc'] = $new->descricao;
      $response['cor'] = $new->cor;
		}else{
			$response['msg'] = 'Erro ao Adicionar STipotatus';
			$response['status'] = 'error';
		}
		return $response;
     }

     public function deleteTrp(request $request){
      if(!isAllowed('config-geral')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
    	$dados = $request->all();
    	$id = $dados['id'];
    	$new = trd::find($id)->delete();
    	if($new){
			$response['status'] = 'success';
			$response['msg'] = 'Tipo Deletado com Sucesso';
		}else{
			$response['msg'] = 'Erro ao Deletar Tipo';
			$response['status'] = 'error';
		}
		return $response;
    }

    public function setOrder(request $request){
      if(!isAllowed('config-geral')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
    	$dados = $request['sorted'];
    	$ordem = 1;
    	foreach($dados as $dado){
    		$id = str_replace('EsO', '', $dado);
    		$data = array('ordem' => $ordem);
    		$new = esdef::find($id)->update($data);
    		$ordem++;
    	}
    }

    public function setIcon(request $request){
      if(!isAllowed('config-geral')){
        return view('backend.modals.unauthorized');
      } 
    	$id = $request['id'];
    	$tarefa = trd::find($id);
      $icones = \App\Icone::all();
    	return view('backend.modals.settings.icon', compact('tarefa','icones'));
    }

    public function proj_setIcon(request $request){
      if(!isAllowed('editar-projetos')){
        return view('backend.modals.unauthorized');
      } 
      $id = $request['id'];
      $tarefa = ttf::find($id);
      $icones = \App\Icone::all();
      return view('backend.modals.settings.proj-icon', compact('tarefa','icones'));
    }

    public function setColor(request $request){
      if(!isAllowed('config-geral')){
        return view('backend.modals.unauthorized');
      } 
      $id = $request['id'];
      $tarefa = trd::find($id);
      return view('backend.modals.settings.color', compact('tarefa'));
    }

    public function proj_setColor(request $request){
      if(!isAllowed('editar-projetos')){
        return view('backend.modals.unauthorized');
      } 
      $id = $request['id'];
      $tarefa = ttf::find($id);
      return view('backend.modals.settings.proj-color', compact('tarefa'));
    }

    public function storeIcon(request $request){
      if(!isAllowed('config-geral')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
    	$dados = $request->all();
      if(isset($dados['select'])){
        $path = 'public/img/icones/';
        $tarefa = trd::find($dados['tarefa']);
        if(file_exists($path.$dados['icon'])){
          $toUp = array('icone' => $dados['icon']);
          $tarefa->update($toUp);
          if($tarefa){
            $response['msg'] = 'Icone Atualizado com Sucesso';
              $response['status'] = 'success';
              $response['img'] =  asset('img/icones/'.$dados['icon']);
              $response['idt'] = $tarefa->id;
          }
        }else{
            $response['msg'] = 'Error ao salvar icone';
            $response['status'] = 'error';
        }
        return $response;

      }else{
        	$image = $dados['icon'];
        	$tarefa = trd::find($dados['tarefa']);
    		 $exts = array('jpg', 'jpeg', 'png', 'gif', 'jpe', 'jif', 'jfif', 'jfi');
    	        $extension = $image->getClientOriginalExtension();
    	        if(!in_array($extension, $exts)){
    	           $response['msg'] = 'Extensão Invalida';
    			   $response['status'] = 'error';
    			   return $response;
    	        }
    	    $name = $tarefa->id.'default.'.$extension;
    	    $path = 'public/img/icones/';
    	    $request->file('icon')->move($path, $name);
    	 	if(file_exists($path.$name)){
    	 		$toUp = array('icone' => $name);
    	 		$tarefa->update($toUp);
    	 		if($tarefa){
    	 			$response['msg'] = 'Icone Atualizado com Sucesso';
    		    	$response['status'] = 'success';
    		    	$response['img'] =  asset('img/icones/'.$name);
    		    	$response['idt'] = $tarefa->id;
    	 		}
    	 	}else{
    	 	    $response['msg'] = 'Error ao salvar icone';
    		    $response['status'] = 'error';
    	 	}
    	 	return $response;
        }
    }

    public function proj_storeIcon(request $request){
      if(!isAllowed('editar-projetos')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
      $dados = $request->all();
      if(isset($dados['select'])){
        $path = 'public/img/icones/';
        $tarefa = ttf::find($dados['tarefa']);
        if(file_exists($path.$dados['icon'])){
          $toUp = array('icone' => $dados['icon']);
          $tarefa->update($toUp);
           if($tarefa){
          $response['msg'] = 'Icone Atualizado com Sucesso';
            $response['status'] = 'success';
            $response['id'] = $tarefa->projeto_id;
        }
      }else{
          $response['msg'] = 'Error ao salvar icone';
          $response['status'] = 'error';
      }
        return $response;

      }else{
        $image = $dados['icon'];
        $tarefa = ttf::find($dados['tarefa']);
       $exts = array('jpg', 'jpeg', 'png', 'gif', 'jpe', 'jif', 'jfif', 'jfi');
            $extension = $image->getClientOriginalExtension();
            if(!in_array($extension, $exts)){
               $response['msg'] = 'Extensão Invalida';
           $response['status'] = 'error';
           return $response;
            }
        $name = $tarefa->id.'.'.$extension;
        $path = 'public/img/icones/';
        $request->file('icon')->move($path, $name);
      if(file_exists($path.$name)){
        $toUp = array('icone' => $name);
        $tarefa->update($toUp);
        if($tarefa){
          $response['msg'] = 'Icone Atualizado com Sucesso';
            $response['status'] = 'success';
            $response['id'] = $tarefa->projeto_id;
        }
      }else{
          $response['msg'] = 'Error ao salvar icone';
          $response['status'] = 'error';
      }
      return $response;
    }
    }

    public function storeColor(request $request){
      if(!isAllowed('config-geral')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
      $Alldados = $request->all();
      $dadosBefore = urldecode($Alldados['dados']);
      $dados = explode('&', $dadosBefore);
      foreach($dados as $dado){
          $check2 = explode('=',$dado);
          if($check2[1] != ''){
            $check[$check2[0]] = $check2[1];
          }
      }
      $toUp = array('cor' => $check['cor']);
      $update = trd::find($check['tarefa']);
      $updated = $update->update($toUp);
      if($updated){
        $response['msg'] = 'Cor Atualizada com Sucesso';
          $response['status'] = 'success';
          $response['cor'] =  $check['cor'];
          $response['id'] = $update->id;
    }else{
        $response['msg'] = 'Error ao salvar cor';
        $response['status'] = 'error';
    }
    return $response;
    }

    public function proj_storeColor(request $request){
      if(!isAllowed('editar-projetos')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
      $Alldados = $request->all();
      $dadosBefore = urldecode($Alldados['dados']);
      $dados = explode('&', $dadosBefore);
      foreach($dados as $dado){
          $check2 = explode('=',$dado);
          if($check2[1] != ''){
            $check[$check2[0]] = $check2[1];
          }
      }
      $toUp = array('cor' => $check['cor']);
      $update = ttf::find($check['tarefa']);
      $updated = $update->update($toUp);
      if($updated){
        $response['msg'] = 'Cor Atualizada com Sucesso';
          $response['status'] = 'success';
          $response['id'] = $update->projeto_id;
    }else{
        $response['msg'] = 'Error ao salvar cor';
        $response['status'] = 'error';
    }
    return $response;
    }

    public function proj_estagios(request $request){
	    $id = $request['id'];
	    $projeto = proj::find($id);
	    return view('backend.modals.settings.estagios', compact('projeto'));
	  }

   public function proj_setOrder(request $request){
    if(!isAllowed('editar-projetos')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
   	$req = $request->all();
   	$dados = $request['sorted'];
	$ordem = 1;
  $proj = false;
	foreach($dados as $dado){
		$id = $dado;
		$data = array('ordem' => $ordem);
		$new = estag::find($id);
    if(!$proj)
      $proj = $new->projeto_id;
    $new->update($data);
		$ordem++;
	}
   }

   public function proj_estagioEdit(request $request){
    if(!isAllowed('editar-projetos')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
   	$Alldados = $request->all();
    $dadosBefore = urldecode($Alldados['dados']);
    $dados = explode('&', $dadosBefore);
    foreach($dados as $dado){
        $check2 = explode('=',$dado);
        if($check2[1] != ''){
          $check[$check2[0]] = $check2[1];
        }
    }
    $toUp = array('descricao' => $check['descricao']);
    $update = estag::find($check['id']);
    $old = $update->descricao;
    $updated = $update->update($toUp);
    if($updated){
		$response['msg'] = 'Estágio Atualizado com Sucesso';
    	$response['status'] = 'success';
    	$response['id'] = $update->projeto_id;
       Kanban::configUpdate('Estágios', access()->user()->id, $update->projeto_id);
 	}else{
 	    $response['msg'] = 'Erro ao Atualizar Estágio';
	    $response['status'] = 'error';
 	}
 	return $response;
   }

   public function proj_estagioNovo(request $request){
   		$id = $request['id'];
	    $projeto = proj::find($id);
	    return view('backend.modals.settings.criar-estagio', compact('projeto'));
   }

   public function proj_estagioExcluir(request $request){
    if(!isAllowed('editar-projetos')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
   	$id = $request['id'];
    $new = estag::find($id);
    if(isset($new->tarefas->first()->id)){
    	$response['msg'] = 'Estágios com tarefas atribuidas não podem ser excluidos.';
	    $response['status'] = 'error';
	    return $response;
    }
    $idgo = $new->projeto_id;
    $new->delete();
    $response['msg'] = 'Estágio Excluido com Sucesso';
    $response['status'] = 'success';
    $response['id'] = $idgo;
    Kanban::configUpdate('Estágios', access()->user()->id, $idgo);
    return $response;
   }

   public function proj_stProjeto(request $request){
    if(!isAllowed('editar-projetos')){
        return view('backend.modals.unauthorized');
      } 
    $id = $request['id'];
    $projeto = proj::find($id);
    return view('backend.modals.settings.stProjeto', compact('projeto'));
  }

  public function proj_stEdit(request $request){
    if(!isAllowed('editar-projetos')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
   	$Alldados = $request->all();
    $dadosBefore = urldecode($Alldados['dados']);
    $dados = explode('&', $dadosBefore);
    foreach($dados as $dado){
        $check2 = explode('=',$dado);
        if($check2[1] != ''){
          $check[$check2[0]] = $check2[1];
        }
    }
    $toUp = array('descricao' => $check['descricao']);
    $update = stp::find($check['id']);
    $updated = $update->update($toUp);
    if($updated){
		$response['msg'] = 'Status Atualizado com Sucesso';
    	$response['status'] = 'success';
    	$response['id'] = $update->projeto_id;
 	}else{
 	    $response['msg'] = 'Erro ao Atualizar Status';
	    $response['status'] = 'error';
 	}
 	return $response;
   }

   public function proj_stNovo(request $request){
    if(!isAllowed('editar-projetos')){
        return view('backend.modals.unauthorized');
      } 
   		$id = $request['id'];
	    $projeto = proj::find($id);
	    return view('backend.modals.settings.criar-stp', compact('projeto'));
   }

   public function proj_stExcluir(request $request){
    if(!isAllowed('editar-projetos')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
   	$id = $request['id'];
    $new = stp::find($id);
    if(isset($new->projetos->first()->id)){
    	$response['msg'] = 'Status atribuido ao projeto, não pode ser excluido.';
	    $response['status'] = 'error';
	    return $response;
    }
    $idgo = $new->projeto_id;
    $new->delete();
    $response['msg'] = 'Status Excluido com Sucesso';
    $response['status'] = 'success';
    $response['id'] = $idgo;
    return $response;
   }

   ///

   public function proj_srTarefa(request $request){
    if(!isAllowed('editar-projetos')){
        return view('backend.modals.unauthorized');
      } 
    $id = $request['id'];
    $projeto = proj::find($id);
    return view('backend.modals.settings.srTarefa', compact('projeto'));
  }

  public function proj_srEdit(request $request){
    if(!isAllowed('editar-projetos')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
   	$Alldados = $request->all();
    $dadosBefore = urldecode($Alldados['dados']);
    $dados = explode('&', $dadosBefore);
    foreach($dados as $dado){
        $check2 = explode('=',$dado);
        if($check2[1] != ''){
          $check[$check2[0]] = $check2[1];
        }
    }
    $toUp = array('descricao' => $check['descricao']);
    $update = stt::find($check['id']);
    $updated = $update->update($toUp);
    if($updated){
		$response['msg'] = 'Status Atualizado com Sucesso';
    	$response['status'] = 'success';
    	$response['id'] = $update->projeto_id;
 	}else{
 	    $response['msg'] = 'Erro ao Atualizar Status';
	    $response['status'] = 'error';
 	}
 	return $response;
   }

   public function proj_srNovo(request $request){
    if(!isAllowed('editar-projetos')){
        return view('backend.modals.unauthorized');
      } 
   		$id = $request['id'];
	    $projeto = proj::find($id);
	    return view('backend.modals.settings.criar-stt', compact('projeto'));
   }

   public function proj_srExcluir(request $request){
    if(!isAllowed('editar-projetos')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
   	$id = $request['id'];
    $new = stt::find($id);
    if(isset($new->tarefas->first()->id)){
    	$response['msg'] = 'Status atribuido a tarefa(s), não pode ser excluido.';
	    $response['status'] = 'error';
	    return $response;
    }
    $idgo = $new->projeto_id;
    $new->delete();
    $response['msg'] = 'Status Excluido com Sucesso';
    $response['status'] = 'success';
    $response['id'] = $idgo;
    return $response;
   }

   public function proj_tpTarefa(request $request){
    if(!isAllowed('editar-projetos')){
        return view('backend.modals.unauthorized');
      } 
      $id = $request['id'];
      $projeto = proj::find($id);
      return view('backend.modals.settings.ttp', compact('projeto'));
   }

    public function proj_ttCreate(request $request){
      if(!isAllowed('editar-projetos')){
        return view('backend.modals.unauthorized');
      } 
      $id = $request['id'];
      $projeto = proj::find($id);
      return view('backend.modals.settings.criar-tt', compact('projeto'));
   }

   public function proj_ttExcluir(request $request){
    if(!isAllowed('editar-projetos')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
    $id = $request['id'];
    $new = ttf::find($id);
    if(isset($new->tarefas->first()->id)){
      $response['msg'] = 'Tipo atribuido a tarefa(s), não pode ser excluido.';
      $response['status'] = 'error';
      return $response;
    }
    $idgo = $new->projeto_id;
    $new->delete();
    $response['msg'] = 'Tipo Excluido com Sucesso';
    $response['status'] = 'success';
    $response['id'] = $idgo;
    return $response;
   }

     public function proj_ttEdit(request $request){
      if(!isAllowed('editar-projetos')){
        $r = [];
        $r['status'] = 'error';
        $r['msg'] = 'Você não tem permissão para fazer isto.';
        return $r;
      }
    $Alldados = $request->all();
    $dadosBefore = urldecode($Alldados['dados']);
    $dados = explode('&', $dadosBefore);
    foreach($dados as $dado){
        $check2 = explode('=',$dado);
        if($check2[1] != ''){
          $check[$check2[0]] = $check2[1];
        }
    }
    $toUp = array('descricao' => $check['descricao']);
    $update = ttf::find($check['id']);
    $updated = $update->update($toUp);
    if($updated){
    $response['msg'] = 'Tipo Atualizado com Sucesso';
      $response['status'] = 'success';
      $response['id'] = $update->projeto_id;
  }else{
      $response['msg'] = 'Erro ao Atualizar Tipo';
      $response['status'] = 'error';
  }
  return $response;
   }

   public function chat(request $request){
    $dados = $request->all();
    $thisSet = sets::where('model',$dados['model'])->where('name',$dados['type'])->where('user_id',access()->user()->id)->first();
    if(isset($thisSet->id)){
      $thisSet = $thisSet->update(['param'=>$dados['val']]);
      if($thisSet) return '200'; else return '300';
    }else{
      $thisSetN = sets::create(['model'=>$dados['model'], 'name'=>$dados['type'], 'param'=>$dados['val'],'user_id'=>access()->user()->id,'locatario_id'=>access()->user()->locatario_id]);
      if(isset($thisSetN->id)) return '200'; else return '300';
    }
   }

   public function token(){
     return  csrf_token();
   }

}
