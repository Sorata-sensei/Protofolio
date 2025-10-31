<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use Illuminate\Support\Facades\Storage;

class DailyManageController extends Controller
{
    public function index(){
            $activities = Activity::orderBy('date', 'desc')->paginate(5);
            $menu = 'Activities';
            foreach ($activities as $activity) {
                if ($activity->image) {
                    $imagePath = public_path('storage/images/' . $activity->image);

                    // Pastikan file ada sebelum mendapatkan detailnya
                    if (file_exists($imagePath)) {
                        $dimensions = getimagesize($imagePath);
                        $activity->width = $dimensions[0] ?? 0; // Lebar
                        $activity->height = $dimensions[1] ?? 0; // Tinggi
                        $activity->size = round(filesize($imagePath) / 1024, 2); // Ukuran dalam KB
                    } else {
                        $activity->width = null;
                        $activity->height = null;
                        $activity->size = null;
                    }
                }
            }

            return view('admin.daily.index', compact('activities','menu'));
        }


    public function create()
    {
        $menu = 'Create Activities';
        return view('admin.daily.create',compact('menu'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'image' => 'image|nullable',
        ]);
        $request->all();
        

        $activity = new Activity();
        $activity->title = $request->title;
        $activity->description = $request->description; // Gunakan deskripsi yang sudah dibersihkan
        $activity->date = $request->date;
        $activity->tag =$request->tag;
        $activity->type =$request->type;
        $activity->link =$request->link;
        if ($request->hasFile('image')) {
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            $activity->image = $fileNameToStore;
        }

        $activity->save();
        return redirect()->route('admin.activities.index')->with('success', 'Activity created successfully.');
    }

    public function edit($id)
    {
    	
        $activity = Activity::findOrFail($id);
        $menu = 'Edit Activities '.$activity->title;
        return view('admin.daily.edit', compact('activity','menu'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'date' => 'required|date',
            'image' => 'image|nullable',
        ]);

        // Konfigurasi HTML Purifier
       

        $activity = Activity::findOrFail($id);
        $activity->title = $request->title;
        $activity->description = $request->description; // Gunakan deskripsi yang sudah dibersihkan
        $activity->date = $request->date;
        $activity->tag =$request->tag;
        $activity->type =$request->type;
        $activity->link =$request->link;
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($activity->image) {
                Storage::delete('public/images/' . $activity->image);
            }

            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            $activity->image = $fileNameToStore;
        }

        $activity->save();
        return redirect()->route('admin.activities.index')->with('success', 'Activity updated successfully.');
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        if ($activity->image) {
            Storage::delete('public/images/' . $activity->image);
        }
        $activity->delete();
        return redirect()->route('admin.activities.index')->with('success', 'Activity deleted successfully.');
    }
}