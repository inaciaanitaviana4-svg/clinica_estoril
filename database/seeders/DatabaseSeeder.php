<?php

namespace Database\Seeders;

use App\Models\Admi;
use App\Models\Clinica;
use App\Models\User;
use App\Models\Utilizador;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = Admi::create([
            "morada" => "luanda sul",
            "num_telefone" => "934712111",
            "senha" => Hash::make('Anyangel04'),
            'nome' => 'inaciaanita',
            'genero' => 'F',
            'email' => 'inaciaanita.viana4@gmail.com',
        ]);
        Clinica::create([
            "nif" => "1113",
            "localizacao" => "municipio do kilambakiaxi'luanda, golf2'vilaestoril",
            "nome" => "Clinica Estoril",
            'id_admi' => $admin->id_admin,

        ]);
        Utilizador::create([
            "num_telefone" => "934712111",
            "senha" => Hash::make('Anyangel04'),
            'nome' => 'inaciaanita',
            'genero' => 'F',
            'email' => 'inaciaanita.viana4@gmail.com',
            "nivel_acesso" => 0,
            'id_admi' => $admin->id_admin,
        ]);
    }
}
