<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\WebsiteResource;
use App\Models\Website;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebsiteController extends Controller
{

    public function index()
    {
        return response()->json([
            'message' => 'succcess',
            'data' => Website::all()
        ], 200);
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'url' => 'required',
            'status' => 'required',
            'os' => 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $program = Website::create([
            'url' => $request->url,
            'status' => $request->status,
            'os' => $request->os
         ]);

        return response()->json(['Program created successfully.', new WebsiteResource($program)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $website = Website::where('id', $id)->first;
        if (is_null($website)) {
            return response()->json('Data not found', 404);
        }
        return response()->json([new WebsiteResource($website)]);
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
        //
    }

    public function check(Request $request)
    {
        $website = Website::where('url', $request->url)->first();
        if (is_null($website)) {
            return response()->json('Data not found', 404);
        }
        return response()->json([new WebsiteResource($website)]);
    }
}
