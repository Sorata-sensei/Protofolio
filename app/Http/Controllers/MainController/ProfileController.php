<?php

namespace App\Http\Controllers\MainController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class ProfileController extends Controller
{
   public function index(){
    $user = user::where('id','1')->first();
    $cvPath = asset('storage/' . $user->cv);
        return view('main/profile/index',['url' =>  $cvPath]);
    }
}