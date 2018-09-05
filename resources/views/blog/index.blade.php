@extends('layouts.page')

@push('body-class', 'blog blog-index')

@section('content')

<div class="full-width">
    @foreach ($posts as $post)
        <div class="card container-small center p-2 my-1">
            <div class="post media">
                <img class="post-thumbnail media-image" src="{{ $post->getFeaturedImage()->getThumbnailUrl() }}">
                <div class="post-excerpt media-content">
                    <h1><a href="{{ $post->getUrl() }}">{{ $post->getTitle() }}<a/></h1>
                    <div>{!! $post->getExcerpt() !!}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
