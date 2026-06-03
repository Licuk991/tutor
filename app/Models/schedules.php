<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\classes;
use App\Models\items;
use App\Models\User;
use App\Models\reviews;


class schedules extends Model
{
    use HasFactory;

     protected $fillable = [
        'item_id',
        'classes_id',
        'user_id',
        'date',
        'status',
    ];

    public $timestamps = false;

    public function ScheItem(){
        return $this->belongsTo(items::class, 'item_id');
    }
    public function ScheClasses(){
        return $this->belongsTo(classes::class, 'classes_id');
    }
    public function ScheUser(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function ScheReview(){
        return $this->hasMany(reviews::class, 'schedule_id');
    }
}
