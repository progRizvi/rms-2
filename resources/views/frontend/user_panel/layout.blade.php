<!DOCTYPE html>
<html lang="zxx">

<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="{{ url('frontend/userPanel/css/bootstrap1.min.css') }}" />


    <link rel="stylesheet" href="{{ url('frontend/userPanel/css/themify-icons.css') }}" />

    <link rel="stylesheet" href="{{ url('frontend/userPanel/css/nice-select.css') }}" />

    <link rel="stylesheet" href="{{ url('frontend/userPanel/css/owl.carousel.css') }}" />

    <link rel="stylesheet" href="{{ url('frontend/userPanel/css/gijgo.min.css') }}" />

    <link rel="stylesheet" href="{{ url('frontend/userPanel/css/font_awesome/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ url('frontend/userPanel/css/tagsinput.css') }}" />

    <link rel="stylesheet" href="vendors/datepicker/date-picker.css" />
    <link rel="stylesheet" href="vendors/vectormap-home/vectormap-2.0.2.css" />

    <link rel="stylesheet" href="{{ url('frontend/userPanel/css/scrollable.css') }}" />

    <link rel="stylesheet" href="vendors/datatable/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="vendors/datatable/css/responsive.dataTables.min.css" />
    <link rel="stylesheet" href="vendors/datatable/css/buttons.dataTables.min.css" />

    <link rel="stylesheet" href="{{ url('frontend/userPanel/css/summernote-bs4.css') }}" />

    <link rel="stylesheet" href="{{ url('frontend/userPanel/css/morris.css') }}">

    <link rel="stylesheet" href="{{ url('frontend/userPanel/css/material-icons.css') }}" />

    <link rel="stylesheet" href="{{ url('frontend/userPanel/css/metisMenu.css') }}">

    <link rel="stylesheet" href="{{ url('frontend/userPanel/css/style1.css') }}" />
    <link rel="stylesheet" href="{{ url('frontend/userPanel/css/default.css') }}" id="colorSkinCSS">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body class="crm_body_bg">


    @include('frontend.pages.user_panel.fixed.navbar')

    <section class="main_content dashboard_part large_header_bg">

        @include('frontend.pages.user_panel.fixed.header')

        <div class="main_content_iner overly_inner ">
            <div class="container-fluid p-0 ">
                @yield('user_panel_content')
            </div>
        </div>

    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>



    <script src="{{ url('frontend/puserPanel/js/metisMenu.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('frontend/puserPanel/js/buttons.flash.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.5/perfect-scrollbar.min.js"></script>
    <script src="{{ url('frontend/puserPanel/scrollable-custom.js') }}"></script>

    <script src="{{ url('frontend/puserPanel/js/dashboard_init.js') }}"></script>
    <script src="{{ url('frontend/puserPanel/js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {{-- ajax setup --}}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }
        });
    </script>
    @stack('js')
</body>

</html>
