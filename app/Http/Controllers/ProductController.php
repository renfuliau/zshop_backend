<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product_status = [
        'active' => '上架',
        'inactive' => '下架'
    ];
    public function index()
    {
        $products = Product::with('category')->with('subcategory')->get();
        // dd($products);
        return view('layouts.product.index', compact('products'))
        ->with('product_status', $this->product_status);
    }

    public function create()
    {
        $categories = Category::get();
        return view('layouts.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $product = new Product();
        $product->fill($request->all());
        // dd($product);
        $product->save();
        $products = Product::with('category')->with('subcategory')->get();

        // return view('layouts.product.index', compact('products'))
        // ->with('product_status', $this->product_status);
        return redirect()->route('product-index');
    }
}
