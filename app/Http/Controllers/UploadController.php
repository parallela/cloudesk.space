<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Link;

class UploadController extends Controller
{
    /**
     * @param UploadRequest $request
     */
    public function upload(UploadRequest $request)
    {
        /*
         * If user have registration, make his own folder with name of his email address
         */
        $folder = !Auth::user() ? md5(Str::random(10) . $request->ip() . time()) : Auth::user()->email;

        // Get all of the files
        $files = $request->file('cloudesk_upload');

        // Generate Short url
        $shortUrl = env("SHORT_URL") . "/" . Str::random(5);

        /*
         * Generate a new short link
         */
        $link = new Link();
        $link->url = $shortUrl;
        $link->save();


        /*
         * Data insert
         */
        $data = [];

        foreach ($files as $file) {
            $data[] = [
                "original_name" => $file->getClientOriginalName(),
                "unique_name" => $file->hashName(),
                "last_modified" => time(),
                "server_path" => "/home/$folder/" . $file->hashName(),
                "size" => $file->getSize(),
                "extension" => $file->getClientOriginalExtension(),
                "link_id" => $link->id,
                "delete_at" => Carbon::now()->addWeek(1),
                "user_id" => Auth::user() ? Auth::user()->id : null
            ];
            Storage::disk('fu_ftp')->put("/home/$folder", $file);
        }

        File::insert($data);
        return response()->json([
            "success" => "file was uploaded successfully",
            "file" => $data,
            "url" => $link->url
        ], 200);
    }
}
