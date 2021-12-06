<?php


namespace Task\CollectionParser\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ParserController extends Controller
{


    public function index()
    {
        $view = 'task-parser::parse';
        return view($view);
    }

    public function parse(Request $request)
    {
        $fileName = 'dataCollection.'.$request->csv_file->getClientOriginalExtension();
        $request->csv_file->move(public_path('/uploads'), $fileName);
        \Artisan::call(' model:publish');
        echo 'Successful';
    }

}