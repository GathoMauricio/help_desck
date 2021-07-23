<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Caze;

class CaseBinnacleController extends Controller
{
    public function index($id){
        $case = Caze::findOrFail($id);
        return view('case_binnacle.index',['case' => $case]);
    }
}
