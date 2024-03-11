<?php

namespace App\Models;

use App\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Session extends Model
{

    use  HasFactory, HasFilter;

    protected $fillable = [
        'name', 'description', 'course_id', 'session_link', 'pdf', 'status', 'order'
    ];

    /**
     * @param $session
     * @return array
     */
    public static function validateRules($session = null): array
    {
        $courseId = request()->input('course_id'); // Get the course_id from the request
        $id = $session == null ? null : $session->id;
        $rules = [
            'name' => 'required|max:255',
            'session_link' => 'nullable|max:255',
            'description' => 'nullable',
            'course_id' => 'required|int|exists:courses,id',
            'order' => [
                'required',
                'int',
                Rule::unique('sessions', 'order')
                    ->where(function ($query) use ($courseId, $id) {
                        return $query->where('course_id', $courseId)->where('id', '!=', $id);
                    }),
            ],
        ];


        return $rules;
    }


    public function Course()
    {
        return $this->belongsTo(Course::class);
    }
}
