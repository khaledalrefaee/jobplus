<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User_Detail extends Model
{
    use HasFactory;

    protected $guarded = []; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopework()
    {
        return $this->belongsTo(Scope_work::class,'scope_work_id');
    }

    public function jobtitle()
    {
        return $this->belongsTo(Job_Title::class,'job_title_id');
    }

 


}
