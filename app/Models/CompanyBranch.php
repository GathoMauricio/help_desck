<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBranch extends Model
{
    use HasFactory;

    protected $table = 'company_branches';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'company_id',
        'name',
        'email',
        'phone',
        'address',
        'created_at',
        'updated_at'
    ];

    public function company()
    {
        return $this->belongsTo
        (
            'App\Models\Company',
            'company_id',
            'id'
        )
        ->withDefault();
    }

}
