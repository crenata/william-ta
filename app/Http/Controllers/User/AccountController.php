<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view("user.account.edit")->withAccount(auth()->user());
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param string $id
     */
    public function update(Request $request) {
        $this->validate($request, [
            "name" => "required|string",
            "username" => "required|string",
            "phone" => "required|string|max:13",
            "email" => "required|string|email",
            "old_password" => "nullable|string|min:8"
        ]);

        $account = User::findOrFail(auth()->id());
        if ($account->username !== $request->username) {
            $this->validate($request, [
                "username" => "unique:users"
            ]);
        }
        if ($account->phone !== $request->phone) {
            $this->validate($request, [
                "phone" => "unique:users"
            ]);
        }
        if ($account->email !== $request->email) {
            $this->validate($request, [
                "email" => "unique:users"
            ]);
        }
        $account->name = $request->name;
        $account->username = $request->username;
        $account->phone = $request->phone;
        $account->email = $request->email;
        if (!empty($request->old_password)) {
            if (Hash::check($request->old_password, $account->password)) {
                $this->validate($request, [
                    "new_password" => "required|string|min:8",
                    "confirm_password" => "required|string|min:8|same:new_password"
                ]);
                $account->password = Hash::make($request->new_password);
            }
        }
        $account->save();

        return redirect()->route("account.index")->withStatus("Successfully edited.");
    }
}
