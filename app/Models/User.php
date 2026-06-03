<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\tutors_details;
use App\Models\reviews;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'FIO',
        'email',
        'login',
        'password',
        'role',
    ];

    public $timestamps = false;

    protected $table = 'users';

  public function UserTurot()
{
    return $this->hasOne(tutors_details::class, 'user_id');
}

    public function tutorItem()
    {
        // Используем hasOneThrough, чтобы дотянуться от User до Items через TutorDetails
        return $this->hasOneThrough(
            items::class,
            tutors_details::class,
            'user_id', // внешний ключ в tutors_details
            'id',      // первичный ключ в items
            'id',      // локальный ключ в User
            'item_id'  // локальный ключ в tutors_details
        );
    }
    public function UserReview()
    {
        return $this->hasMany(reviews::class, 'user_id');
    }
    
 // ОСТАВЬТЕ ТОЛЬКО ЭТОТ МЕТОД ДЛЯ СПИСКА УЧЕНИКОВ
    public function getEnrolledStudentsAttribute()
    {
        // 1. Проверяем, есть ли у учителя привязанный предмет
        $itemId = $this->tutorItem->item_id ?? null;

        if (!$itemId) {
            return collect(); // Возвращаем пустую коллекцию, если предмета нет
        }

        // 2. Ищем всех пользователей, которые есть в расписании (schedules) для этого предмета
        return \App\Models\User::whereHas('schedules', function($query) use ($itemId) {
            $query->where('item_id', $itemId);
        })->get();
    }

    // Эта связь нужна, чтобы метод выше мог работать (whereHas('schedules'))
    public function schedules()
    {
        return $this->hasMany(schedules::class, 'user_id', 'id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
