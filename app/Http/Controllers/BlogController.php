<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;

class BlogController extends Controller
{
    public function index()
    {
        // show all approved blog posts
        $blogs = Blog::where('status', 'approved')->orderBy('created_at','desc')->paginate(5);
        return view('welcome', compact('blogs'));
        //return $dataTable->render('user.blogs.index', compact('blogs')); used to return all blogs
    }

    public function create()
    {
        //show form to create a blog post
    }

   
    public function store(Request $request)
    {
        //store a new post
    }

    public function show($id)
    {
        //show a blog post
        $blog = Blog::where('id',$id)->first();
        if($blog->status=='approved'){
            return view('show', compact('blog'));
        }
        return redirect()->route('welcome');
    }

    
    public function edit($id)
    {
        //show form to edit the post
    }

    
    public function update(Request $request, $id)
    {
        //save the edited post
    }

    
    public function destroy($id)
    {
        //delete a post
    }
}
