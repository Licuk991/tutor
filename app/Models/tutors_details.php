<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\items;

class tutors_details extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'experience',
        'item_id',
        'photo',
        'status',
    ];

    public $timestamps = false;

    public function TutorUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function TutorItem(){
        return $this->belongsTo(items::class, 'item_id');
    }
}
