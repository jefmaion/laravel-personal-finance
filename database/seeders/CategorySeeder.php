<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'Alimentação'          => ['Lanches e Refeições', 'Supermercado'],
            'Veículos'             => ['Combustível', 'Estacionamento', 'IPVA/Licenciamento', 'Troca de Óleo/Manutenção', 'Seguro', 'Multas'],
            'Contas Essenciais'    => ['Manutenção', 'Estúdio', 'Tv/Telefone/Internet', 'Água', 'Luz'],
            'Saúde'                => ['Farmácia', 'Cosméticos'],
            'Lazer'                => ['Viagens/Passeios', 'Cinema'],
            'Pessoal'              => ['Cabeleireiro', 'Presentes', 'Cursos', 'Cartão de Crédito'],
            'Receitas'             => ['Salário', 'Renda Extra', 'Juros', 'Investimentos'],
            'Investimento Eterno'  => ['Dízimos', 'Ofertas'],
            'Outros'               => ['Presentes p/ Terceiros','Não definidos']
        ];

        foreach($data as $cat => $item) {

            $new = Category::create(['name' => $cat, 'category_id' => 0, 'enabled' => 1]);

            foreach($item as $sub) {
                Category::create(['name' => $sub, 'category_id' => $new->id, 'enabled' => 1]);
            }

        }
    }
}
