<?php

namespace App\Http\Controllers;
Use App\Models\ActorsModel;
Use App\Models\CountryModel;
use Illuminate\Http\Request;

class ActorsController extends Controller
{
    public function listActor(){       
            $title="Danh sách diễn viên";
            $actors=ActorsModel::getAllActors();
            foreach($actors as $item){
                if($item->gender==1)
                $item->gender="Nam";
                else
                $item->gender="Nữ";
                $nationality=CountryModel::find( $item->nationality);
                $item->nationality=$nationality->country_name;
            }
            return view("Actor.listActor",compact('title',"actors"));
    }
    public function addActor(){
        // return view("Actor.addActor");
    }
}
