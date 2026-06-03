<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\kurs;
use App\Models\schedules;

class classes extends Model
{
    use HasFactory;

      protected $fillable = [
        'number',
    ];

    public $timestamps = false;

    public function ClassesKurs(){
        return $this->hasMany(kurs::class, 'classes_id');
    }
    public function ClassesSche(){
        return $this->hasMany(schedules::class, 'classes_id');
    }
}
