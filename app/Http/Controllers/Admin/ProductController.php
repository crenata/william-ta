<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $products = Product::with("category")->paginate();
        return view("admin.product.view")->withProducts($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $categories = Category::all();
        return view("admin.product.add")->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            "category_id" => "required|numeric|exists:categories,id",
            "name" => "required|string",
            "price" => "required|numeric|min:1",
            "offer_price" => "nullable|numeric|min:1",
            "description" => "required|string",
            "stock" => "nullable|numeric|min:1",
            "duration" => "required|numeric|min:1",
            "duration_type" => "required|string",
            "start_price" => "required|numeric|min:1",
            "end_price" => "required|numeric|min:1",
            "images" => "required|array",
            "images.*" => "required|file|image"
        ]);

        return DB::transaction(function () use ($request) {
            $product = Product::create([
                "category_id" => $request->category_id,
                "name" => $request->name,
                "price" => $request->price,
                "offer_price" => $request->offer_price,
                "description" => $request->description,
                "stock" => $request->integer("stock"),
                "duration" => $request->duration,
                "duration_type" => $request->duration_type,
                "start_price" => $request->start_price,
                "end_price" => $request->end_price
            ]);

            foreach ($request->file("images") as $key => $image) {
                ProductImage::create([
                    "product_id" => $product->id,
                    "image" => StorageHelper::save($request, "images.$key", "products")
                ]);
            }

            return redirect()->route("product.index")->withStatus("Successfully added.");
        });
    }

    /**
     * Display the specified resource.
     * @param string $id
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @param string $id
     */
    public function edit(string $id) {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view("admin.product.edit")->withProduct($product)->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     */
    public function update(Request $request, string $id) {
        $this->validate($request, [
            "category_id" => "required|numeric|exists:categories,id",
            "name" => "required|string",
            "price" => "required|numeric|min:1",
            "offer_price" => "nullable|numeric|min:1",
            "description" => "required|string",
            "stock" => "nullable|numeric|min:1",
            "duration" => "required|numeric|min:1",
            "duration_type" => "required|string",
            "start_price" => "required|numeric|min:1",
            "end_price" => "required|numeric|min:1",
            "images" => "nullable|array",
            "images.*" => "required|file|image"
        ]);

        return DB::transaction(function () use ($request, $id) {
            Product::findOrFail($id)->update([
                "category_id" => $request->category_id,
                "name" => $request->name,
                "price" => $request->price,
                "offer_price" => $request->offer_price,
                "description" => $request->description,
                "stock" => $request->integer("stock"),
                "duration" => $request->duration,
                "duration_type" => $request->duration_type,
                "start_price" => $request->start_price,
                "end_price" => $request->end_price
            ]);

            if (!empty($request->file("images"))) {
                ProductImage::where("product_id", $id)->delete();
                foreach ($request->file("images") as $key => $image) {
                    ProductImage::create([
                        "product_id" => $id,
                        "image" => StorageHelper::save($request, "images.$key", "products")
                    ]);
                }
            }

            return redirect()->route("product.index")->withStatus("Successfully edited.");
        });
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     */
    public function destroy(string $id) {
        return DB::transaction(function ($id) {
            ProductImage::where("product_id", "=", $id)->delete();
            Product::findOrFail($id)->delete();

            return redirect()->route("product.index")->withStatus("Successfully deleted.");
        });
    }
}
