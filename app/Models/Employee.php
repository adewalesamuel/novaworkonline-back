<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

	public function user()
	{
		return $this->belongsTo(User::class);
	}
	public function recruiter()
	{
		return $this->belongsTo(Recruiter::class);
	}
	public function project()
	{
		return $this->belongsTo(Project::class);
	}
}
