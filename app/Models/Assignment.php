<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'assignment_file',
        'title',
        'course_id',

    ];




    public function course()
    {
        return $this->belongsTo(Course::class);
    }



    public function students()
    {
        return $this->belongsToMany(Student::class)
            ->withPivot('assignment_id')
            ->withPivot('assignment_file')
            ->withTimestamps();
    }
}
