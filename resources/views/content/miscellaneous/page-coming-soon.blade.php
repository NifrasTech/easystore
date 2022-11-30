@php
$configData = Helper::applClasses();
@endphp
@extends('layouts/fullLayoutMaster')

@section('title', 'Coming Soon')

@section('page-style')
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-misc.css')) }}">
@endsection

@section('content')
<!-- Coming soon page-->
<div class="misc-wrapper">
  <a class="brand-logo" href="#">
  <!-- <img src="{{asset('images/logo/logo.png')}}" alt=""> -->
    <h2 class="brand-text text-primary ms-1">Easy Store</h2>
  </a>
  <div class="misc-inner p-2 p-sm-3">
    <div class="w-100 text-center">
      <h2 class="mb-1">We are launching soon 🚀</h2>
      @if($configData['theme'] === 'dark')
      <img class="img-fluid" src="{{asset('images/pages/coming-soon-dark.svg')}}" alt="Coming soon page" />
      @else
      <img class="img-fluid" src="{{asset('images/pages/coming-soon.svg')}}" alt="Coming soon page" />
      @endif
    </div>
  </div>
</div>
<!-- / Coming soon page-->
@endsection
