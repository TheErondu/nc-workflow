<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class LottieController extends Controller
{
    public function index(Response $request)

    {

            $data = Storage::disk('json')->get('intro.json');


            // return JSON-formatted response
            return response()->json($data);



    }
}
