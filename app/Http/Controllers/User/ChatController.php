<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;

class ChatController extends Controller {
    public function chat(Request $request) {
        $this->validate($request, [
            "name" => "required|string"
        ]);

        $data = Question::with("answer")->where("name", strtolower($request->name))->first();

        return response()->json($data);
    }
}
