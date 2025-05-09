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
        'actif',
        'verifie'
    ];

    /** utilise le champms mdp pour la connection */
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }
}
