
@extends('layouts.app', ['activePage' => 'serviceCategories', 'titlePage' => __('ServiceCategories')])


@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
	@yield('body')
	</div>
  </div>
</div>
@endsection