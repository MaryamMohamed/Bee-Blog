@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $blog->title }}</div>

                <div class="card-body">
                    

                    <h2>Status:</h2>
                    <p> {{ $blog->status }}</p>

                    <h2>Description</h2>
                    <p>{{ $blog->description }}</p>

                    <h2>Image</h2>
                    <img src="{{url('blogs/'. $blog->image)  }}" width="85%" alt="">
                    
                    <p>Author: {{ $blog->user->name }}</p>
                    <p>Created At: {{ $blog->created_at }}</p>
                </div>
                <div class="col-md-6 offset-md-4">
                    <a href="{{ route('adminDashboard') }}" class="btn btn-danger btn-sm"><i class="">Back</i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
