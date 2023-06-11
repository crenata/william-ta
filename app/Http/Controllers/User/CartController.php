<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $carts = Cart::where("user_id", auth()->id())->paginate();
        return view("user.cart.view")->withCarts($carts);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            "product_id" => "required|numeric|exists:products,id",
            "quantity" => "required|numeric|min:1"
        ]);

        Cart::updateOrCreate(
            [
                "user_id" => auth()->id(),
                "product_id" => $request->product_id
            ],
            [
                "quantity" => $request->quantity
            ]
        );

        return redirect()->route("cart.index")->withStatus("Successfully added.");
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     */
    public function update(Request $request, string $id) {
        $this->validate($request, [
            "product_id" => "required|numeric|exists:products,id",
            "quantity" => "required|numeric|min:1"
        ]);

        Cart::where("user_id", auth()->id())->findOrFail($id)->update([
            "product_id" => $request->product_id,
            "quantity" => $request->quantity
        ]);

        return redirect()->route("cart.index")->withStatus("Successfully edited.");
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     */
    public function destroy(string $id) {
        Cart::where("user_id", auth()->id())->findOrFail($id)->delete();

        return redirect()->route("cart.index")->withStatus("Successfully deleted.");
    }
}
