<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaseFollow;

class CaseFollowController extends Controller
{
    public function index($id)
    {
        $follows = CaseFollow::where('case_id', $id)->get();
        $json = [];
        foreach($follows as $follow)
        {
            $json[] = [
                'author' => $follow->author['name']." ".$follow->author['middle_name']." ".$follow->author['last_name'],
                'body' => $follow->body,
                'created_at' => formatDate($follow->created_at)
            ];
        }
        return $json;
    }
    public function store(Request $request)
    {
        $follow = CaseFollow::create($request->all());
        $follows = CaseFollow::where('case_id', $request->case_id)->get();
        $json = [];
        foreach($follows as $follow)
        {
            $json[] = [
                'author' => $follow->author['name']." ".$follow->author['middle_name']." ".$follow->author['last_name'],
                'body' => $follow->body,
                'created_at' => formatDate($follow->created_at)
            ];
        }
        return $json;
    }

}
