<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;

    protected $table = 'service_types';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'service_area_id',
        'name',
        'created_at',
        'updated_at'
    ];

    public function area()
    {
        return $this->belongsTo
        (
            'App\Models\ServiceArea',
            'service_area_id',
            'id'
        )
        ->withDefault();
    }
}
