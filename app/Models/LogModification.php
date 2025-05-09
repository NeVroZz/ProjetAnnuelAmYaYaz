<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogModification extends Model
{
    use HasFactory;

    protected $table = 'logs_modifications';

    protected $fillable = ['admin_id', 'utilisateur_id', 'action', 'details'];

    public function admin()
    {
        return $this->belongsTo(Utilisateur::class, 'admin_id');
    }

    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id');
    }
}
