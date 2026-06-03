<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use App\Models\schedules;

class reviews extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'schedule_id',
        'rang',
        'text',
        'status',
    ];

    public $timestamps = false;

    public function ReviewUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function ReviewSche(){
        return $this->belongsTo(schedules::class, 'schedule_id');
    }
}
