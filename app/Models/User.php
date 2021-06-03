<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'user_rol_id',
        'status',
        'name',
        'middle_name',
        'last_name',
        'phone',
        'emergency_phone',
        'email',
        'address',
        'password',
        'image',
        'api_token',
        'fcm_token',
        'created_at',
        'updated_at',
    ];
    protected static function boot()
	{
		parent::boot();
        static::creating(function ($query) {
            $query->password = bcrypt($query->email);
            $query->image = 'perfil.png';
            $query->status = 'Activo';
            $query->api_token = \Str::random(60);
		});
	}
    public function rol()
    {
        return $this->belongsTo
        (
            'App\Models\UserRol',
            'user_rol_id',
            'id'
        )
        ->withDefault();
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
