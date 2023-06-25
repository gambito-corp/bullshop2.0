<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Services\Contracts\WoocommerceInterface;
use App\Http\Resources\CategoryResource;


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

                //Aqui hago el Ordenamiento de los productos
                foreach ($products as $producto) {
                    if ($producto['type'] == 'variable') {
                        $producto = $this->productoVariable($producto);
                    } else {
                        $producto = $this->productoIndividual($producto);
                    }
                }


                // Agrega los productos obtenidos a la lista general
                $allProducts = array_merge($allProducts, $products);

                // Incrementa la página para obtener la siguiente página de productos
                $page++;
            } else {
                // Si la petición no es exitosa, puedes manejar el error aquí
                return null;
            }
        } while (!empty($products));

        return $allProducts;
    }

    public function productoIndividual($producto)
    {
        $url = $this->AdvanceUrl . 'products/' . $producto['id'];

        $response = Http::withBasicAuth($this->consumerKey, $this->consumerSecret)
            ->get($url);

        if ($response->successful()) {
            $producto = $response->json();
            dd($producto);
            return $response->json();
        }

        // Si la petición no es exitosa, puedes manejar el error aquí
        return null;
    }

    public function productoVariable($producto)
    {
        $variations = $this->getProductVariations($producto['id']);

        if ($variations) {
            dd($producto, $variations);
            // Realiza las operaciones necesarias con las variaciones del producto
        }

        // Si no se obtuvieron variaciones o la petición no fue exitosa, puedes manejar el error aquí
        return null;
    }

    public function getProduct()
    {
        $url = $this->AdvanceUrl . 'products';

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

    // Implementa más métodos según tus necesidades, siguiendo la firma de la interfaz
}
