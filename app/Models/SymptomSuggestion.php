<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SymptomSuggestion extends Model
{
    use HasFactory;

    protected $table = 'symptom_suggestions';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'symptom_id',
        'body',
        'created_at',
        'updated_at'
    ];

    public function symptom()
    {
        return $this->belongsTo
        (
            'App\Models\ServiceCategorySymptomp',
            'symptom_id',
            'id'
        )
        ->withDefault();
    }
}
