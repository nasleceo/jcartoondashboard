<?php

namespace App\Http\Controllers;

use App\Models\chapters;
use App\Models\ComicModel;
use App\Models\Comments;
use App\Models\Movie;
use App\Models\Posts;
use App\Models\TV;
use App\Models\User;
use App\Models\visitjcartoon;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashController extends Controller
{


    public function show()
    {

        $tvcount = TV::where('place', 'LIKE', '%' . 'tv' . '%')->count();
        $moviecount = TV::where('place', 'LIKE', '%' . 'movie' . '%')->count();
        $usercount = User::count();
        $comicscount = TV::where('place', 'LIKE', '%' . 'comic' . '%')->count();
        $chapterscount = chapters::count();
        $postcount = Posts::count();
        $commentscount = Comments::count();
        $totalvisit = visitjcartoon::count();

        // Get the current date
        $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
        $endOfWeek = Carbon::now()->endOfWeek()->toDateString();

        // Get top cartoon_id's number_visit for this week
        $topCartoonIdsThisWeek = visitjcartoon::orderByDesc('number_visit')
            ->pluck('cartoon_id')
            ->take(10);


      


        return View('layouts.dash', compact('tvcount', 'moviecount', 'usercount', 'comicscount', 'chapterscount', 'postcount', 'commentscount', 'totalvisit'));
    }
}
