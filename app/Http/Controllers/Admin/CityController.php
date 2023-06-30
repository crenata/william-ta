<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class CityController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $cities = City::with("province")->paginate();
        return view("admin.city.view")->withCities($cities);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $provinces = Province::all();
        return view("admin.city.add")->withProvinces($provinces);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            "province_id" => "required|numeric|exists:provinces,id",
            "name" => "required|string"
        ]);

        City::create([
            "province_id" => $request->province_id,
            "name" => $request->name
        ]);

        return redirect()->route("city.index")->withStatus("Successfully added.");
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
        $city = City::findOrFail($id);
        $provinces = Province::all();
        return view("admin.city.edit")->withCity($city)->withProvinces($provinces);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     */
    public function update(Request $request, string $id) {
        $this->validate($request, [
            "province_id" => "required|numeric|exists:provinces,id",
            "name" => "required|string"
        ]);

        $city = City::findOrFail($id);
        $city->province_id = $request->province_id;
        $city->name = $request->name;
        $city->save();

        return redirect()->route("city.index")->withStatus("Successfully edited.");
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     */
    public function destroy(string $id) {
        $used = UserAddress::with("area.city")
            ->whereRelation("area.city", "id", "=", $id)
            ->exists();
        if ($used) return redirect()->route("city.index")->withStatus("City is used by user.");

        City::findOrFail($id)->delete();

        return redirect()->route("city.index")->withStatus("Successfully deleted.");
    }
}
