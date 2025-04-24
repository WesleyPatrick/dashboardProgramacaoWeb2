<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoContato extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
    ];

    public function contatos()
    {
        return $this->hasMany(Contato::class);
    }

    public function isInUse()
    {
        return $this->contatos()->exists();
    }
}
