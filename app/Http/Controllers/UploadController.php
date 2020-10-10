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

    }
}
