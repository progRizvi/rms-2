@extends('frontend.layout')
@section('title', 'Restaurant Details')

@section('content')
    {{-- @dd($foods) --}}
    <div class="row">
        <div class="col-lg-8 col-sm-10 mx-sm-auto mx-lg-2">
            <div class="row">
                @foreach($foods as $food)
                <div class="col-sm-6">
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $food->title }}</h5>
                                    <p class="card-text">
                                        {{ Str::limit($food->description, 100) }}
                                    </p>
                                    <p class="card-text"><small class="text-body-secondary">TK. {{ $food->price }}</small>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <img src="..." class="img-fluid rounded-start" alt="...">

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
