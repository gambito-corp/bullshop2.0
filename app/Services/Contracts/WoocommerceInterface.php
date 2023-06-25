<?php

namespace App\Services\Contracts;

interface WoocommerceInterface
{
    public function getCategories();
    public function getProducts();
    public function getProducts2();
    public function getProduct($id);
}
