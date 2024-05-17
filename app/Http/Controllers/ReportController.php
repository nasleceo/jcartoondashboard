<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\ReportModel;
use App\Models\TV;
use Illuminate\Http\Request;

class ReportController extends Controller
{



    public function show()
    {

        $reports = ReportModel::where('type', 'cartoon')->get();

        $movies = TV::where('place','LIKE', '%' . 'movie' . '%');
        $tvs = TV::where('place','LIKE', '%' . 'tv' . '%');



        return View('layouts.reports.reportcartoon', compact('reports','movies','tvs'));
    }

    public function showcomics()
    {

        $reports = ReportModel::with('comics')->where('type', 'comic')->get();



        return View('layouts.reports.reportcomics', compact('reports'));
    }





    public function deletreportcartoon($id){

        $reports = ReportModel::find($id);
        $reports->delete();

    }
}
