<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Scope_work;
use Illuminate\Notifications\Notifiable;

class Company extends Authenticatable
{
    use HasFactory, Notifiable ;
    
    protected $guarded = []; 


    public function scopeWorks()
    {
        return $this->belongsToMany(Scope_work::class, 'scope_work_company');
    }

    public function latestActiveSubscription()
    {
        return $this->hasMany(Subscription::class)
                    ->where('status', 'active')
                    ->orderBy('created_at', 'desc')->get();
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function JobOpportunity()
    {
        return $this->hasMany(JobOpportunity::class);
    }

}
