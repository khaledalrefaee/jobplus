<?php

namespace App\Models;

use App\Models\Scope_work;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job_Title extends Model
{
    use HasFactory;

    protected $guarded = []; 

    public function scope_work(){
        return $this->belongsTo(Scope_work::class);
    }   
    
    public function scopeSelection($query)
    {
        return $query->select('id', 'name_' . app()->getLocale() . ' as name');
    }
}
