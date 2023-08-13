<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use Faker\Factory as Faker;

class ClientesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            Cliente::create([
                'nome' => $faker->name,
                'data_nascimento' => $faker->date,
                'tipo_pessoa' => $faker->randomElement(['Física', 'Jurídica']),
                'cpf_cnpj' => $faker->unique()->numerify('###.###.###-##'),
                'email' => $faker->email,
                'endereco' => $faker->address,
                'localizacao' => $faker->latitude . ',' . $faker->longitude,
            ]);
        }
    }
}
