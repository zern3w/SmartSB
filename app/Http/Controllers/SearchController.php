<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
    public function getResults(){
    	return view('search.results');
    }

    public function postResults(Request $request){
    	if ($request->ajax()){
    		$result="";
    		$drivers=DB::table('drivers')->where('availability', 1)->where('driver_firstname','LIKE','%'.$request->search.'%')->orWhere('driver_lastname','LIKE','%'.$request->search.'%')->get();
    		if ($drivers){
             $result.='<div class="row">';
             foreach ($drivers as $key => $driver) {
                $result.=
                '<div class="col-sm-4 col-lg-4 col-md-4"">'.
                '<div class="thumbnail">'.
                '<img src="/uploads/avatars/'. $driver->photo .'" class="img-infowindow">'.
                '<div class="caption">'.
                '<h4 class="pull-right">'. "฿". $driver->fee  . '</h4>'.
                '<h4><a href="'. url("drivers/".$driver->driver_id)."/0".'">' .$driver->driver_firstname. " " . $driver->driver_lastname .'</a></h4>'.
                '<p>' .$driver->note .'</p>'.
                '</div>'.
                '<div class="ratings">'.
                ' <p class="pull-right">' .$driver->rating_count . " reviews" . '</p>
                <p>'.
                 number_format($driver->rating_cache, 1) ." stars".
                 '</p>'.
                 '<a href="'. url("children/list/".$driver->driver_id) .'" class="btn btn-primary form-control" >'.
                 '<i class="glyphicon glyphicon-send"></i> Request</a>'.
                 ' </div>'.
                 '</div>'.
                 '</div>';
             }
             $result.='</div>';
             return Response($result);

         }
     }
 }
}