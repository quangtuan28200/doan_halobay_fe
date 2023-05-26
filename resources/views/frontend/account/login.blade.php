@extends('frontend.layouts.layout')
@section('body')
<style>
    .error_res {
        color: red;
    }

    .hidden {
        display: none;
    }
</style>
<section class="login py-5">
    <div class="container">
        <div class="row no-gutters overflow-hidden border radius-md bg-white">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="login-bg d-flex align-items-center justify-content-center h-100 w-100 radius-md px-5">
                    <img src="{{ asset('frontend/img/logo-main-white.png') }}" class="img-fluid w-100">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="login-form p-5">
                    <h4 class="text-center text-primary font-sm-title mb-5">Đăng nhập</h4>
                    <form action="">
                        <label class="matter-textfield-filled d-block">
                            <input type="email" placeholder=" " name="email" />
                            <span>Email của bạn <p class="text-danger d-inline-block mb-0">*</p></span>
                        </label>
                        <span class="hidden">Bạn chưa nhập email</span>
                        <label class="matter-textfield-filled d-block">
                            <input type="password" placeholder=" " name="password" />
                            <span>Mật khẩu <p class="text-danger d-inline-block mb-0">*</p></span>
                        </label>
                        <span class="hidden">Bạn chưa nhập mật khẩu</span>
                        <div class="d-flex align-items-center justify-content-between mt-4 mb-3">
                            <!-- <div class="remember-password-check">
                                <label class="matter-checkbox">
                                    <input type="checkbox" name="rememberMe">
                                    <span>Ghi nhớ mật khẩu</span>
                                </label>
                            </div> -->
                            <!-- <a href="{{ route('forgot_password') }}" class="text-primary d-block">Quên mật khẩu</a> -->
                        </div>
                        <button type="button" class="btn btn-block btn-primary-gradient font-title font-17pt py-12px">Đăng nhập</button>
                    </form>
                    <div class="w-85 mx-auto mt-5">
                        <div class="line-dash"></div>
                    </div>
                    <div class="text-center mt-4">Bạn chưa có tài khoản? <a href="{{ route('signup') }}" class="text-primary font-medium">Đăng ký</a></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('frontend/sweetalert2/sweetalert2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('frontend/sweetalert2/sweetalert2.min.css') }}">
<script>
    // $('input[name=rememberMe]').on('change', function() {
    //     this.value = this.checked ? true : false;
    // }).change();

    $('body').on('click', '.btn-block', function(e) {
        e.preventDefault();
        const _this = $(this);
        let error = 0;
        const form = $(this).closest('form');
        const email = form.find('input[name=email]').val();
        if (checkInput(form, email, 'email') === 0) error++;
        const password = form.find('input[name=password]').val();
        if (checkInput(form, password, 'password') === 0) error++;
        // const rememberMe = form.find('input[name=rememberMe]').val();
        const data = new FormData();
        data.append('email', email);
        data.append('password', password);
        data.append('rememberMe', false);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if (error == 0) {
            _this.attr("disabled", true);
            _this.html('<i class="fa fa-spinner fa-spin"></i> {{ __("Đang xử lý") }}');
            $.ajax({
                url: '/post_login',
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    _this.attr("disabled", false);
                    _this.html('Đăng nhập');
                    if (response.status !== 200) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "Thông tin đăng nhập chưa chính xác",
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            text: "Đăng nhập thành công",
                        }).then(function() {
                            window.location.href = "{{ route('account_detail') }}"
                        });
                    }
                }
            });
        }
    });
</script>
@endsection