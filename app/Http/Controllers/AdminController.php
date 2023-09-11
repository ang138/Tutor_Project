<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'image_name' => 'required|string|max:255',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create a new Image model instance
        $image             = new Image;
        $image->image_name = $request->input('image_name');

        if ($request->hasFile('image_path'))
        {
            $file      = $request->file('image_path');
            $extension = $file->getClientOriginalExtension();
            $fileName  = time() . '.' . $extension;
            $file->move('assets/images', $fileName);
            $image->image_path = 'assets/images/' . $fileName; // Store the path in the database
        }

        $image->save();

        return redirect('adminHome')->with('success', 'เพิ่มข้อมูลรูปภาพเรียบร้อยแล้ว');
    }

    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'image_name' => 'required|string|max:255',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the image by ID
        $image = Image::find($id);

        if (!$image)
        {
            return redirect('adminHome')->with('error', 'รูปภาพไม่พบ');
        }

        // Update the image name
        $image->image_name = $request->input('image_name');

        // Check if a new image file was uploaded
        if ($request->hasFile('image_path'))
        {
            $file      = $request->file('image_path');
            $extension = $file->getClientOriginalExtension();
            $fileName  = time() . '.' . $extension;
            $file->move('assets/images', $fileName);
            $image->image_path = 'assets/images/' . $fileName; // Update the path in the database
        }

        // Save the updated image data
        $image->save();

        return redirect('adminHome')->with('success', 'อัปเดตข้อมูลรูปภาพเรียบร้อยแล้ว');
    }

    public function deleteImage($id)
    {
        // Find the image by ID
        $image = Image::find($id);

        if (!$image)
        {
            return redirect('adminHome')->with('error', 'รูปภาพไม่พบ');
        }

        // Delete the image from storage (if it exists)
        if (Storage::exists($image->image_path))
        {
            Storage::delete($image->image_path);
        }

        // Delete the image record from the database
        $image->delete();

        return redirect('adminHome')->with('success', 'ลบรูปภาพเรียบร้อยแล้ว');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function adminHome()
    {

        $images = Image::all(); // ดึงข้อมูลรูปภาพทั้งหมด

        return view('adminpages.adminHome', compact('images'));

    }

}
