<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [

        'aphoto',
        'designation',
        'education',
        'location',
        'mobile_number',
        'user_id',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }




}
