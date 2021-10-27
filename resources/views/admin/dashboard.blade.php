@extends('layouts.adminLayouts.master')

@section('title')
			Admin Dashboard
@endsection()



@section('content')
<div class="container">
  <div class="row">
    {!! $dataTable->table() !!}
  </div>
</div>
@endsection()

@section('scripts')
{!! $dataTable->scripts() !!}

@endsection()