@extends('layouts.page')

@push('body-class', 'blog blog-index')

@section('content')

<div class="full-width">
    @foreach ($posts as $post)
        <div class="card container-small center p-2 my-1">
            <div class="post">
                <h1>{{ $post->getTitle() }}</h1>
                <div>{!! $post->getExcerpt() !!}</div>
            </div>
        </div>
    @endforeach
</div>

@endsection
