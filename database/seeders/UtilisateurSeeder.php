<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UtilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $types = ['client', 'livreur', 'commercant', 'prestataire', 'admin'];

        for ($i = 0; $i < 20; $i++) {
            $type = $faker->randomElement($types);

            $id_utilisateur = DB::table('utilisateurs')->insertGetId([
                'nom' => $faker->lastName,
                'prenom' => $faker->firstName,
                'email' => $faker->unique()->safeEmail,
                'mot_de_passe' => Hash::make('password123'),
                'telephone' => $faker->phoneNumber,
                'adresse' => $faker->address,
                'ville' => $faker->city,
                'code_postal' => $faker->postcode,
                'type_utilisateur' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Insérer l'utilisateur dans sa table respective
            switch ($type) {
                case 'client':
                    DB::table('clients')->insert([
                        'id_utilisateur' => $id_utilisateur,
                        'paiement_defaut' => $faker->creditCardType,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    break;

                case 'livreur':
                    DB::table('livreurs')->insert([
                        'id_utilisateur' => $id_utilisateur,
                        'vehicule' => $faker->randomElement(['Voiture', 'Moto', 'Vélo']),
                        'statut_verification' => $faker->boolean(80), // 80% des livreurs sont vérifiés
                        'trajets_predefinis' => json_encode([$faker->city, $faker->city]),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    break;

                case 'commercant':
                    DB::table('commercants')->insert([
                        'id_utilisateur' => $id_utilisateur,
                        'nom_entreprise' => $faker->company,
                        'adresse' => $faker->address,
                        'telephone' => $faker->phoneNumber,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    break;

                case 'prestataire':
                    DB::table('prestataires')->insert([
                        'id_utilisateur' => $id_utilisateur,
                        'type_prestation' => $faker->randomElement(['Réparation', 'Nettoyage', 'Livraison']),
                        'tarif' => $faker->randomFloat(2, 10, 100),
                        'disponibilites' => json_encode(['lundi', 'mercredi', 'vendredi']),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    break;
            }
        }
    }
}
