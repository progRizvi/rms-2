@php
    $categories = App\Models\Category::where('status', 'active')
        ->orderBy('name', 'ASC')
        ->get();
@endphp

<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <form action="{{ route('post.search') }}" method="GET">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Type keyword to search..."
                    aria-label="Type keyword to search..." aria-describedby="button-search"
                    style="border-color:#FF2900 !important; box-shadow:none" name="search" required />
                <button class="btn text-white" style="background:#FF2900" id="button-search" type="submit"><i
                        class="fas fa-search"></i></button>
            </div>
        </form>
        <div class="text-center my-5">
            <h1 class="fw-bolder"><a class="nav-link" href="{{ route('home') }}">Welcome to Blog</a></h1>
            <div class="d-md-flex justify-content-md-center align-items-md-center">
                <ul class="navbar-nav mb-lg-0">
                    <li class="nav-item me-2"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                </ul>
                <div class="dropdown">
                    <button class="btn dropdown-toggle outline-none border-none" type="button" id="dropdownMenuButton2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
                        @foreach ($categories as $category)
                            <li><a class="dropdown-item"
                                    href="{{ route('category.details', $category->slug) }}">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
