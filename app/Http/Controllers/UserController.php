<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\User;

use Illuminate\Http\Request;

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
        ]
        );

        $blog = new Blog();
        $blog ->title = $request['title'];
        $blog ->description = $request['description'];
        $blog ->image = $request['image'];

        if ($request->user()->blogs()->save($blog)){
            
            $message = "Your blog Has Been Sent SUCCESSFULLY";
        }

        return view('user.blogs.create', compact('message'));
    }

    public function show($id)
    {
        //show a blog
        $blog = Blog::where('id',$id)->first();
        return view('user.blogs.show', compact('blog'));
    }

    
    public function edit($id)
    {
        //show form to edit the blog
        $blog = Blog::find($id);
        return view('user.blogs.edit', compact('blog'));

    }

    
    public function update(Request $request, $id)
    {
        //save the edited blog
        $this -> validate($request, [
            'title' => 'required',
            'description' => 'required',
        ]
        );
        
        $blog = Blog::find($id);

        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->image = $request->image;

        $blog->save();

        return redirect()->route('indexBlog');
    }

    
    public function destroy($id)
    {
        //delete a blog
        Blog::find($id)->delete();
        return redirect()->route('indexBlog');
    }
}
