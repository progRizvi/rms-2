@extends('frontend.layout')
@section('title', 'Checkout')
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/css/cart.css') }}">
@endpush
@section('content')

    <form action="{{ route('pay.now') }}" method="post">
        @csrf
        <div class="checkout-section mt-150 mb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="checkout-accordion-wrap">
                            <div class="accordion" id="accordionExample">
                                <div class="card single-accordion">
                                    <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link" type="button" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Shipping Address
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="billing-address-form">

                                                <p>
                                                    <input type="text" placeholder="Name" name="name">
                                                    @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </p>
                                                <p>
                                                    <input type="text" placeholder="Address" name="address">
                                                    @error('address')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </p>
                                                <p>

                                                    <input type="tel" placeholder="Phone" name="phone">
                                                    @error('phone')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </p>
                                                <p>
                                                    <textarea name="bill" id="bill" cols="30" rows="10" placeholder="Say Something"></textarea>
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $carts = session()->get('cart');
                        $total = 0;
                        foreach ($carts as $cart) {
                            $total += $cart['price'] * $cart['quantity'];
                        }
                    @endphp
                    <div class="col-lg-4">
                        <div class="order-details-wrap">
                            <table class="order-details">
                                <thead>
                                    <tr>
                                        <th>Your order Details</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody class="order-details-body">
                                    <tr>
                                        <td>Product</td>
                                        <td>Total</td>
                                    </tr>
                                    @foreach ($carts as $cart)
                                        <tr>
                                            <td>{{ $cart['name'] }}</td>
                                            <td>৳{{ $cart['price'] * $cart['quantity'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tbody class="checkout-details">
                                    <tr>
                                        <td>Subtotal</td>
                                        <td>৳{{ $total }}</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td>৳30</td>
                                    </tr>
                                    <tr>
                                        <td>Total</td>
                                        <td>৳{{ $total + 30 }}</td>
                                        <input type="hidden" name="total" value="{{ $total + 30 }}">
                                    </tr>
                                </tbody>
                            </table>
                            <button class=" mt-2 btn boxed-btn">Place Order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
