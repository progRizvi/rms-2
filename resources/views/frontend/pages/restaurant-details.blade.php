@extends('frontend.layout')
@section('title', 'Restaurant Details')

@section('content')
    <div class="row">
        @if (isset($foods))
            <div class="col-lg-8 col-sm-10 mx-sm-auto mx-lg-2">
                <div class="row">
                    @foreach ($foods as $food)
                        <div class="col-sm-6">
                            <div class="card mb-3" style="max-width: 540px;">
                                <a class="food-modal-btn" style="cursor:pointer" data-bs-toggle="modal"
                                    data-bs-target="#foodModal" data-food-id="{{ $food->id }}">
                                    <div class="row g-0">
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $food->title }}</h5>
                                                <p class="card-text">
                                                    {{ Str::limit($food->description, 100) }}
                                                </p>
                                                <p class="card-text"><small class="text-body-secondary">TK.
                                                        {{ $food->price }}</small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img src="{{ asset('uploads/food/' . $food->image) }}"
                                                class="img-fluid rounded-start" alt="...">

                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="alert alert-danger col-sm-10 mx-auto">No Food Available</div>
        @endif
    </div>
    <div class="modal fade" id="foodModal" tabindex="-1" aria-labelledby="foodModalLabel" aria-hidden="true">
        <div class="modal-dialog">

        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $(".food-modal-btn").click(function() {
                let foodId = $(this).data("food-id");
                $.ajax({
                    url: "{{ route('frontend.food.details') }}",
                    type: "get",
                    data: {
                        food_id: foodId
                    },
                    success: function(response) {
                        $("#foodModal").html(response);
                    }
                });
            });

        });
    </script>
@endpush
