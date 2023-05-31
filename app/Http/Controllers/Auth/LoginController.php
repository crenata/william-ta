<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected string $redirectTo = RouteServiceProvider::HOME;

    protected string $adminTable;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware("guest")->except("logout");
        $this->middleware("guest:admin")->except("logout");

        $this->adminTable = (new Admin())->getTable();
    }

    public function showLoginFormAdmin() {
        return view("admin.auth.login");
    }

    public function loginAdmin(Request $request) {
        $this->validate($request, [
            "username" => "required|string|exists:$this->adminTable,username",
            "password" => "required|string|min:8"
        ], [
            "username.exists" => "These credentials do not match our records."
        ]);

        if (Auth::guard("admin")->attempt($request->only("username", "password"), $request->get("remember"))) {
            return redirect()->intended("/admin/dashboard");
        }

        return back()->withInput($request->only("username", "remember"));
    }
}
