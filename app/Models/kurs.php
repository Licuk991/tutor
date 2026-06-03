<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\classes;
use App\Models\items;

class kurs extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'classes_id',
        'topic',
        'description',
    ];

    public $timestamps = false;

    public function KursClasses(){
        return $this->belongsTo(classes::class, 'classes_id');
    }
    public function KursItem(){
        return $this->belongsTo(items::class, 'item_id');
    }
}
