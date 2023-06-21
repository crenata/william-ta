<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class AddressController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $addresses = UserAddress::with("city")->where("user_id", auth()->id())->paginate();
        return view("user.address.view")->withAddresses($addresses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $cities = City::all();
        return view("user.address.add")->withCities($cities);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            "city_id" => "required|numeric|exists:cities,id",
            "name" => "required|string",
            "address" => "required|string"
        ]);

        UserAddress::create([
            "user_id" => auth()->id(),
            "city_id" => $request->city_id,
            "name" => $request->name,
            "address" => $request->address
        ]);

        return redirect()->route("address.index")->withStatus("Successfully added.");
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
        $address = UserAddress::where("user_id", auth()->id())->findOrFail($id);
        $cities = City::all();
        return view("user.address.edit")->withAddress($address)->withCities($cities);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     */
    public function update(Request $request, string $id) {
        $this->validate($request, [
            "city_id" => "required|numeric|exists:cities,id",
            "name" => "required|string",
            "address" => "required|string"
        ]);

        UserAddress::where("user_id", auth()->id())->findOrFail($id)->update([
            "name" => $request->name,
            "city_id" => $request->city_id,
            "address" => $request->address
        ]);

        return redirect()->route("address.index")->withStatus("Successfully edited.");
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     */
    public function destroy(string $id) {
        UserAddress::where("user_id", auth()->id())->findOrFail($id)->delete();

        return redirect()->route("address.index")->withStatus("Successfully deleted.");
    }
}
