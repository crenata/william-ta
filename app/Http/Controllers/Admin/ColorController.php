<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Material;
use Illuminate\Http\Request;

class ColorController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $colors = Color::with("material")->paginate();
        return view("admin.color.view")->withColors($colors);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $materials = Material::all();
        return view("admin.color.add")->withMaterials($materials);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            "material_id" => "required|numeric|exists:materials,id",
            "name" => "required|string",
            "image" => "required|file|image"
        ]);

        Color::create([
            "material_id" => $request->material_id,
            "name" => $request->name,
            "image" => StorageHelper::save($request, "image", "colors")
        ]);

        return redirect()->route("color.index")->withStatus("Successfully added.");
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
        $color = Color::findOrFail($id);
        $materials = Material::all();
        return view("admin.color.edit")->withColor($color)->withMaterials($materials);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     */
    public function update(Request $request, string $id) {
        $this->validate($request, [
            "material_id" => "required|numeric|exists:materials,id",
            "name" => "required|string",
            "image" => "required|file|image"
        ]);

        $color = Color::findOrFail($id);
        $color->material_id = $request->material_id;
        $color->name = $request->name;
        $color->image = StorageHelper::save($request, "image", "colors");
        $color->save();

        return redirect()->route("color.index")->withStatus("Successfully edited.");
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     */
    public function destroy(string $id) {
        Color::findOrFail($id)->delete();

        return redirect()->route("color.index")->withStatus("Successfully deleted.");
    }
}
