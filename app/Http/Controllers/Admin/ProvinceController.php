<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinceController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $provinces = Province::paginate();
        return view("admin.province.view")->withProvinces($provinces);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view("admin.province.add");
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            "name" => "required|string"
        ]);

        Province::create([
            "name" => $request->name
        ]);

        return redirect()->route("province.index")->withStatus("Successfully added.");
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
        $province = Province::findOrFail($id);
        return view("admin.province.edit")->withProvince($province);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     */
    public function update(Request $request, string $id) {
        $this->validate($request, [
            "name" => "required|string"
        ]);

        $province = Province::findOrFail($id);
        $province->name = $request->name;
        $province->save();

        return redirect()->route("province.index")->withStatus("Successfully edited.");
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     */
    public function destroy(string $id) {
        $used = UserAddress::with("area.city.province")
            ->whereRelation("area.city.province", "id", "=", $id)
            ->exists();
        if ($used) return redirect()->route("province.index")->withStatus("Province is used by user.");

        return DB::transaction(function () use ($id) {
            City::where("province_id", $id)->delete();
            Province::findOrFail($id)->delete();

            return redirect()->route("province.index")->withStatus("Successfully deleted.");
        });
    }
}
