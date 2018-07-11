@extends('layouts.page')

@push('body-class', 'blog post-' . $post->getId())

@section('content')
  <h1>{{ $post->getTitle() }}</h1>
  <div>{{ $post->getContent() }}</div>
@endsection
