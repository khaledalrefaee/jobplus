<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOpportunity extends Model
{
    use HasFactory;


    protected $guarded = []; 

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function jobtitle()
    {
        return $this->belongsTo(Job_Title::class,'job_title_id');
    }

    public function scopework()
    {
        return $this->belongsTo(Scope_work::class , 'scope_work_id');
    }

}
