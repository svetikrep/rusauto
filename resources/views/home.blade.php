@extends('layouts.app')

@section('title', 'RUSAUTO — купите автомобиль своей мечты')

@section('content')
  @include('partials.hero')
  @include('partials.recently-viewed')
  @include('partials.catalog')
  @include('partials.lead-form')
  @include('partials.reviews')
  @include('partials.contacts')
@endsection
