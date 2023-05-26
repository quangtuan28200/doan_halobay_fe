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
<section class="signup-collaborators py-5">
    <div class="container">
        <div class="row no-gutters overflow-hidden border radius-md bg-white">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="login-bg d-flex align-items-center justify-content-center h-100 w-100 radius-md px-5">
                    <img src="{{ asset('frontend/img/logo-main-white.png') }}" class="img-fluid w-100">
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="signup-collaborators-form p-5">
                    <h4 class="text-center text-primary font-sm-title mb-5">Đăng ký cộng tác viên</h4>
                    <form action="">
                        <div class="row no-gutters">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="px-1">
                                    <label class="matter-textfield-filled d-block error">
                                        <input type="text" placeholder=" " class="no-active-focus" name="full_name" />
                                        <span>Họ và tên <p class="text-danger d-inline-block mb-0">*</p></span>
                                    </label>
                                    <span class="hidden">Bạn chưa nhập họ và tên</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="px-1">
                                    <label class="matter-textfield-filled d-block">
                                        <input type="number" placeholder=" " class="no-active-focus" name="phone_number" />
                                        <span>Số điện thoại <p class="text-danger d-inline-block mb-0">*</p></span>
                                    </label>
                                    <span class="hidden">Bạn chưa nhập số điện thoại</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="px-1">
                                    <label class="matter-textfield-filled d-block">
                                        <input type="email" placeholder=" " class="no-active-focus" name="email" />
                                        <span>Email của bạn <p class="text-danger d-inline-block mb-0">*</p></span>
                                    </label>
                                    <span class="hidden">Bạn chưa nhập email</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="px-1">
                                    <label class="matter-textfield-filled d-block">
                                        <input type="password" placeholder=" " class="no-active-focus" name="password" />
                                        <span>Mật khẩu <p class="text-danger d-inline-block mb-0">*</p></span>
                                    </label>
                                    <span class="hidden">Bạn chưa nhập mật khẩu</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="px-1">
                                    <label class="matter-textfield-filled d-block">
                                        <input type="password" placeholder=" " class="no-active-focus" name="confirm_password" />
                                        <span>Nhập lại mật khẩu <p class="text-danger d-inline-block mb-0">*</p></span>
                                    </label>
                                    <span class="hidden">Bạn chưa nhập lại mật khẩu</span>
                                </div>
                            </div>
                            <!-- <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="px-1">
                                    <div class="input-group flex-nowrap signup-input-upload">
                                        <label class="matter-textfield-filled inputUploadNameLabel d-block w-100 border-right-0 mb-0">
                                            <input type="text" class="form-control border-right-0 inputUploadName" placeholder=" ">
                                            <span class="cardPersonText text-trim-line text-one-line">CMND hoặc thẻ căn cước <p class="text-danger d-inline-block mb-0">*</p></span>
                                        </label>
                                        <div class="input-group-append ml-0">
                                            <span class="input-group-text uploadPersonCardBtn mt-0">
                                                <i class="fal fa-cloud-upload text-primary"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <input type="file" class="inputCardPlace" multiple hidden name="file">
                                    <div class="card-info-upload-placeholder bg-gray radius-sm align-items-center justify-content-around flex-wrap p-1 mt-2">
                                    </div>
                                </div>
                                <span class="hidden">Bạn chưa nhập CMND hoặc thẻ căn cước</span>
                            </div> -->
                        </div>
                        <button type="button" class="btn btn-block btn-primary-gradient font-title font-17pt py-12px confirmSignupButton mt-5">Đăng ký</button>
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
    $('body').on('click', '.confirmSignupButton', function(e) {
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
        // const file_list = form.find('.inputCardPlace').prop('files');
        // const file = form.find('.inputCardPlace').prop('files')[0];
        // if (checkInput(form, file, 'file') === 0) error++;
        const data = new FormData();
        data.append('full_name', full_name);
        data.append('phone_number', phone_number);
        data.append('email', email);
        data.append('password', password);
        data.append('confirm_password', confirm_password);
        // for (let i = 0; i < file_list.length; i++) {
        //     data.append('files[]', file_list[i])
        // }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if (error == 0) {
            _this.attr("disabled", true);
            _this.html('<i class="fa fa-spinner fa-spin"></i> {{ __("Đang xử lý") }}');
            $.ajax({
                url: 'post_signup_collaborators',
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    _this.attr("disabled", false);
                    _this.html('Đăng ký');
                    if (response.data.status !== 200) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.data.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            text: response.data.message,
                        }).then(function() {
                            window.location.href = "{{ route('login') }}"
                        });
                    }
                }
            });
        }

    });
</script>
@endsection