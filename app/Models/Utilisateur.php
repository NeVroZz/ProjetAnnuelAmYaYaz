<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use Notifiable;

    protected $table = 'utilisateurs';

    protected $primaryKey = 'id_utilisateur';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe',
        'telephone',
        'adresse',
        'ville',
        'code_postal',
        'type_utilisateur',
    ];

    /**
     * Utilise le champ "mot_de_passe" pour l'authentification
     */
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }
}
