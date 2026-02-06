<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ['name' => 'Samsung', 'description' => 'Tecnologia e eletrônicos'],
            ['name' => 'Apple', 'description' => 'Dispositivos e tecnologia'],
            ['name' => 'Nike', 'description' => 'Roupas e calçados esportivos'],
            ['name' => 'Adidas', 'description' => 'Roupas e calçados esportivos'],
            ['name' => 'Sony', 'description' => 'Eletrônicos e entretenimento'],
            ['name' => 'LG', 'description' => 'Eletrônicos e eletrodomésticos'],
            ['name' => 'Microsoft', 'description' => 'Tecnologia e software'],
            ['name' => 'HP', 'description' => 'Computadores e impressoras'],
            ['name' => 'Dell', 'description' => 'Computadores e tecnologia'],
            ['name' => 'Canon', 'description' => 'Câmeras e equipamentos fotográficos'],
            ['name' => 'Nikon', 'description' => 'Câmeras e equipamentos fotográficos'],
            ['name' => 'Philips', 'description' => 'Eletrônicos e eletrodomésticos'],
            ['name' => 'Bosch', 'description' => 'Ferramentas e eletrodomésticos'],
            ['name' => 'Whirlpool', 'description' => 'Eletrodomésticos'],
            ['name' => 'Lenovo', 'description' => 'Computadores e tecnologia'],
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand['name'],
                'slug' => Str::slug($brand['name']),
                'description' => $brand['description'],
            ]);
        }
    }
}
