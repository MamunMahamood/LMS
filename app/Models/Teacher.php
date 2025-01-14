<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'designation',
        'status',
        'gender',
        'religion',
        'mobile_number',
        'tphoto',
        'user_id',
        'education',
        'location',
        'skill',
        'research_interest',
        
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function courses()
    {
        return $this->hasMany(Course::class);
    }


    
    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class)
                ->withPivot('id')
                ->withPivot('student_id')
                ->withTimestamps();
    }
}
