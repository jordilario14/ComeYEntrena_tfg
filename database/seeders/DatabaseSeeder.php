<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\Role::create([
            'role' => 'ROLE_TRAINER',
        ]);

        \App\Models\Role::create([
            'role' => 'ROLE_CLIENT',
        ]);

        \App\Models\User::create([
            'name' => 'Jordi',
            'surname' => 'Segura Lario',
            'role_id'=> 1,
            'disabled' => false,
            'my_interests' => 'Interesado en el culturismo y el levantamiento de peso. Me gusta mucho aprender sobre nutricion y sobre diferentes estilos de entrenamiento.',
            'about_me' => 'Examinado por NCSA, con titulaciones varias en el sector de nutrición y entrenamiento.',
            'email'        => 'jordilario@uoc.edu',
            'password'     => bcrypt('test_password_UOC_498'),
            'tf_number' => 665499755,
            'weight' => 81.2,
            'height' => 173,
            'remember_token' => Str::random(10),
            'email_verified_at' => date("Y-m-d H:i:s"),
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
