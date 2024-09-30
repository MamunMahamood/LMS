<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'marks',
        'course_id',
       
    ];




    public function students()
    {
        return $this->belongsToMany(Student::class)
            ->withPivot('id')
            ->withPivot('marks_obtain')
            ->withTimestamps();
    }



    public function questions()
    {
        return $this->hasMany(Question::class);
    }


    public function course()
{
    return $this->belongsTo(Course::class);
                
}


public function answers()
{
    return $this->hasMany(Answer::class);
}



public function teachers()
    {
        return $this->belongsToMany(Teacher::class)
                ->withPivot('id')
                ->withPivot('student_id')
                ->withTimestamps();
    }





}
