@extends('layouts.page')

@push('body-class', 'blog post-' . $post->getId())

@section('content')

<div class="full-width">
    <div class="card container-small center p-2 my-1">
        <div class="post">
            <h1>{{ $post->getTitle() }}</h1>
            <div>{!! $post->getContent() !!}</div>
        </div>
    </div>
</div>

@endsection
