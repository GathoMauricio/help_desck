<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CaseBinnacleController extends Controller
{
    public function index($id){
        $case =  \App\Models\Caze::findOrFail($id);
        return view('case_binnacle.index',['case' => $case]);
    }
}
