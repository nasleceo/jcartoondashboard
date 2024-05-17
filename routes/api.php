<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\cartoonController;
use App\Http\Controllers\api\postController;
use App\Http\Controllers\Appupdatecontroller;
use App\Http\Controllers\Roomcontroller;
use App\Http\Controllers\skipg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});





Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::get('me', [AuthController::class, 'me']);
    Route::post('checkusernamejcartoon', [AuthController::class, 'checkusernamejcartoon']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('tasjil', [AuthController::class, 'tasjil']);
    Route::post('checkuseremail', [AuthController::class, 'checkuseremail']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);


});


Route::group([

    'middleware' => 'api',
    'prefix' => 'cartoon'


], function ($router) {

    Route::get('/tvs', [cartoonController::class, 'tvs']);
    Route::get('/tvs/seasons/{id}', [cartoonController::class, 'getSeasonsoftv']);
    Route::get('/tvs/episodes/{id}', [cartoonController::class, 'getEpisodes']);
    Route::get('/tvs/OneEpisode/{id}', [cartoonController::class, 'OneEpisode']);
    Route::get('/tvs/servers/{id}', [cartoonController::class, 'getServers']);
    Route::get('/getLastEpisodes', [cartoonController::class, 'getLastEpisodes']);


    Route::get('/movies', [cartoonController::class, 'movies']);
    Route::get('/movies/getMovieVideos/{id}', [cartoonController::class, 'getMovieVideos']);
    Route::get('/movies/OneVideo/{id}', [cartoonController::class, 'OneVideo']);

    Route::get('comics', [cartoonController::class, 'comics']);
    Route::get('comics/chapters/{id}', [cartoonController::class, 'getChapters']);
    Route::get('comics/chapterspages/{id}', [cartoonController::class, 'getchapterPages']);
    Route::get('comics/getLastChapters', [cartoonController::class, 'getLastChapters']);


    Route::get('searchFilter', [cartoonController::class, 'SearchFilter']);
    Route::get('oneTvorCartoonorComic/{id}', [cartoonController::class, 'oneTvorCartoonorComic']);
    Route::get('addrate', [cartoonController::class, 'addRate']);
    Route::get('addFavorite', [cartoonController::class, 'addFavorite']);
    Route::get('checkFavorite', [cartoonController::class, 'checkFavorite']);
    Route::get('toptvs', [cartoonController::class, 'Toptvs']);
    Route::get('topmovies', [cartoonController::class, 'TopMovies']);
    Route::get('topcomics', [cartoonController::class, 'TopComics']);
    Route::get('mosttvandmovieaddedtofavourit', [cartoonController::class, 'mosttvandmovieaddedtofavourit']);
    Route::get('newrelease', [cartoonController::class, 'newrelease']);
    Route::get('pinedcartoons', [cartoonController::class, 'pinedcartoons']);
    Route::get('slider', [cartoonController::class, 'slider']);


    Route::get('allnews', [cartoonController::class, 'allnews']);



    /*----------------------------  التعليقات و الردود ---------------------------- */


    Route::get('commentsofcartoon/{id}', [cartoonController::class, 'commentsofcartoon']);
    Route::get('addcommentcartoon', [cartoonController::class, 'addCommentCartoon']);


    Route::get('deletcomment/{id}', [cartoonController::class, 'deletcomment']);
    Route::get('editcomment/{id}', [cartoonController::class, 'editcomment']);


    Route::get('commentsofpost/{id}', [cartoonController::class, 'commentsofpost']);
    Route::get('addcommentpost', [cartoonController::class, 'addcommentpost']);


    Route::get('commentsofnews/{id}', [cartoonController::class, 'commentsofnews']);
    Route::get('addcommentnews', [cartoonController::class, 'addcommentnews']);


    Route::get('likeunlikecomment', [cartoonController::class, 'LikeComment']);
    Route::get('CheckLikeComment', [cartoonController::class, 'CheckLikeComment']);

    Route::get('likeunlikepost', [cartoonController::class, 'Likeposts']);
    Route::get('CheckLikeposts', [cartoonController::class, 'CheckLikeposts']);

    Route::get('likeunlikemowajaha', [cartoonController::class, 'Likemowajaha']);
    Route::get('CheckLikemowajaha', [cartoonController::class, 'CheckLikemowajaha']);


    Route::get('replaysofcomments/{id}', [cartoonController::class, 'replaysofcomments']);
    Route::get('addReplay', [cartoonController::class, 'addReplay']);
    Route::get('deletReplay', [cartoonController::class, 'deletReplay']);

    Route::get('likeunlikereplay', [cartoonController::class, 'likeunlikereplay']);
    Route::get('CheckLikereplay', [cartoonController::class, 'CheckLikereplay']);

    /*---------------------------- المنشورات ---------------------------- */


    Route::get('posts', [postController::class, 'posts']);
    Route::get('mostliked', [postController::class, 'mostliked']);
    Route::get('trendpost/{country}', [postController::class, 'trendpost']);
    Route::get('random', [postController::class, 'random']);


    Route::get('visitpost/{id}', [postController::class, 'visitpost']);
    Route::get('addviewtopost/{id}', [postController::class, 'addviewtopost']);
    Route::post('addpost', [postController::class, 'addpost']);

    Route::get('Likeposts', [postController::class, 'Likeposts']);
    Route::get('CheckLikeposts', [postController::class, 'CheckLikeposts']);
    Route::get('savepost', [postController::class, 'Savepost']);

    Route::get('reportpost', [postController::class, 'reportpost']);



     /*---------------------------- نظام المتابعة ---------------------------- */

     Route::get('Followunfollowuser', [postController::class, 'Followunfollowuser']);
     Route::get('CheckFollow', [postController::class, 'CheckFollow']);
     Route::get('getfollowings/{user_id}', [postController::class, 'getfollowings']);
     Route::get('getfollowers/{user_id}', [postController::class, 'getfollowers']);


     /*---------------------------- نظام الإشعارات ---------------------------- */


     Route::get('notifications/{id}', [postController::class, 'notifications']);


     /*---------------------------- الغرف ---------------------------- */


     Route::get('/rooms', [Roomcontroller::class, 'showroomsapi']);
     Route::get('/myrooms/{user_id}', [Roomcontroller::class, 'myroomsapi']);
     Route::get('/deleteroom/{id}', [Roomcontroller::class, 'deleteroomsapi']);
     Route::post('/addnewroom', [Roomcontroller::class, 'AddnewRoomapi']);
     Route::get('/usersinsideRoomApi/{id}', [Roomcontroller::class, 'usersinsideRoomApi']);
     Route::get('/enterRoomapi/{id}', [Roomcontroller::class, 'enterRoomapi']);
     Route::get('/userOutFromRoom/{id}', [Roomcontroller::class, 'userOutFromRoom']);

     Route::get('/allmessagesapi/{id}', [Roomcontroller::class, 'allmessagesapi']);
     Route::get('/addmessagesapi/{id}', [Roomcontroller::class, 'addmessagesapi']);
     Route::get('/deletemessagesapi/{id}', [Roomcontroller::class, 'deletemessagesapi']);

     /*---------------------------- الإعلانات ---------------------------- */

     Route::get('/alladsidandnative', [AdsController::class, 'alladsidandnative']);


     /*---------------------------- الإعدادات ---------------------------- */
     Route::get('/skipapi', [skipg::class, 'skipapi']);

     Route::get('/appupdateShowapi', [Appupdatecontroller::class, 'appupdateShowapi']);


});

