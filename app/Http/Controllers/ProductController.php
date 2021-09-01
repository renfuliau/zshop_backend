<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImg;
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
        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            'slug' => 'required',
            "summary" => "required",
            "stock" => "required",
            "price" => "required",
            "special_price" => "required",
            "description" => "required",
            "photos" => "required",
        ]);
        // dd($request->all());
        // dd($request->hasFile('photos'));
        $product = Product::create($request->all());
        // dd($products);
        if ($request->hasFile('photos')) {
            $allowedfileExtension = ['jpg', 'jpeg', 'png'];
            $files = $request->file('photos');
            // dd($files);
            foreach ($files as $file) {
                // $filename = $file->getClientOriginalName();
                // dd($filename);
                $extension = $file->getClientOriginalExtension();
                // dd($extension);
                $check = in_array($extension, $allowedfileExtension);
                //dd($check);
                if ($check) {
                    $filepath_array = array();
                    // $products = Product::create($request->all());
                    // foreach ($request->photos as $photo) {
                    $filepath = '/storage/' . $file->store('photos');
                    array_push($filepath_array, $filepath);
                    // dd($filepath);
                    ProductImg::create([
                        'product_id' => $product->id,
                        'filepath' => $filepath
                    ]);
                    // }
                    $filepath_string = implode(',', $filepath_array);
                    $product['photo'] = $filepath_string;
                    $product->save();
                    // dd($filepath_string);
                    echo "Upload Successfully";
                } else {
                    echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
                }
            }
        }
        return redirect()->route('product-index');
    }

    public function detail($id)
    {
        $product = Product::with('productImg')->find($id);
        $categories = Category::get();

        // dd($product);
        return view('layouts.product.detail', compact('product', 'categories'));
    }

    public function statusUpdate(Request $request)
    {
        // dd($request->all());
        $product = Product::find($request->product_id);
        // dd($product);
        $product['status'] = $request->status;
        $product->save();

        return redirect()->back();
    }
}
