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
use App\Models\SymptomSuggestion;

use App\Models\CasePriority;

class CaseController extends Controller
{
    public function index()
    {
        switch (\Auth::user()->user_rol_id) {
            case 1:
                $cases = Caze::orderBy('id', 'DESC')->get();
                break;
            case 2:
                $cases = Caze::where('user_support_id', \Auth::user()->id)->orderBy('id', 'DESC')->get();
                break;
            case 3:
                $cases = Caze::where('user_contact_id', \Auth::user()->id)->orderBy('id', 'DESC')->get();
                break;
        }
        $json = [];
        foreach ($cases as $case) {
            $json[] = [
                'id' => $case->id,
                'case' => $case->num_case,
                'priority' => $case->priority['name'],
                'status' => $case->status['name'],
                'branch' => $case->contact->branch->company['name'] . ' - ' . $case->contact->branch['name'],
                'author' => $case->contact['name'] . ' ' . $case->contact['middle_name'] . ' ' . $case->contact['last_name'],
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
        $lastCase = Caze::orderBy('id', 'DESC')->first();
        if($lastCase)
        {
            $explode = explode('-', $lastCase->num_case);
            $num_case = 'C-' . ($explode[1] + 1);
        }else{
            $num_case= 'C-3000';
        }
        
        $case = Caze::create([
            'num_case' => $num_case,
            'symptomp_id' => $request->symptomp_id,
            'priority_case_id' => $request->priority_case_id,
            'description' => $request->description
        ]);
        $supports = User::where(function($q){
            $q->where('user_rol_id', 1);
            $q->orWhere('user_rol_id', 2);
        })->get();
        foreach ($supports as $support) {
            sendPusher($support->id, 'message', 'Se han agregado nuevos casos en espera de asignación.');
            sendFcm($support->fcm_token, "Nuevos casos", 'Se han agregado nuevos casos en espera de asignación.', ['case_id' => $case->id]);
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

    public function changeSintoma(Request $request)
    {
        $sugerencias = SymptomSuggestion::where('symptom_id', $request->sintoma_id)->orderBy('body')->get();
        return ['sugerencias' => $sugerencias];
    }

    public function loadAllCases(Request $request)
    {
        switch (\Auth::user()->user_rol_id) {
            case 1:
                $cases = Caze::orderBy('id', 'DESC')->get();
                break;
            case 2:
                $cases = Caze::where('user_support_id', \Auth::user()->id)->orderBy('id', 'DESC')->get();
                break;
            case 3:
                $cases = Caze::where('user_contact_id', \Auth::user()->id)->orderBy('id', 'DESC')->get();
                break;
        }
        $json = [];
        foreach ($cases as $case) {
            if (!is_null($case->user_support_id)) {
                $asignado = $case->support['name'] . ' ' . $case->support['middle_name'] . ' ' . $case->support['last_name'];
            } else {
                $asignado = "No disponible";
            }

            $json[] = [
                "id" => $case->id,
                "caso" => $case->num_case,
                "fecha" => formatDate($case->created_at),
                "area" => $case->symptomp->category->type->area['name'],
                "servicio" => $case->symptomp->category->type['name'],
                "categoria" => $case->symptomp->category['name'],
                "sintoma" => $case->symptomp['name'],
                "descripcion" => $case->description,
                "estatus" => $case->status['name'],
                "id_estatus" => $case->status_id,
                "prioridad" => $case->priority['name'],
                "prioridad_id" => $case->priority_case_id,

                "contacto" => $case->contact['name'] . ' ' . $case->contact['middle_name'] . ' ' . $case->contact['last_name'],
                "empresa" => $case->contact->branch->company['name'],
                "sucursal" => $case->contact->branch['name'],

                "asignado" => $asignado,
                "retroalimentacion" => $case->feedback
            ];
        }
        return $json;
    }
    public function loadPendingCases(Request $request)
    {
        switch (\Auth::user()->user_rol_id) {
            case 1:
                $cases = Caze::where('status_id', 1)->orderBy('id', 'DESC')->get();
                break;
            case 2:
                $cases = Caze::where('status_id', 1)->where('user_support_id', \Auth::user()->id)->orderBy('id', 'DESC')->get();
                break;
            case 3:
                $cases = Caze::where('status_id', 1)->where('user_contact_id', \Auth::user()->id)->orderBy('id', 'DESC')->get();
                break;
        }
        $json = [];
        foreach ($cases as $case) {
            if (!is_null($case->user_support_id)) {
                $asignado = $case->support['name'] . ' ' . $case->support['middle_name'] . ' ' . $case->support['last_name'];
            } else {
                $asignado = "No disponible";
            }

            $json[] = [
                "id" => $case->id,
                "caso" => $case->num_case,
                "fecha" => formatDate($case->created_at),
                "area" => $case->symptomp->category->type->area['name'],
                "servicio" => $case->symptomp->category->type['name'],
                "categoria" => $case->symptomp->category['name'],
                "sintoma" => $case->symptomp['name'],
                "descripcion" => $case->description,
                "estatus" => $case->status['name'],
                "id_estatus" => $case->status_id,
                "prioridad" => $case->priority['name'],
                "prioridad_id" => $case->priority_case_id,

                "contacto" => $case->contact['name'] . ' ' . $case->contact['middle_name'] . ' ' . $case->contact['last_name'],
                "empresa" => $case->contact->branch->company['name'],
                "sucursal" => $case->contact->branch['name'],

                "asignado" => $asignado,
                "retroalimentacion" => $case->feedback
            ];
        }
        return $json;
    }

    public function loadProgressCases(Request $request)
    {
        switch (\Auth::user()->user_rol_id) {
            case 1:
                $cases = Caze::where('status_id', 2)->orderBy('id', 'DESC')->get();
                break;
            case 2:
                $cases = Caze::where('status_id', 2)->where('user_support_id', \Auth::user()->id)->orderBy('id', 'DESC')->get();
                break;
            case 3:
                $cases = Caze::where('status_id', 2)->where('user_contact_id', \Auth::user()->id)->orderBy('id', 'DESC')->get();
                break;
        }
        $json = [];
        foreach ($cases as $case) {
            if (!is_null($case->user_support_id)) {
                $asignado = $case->support['name'] . ' ' . $case->support['middle_name'] . ' ' . $case->support['last_name'];
            } else {
                $asignado = "No disponible";
            }

            $json[] = [
                "id" => $case->id,
                "caso" => $case->num_case,
                "fecha" => formatDate($case->created_at),
                "area" => $case->symptomp->category->type->area['name'],
                "servicio" => $case->symptomp->category->type['name'],
                "categoria" => $case->symptomp->category['name'],
                "sintoma" => $case->symptomp['name'],
                "descripcion" => $case->description,
                "estatus" => $case->status['name'],
                "id_estatus" => $case->status_id,
                "prioridad" => $case->priority['name'],
                "prioridad_id" => $case->priority_case_id,

                "contacto" => $case->contact['name'] . ' ' . $case->contact['middle_name'] . ' ' . $case->contact['last_name'],
                "empresa" => $case->contact->branch->company['name'],
                "sucursal" => $case->contact->branch['name'],

                "asignado" => $asignado,
                "retroalimentacion" => $case->feedback
            ];
        }
        return $json;
    }

    public function loadFinishCases(Request $request)
    {
        switch (\Auth::user()->user_rol_id) {
            case 1:
                $cases = Caze::where('status_id', 3)->orderBy('id', 'DESC')->get();
                break;
            case 2:
                $cases = Caze::where('status_id', 3)->where('user_support_id', \Auth::user()->id)->orderBy('id', 'DESC')->get();
                break;
            case 3:
                $cases = Caze::where('status_id', 3)->where('user_contact_id', \Auth::user()->id)->orderBy('id', 'DESC')->get();
                break;
        }
        $json = [];
        foreach ($cases as $case) {
            if (!is_null($case->user_support_id)) {
                $asignado = $case->support['name'] . ' ' . $case->support['middle_name'] . ' ' . $case->support['last_name'];
            } else {
                $asignado = "No disponible";
            }

            $json[] = [
                "id" => $case->id,
                "caso" => $case->num_case,
                "fecha" => formatDate($case->created_at),
                "area" => $case->symptomp->category->type->area['name'],
                "servicio" => $case->symptomp->category->type['name'],
                "categoria" => $case->symptomp->category['name'],
                "sintoma" => $case->symptomp['name'],
                "descripcion" => $case->description,
                "estatus" => $case->status['name'],
                "id_estatus" => $case->status_id,
                "prioridad" => $case->priority['name'],
                "prioridad_id" => $case->priority_case_id,

                "contacto" => $case->contact['name'] . ' ' . $case->contact['middle_name'] . ' ' . $case->contact['last_name'],
                "empresa" => $case->contact->branch->company['name'],
                "sucursal" => $case->contact->branch['name'],

                "asignado" => $asignado,
                "retroalimentacion" => $case->feedback
            ];
        }
        return $json;
    }

    public function loadUnasignedCases(Request $request)
    {
        switch (\Auth::user()->user_rol_id) {
            case 1:
                $cases = Caze::where('user_support_id', NULL)->orderBy('id', 'DESC')->get();
                break;
            case 2:
                $cases = Caze::where('user_support_id', NULL)->where('user_support_id', \Auth::user()->id)->orderBy('id', 'DESC')->get();
                break;
            case 3:
                $cases = Caze::where('user_support_id', NULL)->where('user_contact_id', \Auth::user()->id)->orderBy('id', 'DESC')->get();
                break;
        }
        $json = [];
        foreach ($cases as $case) {
            if (!is_null($case->user_support_id)) {
                $asignado = $case->support['name'] . ' ' . $case->support['middle_name'] . ' ' . $case->support['last_name'];
            } else {
                $asignado = "No disponible";
            }

            $json[] = [
                "id" => $case->id,
                "caso" => $case->num_case,
                "fecha" => formatDate($case->created_at),
                "area" => $case->symptomp->category->type->area['name'],
                "servicio" => $case->symptomp->category->type['name'],
                "categoria" => $case->symptomp->category['name'],
                "sintoma" => $case->symptomp['name'],
                "descripcion" => $case->description,
                "estatus" => $case->status['name'],
                "id_estatus" => $case->status_id,
                "prioridad" => $case->priority['name'],
                "prioridad_id" => $case->priority_case_id,

                "contacto" => $case->contact['name'] . ' ' . $case->contact['middle_name'] . ' ' . $case->contact['last_name'],
                "empresa" => $case->contact->branch->company['name'],
                "sucursal" => $case->contact->branch['name'],

                "asignado" => $asignado,
                "retroalimentacion" => $case->feedback
            ];
        }
        return $json;
    }

    public function obetenerAreas(){
        $areas = ServiceArea::orderBy('name')->get();
        $prioridades = CasePriority::all();

        return [
            'areas' => $areas,
            'prioridades' => $prioridades
        ];
    }

    public function tomarCaso(Request $request)
    {
        $caso = Caze::findOrFail($request->case_id);
        if(is_null($caso->user_support_id)){
            $caso->user_support_id = \Auth::user()->id;
            $caso->status_id = 2;
            $caso->save();
            $body = $caso->support['name'].' '.$caso->support['middle_name'].' a sido asignado a su caso '.$caso->num_case;
            sendFcm($caso->contact['fcm_token'],"Caso en progreso", $body,['tipo' => 'caso_asignado','case_id' => $caso->id,'body'=>$body]);
            return [
                'error' => 0,
                'msg' => 'El caso se agregó a su lista en progreso.'
            ];
        }else{
            return [
                'error' => 1,
                'msg' => 'Este caso ya ha sido tomado por '.$caso->support['name'].' '.$caso->support['middle_name'].'.'
            ];
        }
    }
}
