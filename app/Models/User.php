<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    const STATUS_REQUEST = 'request';
    const STATUS_ACTIVE = 'active';
    const STATUS_DISABLED = 'disabled';
    protected $dates = ['created_at'];

    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'mobile',
        'year',
        'role',
        'device_name',
        'password',
        'faculty_id',
        'forget_password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function CourseAccesses(){
        return $this->hasMany(CourseAccess::class,'user_id' , 'id');
    }

    public function UserTrackings(){
        return $this->hasMany(UserTracking::class,'user_id' , 'id');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class,'faculty_id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class,'course_accesses');
    }

    public function teaches()
    {
        return $this->hasMany(Course::class,'instructor_name');
    }
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function ($query, $search){
            $query->where(function($query) use ($search) {
                $query
                    ->where('name', 'like', '%' . $search . '%')
                    ->orWhere('mobile', 'like', '%' . $search . '%');
            });
        });
    }

    public function getNameAttribute($value)
    {
        if($this->trashed()){
            return $value . ' (Deleted) ';
        }
        return $value;
    }
}
