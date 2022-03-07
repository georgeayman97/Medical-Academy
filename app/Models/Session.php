<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{

    use HasFactory;

    protected $fillable = [
        'name','slug','description','course_id','session_link'
    ];

    public static function validateRules()
    {
        return [
            'name' => 'required|max:255',
            'session_link' => 'required|max:255',
            'description' => 'nullable',
            'course_id' => 'required|int|exists:courses,id'
            
        ];
    }

    public function Course(){
        return $this->belongsTo(Course::class);
    }
}
