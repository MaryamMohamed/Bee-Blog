@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Blogs') }}</div>

                <div class="card-body">
                    {{ __('Here you will found latest blogs') }}

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>title</th>
                                <th>description</th>
                                <th>image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $blog)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$blog->title}}</td>
                                <td>{{$blog->description}}</td>
                                <td><img src="{{url('blogs/'. $blog->image)  }}" width="100" height="100" class="" alt=""></td>                                
                                <td>
                                    <a href="{{route('viewBlog', $blog->id)}}" class="btn btn-sm btn-success"><i class="fa fa-edit">Show</i></a>
                                </td>
                            </tr>
                            @endforeach
                            {{ $blogs->links() }}
                            
                        </tbody>
                        
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
