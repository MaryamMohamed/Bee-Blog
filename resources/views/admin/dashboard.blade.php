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
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
{!! $dataTable->scripts() !!}

@endsection()