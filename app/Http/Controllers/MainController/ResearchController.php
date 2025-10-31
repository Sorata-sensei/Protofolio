<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Research;

class ResearchController extends Controller
{
    public function index()
    {
         $researches = Research::orderBy('year', 'desc')->get();
        return view('main/research/index', ['researches' => $researches]);
    }

}