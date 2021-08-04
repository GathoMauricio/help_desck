<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaseBinnacle;
use App\Models\BinnacleImage;

class CaseBinnacleController extends Controller
{
    public function index()
    {
        //$case =  \App\Models\Caze::findOrFail($id);
        $case = [];
        return view('case_binnacle.index',['case' => $case]);
    }

    public function verBitacoras(Request $request)
    {
        $bitacoras = CaseBinnacle::where('case_id',$request->case_id)->orderBy('id', 'DESC')->get();
        $json = [];
        foreach($bitacoras as $bitacora)
        {
            $json[] = [
                'id' => $bitacora->id,
                'author' => $bitacora->author['name'].' '.$bitacora->author['middle_name'].' '.$bitacora->author['last_name'],
                'body' => $bitacora->description,
                'created_at' => formatDate($bitacora->created_at),
                'contador_imagenes' => count(BinnacleImage::where('binnacle_id',$bitacora->id)->get())
            ];
        }
        return $json;
    }

    public function guardarBitacora(Request $request)
    {
        $caso = CaseBinnacle::create([
            'case_id' => $request->case_id,
            'description' => $request->description
        ]);
        if($caso)
        {
            return [
                'error' => 0,
                'msg' => "Bitácora creada ahora puede subir imágenes"
            ];
        }else{
            return [
                'error' => 1,
                'msg' => "Error con el servidor"
            ];
        }
    }

}
