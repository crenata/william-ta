<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\StorageHelper;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $categories = Category::paginate();
        return view("admin.category.view")->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view("admin.category.add");
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request) {
        $this->validate($request, [
            "name" => "required|string",
            "image" => "required|file|image"
        ]);

        Category::create([
            "name" => $request->name,
            "image" => StorageHelper::save($request, "image", "categories"),
            "can_custom" => $request->boolean("can_custom")
        ]);

        return redirect()->route("category.index")->withStatus("Successfully added.");
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
        $category = Category::findOrFail($id);
        return view("admin.category.edit")->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     */
    public function update(Request $request, string $id) {
        $this->validate($request, [
            "name" => "required|string",
            "image" => "required"
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        if ($request->hasFile("image")) $category->image = StorageHelper::save($request, "image", "categories");
        $category->can_custom = $request->boolean("can_custom");
        $category->save();

        return redirect()->route("category.index")->withStatus("Successfully edited.");
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     */
    public function destroy(string $id) {
        Category::findOrFail($id)->delete();

        return redirect()->route("category.index")->withStatus("Successfully deleted.");
    }
}
