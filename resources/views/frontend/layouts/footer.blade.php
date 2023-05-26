<footer>
    <div class="container">
        <hr>
        <div class="row footer-form overflow-hidden border radius-md no-gutters shadow-sm">
            <div class="col-sm-12 col-md-5 col-lg-4">
                <div class="footer-form-bg w-100 h-100"></div>
            </div>
            <div class="col-sm-12 col-md-7 col-lg-8">
                <div class="footer-form-container py-4 px-3">
                    <form action="">
                        <div>
                            <h5 class="font-title mb-2">Đăng ký nhận tin</h5>
                            để không bỏ lỡ các ưu đãi hấp dẫn mới nhất từ Halobay
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="form-group mb-0 mt-2">
                                    <label class="matter-textfield-filled d-block">
                                        <input type="text" placeholder=" " name="full_name" />
                                        <span>Tên của bạn</span>
                                    </label>
                                    <span class="hidden">Bạn chưa nhập tên</span>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <div class="form-group mb-0 mt-2">
                                    <label class="matter-textfield-filled d-block">
                                        <input type="email" placeholder=" " name="email" />
                                        <span>Email của bạn</span>
                                    </label>
                                    <span class="hidden">Bạn chưa nhập email</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <button type="button" class="btn btn-primary-gradient radius-md btn-block font-medium py-12px mt-2" id="btn-sign-up-notify">Đăng ký</button>
                            </div>
                        </div>
                    </form>

                    <!-- <p class="mt-3 mb-0">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    </p> -->
                </div>
            </div>
        </div>
        <div class="footer-link d-flex flex-wrap align-items-center justify-content-center py-4">
            @if ($menu_footer)
            @foreach ($menu_footer as $footer)
            @if ($footer->actionType == 1)
            <a href="{{ $footer->link }}" class="footer-link-item font-medium font-16pt text-decoration-none d-block text-dark px-md-2 px-lg-2 px-xl-2">
                {{ $footer->name }}
            </a>
            @else
            <a href="#" data-link="#booking-hotel" class="footer-link-item footer-link-action font-medium font-16pt text-decoration-none d-block text-dark px-md-2 px-lg-1 px-xl-1">
                {{ $footer->name }}
            </a>
            @endif
            @endforeach
            @endif
            <!-- <a href="payment-method.html" class="footer-link-item font-medium font-16pt text-decoration-none d-block text-dark px-md-2 px-lg-1 px-xl-1">
                Hình thức thanh toán
            </a>
            <a href="#" data-link="#booking-hotel" class="footer-link-item footer-link-action font-medium font-16pt text-decoration-none d-block text-dark px-md-2 px-lg-1 px-xl-1">
                Khách sạn
            </a>
            <a href="#" data-link="#booking-airplane" class="footer-link-item footer-link-action font-medium font-16pt text-decoration-none d-block text-dark px-md-2 px-lg-1 px-xl-1">
                Vé máy bay
            </a>
            <a href="#" data-link="#booking-tour" class="footer-link-item footer-link-action font-medium font-16pt text-decoration-none d-block text-dark px-md-2 px-lg-1 px-xl-1">
                Tour du lịch
            </a>
            <a href="#" data-link="#booking-seaplane" class="footer-link-item footer-link-action font-medium font-16pt text-decoration-none d-block text-dark px-md-2 px-lg-1 px-xl-1">
                Thủy phi cơ
            </a>
            <a href="#" data-link="#booking-yacht" class="footer-link-item footer-link-action font-medium font-16pt text-decoration-none d-block text-dark px-md-2 px-lg-1 px-xl-1">
                Du thuyền
            </a>
            <a href="#" data-link="#booking-combo" class="footer-link-item footer-link-action font-medium font-16pt text-decoration-none d-block text-dark px-md-2 px-lg-1 px-xl-1">
                Combo
            </a>
            <a href="#" class="footer-link-item font-medium font-16pt text-decoration-none d-block text-dark px-md-2 px-lg-1 px-xl-1">
                Fanpage
            </a>
            <a href="#" class="footer-link-item font-medium font-16pt text-decoration-none d-block text-dark px-md-2 px-lg-1 px-xl-1">
                Địa chỉ công ty
            </a>
            <a href="#" class="footer-link-item font-medium font-16pt text-decoration-none d-block text-dark px-md-2 px-lg-1 px-xl-1">
                Chính sách bảo mật
            </a>
            <a href="#" class="footer-link-item font-medium font-16pt text-decoration-none d-block text-dark px-md-2 px-lg-1 px-xl-1">
                Điều khoản sử dụng
            </a> -->
        </div>
        <div class="footer-bottom-info text-center pb-4">
            <div class="font-medium font-20pt mb-4">Công ty cổ phần Thương mại Dịch vụ <span class="text-uppercase">halobay</span></div>
            <img src="{{ asset('frontend/img/logo-main.png') }}" class="img-fluid footer-bottom-info-logo">
        </div>
    </div>
</footer>