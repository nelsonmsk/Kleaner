
@extends('layouts.app', ['activePage' => 'serviceTypes', 'titlePage' => __('ServiceTypes')])


@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
	@yield('body')
	</div>
  </div>
</div>
@endsection