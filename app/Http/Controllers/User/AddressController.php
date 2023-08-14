<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\City;
use App\Models\Province;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class AddressController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $addresses = UserAddress::with("area.city.province")->where("user_id", auth()->id())->paginate();
        return view("user.address.view")->withAddresses($addresses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {
        $provinces = Province::all();
        $cities = [];
        $areas = [];
        if (!empty($request->province)) $cities = City::where("province_id", $request->province)->get();
        if (!empty($request->city)) $areas = Area::where("city_id", $request->city)->get();
        return view("user.address.add")
            ->withProvinces($provinces)
            ->withProvinceId((int) $request->province)
            ->withCityId((int) $request->city)
            ->withCities($cities)
            ->withAreas($areas);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            "area_id" => "required|numeric|exists:areas,id",
            "name" => "required|string",
            "address" => "required|string",
            "latitude" => ["required", "regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/"],
            "longitude" => ["required", "regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/"]
        ]);

        UserAddress::create([
            "user_id" => auth()->id(),
            "area_id" => $request->area_id,
            "name" => $request->name,
            "address" => $request->address,
            "latitude" => $request->latitude,
            "longitude" => $request->longitude
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
    public function edit(Request $request, string $id) {
        $address = UserAddress::with("area.city.province")->where("user_id", auth()->id())->findOrFail($id);
        $cityId = $address->area->city->id;
        $provinceId = $address->area->city->province->id;
        $provinces = Province::all();
        $cities = City::where("province_id", empty($request->province) ? $provinceId : $request->province)->get();
        $areas = Area::where("city_id", empty($request->province) ? $cityId : $request->city)->get();
        return view("user.address.edit")
            ->withAddress($address)
            ->withProvinces($provinces)
            ->withProvinceId((int) $request->province)
            ->withCityId((int) $request->city)
            ->withCities($cities)
            ->withAreas($areas);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     */
    public function update(Request $request, string $id) {
        $this->validate($request, [
            "area_id" => "required|numeric|exists:areas,id",
            "name" => "required|string",
            "address" => "required|string",
            "latitude" => ["required", "regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/"],
            "longitude" => ["required", "regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/"]
        ]);

        UserAddress::where("user_id", auth()->id())->findOrFail($id)->update([
            "name" => $request->name,
            "area_id" => $request->area_id,
            "address" => $request->address,
            "latitude" => $request->latitude,
            "longitude" => $request->longitude
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
