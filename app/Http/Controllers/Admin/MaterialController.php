<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $materials = Material::paginate();
        return view("admin.material.view")->withMaterials($materials);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view("admin.material.add");
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

        Material::create([
            "name" => $request->name
        ]);

        return redirect()->route("material.index")->withStatus("Successfully added.");
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
        $material = Material::findOrFail($id);
        return view("admin.material.edit")->withMaterial($material);
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

        $material = Material::findOrFail($id);
        $material->name = $request->name;
        $material->save();

        return redirect()->route("material.index")->withStatus("Successfully edited.");
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     */
    public function destroy(string $id) {
        return DB::transaction(function () use ($id) {
            Color::where("material_id", $id)->delete();
            Material::findOrFail($id)->delete();

            return redirect()->route("material.index")->withStatus("Successfully deleted.");
        });
    }
}
