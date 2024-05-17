<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{


    public function show()
    {
        $news = News::all();



        return View('layouts.news.news', compact('news'));
    }


    public function addnews(Request $request)
    {
        $data['title'] = $request->title;
        $data['text'] = $request->text;
        $data['image'] = $request->image;
        $data['type'] = 'news';
        $data['news_Time'] = now()->toDateString();
        $data['tv_id'] =  $request->tv_id;
        $data['views'] = 0;
        $data['state'] = $request->status;




        $movie = News::create($data);
        if (!$movie) {
            return 'خطا في إدخال المعلومات';
        }

        return 'تم الأمر بنجاح';
    }


    public function deletnews($id)
    {
        $news = News::find($id);
        $news->delete();
    }

    public function editnewsview($id)
    {
        $news = News::find($id);



        return View('layouts.news.editnews', compact('news'));
    }

    public function editnews($id,Request $request){

        $data = News::find($id);

        $data['title'] = $request->title;
        $data['text'] = $request->text;
        $data['image'] = $request->image;
        $data['news_Time'] = now()->toDateString();
        $data['tv_id'] =  $request->tv_id;
        $data['state'] = $request->status;




        $data->save();


        if (!$data) {
            return 'خطا في إدخال المعلومات';
        }

        return 'تم الأمر بنجاح';
    }

}
