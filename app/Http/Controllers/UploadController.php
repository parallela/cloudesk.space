<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        $shortUrl = env("SHORT_URL")."/".Str::random(5);

        /*
         * Generate a new short link
         */
        $link = new Link();
        $link->url = $shortUrl;
        $link->save();

        foreach ($files as $file) {
            $fileModel = new File();

            $fileModel->original_name = $file->getClientOriginalName();
            $fileModel->unique_name = $file->hashName();
            $fileModel->last_modified = time();
            $fileModel->server_path = "/home/$folder/".$file->hashName();
            $fileModel->size= $file->getSize();
            $fileModel->extension = $file->getClientOriginalExtension();
            $fileModel->link_id = $link->id;
            $fileModel->delete_at = Carbon::now()->addWeek(1);
            $fileModel->user_id = Auth::user() ? Auth::user()->id : null;
            $fileModel->save();

            Storage::disk('fu_ftp')->put("/home/$folder", $file);
        }


    }
}
