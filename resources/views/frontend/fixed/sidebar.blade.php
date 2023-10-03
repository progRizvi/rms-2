@php
    $categories = App\Models\Category::all();
    $posts = App\Models\Post::latest()
        ->take(5)
        ->get();
@endphp
<div class="col-lg-4">
    <div class="mt-5">
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
    </div>
    <!-- Categories widget-->
    <div class="card mb-4">
        <div class="card-header">Categories</div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <ul class="list-unstyled mb-0">
                        @foreach ($categories as $category)
                            <li><a href="{{ route('category.details', $category->slug) }}" class="text-decoration-none"
                                    style="color:#FF2900">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
