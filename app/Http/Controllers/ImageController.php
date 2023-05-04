<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiHoc;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class ImageController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('upload')){
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName .'-'.time().'.'.$extension;
            $request->file('upload')->move(public_path('media/images'), $fileName);

            $url = asset('media/images/'.$fileName);

            return response()->json(
                [
                    'fileName' =>$fileName,
                    'uploaded'=>1,
                    'url'=>$url
                ]);
        }

    }
}
