<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Caze;
use App\Models\ServiceArea;
use App\Models\ServiceType;
use App\Models\ServiceTypeCategory;
use App\Models\ServiceCategorySymptomp;

use App\Models\CasePriority;

class CaseController extends Controller
{
    public function index()
    {
        switch(\Auth::user()->user_rol_id)
        {
            case 1: 
                $cases = Caze::orderBy('id','DESC')->get();
                break;
            case 2: 
                $cases = Caze::where('user_support_id',\Auth::user()->id)->orderBy('id','DESC')->get();
                break;
            case 3: 
                $cases = Caze::where('user_contact_id',\Auth::user()->id)->orderBy('id','DESC')->get();
                break;
        }
        $json = [];
        foreach($cases as $case){
            $json[] = [
                'id' => $case->id,
                'case' => $case->num_case,
                'priority' => $case->priority['name'],
                'status' => $case->status['name'],
                'branch' => $case->contact->branch->company['name'].' - '.$case->contact->branch['name'],
                'author' => $case->contact['name'].' '.$case->contact['middle_name'].' '.$case->contact['last_name'],
                'description' => $case->description,
                'date' => formatDate($case->created_at)
            ];
        }
        return $json;
    }

    public function create()
    {
        $areas = ServiceArea::orderBy('name')->get();
        $prioridades = CasePriority::all();

        return [
            'areas' => $areas,
            'prioridades' => $prioridades
        ];

    }

    public function store(Request $request)
    {
        $lastCase = Caze::orderBy('id','DESC')->first();
        $explode = explode('NUM',$lastCase->num_case);

        $case = Caze::create([
            'num_case' => 'NUM'.($explode[1] + 1),
            'symptomp_id' => $request->symptomp_id,
            'priority_case_id' => $request->priority_case_id,
            'description' => $request->description
        ]);
        $supports = User::where('user_rol_id',2)->get();
        foreach($supports as $support)
        {
            sendPusher($support->id,'message','Se han agregado nuevos casos en espera de asignación.');
            sendFcm($support->fcm_token,"Nuevos casos", 'Se han agregado nuevos casos en espera de asignación.',['case_id' => $case->id]);
        }
        return $case;
    }

    public function changeArea(Request $request)
    {
        $servicios = ServiceType::where('service_area_id', $request->area_id)->orderBy('name')->get();
        return ['servicios' => $servicios];
    }

    public function changeServicio(Request $request)
    {
        $categorias = ServiceTypeCategory::where('service_type_id', $request->servicio_id)->orderBy('name')->get();
        return ['categorias' => $categorias];
    }

    public function changeCategoria(Request $request)
    {
        $sintomas = ServiceCategorySymptomp::where('service_type_category_id', $request->categoria_id)->orderBy('name')->get();
        return ['sintomas' => $sintomas];
    }
}
