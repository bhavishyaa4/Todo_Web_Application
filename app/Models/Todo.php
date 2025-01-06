<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Todo extends Model
{
    use HasFactory;

    protected $fillable=[
        'applicant_id',
        'title',
        'description',
        'is_completed',
    ];

    public function applicant(){
        return $this->belongsTo(Applicant::class,'applicant_id');
    }
}
