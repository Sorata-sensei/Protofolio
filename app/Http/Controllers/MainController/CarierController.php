<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carier;
class CarierController extends Controller
{
     public function index(){
         $cariers = Carier::orderBy('created_at', 'desc')->get();
            foreach ($cariers as $carier) {
                $carier->skills = json_decode($carier->skills, true);
            }
        return view('main/carier/index', compact('cariers'));
    }
}