<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
class UserManageController extends Controller
{
     public function index(){
      $menu = 'User';
    $user = User::where('name', Auth::user()->name)->first();
    $cvPath = asset('storage/' . $user->cv);
    $encryptedUrl = Crypt::encrypt($cvPath);
     return view('admin.user.index', compact('user', 'encryptedUrl','menu'));

    
   }
   public function store(Request $request){
     // return $request->all();
     $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'cv' => 'nullable|file|mimes:pdf|max:2048', // Jika CV adalah file, Anda bisa menggunakan 'file' atau 'mimes:pdf,doc,docx'
      ]);

         \DB::beginTransaction();
         $user =  User::find(Auth::user()->id);
         $user->name = $request->nama;
         $user->email = $request->email;
         // Ambil file CV
         $file = $request->file('cv');
         // Buat nama file kustom
         $customFileName = 'cv_' . strtolower(str_replace(' ', '_', $request->nama)) . '_' . time() . '.' . $file->getClientOriginalExtension();
         // Simpan file ke storage
         $filePath = $file->storeAs('cv', $customFileName, 'public'); // Simpan di folder 'cvs' dalam storage
         // Simpan path file ke database jika diperlukan
         $user->cv = $filePath; // Pastikan ada kolom 'cv_path' di tabel users
          // Simpan pengguna ke database
         $user->save();
         \DB::commit();
         if ($user) {
            return redirect()->back()->with('success', 'Data update successfully');
        } else {
            return redirect()->back()->with("error", "Maaf Anda gagal Menyimpan, Ulangi kembali atau cek koneksi anda.");
        }
   }
}