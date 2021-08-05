<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BinnacleImage;

class BinnacleImageController extends Controller
{
    public function index($id)
    {
        $images = BinnacleImage::where('binnacle_id',$id)->get();
        $json = [];
        foreach($images as $image)
        {
            $json[] = [
                'id' => $image->id,
                'url' => getUrl().'/storage/binnacle_images/'.$image->image,
                'description' => $image->description,
                'date' => formatDate($image->created_at)
            ];
        }
        return $json;
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
            //$img = $img->widen(intdiv($img->width() , 4));
            $img->save('storage/binnacle_images/'.$name, 60);
            $binnacle_image->image = $name;
            $binnacle_image->save();
            return "Imagen almacenada";
        }else{ "Error durante la carga"; } 
    }

    public function verImagenesBitacoras(Request $request)
    {
        $imagenes = BinnacleImage::where('binnacle_id',$request->binnacle_id)->get();
        $json = [];
        foreach($imagenes as $imagen)
        {
            $json[] = [
                'id' => $imagen->id,
                'url' => getUrl().'/storage/binnacle_images/'.$imagen->image,
                'description' => $imagen->description,
                'date' => formatDate($imagen->created_at),
            ];
        }
        return  $json;
    }
}
