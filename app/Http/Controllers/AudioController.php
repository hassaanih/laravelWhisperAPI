<?php

namespace App\Http\Controllers;

use App\Models\AudioDetails;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class AudioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try{
            if ($request->hasFile('audio_file')) {
                $file = $request->file('audio_file');
                $filename = $file->getClientOriginalName();
                // $path = $file->storeAs('public/audio', $filename);
                $path = Storage::disk('public')->put('audio', $file);
    
                $audioPath = new AudioDetails();
                $audioPath->audio_file_path = $path;
                $audioPath->audio_client_path = env('STORAGE_URL').$path;
                $audioPath->save();
    
                $response['path'] =  $audioPath->audio_client_path;
    
    
                return response()->json($response, Response::HTTP_OK);
            }
            $response['message'] = ['file not found'];
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }catch(Throwable $e){
            Log::error($e->getMessage());
            $response['general'] = $e->getMessage();
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
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
}
