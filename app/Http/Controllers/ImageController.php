<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Image::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function test()
    {
        $path = Storage::disk('local')->put('file.txt', 'Contents');
        return response()->json((['message' => 'File put in disk', 'path' => $path]), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Check if has file
        if ($request->hasFile('image')) {

            $files = $request->file('image');
            $images = [];

            foreach ($files as $file) {
                //Save in storage/app/images
                $path = Storage::putFile('images', $file);

                //Create image with path
                $image = new Image();
                $image->name = $file->getClientOriginalName();
                $image->path = $path;
                $image->save();

                array_push($images, $image);
            }

            //Return message and image created
            return response()->json((['message' => 'Image uploaded', 'images' => $images]), 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Image::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::find($id);
        Storage::delete($image->path);
        $image->delete();
        return response()->json((['message' => 'Delete image successfully']), 200);
    }
}
