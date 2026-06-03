<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\kurs;
use App\Models\schedules;
use App\Models\tutors_details;

class items extends Model
{
    use HasFactory;

     protected $fillable = [
        'name_t',
        'foto',
    ];

    public $timestamps = false;

    public function ItemKurs(){
        return $this->hasMany(kurs::class, 'item_id');
    }
    public function ItemSche(){
        return $this->hasMany(schedules::class, 'item_id');
    }
    public function ItemTutor(){
        return $this->hasMany(tutors_details::class, 'item_id');
    }
}
