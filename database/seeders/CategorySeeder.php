<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Eletrônicos', 'description' => 'Dispositivos eletrônicos e gadgets'],
            ['name' => 'Roupas', 'description' => 'Vestuário e acessórios'],
            ['name' => 'Casa e Jardim', 'description' => 'Produtos para casa e jardim'],
            ['name' => 'Esportes', 'description' => 'Artigos esportivos e fitness'],
            ['name' => 'Beleza e Cuidados Pessoais', 'description' => 'Produtos de beleza e cuidados pessoais'],
            ['name' => 'Livros', 'description' => 'Livros e publicações'],
            ['name' => 'Brinquedos', 'description' => 'Brinquedos e jogos'],
            ['name' => 'Automotivo', 'description' => 'Acessórios e peças automotivas'],
            ['name' => 'Alimentos e Bebidas', 'description' => 'Produtos alimentícios e bebidas'],
            ['name' => 'Saúde', 'description' => 'Produtos de saúde e bem-estar'],
            ['name' => 'Informática', 'description' => 'Computadores e periféricos'],
            ['name' => 'Móveis', 'description' => 'Móveis e decoração'],
            ['name' => 'Ferramentas', 'description' => 'Ferramentas e equipamentos'],
            ['name' => 'Música', 'description' => 'Instrumentos musicais e acessórios'],
            ['name' => 'Fotografia', 'description' => 'Câmeras e equipamentos fotográficos'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
}
