<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;


    protected $fillable = [
        'sphoto',
        'father_name',
        'mother_name',
        'hall',
        'session',
        'department',
        'location',
        'status',
        'gender',
        'sid',
        'religion',
        'mobile_number',
        'user_id',
    ];
    



    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function courses()
{
    return $this->belongsToMany(Course::class)
                ->withPivot('attendance')
                ->withPivot('lecture')
                ->withPivot('id')
                ->withTimestamps();
}


public function studentCourses()
{
    return $this->belongsToMany(Course::class, 'course_user_enrollment')
                ->withPivot('id')
                ->withTimestamps();
}


public function quizzes()
{
    return $this->belongsToMany(Quiz::class)
                ->withPivot('id')
                ->withTimestamps();
}



public function answers()
{
    return $this->hasMany(Answer::class);
}
}
