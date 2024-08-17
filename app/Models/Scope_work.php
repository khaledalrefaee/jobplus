<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scope_work extends Model
{
    use HasFactory;
    
    protected $guarded = []; 

    public function scopeSelection($query)
    {
        return $query->select('id', 'name_' . app()->getLocale() . ' as name');
    }

    public function Job_Title(){
        return $this->hasMany(Job_Title::class, 'scope_work_id');
    }

    public function userdetail(){
        return $this->hasMany(User_Detail::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($scopeworks) {
            $scopeworks->Job_Title()->delete();
        });

        static::deleting(function ($userdetail) {
            $userdetail->userdetail()->delete();
        });
    }

    

}
