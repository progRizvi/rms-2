@extends('frontend.layout')
@section('title', $post->title)
@section('meta_keywords', $post->meta_keywords)
@section('meta_description', $post->meta_description)
@section('main')
    <div class="col-lg-8">
        <!-- Featured blog post-->
        <div class="card mb-4">
            <img class="card-img-top" src="{{ url('/uploads/thumbnail', $post->thumbnail) }}" alt="{{ $post->title }}" />
            <div class="card-body">
                <div class="small text-muted my-3"><a href="{{ route('category.details', $post->category->slug) }}"
                        class="text-decoration-none text-white rounded me-1"
                        style="display:inline-block; background:#FF2900; padding: 2px 8px; ">{{ $post->category->name }}</a>
                    {{ now()->parse($post->posted_at)->format('d F Y') }}</div>
                <h2 class="card-title">{{ $post->title }}</h2>
                <p class="card-text">
                    {!! $post->content !!}
                </p>
            </div>
        </div>
        @push('relatedPost')
            <div class="row mb-5">
                @if ($relatedPost->count() > 0)
                    <p class="display-4">Related Post</p>
                @endif
                @foreach ($relatedPost as $post)
                    <div class="col-md-4 ">
                        <div class="card text-bg-secondary">
                            <a href="{{ route('post.details', $post->slug) }}">
                                <img src="{{ url('/uploads/thumbnail', $post->thumbnail) }}" class="card-img"
                                    alt="{{ $post->title }}">
                                <div class="card-img-overlay">
                                    <div class="d-flex flex-row justify-content-center align-items-center">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <p class="card-text">
                                            <small>{{ now()->parse($post->posted_at)->format('d F Y') }}</small>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endpush
    </div>
@endsection
