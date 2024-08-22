<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\City;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\BusinessGallery;
use App\Models\skill;

class User extends Authenticatable
{
    use HasFactory, Notifiable ,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = []; 
    // protected $fillable = ['first_name','last_name'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    public function city()
    {
        return $this->belongsTo(City::class);
    }

     
    public function userdetails()
    {
        return $this->hasOne(User_Detail::class);
    }

    public function cv()
    {
        return $this->hasOne(Cv::class);
    }

    public function businessgallery()
    {
        return $this->hasMany(BusinessGallery::class ,'user_id');
    }

    public function skill()
    {
        return $this->hasMany(skill::class ,'user_id');
    }
   
 

    public function language()
    {
        return $this->hasMany(Language::class ,'user_id');
    }

    public function experience()
    {
        return $this->hasMany(Experience::class ,'user_id');
    }

    public function certificate()
    {
        return $this->hasMany(Certificate::class ,'user_id');
    }
    

    public function scopework()
    {
        return $this->belongsTo(Scope_work::class,'scope_work_id');
    }

    public function jobtitle()
    {
        return $this->belongsTo(Job_Title::class,'job_title_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($userdetails) {
            $userdetails->userdetails()->delete();
        });

        static::deleting(function ($businessgallery) {
            $businessgallery->businessgallery()->delete();
        });

        static::deleting(function ($skill) {
            $skill->skill()->delete();
        });

        static::deleting(function ($language) {
            $language->language()->delete();
        });

        static::deleting(function ($experience) {
            $experience->experience()->delete();
        });

        static::deleting(function ($certificate) {
            $certificate->certificate()->delete();
        });

        static::deleting(function ($cv) {
            $cv->cv()->delete();
        });
    }

 


    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

 
}
