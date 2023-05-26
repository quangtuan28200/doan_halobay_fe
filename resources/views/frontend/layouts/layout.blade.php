<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta id="token" name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('frontend/img/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('frontend/img/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('frontend/img/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('frontend/img/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('frontend/img/favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('frontend/img/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('frontend/img/favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('frontend/img/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/img/favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('frontend/img/favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('frontend/img/favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend/img/favicon/favicon-16x16.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('frontend/img/favicon/ms-icon-144x144.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/fontawesome.all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/matter.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/ion.rangeSlider.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/misc-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/main-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/bootstrap-select/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/sweetalert2/sweetalert2.min.css') }}">
    <title>HaloBay</title>
</head>

<body @if(!isset($is_background))class="bg-white" @endif>
    <div class="container-fluid">
        <div class="backdrop backdrop-toggle-event position-fixed"></div>
        <div class="overlay-loader position-fixed h-100 w-100">
            <div class="w-100 h-100 d-flex align-items-center justify-content-center flex-column">
                <div class="spinner-border text-light mb-2" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="text-white">Đang tải dữ liệu...</div>
            </div>
        </div>
        @include('frontend.layouts.header')
        @yield('body')
        <div class="backdrop backdrop-toggle-event position-fixed"></div>
        <div class="backdrop backdrop-modal position-fixed"></div>
        @include('frontend.layouts.footer')
        <div class="modal fade" id="saveInfoSuccessModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-0 overflow-hidden radius-md">
                    <div class="modal-body text-center font-18pt py-5">
                        <p class="mb-0">Lưu lại thành công</p>
                    </div>
                    <div class="modal-footer d-flex p-0">
                        <button class="btn btn-primary font-title btn-block rounded-0 m-0 py-3" data-dismiss="modal">Đồng ý</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery-3.5.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.fancybox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/ion.rangeSlider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/defaults-vi_VN.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.autocomplete.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/pretty-scroll.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/smooth-scroll.polyfills.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/js/accounting.js') }}"></script>
    <script src="{{ asset('frontend/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('frontend/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    @yield('scripts')
    <script>
        $('body').on('click', '#btn-sign-up-notify', function(e) {
            e.preventDefault();
            let error = 0;
            const form = $(this).closest('form');
            const email = form.find('input[name=email]').val();
            if (checkInput(form, email, 'email') === 0) error++;
            const full_name = form.find('input[name=full_name]').val();
            if (checkInput(form, full_name, 'full_name') === 0) error++;
            const data = new FormData();
            data.append('email', email);
            data.append('full_name', full_name);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if (error == 0) {
                $.ajax({
                    url: 'sign_up_notify',
                    type: "POST",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.data.status == 200 || response.data.status == 201) {
                            Swal.fire({
                                icon: 'success',
                                text: "Đăng ký nhận thông báo thành công",
                            }).then(function() {
                                form.find('input[name=email]').val('');
                                form.find('input[name=full_name]').val('');
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.data.message,
                            });
                        }
                    }
                });
            }

        });

        // $(document).ready(function(){
        //     let url = window.location.href;
        //     $('.nav-link').each(function() {
        //         if (this.href === url) {
        //             $(this).addClass('active');
        //         }
        //     });

        //     $('.nav-link').click(function (e) { 
        //         $('.nav-link').removeClass('active');
        //         $(this).addClass('active');
        //     });
        // });
    </script>
</body>

</html>