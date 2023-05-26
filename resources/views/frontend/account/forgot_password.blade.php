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
<section class="forgot-password py-5">
    <div class="container">
        <div class="row no-gutters overflow-hidden border radius-md bg-white">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="login-bg d-flex align-items-center justify-content-center h-100 w-100 radius-md px-5">
                    <img src="{{ asset('frontend/img/logo-main-white.png') }}" class="img-fluid w-100">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <form action="">
                    <div class="forgot-password-form p-5">
                        <h4 class="text-center text-primary font-sm-title mb-5">Quên mật khẩu</h4>
                        <label class="matter-textfield-filled d-block">
                            <input type="email" name="email" placeholder=" " class="no-active-focus" />
                            <span>Email của bạn <p class="text-danger d-inline-block mb-0">*</p></span>
                        </label>
                        <span class="hidden">Bạn chưa nhập email</span>
                        <button type="button" class="btn btn-block btn-primary-gradient font-title font-17pt py-12px mt-md-5 mt-lg-5 mt-xl-5 btn_submit">Tìm tài khoản</button>
                        <div class="space-bottom-line w-85 mx-auto pt-9">
                            <div class="line-dash"></div>
                        </div>
                        <div class="text-center mt-4">Bạn đã có tài khoản? <a href="{{ route('login') }}" class="text-primary font-medium">Đăng nhập</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('frontend/sweetalert2/sweetalert2.min.js') }}"></script>
<link rel="stylesheet" href="{{ asset('frontend/sweetalert2/sweetalert2.min.css') }}">
<script>
    $('body').on('click', '.btn_submit', function(e){
        e.preventDefault();
        const _this = $(this);
        let error = 0; 
        const form = $(this).closest('form');
        const email = form.find('input[name=email]').val();
        if (checkInput(form, email, 'email') === 0) error++;
        const data = new FormData();
        data.append('email', email);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if (error == 0) {
            _this.attr("disabled", true);
            _this.html('<i class="fa fa-spinner fa-spin"></i> {{ __("Đang xử lý") }}');
            $.ajax({
                url: '/post_forgot_pass',
                type: "POST",
                data:data,
                contentType : false,
                processData : false,
                success: function(response) {
                    _this.attr("disabled", false);
                    _this.html('Tìm tài khoản');
                    if (response.status !== 200) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    } else{
                        Swal.fire(
                            {
                            icon: 'success',
                            text: "Gửi email thành công",
                        }).then( function () {
                            //window.location.href = "{{ route('account_detail') }}"
                        });
                    }
                }
            });
        }
     
    });
</script>
@endsection