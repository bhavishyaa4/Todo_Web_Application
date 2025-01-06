<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Applicant extends Authenticatable
{
    use HasFactory;
    protected $table = 'applicant';
    public $timestamps = false;

    protected $fillable=[
        'name',
        'email',
        'username',
        'password',
    ];

    protected $hidden=[
        'password',
        'remember_token',
    ];

    public function todos(){
        return $this->hasMany(Todo::class, 'applicant_id');
    }
}
