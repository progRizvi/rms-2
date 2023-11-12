@extends('frontend.layout')
@section('title', 'cart')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/cart.css') }}">
@endpush
@section('content')

    <div class="cart-section mt-150 mb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="cart-table-wrap">
                        <table class="cart-table">
                            <thead class="cart-table-head">
                                <tr class="table-head-row">
                                    <th class="product-remove"></th>
                                    <th class="product-image">Product Image</th>
                                    <th class="product-name">Name</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-total">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (session('cart'))
                                    {{-- @dd(session('cart')) --}}
                                    @foreach (session('cart') as $id => $details)
                                        <tr class="table-body-row">
                                            <td class="product-remove" data-id="{{ $id }}"><a href="#"><i
                                                        class="far fa-window-close"></i></a>
                                            </td>
                                            <td class="product-image"><img
                                                    src='{{ asset('uploads/food/' . $details['image']) }}' alt="">
                                            </td>
                                            <td class="product-name">{{ $details['name'] }}</td>
                                            <td class="product-price">{{ $details['price'] }}</td>
                                            <td class="product-quantity">
                                                {{-- <input type="number" placeholder="0"
                                                    class="update-cart" value="{{ $details['quantity'] }}"> --}}
                                                <div class="input-group w-auto justify-content-end align-items-center">
                                                    <input type="button" value="-"
                                                        class="button-minus border rounded-circle  icon-shape icon-sm mx-1 "
                                                        data-field="quantity">
                                                    <input type="number" step="1" max="10"
                                                        value="{{ $details['quantity'] }}" name="quantity"
                                                        class="quantity-field border-0 text-center w-25"
                                                        data-food-id="{{ $id }}">
                                                    <input type="button" value="+"
                                                        class="button-plus border rounded-circle icon-shape icon-sm "
                                                        data-field="quantity">
                                                </div>
                                            </td>
                                            <td class="product-total">৳{{ $details['price'] * $details['quantity'] }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">No items in cart</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-4">
                    @if (session('cart'))
                        <div class="total-section">
                            <table class="total-table">
                                @php
                                    $total = 0;
                                    foreach (session('cart') as $id => $details) {
                                        $total += $details['price'] * $details['quantity'];
                                    }
                                @endphp
                                <thead class="total-table-head">
                                    <tr class="table-total-row">
                                        <th>Total</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="total-data">
                                        <td><strong>Subtotal: </strong></td>
                                        <td>৳{{ $total }}</td>
                                    </tr>
                                    <tr class="total-data">
                                        <td><strong>Shipping: </strong></td>
                                        <td>৳30</td>
                                    </tr>
                                    <tr class="total-data">
                                        <td><strong>Total: </strong></td>
                                        <td>৳{{ $total + 30 }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="cart-buttons">
                                <a @auth('customers')
                                 href="{{ route('checkout') }} @endauth"
                                    class="boxed-btn black">Check Out</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    @if (!Auth::guard('customers')->check())
        <script>
            $(document).ready(function() {
                $(".boxed-btn").click(function() {
                    setTimeout(() => {
                        window.location.href = "{{ route('home') }}";
                    }, 1000);

                    toastr.error("Please login first")
                })
            });
        </script>
    @endif
    <script>
        function incrementValue(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

            if (!isNaN(currentVal)) {
                parent.find('input[name=' + fieldName + ']').val(currentVal + 1);
            } else {
                parent.find('input[name=' + fieldName + ']').val(0);
            }
        }

        function decrementValue(e) {
            e.preventDefault();
            var fieldName = $(e.target).data('field');
            var parent = $(e.target).closest('div');
            var currentVal = parseInt(parent.find('input[name=' + fieldName + ']').val(), 10);

            if (!isNaN(currentVal) && currentVal > 0) {
                parent.find('input[name=' + fieldName + ']').val(currentVal - 1);
            } else {
                parent.find('input[name=' + fieldName + ']').val(0);
            }

        }

        function updateCart() {
            let quantity = $('.quantity-field').val();
            let foodId = $('.quantity-field').data('food-id');
            $.ajax({
                url: "{{ route('update.cart') }}",
                method: "POST",
                data: {
                    id: foodId,
                    quantity: quantity
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                        window.location.reload();
                    }
                }
            });
        }

        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            $('.input-group').on('click', '.button-plus', function(e) {
                incrementValue(e);
                updateCart();
            });

            $('.input-group').on('click', '.button-minus', function(e) {
                decrementValue(e);
                updateCart();
            });
        })
    </script>
    <script type="text/javascript">
        $(".quantity-field").change(function(e) {
            e.preventDefault();
            updateCart();
        });
        $(".product-remove").click(function(e) {
            e.preventDefault();

            var ele = $(this);

            if (confirm("Are you sure want to remove?")) {
                $.ajax({
                    url: '{{ route('remove.from.cart') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.attr("data-id")
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
@endpush
