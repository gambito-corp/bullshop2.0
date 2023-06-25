<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Services\WoocommerceService;
use App\Models\Category;


class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $woocommerceService = app(WoocommerceService::class);
        $products = $woocommerceService->getCategories();
        // Ahora puedes guardar los productos en tu base de datos utilizando los modelos y migraciones correspondientes

        // Ejemplo de guardado de productos en la base de datos
        foreach ($products as $product) {
            Category::updateOrCreate(
                ['wp_id' => $product['wp_id']], // Columna única para buscar el registro existente
                [
                    'name' => $product['name'],
                    'slug' => $product['slug'],
                    'description' => $product['description'],
                    'display' => $product['display'],
                    'image' => $product['image'],
                ]
            );
        }
    }
}
