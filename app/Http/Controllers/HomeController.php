<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Material;
use App\Models\Product;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class HomeController extends Controller {
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $recommendedProducts = Product::with("images", "reviews")->orderByDesc("total_purchased")->limit(10)->get();
        $newProducts = Product::with("images", "reviews")->orderByDesc("id")->limit(10)->get();
        return view("home")->withRecommendedProducts($recommendedProducts)->withNewProducts($newProducts);
    }

    public function custom(Request $request) {
        $userAddresses = UserAddress::where("user_id", auth()->id())->get();
        $categories = Category::where("can_custom", true)->limit(4)->get();
        $materials = Material::all();
        $colors = [];
        if (!empty($request->material)) $colors = Color::where("material_id", $request->material)->get();
        $products = Product::with("images", "reviews")
            ->whereRelation("category", "can_custom", "=", true)
            ->orderBy("name")
            ->get();
        return view("custom")
            ->withCategories($categories)
            ->withProducts($products)
            ->withUserAddresses($userAddresses)
            ->withMaterials($materials)
            ->withMaterialId((int) $request->material)
            ->withColors($colors);
    }
}
