<?php

namespace App\Http\Controllers;
require_once('../vendor/autoload.php');
use Illuminate\Http\Request;

use Cloudinary\Cloudinary;
use Cloudinary\Transformation\Resize;


class CloudinaryController extends Controller
{
    function getImage(Request $request){
    if($request->method('POST')){  
    $cloudinary = new Cloudinary(
        [
            'cloud' => [
                'cloud_name' => 'doax8x0n9',
                'api_key'    => '813244531242642',
                'api_secret' => 'NpVe1HTWXm--JHJ4j-zrCvu4qKk',
            ],
        ]
    );    
    $cloudinary->uploadApi()->upload(
        $request->file('poster'),
        ['public_id' => $request->input('poster')]
    );
    echo $request->file('poster');
    }
}
   
}
