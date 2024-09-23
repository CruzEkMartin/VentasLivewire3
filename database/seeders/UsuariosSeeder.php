<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         //eliminar imagenes productos
         Storage::deleteDirectory('public/users');
         Storage::makeDirectory('public/users');


         \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Super Administrador',
            'email' => 'admin@gmail.com',
        ]);

    }
}
