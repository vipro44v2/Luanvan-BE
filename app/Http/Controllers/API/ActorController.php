<?php

namespace App\Http\Controllers\API;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
Use App\Models\ActorsModel;
Use App\Models\CountryModel;
use Illuminate\Http\Request;

class ActorController extends BaseController
{
    public function getAll(){       
        $actor=ActorsModel::all();
        if($actor)
        {
            return response()->json([
            'data'=>$actor,
            'status_code'=>200,
            'message'=>'done'
            ]);
        }
        else
        {
            return response()->json([
                'data'=>null,
                'status_code'=>404,
                'message'=>'error'
            ]);
        }
    }
    public function addActor(){
        // return view("Actor.addActor");
    }
}
