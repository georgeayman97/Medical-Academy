<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'name',
        'image_path',
        'description',
        'faculty_id',
        'year'
    ];

    public static function validateRules()
    {
        return [
            'name' => 'required|max:255',
            'year' => 'required|int',
            'image_path' => 'nullable|image',
            'description' => 'nullable',
            'faculty_id' => 'required|int|exists:faculty,id'
            
        ];
    }

    public function courses(){
        return $this->hasMany(Course::class,'subject_id');
    }
    public function faculty(){
        return $this->belongsTo(Faculty::class,'faculty_id');
    }
}
