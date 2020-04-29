<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SocialNetwork;
use Illuminate\Support\Facades\Validator;

class SocialNetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SocialNetwork::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'icon' => 'required',
            'color' => 'required',
            'url' => 'required',
            'title' => 'required'
        ]);

        //Check if has some error when validating
        if ($validator->fails()) {
            return response()->json((['error' => 'There are required fields empty']), 500);
        }

        //Create new work object to added in BD
        $socialNetwork = new SocialNetwork();
        $socialNetwork->icon = $request->icon;
        $socialNetwork->title = $request->title;
        $socialNetwork->color = $request->color;
        $socialNetwork->image = $request->url;
        $socialNetwork->save();

        //Return success response if validate doens't have errors
        return response()->json(([
            'socialNetworkCreated' => $socialNetwork,
            'message' => 'Social network created succesfully'
        ]), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
            'icon' => 'required',
            'color' => 'required',
            'url' => 'required',
            'title' => 'required'
        ]);

        //Check if has some error when validating
        if ($validator->fails()) {
            return response()->json((['error' => 'There are required fields empty']), 500);
        }

        //Create new work object to added in BD
        $socialNetwork = new SocialNetwork();
        $socialNetwork->icon = $request->icon;
        $socialNetwork->title = $request->title;
        $socialNetwork->color = $request->color;
        $socialNetwork->image = $request->url;
        $socialNetwork->update();

        //Return success response if validate doens't have errors
        return response()->json(([
            'socialNetworkUpdated' => $socialNetwork,
            'message' => 'Social network updated succesfully'
        ]), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = SocialNetwork::find($id)->delete();

        //$result returns boolean
        return response()->json(([
            'id' => $id,
            'message' => 'Social network deleted succesfully'
        ]), 200);
    }
}
