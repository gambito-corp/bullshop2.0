<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Services\WoocommerceService;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Tiempo de ejecución: segundos');
        $woocommerceService = app(WoocommerceService::class);

        // Inicia el temporizador
        $startTime = microtime(true);

        $products = $woocommerceService->getProducts();

        // Detiene el temporizador y calcula el tiempo transcurrido en segundos
        $executionTime = microtime(true) - $startTime;

        // Convierte el tiempo transcurrido en un formato legible
        $formattedTime = number_format($executionTime, 2);

        $this->command->info('Tiempo de ejecución: ' . $formattedTime . ' segundos');
        Log::info('Tiempo de ejecución: ' . $formattedTime . ' segundos');

        // Ahora puedes guardar los productos en tu base de datos utilizando los modelos y migraciones correspondientes

        // Ejemplo de guardado de productos en la base de datos
        foreach ($products as $key => $product) {
            Product::updateOrCreate(
                ['wp_id' => $product['wp_id']],
                [
                    'name' => $product['name'],
                    'slug' => $product['slug'],
                    'permalink' => $product['permalink'],
                    'type' => $product['type'],
                    'status' => $product['status'],
                    'description' => $product['description'],
                    'barcode' => $product['barcode'],
                    'price' => $product['price'],
                    'costo' => $product['costo'],
                    'stock' => $product['stock'],
                    'marca' => $product['marca'],
                    'talla' => $product['talla'],
                    'color' => $product['color'],
                    'image' => $product['image'],
                    'category_id' => $product['category_id'],
                ]
            );
            $message = 'van ' . ($key + 1) . ' de ' . count($products) . ' productos';
            $this->command->info($message);
            Log::info($message);
        }
    }
}
