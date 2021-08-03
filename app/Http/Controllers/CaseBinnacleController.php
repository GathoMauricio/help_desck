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
                'created_at' => formatDate($bitacora->created_at)
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

    public function guardarImagenBitacora(Request $request)
    {
        $binnacle_image = BinnacleImage::create([
            'binnacle_id' => $request->binnacle_id,
            'description' => $request->description,
        ]);
        if($binnacle_image)
        {
            $file = $request->file('image');
            $name =  "Binnacle_api[".$binnacle_image->id."_".$binnacle_image->binnacle_id."]_".\Str::random(8)."_".$file->getClientOriginalName();
            $img = \Image::make($file);
            $img = $img->widen(intdiv($img->width() , 4));
            $img->save('storage/binnacle_images/'.$name, 60);
            //\Storage::disk('local')->put($name,  \File::get($file));
            $binnacle_image->image = $name;
            $binnacle_image->save();
            return "Imagen almacenada";
        }else{ "Error durante la carga"; } 
    }
}
