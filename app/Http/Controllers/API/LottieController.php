<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class LottieController extends ApiController
{
    public function index(Response $request)

    {

            $data = Storage::disk('json')->get('intro.json');


            // return JSON-formatted response
            return response()->json($data);



    }
}
