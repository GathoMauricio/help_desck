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
}
