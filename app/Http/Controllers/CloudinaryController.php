<?php

namespace App\Http\Controllers;
require_once('../vendor/autoload.php');
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use Cloudinary\Cloudinary;
use Cloudinary\Transformation\Resize;


class CloudinaryController extends BaseController
{
    function getImage(Request $request){ 
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
    $cloudinary->uploadApi()->upload(
        'https://upload.wikimedia.org/wikipedia/commons/a/ae/Olympic_flag.jpg',
        ['public_id' => 'olympic_flag']
    );
    echo $request->file('poster');    
}
   
}
