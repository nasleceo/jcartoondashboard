<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\Appupdatecontroller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CastController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\mowajahaController;
use App\Http\Controllers\NadariatController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\notificationController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\ReplayController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\Roomcontroller;
use App\Http\Controllers\skipg;
use App\Http\Controllers\Tvcontroller;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use Goutte\Client;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashController::class, 'show'])->name('dash');


Route::middleware('isLogedin')->group(function () {


    Route::get('/dash', [DashController::class, 'show'])->name('dash');





    /*---------------------------- المسلسلات ---------------------------- */


    Route::get('/tv', [Tvcontroller::class, 'show'])->name('tv');
    Route::get('/tv/addtv', [Tvcontroller::class, 'addtvview'])->name('addtv');
    Route::post('/tv/addtv', [Tvcontroller::class, 'addtv'])->name('addtv.post');
    Route::post('/gettvFromTMDB', [Tvcontroller::class, 'gettvFromTMDB'])->name('gettvFromTMDB');
    Route::get('/tv/edit/{id}', [Tvcontroller::class, 'editshow'])->name('edittv');
    Route::post('/tv/edit/{id}', [Tvcontroller::class, 'Edittv'])->name('Edittv');
    Route::get('/tv/delet/{id}', [Tvcontroller::class, 'delettv'])->name('delettv');

    Route::get('/tv/seasons/{id}', [Tvcontroller::class, 'SeasonsShow'])->name('showSeason');
    Route::post('/tv/seasons/{id}', [Tvcontroller::class, 'addseason'])->name('addSeason');

    Route::get('/tv/seasons/edit/{id}', [Tvcontroller::class, 'Seasonseditshow'])->name('editSeasonshow');
    Route::post('/tv/seasons/edit/{id}', [Tvcontroller::class, 'editseason'])->name('editSeason');

    Route::get('/tv/seasons/delet/{id}', [Tvcontroller::class, 'deletseason'])->name('deletseason');

    Route::get('/tv/seasons/videos/{id}', [Tvcontroller::class, 'SeasonsVideoshow'])->name('SeasonsVideoshow');
    Route::post('/tv/seasons/videos/{id}', [Tvcontroller::class, 'videosseason'])->name('videosseason');

    Route::get('/tv/season/videos/edit/{id}', [Tvcontroller::class, 'SeasonsVideoEditshow'])->name('SeasonsVideoshowEdit');
    Route::post('/tv/season/videos/edit/{id}', [Tvcontroller::class, 'Editvideosseason'])->name('Editvideosseason');


    Route::get('/tv/season/videos/delet/{id}', [Tvcontroller::class, 'deletepe'])->name('deletvid');
    Route::post('/tv/season/videos/DeletAllEpe', [Tvcontroller::class, 'DeletAllEpe'])->name('DeletAllEpe');


    Route::get('/tv/season/videos/servers/{id}', [Tvcontroller::class, 'servers'])->name('servers');
    Route::post('/tv/season/videos/servers/{id}', [Tvcontroller::class, 'addservers'])->name('addservers');
    Route::get('/tv/season/videos/servers/delet/{id}', [Tvcontroller::class, 'deletservers'])->name('deletservers');


 /*---------------------------- الغرف ---------------------------- */


    Route::get('/roomcartoon', [Roomcontroller::class, 'show'])->name('roomcartoon');
    Route::get('/getMovieType/{id}', [Roomcontroller::class, 'getMovieType'])->name('getMovieType');
    Route::get('/getSeasons/{id}', [Roomcontroller::class, 'getSeasons'])->name('getSeasons');
    Route::get('/getEpisdoes/{id}', [Roomcontroller::class, 'getEpisdoes'])->name('getEpisdoes');
    Route::get('/getEpisdoesMovie/{id}', [Roomcontroller::class, 'getEpisdoesMovie'])->name('getEpisdoesMovie');


    Route::post('/AddnewRoom', [Roomcontroller::class, 'AddnewRoom'])->name('AddnewRoom');

    Route::get('/roomcartoon/user/{id}', [Roomcontroller::class, 'usersinsideRoom'])->name('usersinsideRoom');
    Route::post('/AddnewUserToRoom/{id}', [Roomcontroller::class, 'AddnewUserToRoom'])->name('AddnewUserToRoom');
    Route::get('/roomcartoon/delete/{id}', [Roomcontroller::class, 'userOutFromRoom'])->name('userOutFromRoom');


    Route::post('/Addnewmessages/{id}', [Roomcontroller::class, 'Addnewmessages'])->name('Addnewmessages');
    Route::get('/roomcartoon/messages/{id}', [Roomcontroller::class, 'allmessages'])->name('allmessages');
    Route::get('/roomcartoon/delete/{id}', [Roomcontroller::class, 'DeleteRoom'])->name('DeleteRoom');





    /*---------------------------- الأفلام ---------------------------- */


    Route::get('/movie', [MovieController::class, 'show'])->name('movie');
    Route::get('/movie/addmovie', [MovieController::class, 'addmovieview'])->name('addmovie');
    Route::post('/movie/addmovie', [MovieController::class, 'addmovie'])->name('addmovie.post');
    Route::post('/getmovieFromTMDB', [MovieController::class, 'getmovieFromTMDB'])->name('getmovieFromTMDB');
    Route::get('/movie/delet/{id}', [MovieController::class, 'deletmovie'])->name('deletmovie');



    Route::get('/movie/edit/{id}', [MovieController::class, 'editshow'])->name('editmovie');
    Route::post('/movie/edit/{id}', [MovieController::class, 'Editmovie'])->name('Editmovie');

    Route::get('/movie/videos/{id}', [MovieController::class, 'showviedoes'])->name('showviedoes');
    Route::post('/movie/videos/{id}', [MovieController::class, 'moviegovideos'])->name('postvideo');
    Route::get('/movie/videos/edit/{id}', [MovieController::class, 'movievideosEdit'])->name('Editmovievidview');
    Route::post('/movie/videos/edit/{id}', [MovieController::class, 'movievideoEdit'])->name('Editmovievid');

    Route::get('/movie/videos/delet/{id}', [MovieController::class, 'deletmovievideo'])->name('Deletmovievid');


    /*---------------------------- الإبلاغات ---------------------------- */


    Route::get('/reportcartoon', [ReportController::class, 'show'])->name('reportcartoon');
    Route::get('/reportcartoon/delet/{id}', [ReportController::class, 'deletreportcartoon'])->name('dlreportcartoon');




    Route::get('/reportcomics', [ReportController::class, 'showcomics'])->name('reportcomics');
    Route::get('/reportmojama', [ReportController::class, 'show'])->name('reportmojama');



    /*---------------------------- الكوميكس ---------------------------- */


    Route::get('/comic', [ComicController::class, 'show'])->name('comic');

    Route::get('/comics/addcomic', [ComicController::class, 'addcomicview'])->name('addcomicview');
    Route::post('/comics/addcomic', [ComicController::class, 'addcomic'])->name('addcomic.post');

    Route::get('/comic/edit/{id}', [ComicController::class, 'editcomicview'])->name('editcomicview');
    Route::post('/comic/edit/{id}', [ComicController::class, 'editcomic'])->name('editcomic');



    Route::get('/comic/chapters/{id}', [ComicController::class, 'showchapters'])->name('showchapters');
    Route::post('/comic/chapters/{id}', [ComicController::class, 'addchapter'])->name('addchapter');
    Route::get('/comic/chapters/edit/{id}', [ComicController::class, 'editchapterview'])->name('editchapterv');
    Route::post('/comic/chapters/edit/{id}', [ComicController::class, 'editchapter'])->name('editchapter');


    Route::get('/comic/chapters/delet/{id}', [ComicController::class, 'deletchapter'])->name('deletchapter');


    Route::get('/comic/delet/{id}', [ComicController::class, 'deletcomic'])->name('deletcomic');


    /*---------------------------- المنشورات ---------------------------- */

    Route::get('/posts', [PostsController::class, 'show'])->name('posts');


    Route::get('/posts/addpost', [PostsController::class, 'addpostview'])->name('addpostview');
    Route::post('/posts/addpost', [PostsController::class, 'addpost'])->name('addpost.post');

    Route::get('/posts/edit/{id}', [PostsController::class, 'editpostview'])->name('editpostview');
    Route::post('/posts/edit/{id}', [PostsController::class, 'editpost'])->name('editpost.post');

    Route::get('/posts/delet/{id}', [PostsController::class, 'deletpost'])->name('deletpost');

    Route::post('/posts/accept/{id}', [PostsController::class, 'acceptpost'])->name('acceptpost');


    Route::get('/posts/comments/{id}', [PostsController::class, 'showcommentsofpost'])->name('showcommentsofpost');
    Route::post('/posts/comments/{id}', [PostsController::class, 'addcommentsofpost'])->name('addcommentsofpost');

    Route::get('/posts/comments/delet/{id}', [PostsController::class, 'deletcommentsofpost'])->name('deletcommentsofpost');

    Route::get('/posts/comments/edit/{id}', [PostsController::class, 'editshowcommentsofpost'])->name('editshowcommentsofpost');
    Route::post('/posts/comments/edit/{id}', [PostsController::class, 'editcommentsofpost'])->name('editcommentsofpost');



    /*---------------------------- الأخبار ---------------------------- */


    Route::get('/news', [NewsController::class, 'show'])->name('news');


    Route::post('/news/addnews', [NewsController::class, 'addnews'])->name('addnewview');
    Route::get('/news/delet/{id}', [NewsController::class, 'deletnews'])->name('deletnews');

    Route::post('/news/edit/{id}', [NewsController::class, 'editnewsview'])->name('editnewsview');
    Route::get('/news/edit/{id}', [NewsController::class, 'editnews'])->name('editnews');

    /*---------------------------- النظريات ---------------------------- */


    Route::get('/nadariat', [NadariatController::class, 'show'])->name('nadariat');
    Route::post('/nadariat/addpost', [NadariatController::class, 'addpost'])->name('addnadariat.post');
    Route::post('/nadariat/accept/{id}', [NadariatController::class, 'acceptnadar'])->name('acceptNadaria');

    Route::get('/nadariat/delet/{id}', [NadariatController::class, 'deletnadaria'])->name('deletnadaria');



    Route::get('/nadariat/edit/{id}', [NadariatController::class, 'editpostview'])->name('editnadariatview');
    Route::post('/nadariat/edit/{id}', [NadariatController::class, 'editpost'])->name('editnadariat.post');



    Route::get('/posts/comments/{id}', [PostsController::class, 'showcommentsofpost'])->name('showcommentsofpost');
    Route::post('/posts/comments/{id}', [PostsController::class, 'addcommentsofpost'])->name('addcommentsofpost');

    Route::get('/posts/comments/delet/{id}', [PostsController::class, 'deletcommentsofpost'])->name('deletcommentsofpost');

    Route::get('/posts/comments/edit/{id}', [PostsController::class, 'editshowcommentsofpost'])->name('editshowcommentsofpost');
    Route::post('/posts/comments/edit/{id}', [PostsController::class, 'editcommentsofpost'])->name('editcommentsofpost');



    /*---------------------------- المراجعات ---------------------------- */


    Route::get('/reviews', [ReviewsController::class, 'show'])->name('reviews');

    Route::post('/reviews/addpost', [ReviewsController::class, 'addpost'])->name('reviews.post');

    Route::get('/reviews/delet/{id}', [ReviewsController::class, 'deletnadaria'])->name('deletreviews');

    /*---------------------------- التعليقات ---------------------------- */


    Route::get('/comments', [CommentsController::class, 'showcommentsofpost'])->name('comments');

    Route::post('/comments/addcoments', [CommentsController::class, 'addcomments'])->name('addcoments');

    Route::get('/comments/delet/{id}', [CommentsController::class, 'deletcomment'])->name('deletcomment');


    /*---------------------------- الردود ---------------------------- */


    Route::get('/replays/{id}', [ReplayController::class, 'showcommentsofpost'])->name('showreplay');

    Route::post('/replays/add/{id}', [ReplayController::class, 'addreplay'])->name('addreplay');

    Route::get('/replays/delet/{id}', [ReplayController::class, 'deletreplay'])->name('deletreplay');


    /*---------------------------- الشخصيات ---------------------------- */


    Route::get('/casts', [CastController::class, 'show'])->name('showcast');
    Route::get('/casts/delet/{id}', [CastController::class, 'deletcasts'])->name('deletcasts');

    Route::post('/casts/addcast', [CastController::class, 'addCast'])->name('addCast');

    Route::get('/casts/edit/{id}', [CastController::class, 'editcastsview'])->name('editcastsview');
    Route::post('/casts/edit/{id}', [CastController::class, 'editcasts'])->name('editcasts');


    /*---------------------------- التوصيات ---------------------------- */

    Route::get('/tawsiat', [PostsController::class, 'showtawsiat'])->name('tawsiat');

    Route::post('/tawsiat/addtawsia', [PostsController::class, 'addtawsiat'])->name('addtawsiat');



    /*---------------------------- التقيمات ---------------------------- */

    Route::get('/rates', [RateController::class, 'show'])->name('rates');
    Route::post('/rates/addtawsia', [RateController::class, 'addrates'])->name('addrates');
    Route::get('/rates/delet/{id}', [RateController::class, 'deletrate'])->name('deletrate');


    /*---------------------------- المواجهات ---------------------------- */

    Route::get('/mowajaha', [mowajahaController::class, 'show'])->name('mowajaha');
    Route::post('/mowajaha/addtawsia', [mowajahaController::class, 'addmowajaha'])->name('addmowajaha');
    Route::get('/mowajaha/delet/{id}', [mowajahaController::class, 'deletmowaajaha'])->name('deletmowaajaha');




    /*---------------------------- الإعلانات ---------------------------- */

    Route::get('/adsshow', [AdsController::class, 'show'])->name('adsview');

    Route::post('/adssave', [AdsController::class, 'saveads'])->name('saveads');

    Route::get('/jcartoonads', [AdsController::class, 'jcartoonads'])->name('jcartoonads');
    Route::post('/saveadsCenter', [AdsController::class, 'saveadsCenter'])->name('saveadsCenter');


    Route::get('/jcartoonadsadvert', [AdsController::class, 'jcartoonadsadvert'])->name('jcartoonadsadvert');


    /*---------------------------- الإشعارات ---------------------------- */

    Route::get('/notification', [notificationController::class, 'show'])->name('notification');
    Route::get('/getnoticartoon/{id}', [notificationController::class, 'getcartoonfronotificatiob'])->name('getcartoonfronotificatiob');




    /*---------------------------- المستخدمين ---------------------------- */

    Route::get('/users', [UsersController::class, 'show'])->name('users');
    Route::get('/users/delete/{id}', [UsersController::class, 'delet_user'])->name('delet_user');

    Route::get('/users/verefed/{id}', [UsersController::class, 'verife'])->name('verife');
    Route::get('/users/banne/{id}', [UsersController::class, 'banne'])->name('banne');

    Route::get('/users/unverife/{id}', [UsersController::class, 'unverife'])->name('unverife');
    Route::get('/users/unbanne/{id}', [UsersController::class, 'unbanne'])->name('unbanne');


    Route::get('/users/noads/{id}', [UsersController::class, 'noads'])->name('noads');
    Route::get('/users/ads/{id}', [UsersController::class, 'ads'])->name('ads');



    /*******************  Skip Google  **********************/

     Route::resource('skipgoogle', skipg::class)->name('index','skipg')->name('store','saveinfo');



     /*---------------------------- الإعدادات ---------------------------- */

     Route::get('/urlandapi', [Appupdatecontroller::class, 'urlandapiShow'])->name('urlandapi');

    Route::get('/appupdate', [Appupdatecontroller::class, 'appupdateShow'])->name('appupdate');
    Route::post('/appupdate/save', [Appupdatecontroller::class, 'saveupdate'])->name('saveupdate');



});







/*---------------------------- Auth ---------------------------- */


Route::controller(AuthController::class)->group(function () {

    Route::get('/login', 'login')->name('login')->middleware('AlreadyLoggedIn');
    Route::post('/login', 'loginPost')->name('login.post');
    Route::get('/logout',  'logout')->name('logout');
});
