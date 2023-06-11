<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     * @param string $id
     * @return mixed
     */
    public function index(string $id = null) {
        $categories = Category::all();
        $products = Product::with("category")->whereNull("offer_price");
        if (!empty($id)) $products = $products->where("category_id", $id);
        $products = $products->paginate();
        return view("user.product.view")->withCategories($categories)->withProducts($products)->withCategoryId((int) $id);
    }

    /**
     * Display the specified resource.
     * @param string $id
     */
    public function show(string $id) {
        $product = Product::with("category", "images")->findOrFail($id);
        return view("user.product.show")->withProduct($product);
    }
}
