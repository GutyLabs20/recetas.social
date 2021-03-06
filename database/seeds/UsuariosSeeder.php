<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'El Comelón',
            'email' => 'comelon@recetas.social',
            'password' => Hash::make('password'),
        ]);

        $user->perfil()->create();

    }
}
