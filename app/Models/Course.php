<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    const STATUS_ACTIVE = 'active';
    const STATUS_DISABLED = 'disabled';

    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'instructor_name',
        'image_path',
        'description',
        'course_year',
        'status',
        'price',
        'subject_id'
    ];

    public function CourseAccesses(){
        return $this->hasMany(CourseAccess::class,'course_id','id');
    }

    // protected $with =['CourseAccesses'];

    public function Sessions(){
        return $this->hasMany(Session::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'course_accesses');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'instructor_name');
    }


    public static function validateRules()
    {
        //dimensions:min_width:300,min_height:300   =====> in Image validation
        return [
            'name' => 'required|max:255',
            'instructor_name' => 'required|max:255',
            'description' => 'nullable',
            'image' => 'nullable|image',
            'price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|unique:products,sku',
            'status' => 'in:' . self::STATUS_ACTIVE . ',' . self::STATUS_DISABLED,
        ];
    }

    public function getImageUrlAttribute()
    {
        if(!$this->image_path){
            return asset('images/placeholder.png');
        }
        // if the image is link
        if(stripos($this->image_path, 'http') === 0){
            return $this->image_path;
        }

        return asset('uploads/' . $this->image_path);
    }

    // public function CourseAccessUsers()
    // {
    //     return $this->hasManyThrough(
    //         User::class,
    //         CourseAccess::class,
    //         'course_id',
    //         'id');
    // }

    // Mutators: set{AttributeName}Attribute
    public function setNameAttribute($value)
    {
        // to convert first char in names to capital letter
        //$this->attributes['name'] = Str::studly($value); //without spaces

        $this->attributes['name'] = Str::title($value);  //with spaces

        // initialize the slug column from here
        $this->attributes['slug'] = Str::slug($value);
    }

    //------------------------------------------------ SEARCH --------------------------------------------------------


    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, function ($query, $search){
            $query->where(function($query) use ($search) {
                $query
                    ->where('name', 'like', '%' . $search . '%');
            });
        });
        $query->when($filters['doctor'] ?? false, function ($query, $doctor){
            $query->wherehas('doctor', function ($query) use ($doctor) {
                $query->where('instructor_name', $doctor);
            });
        });
        $query->when($filters['course_year'] ?? false, function($query, $course_year){
            $query->where('course_year', $course_year);
            });

    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

}
