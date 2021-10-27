<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

//use Datatables;
use Yajra\Datatables\Datatables;


class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:administrator']);
    }

    public function index(Request $request)
    {
        # code...
        if ($request->ajax()) {
            # code...
            $data = Blog::latest()->get();
            return DataTables::of($data)
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="approve" id="'.$data->id.'" class="approve btn btn-primary btn-sm">Edit</button>';
                        $button .= '&nbsp;&nbsp;&nbsp;<button type="button" name="decline" id="'.$data->id.'" class="decline btn btn-danger btn-sm">Delete</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    return view('admin.dashboard');
    }
    public function dashboard()
    {
        # view user dashboard
        //$blogs = Blog::all();
    return view('admin.dashboard'/*, compact('blogs')*/);
    }

    public function getBlogs()
    {
        # code...
        return Datatables::of(Blog::query())->make(true);
    }
    public function show($id)
    {
        # code...
        $blog = Blog::findOrFail($id);
        return view('admin.blogs', compact('blog'));
        
    }

    public function approveBlog($id)
    {
        $blog = Blog::findOrFail($id);

        $blog->status = 'approved';
        $blog->save();
        return redirect()->route('adminDashboard');
    }

    public function pendBlog($id)
    {
        $blog = Blog::findOrFail($id);

        $blog->status = 'pended';
        $blog->save();
        return redirect()->route('adminDashboard');
    }

    public function declineBlog($id)
    {
        $blog = Blog::findOrFail($id);

        $blog->status = 'declined';
        $blog->save();
        return redirect()->route('adminDashboard');
    }
}
