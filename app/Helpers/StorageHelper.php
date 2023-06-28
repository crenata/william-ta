<?php

namespace App\Helpers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StorageHelper extends Controller {
    public static function save(Request $request, $field = "file", $directory = "root", $customFilename = null) {
        if ($request->hasFile($field)) {
            $file = Carbon::now()->format("Y-m-d-H-i") .
                "-" .
                basename($directory) .
                "-" .
                Str::random(12) .
                "." .
                $request->file($field)->getClientOriginalExtension();
            if (!empty($customFilename) && is_string($customFilename)) $file = $customFilename;
            Storage::disk("public")->putFileAs($directory, $request->file($field), $file);
            return $file;
        } else if (!empty($request->input($field))) {
            return $request->input($field);
        } else {
            return null;
        }
    }
}
