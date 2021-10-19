@extends('layouts.layouts.master')

@section('title')
			Welcome to Digital CRM!
@endsection()



@section('content')

<div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> All Blogs</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>#</th>
                      <th>title</th>
                      <th>description</th>
                      <th>image</th>
                      <th>status</th>
                      <th>Actions</th>
                    </thead>
                    <tbody>
                      <!--fetch table data -->
                      @foreach($blogs as $blog)
                      <tr>
                        <td>{{$loop->index + 1}}</td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->description }}</td>
                        <td><img src="{{url('blogs/'. $blog->image)  }}" width="100" height="100" class="" alt=""></td>
                        <td>{{ $blog->status }}</td>
                        <td>
                          <form action="{{route('approveBlog', $blog->id)}}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-success">Approve</button> 
                          </form>
                        </td>
                        <td>
                          <form action="{{route('pendBlog', $blog->id)}}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-primary">Pend</button> 
                          </form>
                        </td>
                        <td>
                          <form action="{{route('declineBlog', $blog->id)}}" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger">Decline</button> 
                          </form>
                        </td>
                       </tr>
                       @endforeach()
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection()

@section('scripts')


@endsection()