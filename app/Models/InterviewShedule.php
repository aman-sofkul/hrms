<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterviewShedule extends Model
{
    use HasFactory;
    protected $fillable=[ 'user_id', 'company_name', 'hr_name', 'contact_number', 'location', 'description', 'status'];
}
