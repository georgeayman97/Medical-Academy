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
        'status',
        'price',
    ];

    public function Sessions(){
        return $this->hasMany(Session::class);
    }

    public static function validateRules()
    {
        return [
            'name' => 'required|max:255',
            'instructor_name' => 'required|max:255',
            'description' => 'nullable',
            'image' => 'nullable|image|dimensions:min_width:300,min_height:300',
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

    // Mutators: set{AttributeName}Attribute
    public function setNameAttribute($value)
    {
        // to convert first char in names to capital letter
        //$this->attributes['name'] = Str::studly($value); //without spaces

        $this->attributes['name'] = Str::title($value);  //with spaces

        // initialize the slug column from here
        $this->attributes['slug'] = Str::slug($value);
    }
}
