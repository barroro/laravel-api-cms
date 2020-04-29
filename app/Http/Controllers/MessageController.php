<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Message::orderBy('created_at', 'desc')->get();
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
            'email' => 'required',
            'subject' => 'required',
            'body' => 'required',
        ]);

        //Check if has some error when validating
        if ($validator->fails()) {
            return response()->json((['error' => 'There are required fields empty']), 500);
        }

        //Create new work object to added in BD
        $message = new Message;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->body = $request->body;
        $message->save();

        //Return success response if validate doens't have errors
        return response()->json((['messageCreated' => $message]), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Message::find($id)->get();
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
        //Create new work object to added in BD
        $message = Message::find($id);
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->body = $request->body;
        $message->save();

        //Return success response if validate doens't have errors
        return response()->json((['messageUpdated' => $message]), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Message::find($id)->delete();

        //Return success response if validate doens't have errors
        return response()->json((['messageDeleted' => $result]), 200);
    }
}
