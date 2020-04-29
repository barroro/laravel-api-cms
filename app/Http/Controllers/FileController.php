<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function Test()
    {
        return response()->download(public_path('uploads\tool.jpg'), 'User image');
    }

    public function Save(Request $request)
    {
        $fileName = date("Y-m-d") . "-" . $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->move(public_path("uploads"), $fileName);
        $photoUrl = url('uploads/' . $fileName);
        return response()->json((['url' => $photoUrl]), 200);
    }
}
