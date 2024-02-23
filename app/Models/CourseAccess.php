<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseAccess extends Model
{
    const STATUS_REQUEST = 'request';
    const STATUS_ENROLLED = 'enrolled';
    const STATUS_DISABLED = 'disabled';
    
    use HasFactory;

    protected $fillable = [
        'course_id',
        'user_id',
        'status',
    ];

    //protected $with = ['course', 'user'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id')->withTrashed();
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','id');
    }

}