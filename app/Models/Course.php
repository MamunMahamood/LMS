<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TheJano\LaravelFilterable\Traits\HasFilterableTrait;
use App\Filters\Filterable\CourseFilterable;

class Course extends Model
{
    use HasFactory;
    use HasFilterableTrait;

    protected $fillable = [
        'cphoto',
        'course_name',
        'cid',
        'session',
        'course_code',
        'teacher_id',
        
    ];

    


    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function filterableClass()
    {
        return CourseFilterable::class;
    }



    public function students()
{
    return $this->belongsToMany(Student::class)
                ->withPivot('attendance')
                ->withPivot('lecture')
                ->withPivot('id')
                ->withTimestamps();;
}


public function courseStudents()
{
    return $this->belongsToMany(Student::class, 'course_user_enrollment')
                ->withPivot('id')
                ->withTimestamps();
}

public function userPosts()
{
    return $this->belongsToMany(User::class, 'course_user_post')
                ->withPivot('post')
                ->withPivot('id')
                ->withTimestamps();
}




public function quizzes()
{
    return $this->hasMany(Quiz::class);
                
}




}
