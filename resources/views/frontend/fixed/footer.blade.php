<!-- Footer -->
<footer class="text-center text-lg-start  text-muted" style='background:#F7F8FC'>
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <div class="row mt-3" style="padding-top:30px">
                <div class="col-md-12 col-lg-4 col-xl-3 mx-auto mb-4">
                    <img src="https://www.chinabazarb2b.com/img/frontend/brand/logo.svg" alt="" class="img-fluid"
                        style="width: 190px; height: 64px; display: block;">
                    <ul>
                        <li class="mt-4 d-flex  align-items-center" style="list-style:none;margin-bottom:15px">
                            <p>
                                <i class="fas fa-map-marker-alt"></i>
                            </p>
                            <p class="ms-4">
                                <b>Madina (7th floor)</b>
                                <br>
                                <span>Plot no:02. Mirpur-1, dhaka 1216</span>
                            </p>
                        </li>
                        <li class=" d-flex  align-items-center" style="list-style:none;margin-bottom:15px">
                            <p>
                                <i class="fas fa-envelope"></i>
                            </p>
                            <p class="ms-4">
                                <a class="text-decoration-none text-reset"
                                    href="mailto:support@chinabazarb2b.com">support@chinabazarb2b.com</a>
                            </p>
                        </li>
                        <li class="d-flex  align-items-center" style="list-style:none;margin-bottom:15px">
                            <p>
                                <i class="fas fa-phone-alt"></i>
                            </p>
                            <p class="ms-4">
                                <a class="text-decoration-none text-reset" href="tel:01760843004">01760843004</a>
                            </p>
                        </li>
                        <li class="list-unstyled">
                            <a href="" class="text-decoration-none me-4 text-reset">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="" class="text-decoration-none me-4 text-reset">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="" class="text-decoration-none me-4 text-reset">
                                <i class="fab fa-youtube"></i>
                            </a>

                        </li>
                    </ul>
                </div>

                @php
                    $whoWe = [
                        ['name' => 'About Us', 'link' => 'about-us'],
                        ['name' => 'Contact Us', 'link' => 'contact-us'],
                        [
                            'name' => "Privacy
                    Policy",
                            'link' => 'privacy-policy',
                        ],
                        ['name' => 'Terms & Conditions', 'link' => 'terms-conditions'],
                        [
                            'name' => "Return and Refund
                    Policy",
                            'link' => 'return-and-refund-policy',
                        ],
                        ['name' => 'Secured Payment', 'link' => 'secured-payment'],
                        ['name' => 'Transparency', 'link' => 'transparency'],
                    ];
                @endphp
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        Who We Are
                    </h6>

                    @foreach ($whoWe as $menu)
                        <p>
                            <a href="https://www.chinabazarb2b.com/{{ $menu['link'] }}"
                                class="text-reset text-decoration-none">{{ $menu['name'] }}</a>
                        </p>
                    @endforeach
                </div>
                @php
                    
                    $usefulLinks = [
                        [
                            'name' => 'How To Buy',
                            'link' => 'how-to-buy',
                        ],
                        [
                            'name' => 'Shipping & Delivery',
                            'link' => 'shipping-and-delivery',
                        ],
                        [
                            'name' => 'Shipping Charge List',
                            'link' => 'shipping-charge-list',
                        ],
                        [
                            'name' => 'Custom & Shipping Charge',
                            'link' => 'custom-and-shipping-charge',
                        ],
                        [
                            'name' => 'Delivery Charges',
                            'link' => 'delivery-charges',
                        ],
                        [
                            'name' => 'Minimum Order Quantity',
                            'link' => 'minimum-order-quantity',
                        ],
                        [
                            'name' => 'Prohibited Items',
                            'link' => 'prohibited-items',
                        ],
                    ];
                @endphp
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        Useful Links
                    </h6>
                    @foreach ($usefulLinks as $menu)
                        <p>
                            <a href="https://www.chinabazarb2b.com/{{ $menu['link'] }}"
                                class="text-reset text-decoration-none">{{ $menu['name'] }}</a>
                        </p>
                    @endforeach
                </div>
                @php
                    
                    $customer = [
                        [
                            'name' => 'Account',
                            'link' => 'account',
                        ],
                        [
                            'name' => 'Special Offer',
                            'link' => 'special-offer',
                        ],
                        [
                            'name' => 'Wish List',
                            'link' => 'wishlist',
                        ],
                        [
                            'name' => 'Cart',
                            'link' => 'shopping-cart',
                        ],
                        [
                            'name' => 'FAQ',
                            'link' => 'fags',
                        ],
                    ];
                @endphp
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <h6 class="text-uppercase fw-bold mb-4">
                        Customer
                    </h6>
                    @foreach ($customer as $menu)
                        <p>
                            <a href="https://www.chinabazarb2b.com/{{ $menu['link'] }}"
                                class="text-reset text-decoration-none">{{ $menu['name'] }}</a>
                        </p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <div class="text-center p-4" style="background-color: #F7F8FB;">
        © 2020 - 2023 Copyright:
        <a class="text-reset fw-bold text-decoration-none" href="https://www.chinabazarb2b.com/">ChinaBazarB2B</a>
    </div>
</footer>
