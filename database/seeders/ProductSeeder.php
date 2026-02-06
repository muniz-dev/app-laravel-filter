<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = Brand::all();
        $categories = Category::all();

        $products = [
            ['name' => 'Smartphone Galaxy S23', 'price' => 899.99, 'stock' => 50, 'category' => 'Eletrônicos'],
            ['name' => 'iPhone 15 Pro', 'price' => 1199.99, 'stock' => 30, 'category' => 'Eletrônicos'],
            ['name' => 'Tênis Nike Air Max', 'price' => 129.99, 'stock' => 100, 'category' => 'Roupas'],
            ['name' => 'Tênis Adidas Ultraboost', 'price' => 149.99, 'stock' => 80, 'category' => 'Esportes'],
            ['name' => 'Notebook Dell XPS 15', 'price' => 1599.99, 'stock' => 25, 'category' => 'Informática'],
            ['name' => 'Câmera Canon EOS R5', 'price' => 3499.99, 'stock' => 15, 'category' => 'Fotografia'],
            ['name' => 'TV Samsung 55" QLED', 'price' => 1299.99, 'stock' => 40, 'category' => 'Eletrônicos'],
            ['name' => 'PlayStation 5', 'price' => 499.99, 'stock' => 20, 'category' => 'Eletrônicos'],
            ['name' => 'Camiseta Nike Dri-FIT', 'price' => 39.99, 'stock' => 200, 'category' => 'Roupas'],
            ['name' => 'MacBook Pro M3', 'price' => 1999.99, 'stock' => 18, 'category' => 'Informática'],
            ['name' => 'Aspirador de Pó Dyson', 'price' => 399.99, 'stock' => 35, 'category' => 'Casa e Jardim'],
            ['name' => 'Geladeira LG Side by Side', 'price' => 1899.99, 'stock' => 12, 'category' => 'Casa e Jardim'],
            ['name' => 'Furadeira Bosch Professional', 'price' => 179.99, 'stock' => 60, 'category' => 'Ferramentas'],
            ['name' => 'Tablet iPad Pro', 'price' => 1099.99, 'stock' => 28, 'category' => 'Eletrônicos'],
            ['name' => 'Monitor HP 27" 4K', 'price' => 299.99, 'stock' => 45, 'category' => 'Informática'],
            ['name' => 'Headphone Sony WH-1000XM5', 'price' => 399.99, 'stock' => 55, 'category' => 'Eletrônicos'],
            ['name' => 'Máquina de Lavar Whirlpool', 'price' => 699.99, 'stock' => 22, 'category' => 'Casa e Jardim'],
            ['name' => 'Bicicleta Mountain Bike', 'price' => 599.99, 'stock' => 30, 'category' => 'Esportes'],
            ['name' => 'Kit de Maquiagem Profissional', 'price' => 89.99, 'stock' => 75, 'category' => 'Beleza e Cuidados Pessoais'],
            ['name' => 'Livro "O Poder do Hábito"', 'price' => 29.99, 'stock' => 150, 'category' => 'Livros'],
            ['name' => 'Lego Star Wars Set', 'price' => 79.99, 'stock' => 90, 'category' => 'Brinquedos'],
            ['name' => 'Pneu Michelin 205/55R16', 'price' => 89.99, 'stock' => 120, 'category' => 'Automotivo'],
            ['name' => 'Cafeteira Expresso', 'price' => 249.99, 'stock' => 40, 'category' => 'Casa e Jardim'],
            ['name' => 'Suplemento Whey Protein', 'price' => 49.99, 'stock' => 200, 'category' => 'Saúde'],
            ['name' => 'Guitarra Fender Stratocaster', 'price' => 799.99, 'stock' => 15, 'category' => 'Música'],
            ['name' => 'Sofá Retrátil 3 Lugares', 'price' => 899.99, 'stock' => 10, 'category' => 'Móveis'],
            ['name' => 'Smartwatch Apple Watch', 'price' => 399.99, 'stock' => 65, 'category' => 'Eletrônicos'],
            ['name' => 'Impressora HP LaserJet', 'price' => 199.99, 'stock' => 50, 'category' => 'Informática'],
            ['name' => 'Câmera Nikon D850', 'price' => 2999.99, 'stock' => 8, 'category' => 'Fotografia'],
            ['name' => 'Ventilador de Teto Philips', 'price' => 149.99, 'stock' => 35, 'category' => 'Casa e Jardim'],
            ['name' => 'Tênis Nike Air Jordan', 'price' => 179.99, 'stock' => 70, 'category' => 'Roupas'],
            ['name' => 'Xbox Series X', 'price' => 499.99, 'stock' => 25, 'category' => 'Eletrônicos'],
            ['name' => 'Mesa de Escritório', 'price' => 299.99, 'stock' => 30, 'category' => 'Móveis'],
            ['name' => 'Kit de Ferramentas Bosch', 'price' => 129.99, 'stock' => 80, 'category' => 'Ferramentas'],
            ['name' => 'Perfume Importado', 'price' => 79.99, 'stock' => 100, 'category' => 'Beleza e Cuidados Pessoais'],
            ['name' => 'Livro "Sapiens"', 'price' => 34.99, 'stock' => 120, 'category' => 'Livros'],
            ['name' => 'Boneca Barbie', 'price' => 24.99, 'stock' => 150, 'category' => 'Brinquedos'],
            ['name' => 'Óleo de Motor 5W-30', 'price' => 29.99, 'stock' => 200, 'category' => 'Automotivo'],
            ['name' => 'Chá Verde Orgânico', 'price' => 14.99, 'stock' => 300, 'category' => 'Alimentos e Bebidas'],
            ['name' => 'Vitamina D3', 'price' => 19.99, 'stock' => 250, 'category' => 'Saúde'],
            ['name' => 'Piano Digital Yamaha', 'price' => 599.99, 'stock' => 12, 'category' => 'Música'],
        ];

        foreach ($products as $productData) {
            // Find matching brand (simple matching by name similarity)
            $brand = $brands->random();
            
            // Find matching category
            $category = $categories->firstWhere('name', $productData['category']);
            if (!$category) {
                $category = $categories->random();
            }

            $product = Product::create([
                'name' => $productData['name'],
                'slug' => Str::slug($productData['name']),
                'description' => 'Descrição do produto ' . $productData['name'],
                'price' => $productData['price'],
                'stock' => $productData['stock'],
                'sku' => 'SKU-' . strtoupper(Str::random(8)),
                'brand_id' => $brand->id,
                'is_active' => true,
            ]);

            // Attach category
            $product->categories()->attach($category->id);
            
            // Randomly attach 1-3 additional categories
            $additionalCategories = $categories->where('id', '!=', $category->id)->random(rand(0, 2));
            foreach ($additionalCategories as $additionalCategory) {
                $product->categories()->attach($additionalCategory->id);
            }
        }
    }
}
