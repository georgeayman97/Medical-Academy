<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    protected $table = 'faculty';

    protected $fillable = [
        'name','country','description','city','years'
    ];

    public static function validateRules()
    {
        return [
            'name' => 'required|max:255',
            'country' => 'required|max:255',
            'description' => 'nullable',
            'city' => 'required|max:255',
            'years' => 'required|numeric|min:0|max:7|not_in:0',
        ];
    }
}
