@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    {{ __('You are logged in as user!') }}
                </div>
                <a href="{{ route('indexBlog') }}" style="margin-top: 20px;" class="btn btn-lg btn-success btn-block">
                    <strong>View My Blogs</strong>
                </a> 
                <a href="{{ route('createBlog') }}" style="margin-top: 20px;" class="btn btn-lg btn-success btn-block">
                    <strong>Create New Blog</strong>
                </a> 
            </div>
        </div>
    </div>
</div>
@endsection
