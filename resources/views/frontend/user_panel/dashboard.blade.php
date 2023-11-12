@extends('frontend.pages.user_panel.layout')

@section('title', 'Profile')
@section('user_panel_content')
    <style>
        body {
            margin-top: 20px;
            color: #1a202c;
            text-align: left;
            background-color: #e2e8f0;
        }

        .main-body {
            padding: 15px;
        }

        .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1rem;
        }

        .gutters-sm {
            margin-right: -8px;
            margin-left: -8px;
        }

        .gutters-sm>.col,
        .gutters-sm>[class*=col-] {
            padding-right: 8px;
            padding-left: 8px;
        }

        .mb-3,
        .my-3 {
            margin-bottom: 1rem !important;
        }

        .bg-gray-300 {
            background-color: #e2e8f0;
        }

        .h-100 {
            height: 100% !important;
        }

        .shadow-none {
            box-shadow: none !important;
        }
    </style>
    <div class="container">
        <div class="main-body">
            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ auth('customers')->user()->image ? url('uploads/customers', auth('customers')->user()->image) : 'https://bootdey.com/img/Content/avatar/avatar7.png' }}"
                                    alt="Admin" class="rounded-circle" width="150">
                                <div class="mt-3">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                </div>
                                <div class="col-sm-9 text-secondary name">
                                    {{ auth('customers')->user()->name }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9 text-secondary email">
                                    {{ auth('customers')->user()->email }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Phone</h6>
                                </div>
                                <div class="col-sm-9 text-secondary phone">
                                    {{ auth('customers')->user()->contact }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Address</h6>
                                </div>
                                <div class="col-sm-9 text-secondary address">
                                    {{ auth('customers')->user()->address }}
                                </div>
                            </div>
                            <hr>
                            <div class="row image d-none">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Profile Picture</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="file" name="image" id="">
                                </div>
                            </div>
                            <hr>
                            <div class="row buttons">
                                <div class="col-sm-12">
                                    <a class="btn btn-info edit" href="javascript:void(0)">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $(".edit").click(function() {
                const name = $(".name")
                const email = $(".email")
                const phone = $(".phone")
                const address = $(".address")
                const image = $(".image")

                name.html(
                    `<input type="text" class="form-control" name="name" value="${name.text().trim()}">`
                )
                email.html(
                    `<input type="text" name="email" class="form-control" value="${email.text().trim()}">`
                )
                phone.html(
                    `<input type="text" name="phone" class="form-control" value="${phone.text().trim()}">`
                )
                address.html(
                    `<input type="text" name="address" class="form-control" value="${address.text().trim()}">`
                )
                image.removeClass("d-none")
                $(".buttons").html(
                    `<div class="col-sm-12">
                        <button class="btn btn-success update" onclick="updateProfile()">Update</button>
                        <a class="btn btn-danger cancel" href="javascript:void(0)" onclick="cancelBtn()">Cancel</a>
                    </div>`
                )
            })
        });

        function updateProfile() {
            const name = $("input[name='name']").val()
            const email = $("input[name='email']").val()
            const phone = $("input[name='phone']").val()
            const address = $("input[name='address']").val()
            const imageInput = $("input[name='image']")[0];

            const formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('phone', phone);
            formData.append('address', address);
            formData.append('image', imageInput.files[0]);
            $.ajax({
                enctype: 'multipart/form-data',
                url: "{{ route('user.update.profile') }}",
                type: "POST",
                contentType: false,
                cache: false,
                processData: false,
                data: formData,
                success: function(response) {
                    if (response.status == 'success') {
                        toastr.success(response.message)
                        location.reload()
                    } else {
                        toastr.error(response.message)
                    }
                }
            })
        }

        function cancelBtn() {
            location.reload()

        }
    </script>
@endpush
