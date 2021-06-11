<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceTypeCategory extends Model
{
    use HasFactory;

    protected $table = 'service_type_categories';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'service_type_id',
        'name',
        'created_at',
        'updated_at'
    ];

    public function type()
    {
        return $this->belongsTo
        (
            'App\Models\ServiceType',
            'service_type_id',
            'id'
        )
        ->withDefault();
    }
}
