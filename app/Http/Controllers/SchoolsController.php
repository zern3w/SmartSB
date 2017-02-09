<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;

class SchoolsController extends Controller
{
	public function getSchool(){
		return array('schools' => School::all());
	}
}
