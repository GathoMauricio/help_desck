<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caze extends Model
{
    use HasFactory;

    protected $table = 'cases';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'num_case',
        'status_id',
        'symptomp_id',
        'user_contact_id',
        'user_support_id',
        'priority_case_id',
        'description',
        'feedback',
        'created_at',
        'updated_at'
    ];

    protected static function boot()
	{
		parent::boot();
        static::creating(function ($query) {
            $query->status_id = 1;
            $query->user_contact_id = \Auth::user()->id;
		});
	}

    public function status()
    {
        return $this->belongsTo
        (
            'App\Models\CaseStatus',
            'status_id',
            'id'
        )
        ->withDefault();
    }

    public function symptomp()
    {
        return $this->belongsTo
        (
            'App\Models\ServiceCategorySymptomp',
            'symptomp_id',
            'id'
        )
        ->withDefault();
    }

    public function contact()
    {
        return $this->belongsTo
        (
            'App\Models\User',
            'user_contact_id',
            'id'
        )
        ->withDefault();
    }

    public function support()
    {
        return $this->belongsTo
        (
            'App\Models\User',
            'user_support_id',
            'id'
        )
        ->withDefault();
    }

    public function priority()
    {
        return $this->belongsTo
        (
            'App\Models\CasePriority',
            'priority_case_id',
            'id'
        )
        ->withDefault();
    }
}
