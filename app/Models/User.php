<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Overtrue\LaravelFavorite\Traits\Favoriter;
use Overtrue\LaravelFollow\Traits\Follower;
use Overtrue\LaravelFollow\Traits\Followable;
use Overtrue\LaravelLike\Traits\Liker;



class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    use Favoriter;
    use Follower;
    use Followable;
    use Liker;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'userspecial_name',
        'email',
        'password',
        'isverified',
        'isadmin',
        'whatcando',//permetion
        'account_type',
        'profil',
        'noads',
        'ads_date_start',
        'ads_date_end',
        'Subscription',
        'banned',
        'insta_url',
        'face_url',
        'twitter_url',
        'profile_desc',
        'rooms_number',
        'device_id',
        'country'
    ];


    public function user_comments(){
        return $this->hasMany(Comments::class,'user_id','id');
    }

    public function user_posts(){
        return $this->hasMany(Posts::class,'user_id','id');
    }

    public function user_rooms(){
        return $this->hasMany(RoomModel::class,'user_id','id');
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
