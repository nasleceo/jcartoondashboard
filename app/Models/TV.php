<?php

namespace App\Models;

use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFavorite\Traits\Favoriteable;



class TV extends Model implements CanVisit
{
    use HasFactory;
    use HasVisits;
    use Favoriteable;

    public $table = "tv";

    protected $fillable = [
        'title', 'poster', 'cover',
        'year', 'place', 'gener', 'mortabit_id',
        'whereistartcomics', 'age', 'story',
        'tmdb_id', 'statu','pin'
    ];

    public function chapters()
    {
        return $this->hasMany(chapters::class, 'comic_id', 'id');
    }

    public function seasonsCount()
    {
        return SeasonModel::where('movie_id', 'id')->count();
    }
    public function seasons()
    {
        return $this->hasMany(SeasonModel::class, 'movie_id', 'id');
    }

    public function episdoes()
    {
        return $this->hasMany(episodemodel::class, 'tv_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'tv_id', 'id');
    }

    public function rooms()
    {
        return $this->hasMany(RoomModel::class, 'tv_id', 'id');
    }

    public function news()
    {
        return $this->hasMany(News::class, 'movie_id', 'id');
    }

    public function cast()
    {
        return $this->hasMany(Cast::class, 'comic_id', 'id');
    }

    public function rate()
    {
        return $this->hasMany(Rate::class, 'tv_id', 'id');
    }

    public function tawsiat()
    {
        return $this->hasMany(Posts::class, 'tv_id', 'id');
    }

    public function Views()
    {
        return $this->hasMany(visitjcartoon::class, 'cartoon_id', 'id');
    }

    public function favourites()
    {
        return $this->hasMany(Listjcartoon::class, 'tv_id', 'id');
    }

}
