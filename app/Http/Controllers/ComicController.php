<?php

namespace App\Http\Controllers;

use App\Models\ChapterImages;
use App\Models\chapters;
use App\Models\ComicModel;
use App\Models\TV;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use ZipArchive;
use RarArchive;

class ComicController extends Controller
{



    public function show()
    {
        $comics = TV::withTotalVisitCount()->with('chapters')->with('rate')->with('tawsiat')->with('comments')->where('place','LIKE', '%' . 'comic' . '%')->get();

        return View('layouts.comics.comics', compact('comics'));
    }

    public function addcomicview(){

        $comics = TV::where('place','LIKE', '%' . 'comic' . '%')->get();

        return View('layouts.comics.addcomic', compact('comics'));

    }


    public function addcomic(Request $request){
        $listofcomics = [];

        $data['title'] = $request->title;
        $data['poster'] = $request->poster;
        $data['cover'] = $request->cover;
        $data['year'] = $request->year;
        $data['place'] = $request->status.','.'comic';
        $data['gener'] = $request->gener;
        $data['whereistartcomics'] =  $request->whereistartcomics;
        if($request->mortabit_id == 1){

           // return Response()->json($request->mortabit);

            foreach($request->mortabit as $key => $value){

                $listofcomics[] .= $request->mortabit[$key];

            }



        }

        $data['mortabit_id'] =  implode(",",$listofcomics);
        $data['age'] = $request->agerate;
        $data['story'] = $request->story;



        $movie = TV::create($data);
        if (!$movie) {
            return 'خطا في إدخال المعلومات';
        }

        return 'تم الأمر بنجاح';


    }

    public function editcomicview($id){

        $comics = TV::find($id);
        $allcomics = TV::where('place','LIKE', '%' . 'comic' . '%')->get();

        return View('layouts.comics.editcomic', compact('comics','allcomics'));


    }

    public function editcomic($id,Request $request){
        $listofcomics = [];

        $movie = TV::find($id);

        $movie['title'] = $request->title;
        $movie['poster'] = $request->poster;
        $movie['cover'] = $request->cover;
        $movie['year'] = $request->year;
        $movie['place'] = $request->status.','.'comic';
        $movie['gener'] = $request->gener;
        $movie['whereistartcomics'] =  $request->whereistartcomics;


        if($request->mortabit_id == 1){

           // return Response()->json($request->mortabit);
           if ($request->mortabit != null) {
            foreach($request->mortabit as $key => $value){

                $listofcomics[] .= $request->mortabit[$key];

            }
           }




        }

        $movie['mortabit_id'] =  implode(",",$listofcomics);
        $movie['age'] = $request->agerate;
        $movie['story'] = $request->story;



        $movie->save();


        if (!$movie) {
            return 'خطا في إدخال المعلومات';
        }

        return 'تم الأمر بنجاح';


    }

    public function deletcomic($id){

        $comics = TV::find($id);
        $chapter = chapters::where('comic_id',$comics->id)->first();
        if($chapter != null){
            $chapter->delete();
            $images = ChapterImages::where('chapter_id',$chapter->id)->get();
            foreach ($images as $img) {
                $img->delete();
            }
        }

        $comics->delete();


    }

    public function deletchapter($id){

        $comics = chapters::findOrFail($id);
        $images = ChapterImages::where('chapter_id',$comics->id)->get();

        foreach ($images as $img) {
            $img->delete();
        }

        $comics->delete();


    }


    public function showchapters($id){

        $chapters = chapters::with('images')->where('comic_id',$id)->get();
        $comic = TV::find($id);


        return View('layouts.comics.chapters', compact('chapters','comic'));


    }

    public function addchapter($id,Request $request){

        $request->validate([
            'chapters_folder_link'=> 'required|mimes:zip,rar,cbr'
        ]);


        $comic = TV::find($id);

        //return Response()->json($zip_file);


        $movie['title'] = $request->title;
        $movie['comic_id'] = $comic->id;
        $movie['direct_link'] = $request->direct_link;

        // store zip images

        $zip_file = $request->file('chapters_folder_link');

        $chaptertitle  = str_replace(array(":"," ","."), '', $comic->title);




        $extractpath = 'chapters/'.$chaptertitle.'/chapter'.$request->title ;
        
        
        if(!Storage::exists($extractpath)){
          Storage::makeDirectory($extractpath);
         }

        $movie['chapters_folder_link'] = 'https://epesodes.hyperwatching.com/storage/'.$extractpath;
        $movie['statu'] = $request->statu;
        $movie['type'] = 'chapter';


        $chapter = chapters::create($movie);

        $zip = new ZipArchive();
        if( $zip->open($zip_file,ZipArchive::CREATE) == true){
            $zip->extractTo(storage_path('app/public/'.$extractpath));
            $zip->close();
        }





        $zipFileName = $zip_file->getClientOriginalName();
        $innerFolderName = pathinfo($zipFileName, PATHINFO_FILENAME);



        $extractFolderPath = storage_path('app/public/'.$extractpath);

        $extractedImagesChapter = File::allFiles($extractFolderPath);

        foreach ($extractedImagesChapter as $file) {

            $images['title'] = $file->getFilename();
            $images['chapter_id'] = $chapter->id;
            $images['comic_id'] = $comic->id;
            $images['direct_link'] = $extractpath.'/'.$file->getFilename();

            ChapterImages::create($images);

        }



        if (!$movie) {
            return 'خطا في إدخال المعلومات';
        }

        return Response()->json('تم الأمر بنجاح');


    }


    public function editchapterview($id){

        $chapters = chapters::find($id);
        $comic = TV::where('id',$chapters->comic_id)->first();


        return View('layouts.comics.editchapters', compact('chapters','comic'));


    }


    public function editchapter($id,Request $request){

        $request->validate([
            'chapters_folder_link'=> 'mimes:zip'
        ]);


        $chapter = chapters::find($id);
        $comic = TV::find($chapter->comic_id);

        //return Response()->json($zip_file);


        $chapter['title'] = $request->title;
        $chapter['comic_id'] = $comic->id;
        $chapter['direct_link'] = $request->direct_link;

        // store zip images

        $zip_file = $request->file('chapters_folder_link');

        $chaptertitle  = str_replace(array(":"," ","."), '', $comic->title);




        $extractpath = 'chapters/'.$chaptertitle.'/chapter'.$request->title ;

        $chapter['chapters_folder_link'] = $extractpath;
        $chapter['statu'] = $request->statu;
        $chapter['type'] = 'chapter';


        $chapter->save();


        if ($zip_file != null) {

            $imagesold = ChapterImages::where('chapter_id',$chapter->id)->get();

            foreach ($imagesold as $img) {
                $img->delete();
            }


            $zip = new ZipArchive();
            if( $zip->open($zip_file,ZipArchive::CREATE) == true){
                $zip->extractTo('storage/'.$extractpath);
                $zip->close();
            }





            $zipFileName = $zip_file->getClientOriginalName();
            $innerFolderName = pathinfo($zipFileName, PATHINFO_FILENAME);



            $extractFolderPath = storage_path('app/public/'.$extractpath);

            $extractedImagesChapter = File::allFiles($extractFolderPath);

            foreach ($extractedImagesChapter as $file) {

                $images['title'] = $file->getFilename();
                $images['chapter_id'] = $chapter->id;
                $images['comic_id'] = $comic->id;
                $images['direct_link'] = $extractpath.'/'.$file->getFilename();

                ChapterImages::create($images);

            }

        }





        if (!$chapter) {
            return 'خطا في إدخال المعلومات';
        }

        return Response()->json('تم الأمر بنجاح');


    }
}
