<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('utilisateurs')->insert([
            'nom' => 'Admin',
            'prenom' => 'Principal',
            'email' => 'admin@example.com',
            'mot_de_passe' => Hash::make('password'), // Mot de passe = "password"
            'telephone' => '0102030405',
            'adresse' => '1 rue de l\'administration',
            'ville' => 'Paris',
            'code_postal' => '75000',
            'type_utilisateur' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
