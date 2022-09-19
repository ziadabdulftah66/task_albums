<?php

namespace App\Http\Controllers;

use App\Http\Requests\AlbumRequest;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Validator;
use DB;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums=Album::get();
        return view('albums.index',compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AlbumRequest $request)
    {
        try {

            DB::beginTransaction();

            $album= Album::create($request->all());

            return redirect()->route('albums.index')->with(['success' => 'add success']);
            DB::commit();

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('albums.index')->with(['error' => 'there is an error']);
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
        $album = Album::with('photos')->orderBy('id', 'DESC')->find($id);
        if (!$album)
            return redirect()->route('albums.index')->with(['error' => 'not found this album']);

        return view('albums.photos.create', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $album = Album::orderBy('id', 'DESC')->find($id);

        if (!$album)
            return redirect()->route('albums.index')->with(['error' => 'not found this album']);

        return view('albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AlbumRequest $request, $id)
    {
        try
        {
        $album = Album::find($id);
        if (!$album)
            return redirect()->route('albums.index')->with(['error' => 'not found this album']);
        $album->update($request->all());

        return redirect()->route('albums.index')->with(['success' => 'update success']);
    } catch (\Exception $ex) {

     return redirect()->route('albums.index')->with(['error' => 'there is an error']);
    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $album=Album::find($id);
            if (!$album)
                return redirect()->route('albums.index')->with(['error' => 'not found this album']);
            foreach ($album->photos as $photo){
                delete_photo($photo->photo);
            }
            $album->photos()->delete();
            $album->delete();
            return redirect()->route('albums.index')->with(['success' => 'delete all photo of this album success']);

        }
        catch (\Exception $ex) {

            return redirect()->route('albums.index')->with(['error' => 'there is an error']);
        }

    }


    public function move_album($id){

        $my_album = Album::with('photos')->orderBy('id', 'DESC')->find($id);
        $albums = Album::with('photos')->orderBy('id', 'DESC')->get();

        if (!$albums)
            return redirect()->back()->with(['error' => 'not found this photo']);


        return view('albums.move', compact('albums'),compact('my_album'));
    }


    public function moveAlbum(Request $request)
     {
    try
    {
        $album = Album::find($request->album_id);
        if (!$album)
            return redirect()->route('albums.index')->with(['error' => 'not found this album']);
        // update the id of album
        foreach ($album->photos as $photo){
            $photo->update(['album_id'=>$request->album_id]);
        }


        return redirect()->route('albums.index')->with(['success' => 'move album success']);
    } catch (\Exception $ex) {

        return redirect()->route('albums.index')->with(['error' => 'there is an error']);
    }
    }
}
