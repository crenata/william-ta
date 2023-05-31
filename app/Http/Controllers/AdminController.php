<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller {
    protected string $admin;

    public function __construct() {
        $this->admin = (new Admin())->getTable();
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        $admins = Admin::paginate();
        return view("admin.admin.view")->with("admins", $admins);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view("admin.admin.add");
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
            "username" => "required|string|unique:$this->admin,username",
            "password" => "required|string|min:8",
            "confirm_password" => "required|string|min:8|same:password"
        ]);

        Admin::create([
            "name" => $request->name,
            "username" => $request->username,
            "password" => Hash::make($request->password)
        ]);

        return redirect()->route("admin.index")->withStatus("Successfully added.");
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
        $admin = Admin::findOrFail($id);
        return view("admin.admin.edit")->withAdmin($admin);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     */
    public function update(Request $request, string $id) {
        $this->validate($request, [
            "name" => "required|string",
            "username" => "required|string",
            "password" => "nullable|string|min:8",
            "confirm_password" => ["nullable", "string", "min:8", "same:password", Rule::requiredIf(!empty($request->password))]
        ]);

        $admin = Admin::findOrFail($id);
        $admin->name = $request->name;
        $admin->username = $request->username;
        if (!empty($request->password)) $admin->password = Hash::make($request->password);
        $admin->save();

        return redirect()->route("admin.index")->withStatus("Successfully edited.");
    }

    /**
     * Remove the specified resource from storage.
     * @param string $id
     */
    public function destroy(string $id) {
        Admin::findOrFail($id)->delete();

        return redirect()->route("admin.index")->withStatus("Successfully deleted.");
    }
}
