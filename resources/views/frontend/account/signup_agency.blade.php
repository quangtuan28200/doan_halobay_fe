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
<section class="signup-agency py-5">
    <div class="container">
        <div class="row no-gutters overflow-hidden border radius-md bg-white">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="login-bg d-flex align-items-center justify-content-center h-100 w-100 radius-md px-5">
                    <img src="{{ asset('frontend/img/logo-main-white.png') }}" class="img-fluid w-100">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="signup-agency-form p-5">
                    <h4 class="text-center text-primary font-sm-title mb-5">Đăng ký đại lý</h4>
                    <form action="">
                        <div class="row no-gutters">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="px-1">
                                    <label class="matter-textfield-filled d-block">
                                        <input type="text" placeholder=" " class="no-active-focus" name="full_name"/>
                                        <span>Họ và tên <p class="text-danger d-inline-block mb-0">*</p></span>
                                    </label>
                                    <span class="hidden">Bạn chưa nhập họ và tên</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="px-1">
                                    <label class="matter-textfield-filled d-block">
                                        <input type="email" placeholder=" " class="no-active-focus" name="email"/>
                                        <span>Email của bạn <p class="text-danger d-inline-block mb-0">*</p></span>
                                    </label>
                                    <span class="hidden">Bạn chưa nhập email</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="px-1">
                                    <label class="matter-textfield-filled d-block">
                                        <input type="number" placeholder=" " class="no-active-focus" name="phone_number"/>
                                        <span>Số điện thoại <p class="text-danger d-inline-block mb-0">*</p></span>
                                    </label>
                                    <span class="hidden">Bạn chưa nhập số điện thoại</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="px-1">
                                    <label class="matter-textfield-filled d-block">
                                        <input type="text" placeholder=" " class="no-active-focus" name="company_name"/>
                                        <span>Tên công ty <p class="text-danger d-inline-block mb-0">*</p></span>
                                    </label>
                                    <span class="hidden">Bạn chưa nhập tên công ty</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="px-1">
                                    <label class="matter-textfield-filled d-block">
                                        <input type="text" placeholder=" " class="no-active-focus" name="position"/>
                                        <span>Chức vụ</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="px-1">
                                    <label class="matter-textfield-filled d-block">
                                        <input type="text" placeholder=" " class="no-active-focus" name="tax_code"/>
                                        <span>Mã số thuế</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="px-1">
                                    <label class="matter-textfield-filled d-block">
                                        <input type="password" placeholder=" " class="no-active-focus" name="password"/>
                                        <span>Mật khẩu <p class="text-danger d-inline-block mb-0">*</p></span>
                                    </label>
                                    <span class="hidden">Bạn chưa nhập mật khẩu</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="px-1">
                                    <label class="matter-textfield-filled d-block">
                                        <input type="password" placeholder=" " class="no-active-focus" name="confirm_password"/>
                                        <span>Nhập lại mật khẩu <p class="text-danger d-inline-block mb-0">*</p></span>
                                    </label>
                                    <span class="hidden">Bạn chưa nhập lại mật khẩu</span>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-block btn-primary-gradient confirmSignupButton font-title font-17pt py-12px mt-5">Đăng ký</button>
                    </form>
                   
                    <div class="w-85 mx-auto mt-5">
                        <div class="line-dash"></div>
                    </div>
                    <div class="text-center mt-4">Bạn đã có tài khoản? <a href="{{ route('login') }}" class="text-primary font-medium">Đăng nhập</a></div>
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
    $('body').on('click', '.confirmSignupButton', function(e){
        e.preventDefault();
        const _this = $(this);
        let error = 0; 
        const form = $(this).closest('form');
        const full_name = form.find('input[name=full_name]').val();
        if (checkInput(form, full_name, 'full_name') === 0) error++;
        const phone_number = form.find('input[name=phone_number]').val();
        if (checkInput(form, phone_number, 'phone_number') === 0) error++;
        const email = form.find('input[name=email]').val();
        if (checkInput(form, email, 'email') === 0) error++;
        const password = form.find('input[name=password]').val();
        if (checkInput(form, password, 'password') === 0) error++;
        const confirm_password = form.find('input[name=confirm_password]').val();
        if (checkInput(form, confirm_password, 'confirm_password') === 0) error++;
        const company_name = form.find('input[name=company_name]').val();
        if (checkInput(form, company_name, 'company_name') === 0) error++;
        const position = form.find('input[name=position]').val();
        const tax_code = form.find('input[name=tax_code]').val();
        const data = new FormData();
        data.append('full_name', full_name);
        data.append('phone_number', phone_number);
        data.append('email', email);
        data.append('password', password);
        data.append('confirm_password', confirm_password);
        data.append('company_name', company_name);
        data.append('position', position);
        data.append('tax_code', tax_code);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if (error == 0) {
            _this.attr("disabled", true);
            _this.html('<i class="fa fa-spinner fa-spin"></i> {{ __("Đang xử lý") }}');
            $.ajax({
                url: 'post_signup_agency',
                type: "POST",
                data:data,
                contentType : false,
                processData : false,
                success: function(response) {
                    _this.attr("disabled", false);
                    _this.html('Đăng ký');
                    if (response.data.status !== 200) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.data.message,
                        });
                    }else{
                        Swal.fire({
                            icon: 'success',
                            text: "Đăng ký thành công",
                        }).then( function () {
                            window.location.href = "{{ route('login') }}"
                        });
                       
                    }
                }
            });
        }
    });
</script>
@endsection