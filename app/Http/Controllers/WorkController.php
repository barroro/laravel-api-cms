<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Work;
use App\WorkImage;
use App\WorkSection;
use App\WorkSectionImages;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Work::with('category')->get();
    }

    public function getActiveWorks()
    {
        return Work::with('category')->with('images')->where('active', true)->orderBy('created_at', 'desc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'title' => 'required',
            'subtitle' => 'required',
            'content' => 'required',
        ]);

        //Check if has some error when validating
        if ($validator->fails()) {
            return response()->json((['error' => 'There are required fields empty']), 500);
        }

        //Create new work object to added in BD
        $work = new Work;
        $work->title = $request->title;
        $work->subtitle = $request->subtitle;
        $work->content = $request->content;
        $work->category_id = $request->category;
        $work->save();

        //Upload file and get path
        // if ($request->hasFile('photo')) {
        //     $fileName = date("Y-m-d") . "-" . $request->file('photo')->getClientOriginalName();
        //     $request->file('photo')->move(public_path("uploads"), $fileName);
        //     $work->image = 'uploads/' . $fileName;
        // }

        //Added new list of images
        foreach ($request->workImages as $image) {
            $workImage = new WorkImage();
            $workImage->image_id = $image['id'];
            $workImage->work_id = $work->id;
            $workImage->save();
        }

        //Added new list of images
        foreach ($request->sections as $section) {
            $workSection = new WorkSection();
            $workSection->title = $section['title'];
            $workSection->subtitle = $section['subtitle'];
            $workSection->content = $section['content'];
            $workSection->work_id = $work->id;
            $workSection->save();
        }

        //Return success response if validate doens't have errors
        return response()->json((['workCreated' => $work]), 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Work::where('id', $id)->with('sections')->with('category')->with('images')->first();
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
            'title' => 'required',
            'subtitle' => 'required',
            'content' => 'required'
        ]);

        //Check if has some error when validating
        if ($validator->fails()) {
            return response()->json((['error' => 'There are required fields empty']), 500);
        }

        //Find work by id and update fields
        $work = Work::find($id);
        $work->title = $request->title;
        $work->subtitle = $request->subtitle;
        $work->content = $request->content;
        $work->active = $request->active;
        $work->category_id = $request->category;
        $work->update();

        //Delete all work images wors by work id
        WorkImage::where('work_id', $work->id)->delete();

        //Added new list of images
        foreach ($request->workImages as $image) {
            $workImage = new WorkImage();
            $workImage->image_id = $image['id'];
            $workImage->work_id = $work->id;
            $workImage->save();
            //Log::debug($image['id']);
        }

        //Remove work section images
        $workSections = WorkSection::where('work_id', $work->id)->get();
        foreach ($workSections as $workSection) {
            WorkSectionImages::where('work_section_id', $workSection->id)->delete();
        }

        //Delete all work sections
        WorkSection::where('work_id', $work->id)->delete();

        //Added new list of images
        foreach ($request->sections as $section) {

            $workSection = new WorkSection();
            $workSection->title = $section['title'];
            $workSection->subtitle = $section['subtitle'];
            $workSection->content = $section['content'];
            $workSection->work_id = $work->id;
            $workSection->view_type = $section['view_type'];
            $workSection->save();

            if ($section['images']) {
                foreach ($section['images'] as $sectionImage) {
                    $workSectionImage = new WorkSectionImages();
                    $workSectionImage->work_section_id = $workSection->id;
                    $workSectionImage->image_id = $sectionImage['id'];
                    $workSectionImage->save();
                }
            }
        }

        //Return success response if validate doens't have errors
        return response()->json((['workUpdated' => $work]), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = Work::find($id)->delete();

        //Return success response if validate doens't have errors
        return response()->json((['workDelete' => $result]), 200);
    }
}
