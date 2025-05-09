<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogConnexion extends Model
{
    protected $fillable = ['utilisateur_id', 'ip', 'user_agent'];

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }
}
