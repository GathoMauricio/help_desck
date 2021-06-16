<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseFollow extends Model
{
    use HasFactory;

    protected $table = 'case_follows';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'case_id',
        'author_id',
        'body',
        'created_at',
        'updated_at'
    ];

    protected static function boot()
	{
		parent::boot();
        static::creating(function ($query) {
            $query->author_id = \Auth::user()->id;
		});
	}

    public function case()
    {
        return $this->belongsTo
        (
            'App\Models\Caze',
            'case_id',
            'id'
        )
        ->withDefault();
    }
    public function author()
    {
        return $this->belongsTo
        (
            'App\Models\User',
            'author_id',
            'id'
        )
        ->withDefault();
    }
}
