@extends('frontend.layout')

@section('title', 'Profil - Dinas Kesehatan')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1>{{ $page->title }}</h1>
            <div class="content mt-4">
                {!! $page->content !!}
            </div>
        </div>
    </div>
</div>
@endsection