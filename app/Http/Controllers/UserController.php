<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\User;
use App\DataTables\BlogDataTable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:user']);
    }

    public function dashboard()
    {
        # view user dashboard
        return view('user.dashboard');
    }

    public function index()
    {
        
            
            // show my all blogs 
            $blogs = auth()->user()->blogs()->orderBy('created_at', 'desc')->paginate(6);
            return view('user.blogs.index', compact('blogs'));
    }

    public function create()
    {
        //show form to create a blog
        return view('user.blogs.create');
    }

   
    public function store(Request $request)
    {
        //store a new blog
        $this -> validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]
        );

        $blog = new Blog();
        $blog ->title = $request['title'];
        $blog ->description = $request['description'];

        if ($files = $request->file('image')) {
            $destinationPath = 'blogs/'; // upload path
            $blogImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $blogImage);
            $blog ->image = $blogImage;
        }

        if ($request->user()->blogs()->save($blog)){
            
            $message = "Your blog Has Been Sent SUCCESSFULLY";
        }

        return redirect()->route('indexBlog');// view('user.blogs.index')->with('message');
    }

    public function show($id)
    {
        //show a blog
        $blog = Blog::findOrFail($id);
        if(Auth::user() == $blog->user){
            return view('user.blogs.show', compact('blog'));
        }
        return redirect()->route('indexBlog'); 
    }

    
    public function edit($id)
    {
        //show form to edit the blog
        $blog = Blog::findOrFail($id);
        if(Auth::user() == $blog->user){
            return view('user.blogs.edit', compact('blog'));
        }
        return redirect()->route('indexBlog'); 

    }

    
    public function update(Request $request, $id)
    {
        //save the edited blog
        $this -> validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]
        );
        
        $blog = Blog::findOrFail($id);

        $blog->title = $request->title;
        $blog->description = $request->description;

        if ($files = $request->file('image')) {
            $destinationPath = 'blogs/'; // upload path
            $blogImage = date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $blogImage);
            $blog->image = $blogImage;
        }
        if(Auth::user() == $blog->user){
            $blog->save();
            return redirect()->route('indexBlog');
        }
        return redirect()->route('indexBlog');
    }

    
    public function destroy($id)
    {
        //delete a blog
        $blog = Blog::findOrFail($id);
        if(Auth::user() == $blog->user){
            Blog::find($id)->delete();
        }
        return redirect()->route('indexBlog');
    }
}
