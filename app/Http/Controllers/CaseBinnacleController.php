<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CaseBinnacleController extends Controller
{
    public function index(){
        //$case =  \App\Models\Caze::findOrFail($id);
        $case = [];
        return view('case_binnacle.index',['case' => $case]);
    }
}
