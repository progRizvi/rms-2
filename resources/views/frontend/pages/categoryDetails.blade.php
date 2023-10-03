@extends('frontend.layout')

@section('title', isset($category) ? $category->name : 'search for ' . request()->search)

@section('main')

    @if (isset($category))
        <div class="col-md-12">
            <div class="p-3 mb-2 bg-secondary text-white">
                <h2 class="text-center" style="padding:50px 60px; font-weight:400">Category : {{ $category->name }}</h2>
            </div>

        </div>
    @endif
    <div class="col-lg-8 mt-5">
        @if (count($posts) > 0)
            @foreach ($posts as $post)
                <div class="card mb-5">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ url('/uploads/thumbnail', $post->thumbnail) }}" class="img-fluid rounded-start"
                                alt="{{ $post->title }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><a class="text-decoration-none text-dark fw-normal"
                                        href="{{ route('post.details', $post->slug) }}">{{ $post->title }}</a></h5>
                                <p class="card-text">
                                    @php
                                        $date = Carbon\Carbon::parse($post->posted_at);
                                    @endphp
                                    <small class="text-muted">{{ $date->format('d F Y') }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            {{-- No Post Found --}}
            <p class="fw-bold text-center">No post found</p>
        @endif
        <!-- Pagination-->
        <nav aria-label="Pagination">
            <hr class="my-0" />
            {{ $posts->links('pagination::bootstrap-5') }}
        </nav>
    </div>


@endsection
