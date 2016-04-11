<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Projeto as proj;
use Cache;

class KanbanController extends Controller
{
    public function index($id){
    	$projeto = proj::find($id);
    	$estCount = $projeto->estagios->count();
		$columnWidth = 92 / ($estCount + 2);
		$columnWidth = $columnWidth.'%';
    $users = array();
    $usersIn = array();
    foreach($projeto->equipes as $equipe){
        foreach($equipe->users as $membro){
          if(!in_array($membro->id, $usersIn)){
            $users[] = $membro;
            $usersIn[] = $membro->id;
          }
          
        }
      }
      $users = collect($users);
      if (Cache::has('history')) {
        $dados = Cache::pull('history');
      }else{
        $dados = array(
          "sprint" => "0",
          "story" => "0",
          "user" => "0",
          "dis" => "0",
          "etapa" => "0",
          "equipe" => "0"
        );
      }
    	return view('backend.kanban', compact('projeto', 'columnWidth','users', 'dados'));
    }

  public function historia(request $request){
  	$id = $request['id'];
    $obj = proj::find($id);
    $tipo = 'projeto';
    $historias = $obj->historias();

    return view('backend.modals.projetos.historias', compact('obj','tipo','historias'));
  }

  public function setHistory(request $request){
    $dados = $request->all();
    $projeto = $dados['projeto'];
    unset($dados['projeto']);
    Cache::put('history', $dados,5);
    return route('kanban',[$projeto]);
  }

}

// 294219580
// x4x7i6