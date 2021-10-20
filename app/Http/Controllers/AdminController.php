<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:administrator']);
    }

    public function dashboard()
    {
        # view user dashboard
        $blogs = Blog::orderBy('id', 'desc')->paginate(10);;
        return view('admin.dashboard', compact('blogs'));
    }

    public function show($id)
    {
        # code...
        $blog = Blog::where('id',$id)->first();
        return view('admin.blogs', compact('blog'));
        
    }

    public function approveBlog($id)
    {
        $blog = Blog::find($id);

        $blog->status = 'approved';
        $blog->save();
        return redirect()->route('adminDashboard');
    }

    public function pendBlog($id)
    {
        $blog = Blog::find($id);

        $blog->status = 'pended';
        $blog->save();
        return redirect()->route('adminDashboard');
    }

    public function declineBlog($id)
    {
        $blog = Blog::find($id);

        $blog->status = 'declined';
        $blog->save();
        return redirect()->route('adminDashboard');
    }
}
