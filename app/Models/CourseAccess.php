<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseAccess extends Model
{
    const STATUS_REQUEST = 'request';
    const STATUS_ACTIVE = 'active';
    const STATUS_DISABLED = 'disabled';
    
    use HasFactory;
}
