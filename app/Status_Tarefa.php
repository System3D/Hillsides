<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LocatarioScope;

class Status_Tarefa extends Model
{
    protected $table = 'status_tarefa';
    public $timestamps = true;
	protected $fillable = ['descricao', 'projeto_id', 'user_id', 'locatario_id'];

	protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new LocatarioScope);
    }

	public function user() {
		return $this->belongsTo('App\Models\Access\User\User');
	}

	public function locatario() {
		return $this->belongsTo('App\Locatario');
	}

	public function projeto() {
		return $this->belongsTo('App\Projeto');
	}

	public function tarefas() {
		return $this->hasMany('App\Tarefa', 'status_id');
	}
}
