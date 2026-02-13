<?php

namespace Database\Seeders;

use App\Models\Admi;
use App\Models\Clinica;
use App\Models\MetodoPagamento;
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
        $admin = Admi::firstOrCreate([
            "morada" => "luanda sul",
            "num_telefone" => "934712111",
            "senha" => Hash::make('Anyangel04'),
            'nome' => 'inaciaanita',
            'genero' => 'F',
            'email' => 'inaciaanita.viana4@gmail.com',
        ]);
        Clinica::firstOrCreate([
            "nif" => "1113",
            "localizacao" => "municipio do kilambakiaxi'luanda, golf2'vilaestoril",
            "nome" => "Clinica Estoril",
            'id_admi' => $admin->id_admi,

        ]);
        Utilizador::firstOrCreate([
            "num_telefone" => "934712111",
            "senha" => Hash::make('Anyangel04'),
            'nome' => 'inaciaanita',
            'genero' => 'F',
            'email' => 'inaciaanita.viana4@gmail.com',
            "nivel_acesso" => 0,
            'id_admi' => $admin->id_admi,
        ]);

        $metodos = [
            ['nome' => 'Dinheiro'],
            ['nome' => 'Multicaixa'],
            ['nome' => 'Express'],
            ['nome' => 'Código QR'],
        ];

        foreach ($metodos as $metodo) {
            MetodoPagamento::firstOrCreate($metodo);
        }
    }
}
