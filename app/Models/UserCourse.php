<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCourse extends Model
{
    use HasFactory, SoftDeletes;
            
	public function course()
	{
		return $this->belongsTo(Course::class); 
	}
	public function user()
	{
		return $this->belongsTo(User::class); 
	}
}