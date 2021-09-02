<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $product_status = [
        'active' => '上架',
        'inactive' => '下架'
    ];
    public function index()
    {
        $products = Product::with('category')->with('subcategory')->get();
        return view('layouts.product.index', compact('products'))
            ->with('product_status', $this->product_status);
    }

    public function statusUpdate(Request $request)
    {
        $product = Product::find($request->product_id);
        $product['status'] = $request->status;
        $product->save();

        return redirect()->back();
    }

    public function create()
    {
        $categories = Category::get();
        return view('layouts.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'title' => 'required',
        //     'category_id' => 'required',
        //     'slug' => 'required',
        //     "summary" => "required",
        //     "stock" => "required",
        //     "price" => "required",
        //     "special_price" => "required",
        //     "description" => "required",
        //     "photos" => "required",
        // ]);
        $product = Product::create($request->all());
        if ($request->hasFile('photos')) {
            $allowedfileExtension = ['jpg', 'jpeg', 'png'];
            $files = $request->file('photos');
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $filepath = '/storage/' . $file->store('photos');
                    ProductImg::create([
                        'product_id' => $product->id,
                        'filepath' => $filepath
                    ]);
                }
            }
        }
        return redirect()->route('product-index');
    }

    public function detail($id)
    {
        $product = Product::with('productImg')->find($id);
        $categories = Category::get();

        return view('layouts.product.detail', compact('product', 'categories'));
    }

    public function imgDelete(Request $request)
    {
        $img = ProductImg::find($request->id);
        $storage_name = substr($img['filepath'], 9);
        Storage::delete($storage_name);
        if ($img->delete()) {
            return response('照片刪除成功');
        }
        return response('失敗');
    }

    public function sortUpdate(Request $request)
    {
        $img = ProductImg::find($request->id);
        $img['sort'] = $request->sort;
        if ($img->save()) {
            return response('照片排序成功');
        }
        return response('失敗');
    }

    public function productUpdate(Request $request)
    {
        $product = Product::find($request->product_id);
        $product['title'] = $request->title;
        $product['category_id'] = $request->category_id;
        $product['slug'] = $request->slug;
        $product['summary'] = $request->summary;
        $product['stock'] = $request->stock;
        $product['size'] = $request->size;
        $product['price'] = $request->price;
        $product['special_price'] = $request->special_price;
        $product['description'] = $request->description;
        $product->save();

        if ($request->hasFile('photos')) {
            $allowedfileExtension = ['jpg', 'jpeg', 'png'];
            $files = $request->file('photos');
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
                if ($check) {
                    $filepath = '/storage/' . $file->store('photos');
                    ProductImg::create([
                        'product_id' => $product->id,
                        'filepath' => $filepath
                    ]);
                }
            }
        }
        return redirect()->back();
    }
}
