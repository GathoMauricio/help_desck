<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'name',
        'description',
        'image',
        'created_at',
        'updated_at'
    ];
    protected static function boot()
	{
		parent::boot();
        static::creating(function ($query) {
            $query->image = 'company.png';
		});
	}
}
