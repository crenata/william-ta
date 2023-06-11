<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $wishlists = Wishlist::with("product")->where("user_id", auth()->id())->paginate();
        return view("user.wishlist.view")->withWishlists($wishlists);
    }

    /**
     * Display the specified resource.
     * @param string $id
     */
    public function show(string $id) {
        Wishlist::firstOrCreate([
            "user_id" => auth()->id(),
            "product_id" => $id
        ]);

        return redirect()->route("wishlist.index")->withStatus("Successfully added.");
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     */
    public function destroy(string $id) {
        Wishlist::where("user_id", auth()->id())->findOrFail($id)->delete();

        return redirect()->route("wishlist.index")->withStatus("Successfully deleted.");
    }
}
