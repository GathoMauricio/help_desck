<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategorySymptomp extends Model
{
    use HasFactory;

    protected $table = 'service_category_symptoms';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'service_type_category_id',
        'name',
        'created_at',
        'updated_at'
    ];

    public function category()
    {
        return $this->belongsTo
        (
            'App\Models\ServiceTypeCategory',
            'service_type_category_id',
            'id'
        )
        ->withDefault();
    }
}
