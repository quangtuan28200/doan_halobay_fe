@extends('frontend.layouts.layout')
@section('body')
<!-- <div class="account-menu container py-5">
    <div class="row row-medium-space ">
        <div class="col">
            <a href="/tai-khoan" class="account-menu-item font-title text-center text-decoration-none d-block radius-sm px-2 py-12px active">Tài khoản của tôi</a>
        </div>
        <div class="col">
            <a href="history-booking-hotel.html" class="account-menu-item font-title text-center text-decoration-none d-block radius-sm px-2 py-12px">Lịch sử đặt</a>
        </div>
        <div class="col">
            <a href="account-wishlist.html" class="account-menu-item font-title text-center text-decoration-none d-block radius-sm px-2 py-12px">Yêu thích</a>
        </div>
        <div class="col">
            <a href="account-rated.html" class="account-menu-item font-title text-center text-decoration-none d-block radius-sm px-2 py-12px">Bài đánh giá của tôi</a>
        </div>
        <div class="col">
            <a href="account-question-answer.html" class="account-menu-item font-title text-center text-decoration-none d-block radius-sm px-2 py-12px">Bài hỏi đáp của tôi</a>
        </div>
    </div>
</div> -->
<section class="account-info">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="account-info-item account-info-user">
                    <div class="account-info-item-toggle bg-white font-title font-18pt d-flex align-items-center justify-content-between cursor-pointer p-3" data-toggle="collapse" data-target="#accountInfoUser">
                        <span>Thông tin cá nhân</span>
                        <i class="fas fa-caret-right smooth-transition"></i>
                    </div>
                    <div class="collapse show" id="accountInfoUser">
                        <form action="">
                            <div class="account-info-item-content pt-2">
                                <!-- <div class="d-flex mb-3">
                                    <input type="file" class="upload-avatar-input" hidden>
                                    <img src="{{ asset('frontend/img/avatar-demo.jpg') }}" class="account-info-avatar border radius-md img-display-avatar object-fit-cover input-upload-hide mr-3">
                                    <div class="change-avatar radius-md bg-white text-center px-2 py-4">
                                        <i class="fas fa-camera text-primary font-20pt"></i>
                                        <div class="text-muted">Thay đổi ảnh đại diện</div>
                                    </div>
                                </div> -->
                                <div class="account-info-callpase-item d-flex align-items-center justify-content-between bg-white font-17pt mb-5px p-3">
                                    <div class="text-nowrap pr-2">Họ và tên</div>
                                    <div class="text-nowrap account-info-item-input">
                                        <input type="text" class="form-control font-medium no-active-focus text-right" name="full_name" value="{{ $user->fullName }}">
                                        <span class="hidden">Bạn chưa nhập họ và tên</span>
                                    </div>
                                </div>
                                <div class="account-info-callpase-item d-flex align-items-center justify-content-between bg-white font-17pt mb-5px p-3">
                                    <div class="text-nowrap pr-2">Email của bạn</div>
                                    <div class="text-nowrap account-info-item-input">
                                        <input type="text" class="form-control font-medium no-active-focus text-right" name="email" value="{{ $user->email }}">
                                        <span class="hidden">Bạn chưa nhập email</span>
                                    </div>
                                </div>
                                <div class="account-info-callpase-item d-flex align-items-center justify-content-between bg-white font-17pt mb-5px p-3">
                                    <div class="text-nowrap pr-2">Số điện thoại</div>
                                    <div class="text-nowrap account-info-item-input">
                                        <input type="number" class="form-control font-medium no-active-focus text-right" name="phone_number" value="{{ $user->phone }}">
                                        <span class="hidden">Bạn chưa nhập số điện thoại</span>
                                    </div>
                                </div>
                                <div class="account-info-callpase-item d-flex align-items-center justify-content-between bg-white font-17pt mb-5px p-3">
                                    <div class="text-nowrap pr-2">Tên công ty</div>
                                    <div class="text-nowrap account-info-item-input">
                                        <input type="text" class="form-control font-medium no-active-focus text-right" name="company_name" value="{{ $user->companyName }}">
                                        <span class="hidden">Bạn chưa nhập tên công ty</span>
                                    </div>
                                </div>
                                <div class="account-info-callpase-item d-flex align-items-center justify-content-between bg-white font-17pt mb-5px p-3">
                                    <div class="text-nowrap pr-2">Chức vụ</div>
                                    <div class="text-nowrap account-info-item-input">
                                        <input type="text" class="form-control font-medium no-active-focus text-right" name="position" value="{{ $user->position }}">
                                        <span class="hidden">Bạn chưa nhập chức vụ</span>
                                    </div>
                                </div>
                                <div class="account-info-callpase-item d-flex align-items-center justify-content-between bg-white font-17pt mb-5px p-3">
                                    <div class="text-nowrap pr-2">Mã số thuế</div>
                                    <div class="text-nowrap account-info-item-input">
                                        <input type="number" class="form-control font-medium no-active-focus text-right" name="tax_code" value="{{ $user->taxCode }}">
                                    </div>
                                </div>
                                <button class="ml-3 btn btn-primary-gradient save-info-button font-title py-2 col-sm-12 col-md-8 col-lg-5 mt-3">Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 mt-sm-3 mt-md-0">
                <div class="account-info-item account-type">
                    <div class="account-info-item-toggle bg-white font-title font-18pt d-flex align-items-center justify-content-between cursor-pointer p-3" data-toggle="collapse" data-target="#accountType">
                        <span>Loại tài khoản</span>
                        <i class="fas fa-caret-right smooth-transition"></i>
                    </div>
                    <div class="collapse" id="accountType">
                        <div class="account-info-item-content pt-2">
                            <div>
                                <div class="account-info-callpase-item d-flex align-items-center justify-content-between bg-white font-17pt p-3">
                                    <div class="text-nowrap">Loại tài khoản</div>
                                    <div class="text-nowrap font-title">Tài khoản đại lý</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account-info-item account-change-password mt-3">
                    <div class="account-info-item-toggle bg-white font-title font-18pt d-flex align-items-center justify-content-between cursor-pointer p-3" data-toggle="collapse" data-target="#accountChangePassword">
                        <span>Thay đổi mật khẩu đăng nhập</span>
                        <i class="fas fa-caret-right smooth-transition"></i>
                    </div>
                    <div class="collapse" id="accountChangePassword">
                        <form action="">
                            <div class="account-info-item-content pt-2">
                                <div class="account-info-callpase-item d-flex align-items-center justify-content-between bg-white font-17pt mb-5px p-3">
                                    <div class="text-nowrap pr-2">Mật khẩu hiện tại</div>
                                    <div class="text-nowrap account-info-item-input">
                                        <input type="password" name="password_old" class="form-control font-medium no-active-focus text-right">
                                        <span class="hidden">Bạn chưa nhập mật khẩu hiện tại</span>
                                    </div>
                                </div>
                                <div class="account-info-callpase-item d-flex align-items-center justify-content-between bg-white font-17pt mb-5px p-3">
                                    <div class="text-nowrap pr-2">Mật khẩu mới</div>
                                    <div class="text-nowrap account-info-item-input">
                                        <input type="password" name="password_new" class="form-control font-medium no-active-focus text-right">
                                        <span class="hidden">Bạn chưa nhập mật khẩu mới</span>
                                    </div>
                                </div>
                                <div class="account-info-callpase-item d-flex align-items-center justify-content-between bg-white font-17pt mb-5px p-3">
                                    <div class="text-nowrap pr-2">Nhập lại mật khẩu mới</div>
                                    <div class="text-nowrap account-info-item-input">
                                        <input type="password" name="confirm_password_new" class="form-control font-medium no-active-focus text-right">
                                        <span class="hidden">Bạn chưa nhập lại mật khẩu mới</span>
                                    </div>
                                </div>
                                <div class="text-right mt-3 px-3">
                                    <button type="button" class="btn btn-primary-gradient font-title py-2 col-sm-12 col-md-8 col-lg-5 confirm_change_pass">Xác nhận</button>
                                </div>
                            </div>
                        </form>
                    </div>
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
    $('input').on('change', function() {
        const type_input = $(this).attr('type');
        const form = $(this).closest('form');
        const param = $(this).val();
        const input_name = $(this).attr("name");
        if (type_input != 'file') checkInput(form, param, input_name);
    });
    const checkInputUpdateInfo = function(form, param, input_name) {
        if (param === "" || param === undefined) {
            form.find(`input[name=${input_name}]`)
                .next()
                .removeClass("hidden");
            form.find(`input[name=${input_name}]`)
                .next()
                .addClass("error_res");
            return 0;
        } else {
            form.find(`input[name=${input_name}]`)
                .next()
                .removeClass("error_res");
            form.find(`input[name=${input_name}]`)
                .next()
                .addClass("hidden");
            return 1;
        }
    };
    $('body').on('click', '.save-info-button', function(e) {
        e.preventDefault();
        const _this = $(this);
        let error = 0;
        const form = $(this).closest('form');
        const full_name = form.find('input[name=full_name]').val();
        if (checkInputUpdateInfo(form, full_name, 'full_name') === 0) error++;
        const phone_number = form.find('input[name=phone_number]').val();
        if (checkInputUpdateInfo(form, phone_number, 'phone_number') === 0) error++;
        const email = form.find('input[name=email]').val();
        if (checkInputUpdateInfo(form, email, 'email') === 0) error++;
        const company_name = form.find('input[name=company_name]').val();
        const position = form.find('input[name=position]').val();
        const tax_code = form.find('input[name=tax_code]').val();
        const file_avatar = form.find('.upload-avatar-input').prop('files');
        const data = new FormData();
        data.append('full_name', full_name);
        data.append('phone_number', phone_number);
        data.append('email', email);
        data.append('company_name', company_name);
        data.append('position', position);
        data.append('tax_code', tax_code);
        if (file_avatar != undefined) {
            data.append('file_avatar', file_avatar[0]);
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if (error == 0) {
            _this.attr("disabled", true);
            _this.html('<i class="fa fa-spinner fa-spin"></i> {{ __("Đang xử lý") }}');
            $.ajax({
                url: 'cap-nhat-tai-khoan',
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    _this.attr("disabled", false);
                    _this.html('Lưu thay đổi');
                    if (response.status !== 200) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            text: "Cập nhật thông tin thành công",
                        }).then(function() {
                            window.location.href = "{{ route('account_detail') }}"
                        });
                    }
                }
            });
        }

    });
    $('body').on('click', '.confirm_change_pass', function(e) {
        e.preventDefault();
        const _this = $(this);
        let error = 0;
        const form = $(this).closest('form');
        const password_old = form.find('input[name=password_old]').val();
        if (checkInputUpdateInfo(form, password_old, 'password_old') === 0) error++;
        const password_new = form.find('input[name=password_new]').val();
        if (checkInputUpdateInfo(form, password_new, 'password_new') === 0) error++;
        const confirm_password_new = form.find('input[name=confirm_password_new]').val();
        if (checkInputUpdateInfo(form, confirm_password_new, 'confirm_password_new') === 0) error++;
        const data = new FormData();
        data.append('password_old', password_old);
        data.append('password_new', password_new);
        data.append('confirm_password_new', confirm_password_new);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if (error == 0) {
            _this.attr("disabled", true);
            _this.html('<i class="fa fa-spinner fa-spin"></i> {{ __("Đang xử lý") }}');
            $.ajax({
                url: 'cap-nhat-mat-khau',
                type: "POST",
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    _this.attr("disabled", false);
                    _this.html('Xác nhận');
                    if (response.status !== 200) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    } else {
                        Swal.fire({
                            icon: 'success',
                            text: "Cập nhật mật khẩu mới thành công",
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