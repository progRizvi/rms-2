<div class="container-xxl position-relative p-0">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
        <a href="{{ route('home') }}" class="navbar-brand p-0">
            <h1 class="text-primary m-0"><i class="fa fa-utensils me-3"></i>Restoran</h1>
            <!-- <img src="img/logo.png" alt="Logo"> -->
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="fa fa-bars"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-0 pe-4">
                <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>

                @auth('customers')
                    <a href="{{ route('user.dashboard') }}" class="nav-item nav-link">User Profile</a>
                    <a href="{{ route('user.logout') }}" class="nav-item nav-link">Logout</a>
                @else
                    <a href="javascript:void(0)" class="nav-item nav-link" data-bs-toggle="modal"
                        data-bs-target="#modalLoginForm">Login</a>
                    <a href="javascript:void(0)" class="nav-item nav-link" data-bs-toggle="modal"
                        data-bs-target="#modalRegisterForm">Register</a>
                @endauth
                <a href="{{ route('cart') }}" class="nav-item nav-link">
                    @php
                        $total = 0;
                        if (session('cart')) {
                            $total = count(session('cart'));
                        }
                    @endphp
                    <span class="icon-shopping-bag"></span> <i class="fas fa-cart-plus"></i> {{ $total }}
                </a>
            </div>
        </div>
    </nav>


    <div class="container-xxl py-5 bg-dark hero-header mb-5">
        <div class="container my-5 py-5">
            <div class="row align-items-center g-5">
                @if (request()->routeIs('home'))
                    <div class="col-lg-6 text-center text-lg-start">
                        <h1 class="display-3 text-white animated slideInLeft">Enjoy Our<br>Delicious Meal</h1>
                        <p class="text-white animated slideInLeft mb-4 pb-2">Tempor erat elitr rebum at clita. Diam
                            dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed
                            stet lorem sit clita duo justo magna dolore erat amet</p>

                    </div>
                @endif
                @if (request()->routeIs('frontend.restaurant.details'))
                    <a href="" class="btn btn-primary py-sm-3 px-sm-5 me-3 animated slideInLeft"
                        data-bs-toggle="modal" data-bs-target="#bookingModal">Book A
                        Table</a>
                @endif
                <div class="col-lg-6 text-center text-lg-end overflow-hidden">
                    <img class="img-fluid" src="img/hero.png" alt="">
                </div>
            </div>
        </div>
    </div>

</div>


<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-bs-labelledby="myModalLabel"
    aria-bs-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <span aria-bs-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('userCustomer.login') }}" method="post">
                @csrf
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <i class="fas fa-envelope prefix grey-text"></i>
                        <input type="email" id="defaultForm-email" class="form-control validate" name="email">
                        <label data-bs-error="wrong" data-bs-success="right" for="defaultForm-email">Your
                            email</label>
                    </div>

                    <div class="md-form mb-4">
                        <i class="fas fa-lock prefix grey-text"></i>
                        <input type="password" id="defaultForm-pass" class="form-control validate" name="password">
                        <label data-bs-error="wrong" data-bs-success="right" for="defaultForm-pass">Your
                            password</label>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-default">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-bs-labelledby="myModalLabel"
    aria-bs-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4></h4>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <span aria-bs-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body mx-3">
                <div class="col-12 bg-dark d-flex align-items-center">
                    <div class="p-5">

                        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Reservation</h5>
                        <h1 class="text-white mb-4">Book A Table Online</h1>
                        <form action="{{ route('user.booking') }}" method="post">
                            @csrf
                            <input type="hidden" name="slug" value="{{ request()->slug }}">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name"
                                            placeholder="Your Name" name="name">
                                        <label for="name">Your Name</label>
                                    </div>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="tel" class="form-control" id="phone"
                                            placeholder="Your phone" name="phone">
                                        <label for="phone">Your Phone</label>
                                    </div>
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="datetime" class="form-control datetimepicker-input"
                                            id="datetime" placeholder="Date & Time" data-target="#date3"
                                            data-toggle="datetimepicker" name="date_time" value="{{ now() }}" />
                                        <label for="datetime">Date & Time</label>
                                    </div>
                                    @error('date_time')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="select1"name="persons">
                                            <option value="1">People 1</option>
                                            <option value="2">People 2</option>
                                            <option value="3">People 3</option>
                                            <option value="3">People 4</option>
                                            <option value="3">People 5</option>
                                        </select>
                                        <label for="select1">No Of People</label>
                                    </div>
                                    @error('persons')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Special Request" id="message" style="height: 100px" name="message"></textarea>
                                        <label for="message">Special Request</label>
                                    </div>
                                    @error('message')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3 booking"
                                        @auth('customers')
                                 type="submit" @else  type="button" @endauth>Book
                                        Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-bs-labelledby="myModalLabel"
    aria-bs-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
                <button type="button" class="btn close" data-bs-dismiss="modal" aria-bs-label="Close">
                    <span aria-bs-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('register.store') }}" method="post">
                @csrf
                <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <i class="fas fa-user prefix grey-text"></i>
                        <input type="text" id="orangeForm-name" class="form-control validate" name="name">
                        <label data-error="wrong" data-success="right" for="orangeForm-name">Your
                            name</label>
                    </div>
                    <div class="md-form mb-5">
                        <i class="fas fa-envelope prefix grey-text"></i>
                        <input type="email" id="orangeForm-email" class="form-control validate" name="email">
                        <label data-error="wrong" data-success="right" for="orangeForm-email">Your
                            email</label>
                    </div>

                    <div class="md-form mb-4">
                        <i class="fas fa-lock prefix grey-text"></i>
                        <input type="password" id="orangeForm-pass" class="form-control validate" name="password">
                        <label data-error="wrong" data-success="right" for="orangeForm-pass">Your
                            password</label>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-deep-orange">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    @if (!Auth::guard('customers')->check())
        <script>
            $(document).ready(function() {
                $(".booking").click(function() {
                    toastr.error("Please login first")
                })
            });
        </script>
    @endif
@endpush
