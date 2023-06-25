<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Contracts\WoocommerceInterface;

class CategoryController extends Controller
{
    protected $woocommerceService;

    public function __construct(WoocommerceInterface $woocommerceService)
    {
        $this->woocommerceService = $woocommerceService;
    }

    public function index()
    {
        $products = $this->woocommerceService->getProducts2();

        return view('.index', compact('products'));
    }
}
