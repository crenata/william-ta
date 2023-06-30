<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\Province;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class AreaController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $areas = Area::with("city")->paginate();
        return view("admin.area.view")->withAreas($areas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {
        $provinces = Province::all();
        $cities = [];
        if (!empty($request->province)) $cities = City::where("province_id", $request->province)->get();
        return view("admin.area.add")
            ->withProvinces($provinces)
            ->withProvinceId((int) $request->province)
            ->withCities($cities);
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
            "fee" => "required|numeric|min:1"
        ]);

        Area::create([
            "city_id" => $request->city_id,
            "name" => $request->name,
            "fee" => $request->fee
        ]);

        return redirect()->route("area.index")->withStatus("Successfully added.");
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
    public function edit(Request $request, string $id) {
        $area = Area::findOrFail($id);
        $provinceId = $area->city->province->id;
        $provinces = Province::all();
        $cities = City::where("province_id", empty($request->province) ? $provinceId : $request->province)->get();
        return view("admin.area.edit")
            ->withArea($area)
            ->withProvinces($provinces)
            ->withProvinceId((int) $request->province)
            ->withCities($cities);
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
            "fee" => "required|numeric|min:1"
        ]);

        $area = Area::findOrFail($id);
        $area->city_id = $request->city_id;
        $area->name = $request->name;
        $area->fee = $request->fee;
        $area->save();

        return redirect()->route("area.index")->withStatus("Successfully edited.");
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     */
    public function destroy(string $id) {
        $used = UserAddress::with("area")
            ->whereRelation("area", "id", "=", $id)
            ->exists();
        if ($used) return redirect()->route("area.index")->withStatus("Area is used by user.");

        Area::findOrFail($id)->delete();

        return redirect()->route("area.index")->withStatus("Successfully deleted.");
    }
}
