<?php

namespace App\Http\Controllers;

use App\Http\Requests\imageRiquest;
use App\Models\Album;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use DB;

class PhotoController extends Controller
{
    public function storeimages(Request $request){
        $file=$request->file('dzfile');
        $filename=uploadimage('photos',$file);
        return response()->json([
            'name'=>$filename,
            'orignal_name'=>$file->getClientOriginalName(),

        ]);
    }
    public function storeimages_DB(imageRiquest $request){

        try {

            if($request->has('document') && count($request->document)>0){
                foreach ($request->document as $image){
                    Photo::create([
                        'album_id'=>$request->album_id,
                        'photo'=>$image,



                    ]);
                }
                return redirect()->back()->with(['success' => 'Successfully added']);
            }


        }catch (\Exception $ex){
            return redirect()->route('albums.index')->with(['error' => 'Not added']);
        }

    }
    public function Deleteimages($image_id){
        try {
            $image=Photo::find($image_id);
            if(!$image){
                return redirect()->route('albums.index')->with(['error' => 'This picture is not available']);
            }
            delete_photo($image->photo);

            $image->delete();
            return redirect()->back()->with(['success' => 'Deleted successfully']);

        }catch (\Exception $ex){
            return redirect()->route('albums.index')->with(['error' => 'Not deleted']);
        }
    }
    public function moveimages($id){
        $photo = Photo::orderBy('id', 'DESC')->find($id);

        $albums = Album::orderBy('id', 'DESC')->get();

        if (!$photo)
            return redirect()->back()->with(['error' => 'not found this photo']);


        return view('albums.photos.move', compact('albums'),compact('photo'));
    }
    public function movePHoto(Request $request)
    {
        try
        {
            $photo = Photo::find($request->photo_id);
            if (!$photo)
                return redirect()->route('albums.index')->with(['error' => 'not found this photo']);
            $photo->update(['album_id'=>$request->album_id]);

            return redirect()->route('albums.index')->with(['success' => 'move success']);
        } catch (\Exception $ex) {

            return redirect()->route('albums.index')->with(['error' => 'there is an error']);
        }
    }
}
