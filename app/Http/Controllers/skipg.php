<?php

namespace App\Http\Controllers;

use App\Http\Requests\SkipGoogleRequest;
use App\Models\skipgooglemodel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class skipg extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        if (skipgooglemodel::find(1) == null) {


            return view('layouts.skip.skip');
        }

        $data = skipgooglemodel::find(1);

        return view('layouts.skip.skip',compact('data'));

    }

    public function skipapi()
    {

        $data = skipgooglemodel::first();

        return Response()->json($data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SkipGoogleRequest $request)
    {




        if (skipgooglemodel::find(1) == null) {

            $request->validated($request->all());

            $data['text'] = $request->text;
            $data['version'] = $request->version;
            $data['isgo'] = $request->status;

            $video = skipgooglemodel::create($data);

            if (!$video) {
                return redirect(route('skipg'))->with('error', 'There is Problem With Add Video');
            }
            return redirect(route('skipg'));
        } else {
            $request->validated($request->all());

            $data = skipgooglemodel::find(1);


            $data['text'] = $request->text;
            $data['version'] = $request->version;
            $data['isgo'] = $request->status;

            $data->save();

            if (!$data) {
                return redirect(route('skipg'))->with('error', 'There is Problem With Add Video');
            }
            return redirect(route('skipg'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
