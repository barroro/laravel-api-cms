<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Create validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);

        //Check if has some error when validating
        if ($validator->fails()) {
            return response()->json((['error' => 'There are required fields empty']), 500);
        }

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        //Return success response if validate doens't have errors
        return response()->json((['categoryCreated' => $category]), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Category::where('id', $id)->get();
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
        //Create validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required'
        ]);

        //Check if has some error when validating
        if ($validator->fails()) {
            return response()->json((['error' => 'There are required fields empty']), 500);
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        //Return success response if validate doens't have errors
        return response()->json((['categoryUpdated' => $category]), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Category::find($id)->delete();

        //Return success response if validate doens't have errors
        return response()->json((['categoryDelete' => $result]), 200);
    }
}
