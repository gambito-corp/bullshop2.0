<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Services\Contracts\WoocommerceInterface;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
// use App\Models\Product;
use Illuminate\Support\Facades\Log;

class WoocommerceService implements WoocommerceInterface
{
    protected $baseUrl;
    protected $consumerKey;
    protected $consumerSecret;
    protected $AdvanceUrl;

    public function __construct()
    {
        // Configura la URL base y las credenciales de autenticación de WooCommerce
        $this->baseUrl = config('woocommerce.base_url');
        $this->consumerKey = config('woocommerce.consumer_key');
        $this->consumerSecret = config('woocommerce.consumer_secret');
        $this->AdvanceUrl = $this->baseUrl . '/wp-json/wc/v3/';
    }

    public function getCategories()
    {
        $url = $this->AdvanceUrl . 'products/categories';
        $page = 1;
        $allCategories = [];

        do {
            $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
                ->get($url, ['page' => $page]);

            if ($response->successful()) {
                $categories = $response->json();

                // Formatea los datos de cada categoría utilizando el recurso CategoryResource
                $formattedCategories = CategoryResource::collection($categories)->map(function ($resource) {
                    return [
                        'name' => $resource['name'],
                        'wp_id' => $resource['id'],
                        'slug' => $resource['slug'],
                        'description' => $resource['description'],
                        'display' => $resource['display'],
                        'image' => $resource['image'],
                    ];
                });
                // Agrega las categorías formateadas a la lista general
                $allCategories = array_merge($allCategories, $formattedCategories->toArray());

                // Incrementa la página para obtener la siguiente página de categorías
                $page++;
            } else {
                // Si la petición no es exitosa, puedes manejar el error aquí
                return null;
            }
        } while (!empty($categories));

        if (empty($allCategories)) {
            // Manejar el caso de no encontrar categorías
            // Por ejemplo, lanzar una excepción, mostrar un mensaje de error, etc.
            return null;
        }

        return $allCategories;
    }

    public function getProducts()
    {
        $url = $this->AdvanceUrl . 'products';

        $page = 1;
        $perPage = 100; // Cantidad de productos por página
        $allProducts = [];

        do {
            $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
                ->get($url, ['page' => $page, 'per_page' => $perPage]);

            if ($response->successful()) {
                $products = $response->json();

                $allProducts = array_merge($allProducts, $this->processProducts($products));

                $page++;
            } else {
                return null;
            }
        } while (!empty($products));

        return $allProducts;
    }

    private function processProducts($products)
    {
        $processedProducts = [];

        foreach ($products as $producto) {
            if ($producto['type'] == 'variable') {
                $processedProducts = array_merge($processedProducts, $this->getVariationProducts($producto));
            } else {
                $processedProducts[] = $this->productoIndividual($producto);
            }
        }

        return $processedProducts;
    }

    private function getVariationProducts($producto)
    {
        $variations = $this->getProductVariations($producto['id']);
        $variationProducts = [];

        if ($variations) {
            $categoriaId = Category::where('wp_id', $producto['categories'][0]['id'])->value('id');
            $attributes = $producto['attributes'];
            $marcaAttribute = collect($attributes)->firstWhere('name', 'Marca');
            $marca = $marcaAttribute['options'][0] ?? null;

            foreach ($variations as $value) {
                $metaData = collect($value['meta_data'])->keyBy('key');
                $costo = $metaData->get('purchase_product_variable')['value'] ?? null;
                $attributes = collect($value['attributes'])->keyBy('name');
                $talla = $attributes->get('Talla')['option'] ?? 'N/T';
                $color = $attributes->get('Color')['option'] ?? 'N/C';
                $item = [
                    "name" => $producto['name'],
                    "wp_id" => $value['id'],
                    "slug" => $producto['slug'],
                    "permalink" => $value['permalink'],
                    "type" => $producto['type'],
                    "status" => $producto['status'],
                    "description" => $producto['description'],
                    "barcode" => $value['sku'],
                    "price" => $producto['price'],
                    "costo" => $costo,
                    "stock" => $value['stock_quantity'],
                    "marca" => $marca,
                    "talla" => $talla,
                    "color" => $color,
                    "image" => $value['image']['src'] ?? 'N/I   ',
                    "category_id" => $categoriaId,
                ];

                $variationProducts[] = $item;
            }
        }

        return $variationProducts;
    }

    private function productoIndividual($producto)
    {
        $url = $this->AdvanceUrl . 'products/' . $producto['id'];

        $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
            ->get($url);

        if ($response->successful()) {
            $producto = $response->json();
            $categoriaId = Category::where('wp_id', $producto['categories'][0]['id'])->value('id');
            $metaData = $producto['meta_data'];
            $purchaseProductSimpleKey = array_search('purchase_product_simple', array_column($metaData, 'key'));
            $purchaseProductSimple = $purchaseProductSimpleKey !== false ? $metaData[$purchaseProductSimpleKey]['value'] : null;

            $attributes = $producto['attributes'];
            $marcaAttribute = collect($attributes)->firstWhere('name', 'Marca');
            $marca = $marcaAttribute['options'][0] ?? 'S/M';
            $tallaAttribute = collect($attributes)->firstWhere('name', 'Talla');
            $talla = $tallaAttribute['options'][0] ?? 'S/T';
            $colorAttribute = collect($attributes)->firstWhere('name', 'Color');
            $color = $colorAttribute['options'][0] ?? 'S/C';

            $item = [
                "name" => $producto['name'],
                "wp_id" => $producto['id'],
                "slug" => $producto['slug'],
                "permalink" => $producto['permalink'],
                "type" => $producto['type'],
                "status" => $producto['status'],
                "description" => $producto['description'],
                "barcode" => $producto['sku'],
                "price" => $producto['price'],
                "costo" => $purchaseProductSimple,
                "stock" => $producto['stock_quantity'],
                "marca" => $marca,
                "talla" => $talla,
                "color" => $color,
                "image" => $producto['images'][0]['src'] ?? 'N/I',
                "category_id" => $categoriaId,
            ];

            return $item;
        }

        return null;
    }


    public function getProduct($id)
    {
        $url = $this->AdvanceUrl . 'products/' . $id;

        $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
            ->get($url);

        if ($response->successful()) {
            return $response->json();
        }

        // Si la petición no es exitosa, puedes manejar el error aquí
        return null;
    }

    public function getProductVariations($productId)
    {
        $url = $this->AdvanceUrl . 'products/' . $productId . '/variations';

        $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
            ->get($url);

        if ($response->successful()) {
            $variations = $response->json();
            return $variations;
        }

        // Si la petición no es exitosa, puedes manejar el error aquí
        return null;
    }

    /**
     * TODO: VOY A PROVAR OTRO METODO PARA HACER LOS PRODUCTOS
     */


    public function getProducts2()
    {
        $url = $this->AdvanceUrl . 'products';

        $page = 1;
        $perPage = 1; // Cantidad de productos por página
        $allProducts = [];
        $producto = [];

        // Inicia el temporizador
        $startTime = microtime(true);

        do {
            $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
                ->get($url, ['page' => $page, 'per_page' => $perPage]);

            if ($response->successful()) {
                $products = $response->json();
                $producto[] = $products[0];
                $attributes = $products[0]['attributes'];
                $marcaAttribute = collect($attributes)->firstWhere('name', 'Marca');
                $marca = $marcaAttribute['options'][0] ?? 'S/M';
                $categoriaId = Category::where('wp_id', $products[0]['categories'][0]['id'])->value('id');
                if ($producto['type'] == 'variable') {
                    $variaciones = $producto['variations'];
                    foreach ($variaciones as $value) {
                        $item = $this->getProduct($value);
                        $item['marca'] = $producto['marca'];
                    }
                }

                $allProducts = array_merge($allProducts, $products);

                $page++;
            } else {
                return null;
            }
        } while (!empty($products));

        // Detiene el temporizador y calcula el tiempo transcurrido en segundos
        $executionTime = microtime(true) - $startTime;

        // Convierte el tiempo transcurrido en un formato legible
        $formattedTime = number_format($executionTime, 2);

        dump('Tiempo de ejecución de getProducts2(): ' . $formattedTime . ' segundos');

        dd($allProducts);
        return $allProducts;
    }

    // Implementa más métodos según tus necesidades, siguiendo la firma de la interfaz
}
