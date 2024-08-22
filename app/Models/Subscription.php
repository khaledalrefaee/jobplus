<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $guarded = []; 


    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
